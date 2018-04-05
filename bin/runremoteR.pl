#! /usr/bin/perl -w

use warnings;
use DBI;
use strict;
use Cwd;
use List::Util 'first';

sub trim;

#declare path
my $path=cwd();

#get db config
my $db_host;
my $db_username;
my $db_password;

#read database login information from geneck.inc
open(IN_DATABASE, "../../../dbincloc/geneck1.inc") || die("The file geneck.inc is required. \n");
while(my $line = <IN_DATABASE>)
{
	chomp($line);

	if(lc(substr($line, 0, 4)) eq "host")
	{
		$db_host = trim(substr($line, 5));
		next;
	}

	if(lc(substr($line, 0, 8)) eq "username")
	{
		$db_username = trim(substr($line, 9));
		next;
	}

	if(lc(substr($line, 0, 8)) eq "password")
	{
		$db_password = trim(substr($line, 9));
	}
}
close(IN_DATABASE);

# connect to database
my $dbh = DBI->connect('DBI:mysql:geneNetwork;host=' . $db_host, $db_username, $db_password)
	           or die "Can't connect: " . DBI->errstr();

# Get jobid which has not been dealt with
my $sth1 = $dbh->prepare("SELECT JobID, userName,Email,GeneExpression,HubGenes,Method,Param,Param_2 FROM Jobs WHERE Status = 0 order by CreateTime desc LIMIT 1")
			or die("Prepare of SQL failed" . $dbh->errstr());
$sth1->execute();
my @result1 = $sth1->fetchrow_array();

$sth1->finish();

# if no available job id is found in database, the perl code will stop
if($#result1 eq -1)
{
    $dbh->disconnect();
	die "No new job id is found in database!\n"
}

my $jobid = $result1[0];
my $username = $result1[1];
my $email = $result1[2];
my $geneExpression = $result1[3];
my $hubGenes = $result1[4];
my $method = $result1[5];
my $param = $result1[6];
my $param_2 = $result1[7];

my $stm0 = $dbh->prepare("update Jobs set Status = 1 where JobID = '" . $jobid . "';");
$stm0->execute();
$stm0->finish();
$dbh->disconnect();

print "***Runnning new job " . $jobid . " using methods " . $method . "\n";

#Create a file and print $geneExpression data from DB into the file
my $filename = $path . '/../data/expr.' . $jobid . '.csv';
open(my $fh, '>', $filename) or die "Could not open file '$filename' $!";
print $fh $geneExpression;
close $fh;
print "Read sample input done\n";


# --------------------------------  run program  --------------------------------------
# Pass different parameters to R files based on method index
my @int_array       = qw( 1 2 3 4 5 6 7 11);
my @int_array2      = qw( 8 9 );
my @int_array3      = qw( 10 );
if(first {$_ == $method} @int_array){
    system("Rscript master.R " . $jobid . " " . $method . " " . $param);
}
elsif(first {$_ == $method} @int_array2){
    system("Rscript master.R " . $jobid . " " . $method . " " . $param . " -b " . $hubGenes . " -p " . $param_2);
}
elsif(first {$_ == $method} @int_array3){
    system("Rscript master.R " . $jobid . " " . $method . " " . $param . " -p " . $param_2);
}
else{
    print "Fail to call and send parameters to R file";
}

#-------------------------------- write back to database------------------------------
#pass the result csv file to createjson.pl to generate jason file
my $resultcsv = $path . '/../data/est_edge.' . $jobid . '.csv';
my $jsonfile = $path . '/../data/est_edge.' . $jobid . '.json';
my $testnumber = 0;
if(first {$_ == $method} @int_array){
    system('perl', 'createjson.pl', $resultcsv);
}
elsif(first {$_ == $method} @int_array2){
    system('perl', 'createjson.pl', $resultcsv, $hubGenes);
}
elsif(first {$_ == $method} @int_array3){
    system('perl', 'createjson.pl', $resultcsv);
}
else{
    print "Fail to call and send parameters to R file";
}

#The program is going to wait 15 seconds, and every 3 second it will check if result csv file and jason file have been generated
while(((! -e $resultcsv)||(!-e $jsonfile)) && $testnumber < 5){
			sleep 3;
			$testnumber++;
}

#if one of the files is failed to generate, it will update the statue in Jobs table to 3 (failed to generate gene network)
if($testnumber==5){
    my $dbh = DBI->connect('DBI:mysql:geneNetwork;host=' . $db_host, $db_username, $db_password)
    	           or die "Can't connect: " . DBI->errstr();
    my $stm0 = $dbh->prepare("update Jobs set Status = 3 where JobID = '" . $jobid . "';");
    $stm0->execute();
    $stm0->finish();
    $dbh->disconnect();
}

#If two files are successfully generated, it reads the data into a stream
else{
    open FILE, $resultcsv;
    open FILE2, $jsonfile;
    my $resultFile;
    my $buff1;
    while(read FILE, $buff1, 1024) {
      		$resultFile .= $buff1;
    }
    close FILE;
    my $resultjsonFile;
    my $buff2;
    while(read FILE2, $buff2, 1024) {
      		$resultjsonFile .= $buff2;
    }
    close FILE2;

#insert two files into Results table
    my $dbh = DBI->connect('DBI:mysql:geneNetwork;host=' . $db_host, $db_username, $db_password)
        	            or die "Can't connect: " . DBI->errstr();
    my $stm = $dbh->prepare("insert into Results (JobID, EstEdge_csv, EstEdge_json) values (?, ?, ?);");
    $stm->bind_param(1, $jobid);
    $stm->bind_param(2, $resultFile, DBI::SQL_BLOB);
    $stm->bind_param(3, $resultjsonFile, DBI::SQL_BLOB);
    $stm->execute();
    $stm->finish();

#update status in Jobs table to 2 (successfully generate gene network)
    my $stm1 = $dbh->prepare("update Jobs set Status = 2, FinishTime = now() where JobID = '" . $jobid . "';");
	$stm1->execute();
	$stm1->finish();
	$dbh->disconnect();
}
#-------------------------------- Delete all temp files------------------------------
unlink($resultcsv);
unlink($jsonfile);
unlink($filename);
unlink($path . '/../data/tmp_message.' . $jobid . '.txt');

sub trim($)
{
	my $string = shift;
	$string =~ s/^\s+//;
	$string =~ s/\s+$//;
	return $string;
}

