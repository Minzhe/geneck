####################################################################################
## Project: Geneck Program
## Input: JobID, Analysis(i.e. method)
## Output: generate and save to database
##	   a) JSON file for web visualization
##	   b) csv file for web download
## Author: Minzhe Zhang
## Date:  04/09/2018

## Please put the update history of script here
######################################################################################

#! /usr/bin/perl -w

use strict;
use List::Util 'first';

# get word directory
my $path = $ENV{'remoter_path'}."geneck";
# get db config
my $db_host = $ENV{'remoter_host'};
my $db_username = $ENV{'remoter_usr'};
my $db_password = $ENV{'remoter_passwd'};
my $db_dbname = $ENV{'remoter_db'};

my $STATUS_NEWJOB = 0;
my $STATUS_SUCCESS = 1;
my $STATUS_PROCESSING = 2;
my $STATUS_FAIL = 9;


##########################################
## nomogram wang2
## input: job ID
## output: all of results are saved to DB
##########################################
sub geneck
{
		my($jobid, $method) = @_;

		if($jobid eq "" || $method eq ""){exit;}

		my @parameters = getparameters($jobid);

    #get parameters
    my $geneExpression = $parameters[0];
    my $hubGenes = $parameters[1];
    my $param = $parameters[2];
    my $param_2 = $parameters[3];

    #remove " amd '
    $hubGenes =~ s/'//g;
    $hubGenes =~ s/"//g;
    $param =~ s/'//g;
    $param =~ s/"//g;
    $param_2 =~ s/'//g;
    $param_2 =~ s/"//g;

    changestatus($jobid, $STATUS_PROCESSING);

		#Create a file and print $geneExpression data from DB into the file
    my $filename = $path . '/expr.' . $jobid . '.csv';
    open(my $fh, '>', $filename) or die "Could not open file '$filename' $!";
    print $fh $geneExpression;
    close $fh;

    # --------------------------------  run program  --------------------------------------
    # Pass different parameters to R files based on method index
    my @int_array       = qw( 1 2 3 4 5 6 7 11);
    my @int_array2      = qw( 8 9 );
    my @int_array3      = qw( 10 );
    if(first {$_ == $method} @int_array){
        system("Rscript " . $path . "/master.R '" . $jobid . "' '" . $method . "' '" . $param . "'");
    }
    elsif(first {$_ == $method} @int_array2){
        system("Rscript " . $path . "/master.R '" . $jobid . "' '" . $method . "' '" . $param . "' -b '" . $hubGenes . "' -p '" . $param_2 . "'");
    }
    elsif(first {$_ == $method} @int_array3){
        system("Rscript " . $path . "/master.R '" . $jobid . "' '" . $method . "' '" . $param . "' -p '" . $param_2 . "'");
    }
    else{
        print "Fail to call and send parameters to R file";
    }

    #-------------------------------- write back to database------------------------------
    #pass the result csv file to createjson.pl to generate jason file
    my $resultcsv = $path . '/est_edge.' . $jobid . '.csv';
    my $jsonfile = $path . '/est_edge.' . $jobid . '.json';
    my $testnumber = 0;
    if(first {$_ == $method} @int_array){
        system('perl', $path . '/createjson.pl', $resultcsv);
    }
    elsif(first {$_ == $method} @int_array2){
        system('perl', $path . '/createjson.pl', $resultcsv, $hubGenes);
    }
    elsif(first {$_ == $method} @int_array3){
        system('perl', $path . '/createjson.pl', $resultcsv);
    }
    else{
        print "Fail to call and send parameters to R file";
    }
    
    #The program is going to wait 15 seconds, and every 3 second it will check if result csv file and jason file have been generated
    while(((! -e $resultcsv)||(!-e $jsonfile)) && $testnumber < 5){
      		sleep 3;
    			$testnumber++;
    }
    
    #if one of the files is failed to generate, it will update the statue in Jobs table to 9 (failed to generate gene network)
    if($testnumber==5){
        changestatus($jobid, $STATUS_FAIL);
  		  exit;
    }
    #If two files are successfully generated, it reads the data into a stream
    else{
        open FILE, $resultcsv or die("cannot open result csv file\n");
        open FILE2, $jsonfile or die("cannot open result csv file\n");
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
        my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
  		                or die "Can't connect: " . DBI->errstr();
        my $stm = $dbh->prepare("insert into GeneckResults (JobID, EstEdge_csv, EstEdge_json) values (?, ?, ?);");
        $stm->bind_param(1, $jobid);
        $stm->bind_param(2, $resultFile, DBI::SQL_BLOB);
        $stm->bind_param(3, $resultjsonFile, DBI::SQL_BLOB);
        $stm->execute();
        $stm->finish();
    	  $dbh->disconnect();

        # change job status as success
        changestatus($jobid, $STATUS_SUCCESS);
    }
    #-------------------------------- Delete all temp files------------------------------
    unlink($resultcsv);
    unlink($jsonfile);
    unlink($filename);
    unlink($path . '/tmp_message.' . $jobid . '.txt');
}

###########################################################################################
## Below are the private methods for public methods above
###########################################################################################


## Get the parameters by JOBID
sub getparameters
{
	my($jobid) = @_;

	# connect to database
	my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
			   or die "Can't connect: " . DBI->errstr();

	# Get jobid which has not been dealt with
	my $sth1 = $dbh->prepare("SELECT GeneExpression, HubGenes, Param, Param_2 FROM GeneckParameters where JobID = \"". $jobid ."\"")
				or die("Prepare of SQL failed" . $dbh->errstr());
	$sth1->execute();
	my @result1 = $sth1->fetchrow_array();

	$sth1->finish();
	$dbh->disconnect();

	return @result1;
}

sub trim($)
{
    my $string = shift;
    $string =~ s/^\s+//;
    $string =~ s/\s+$//;
    return $string;
}
