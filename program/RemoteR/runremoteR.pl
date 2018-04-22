#######################################################################################
## RemoteR framework
##  	a) Check new job in db; 
## 	b) read new job parameter from db; 
## 	c) call R analysis script; 
## 	d) save calculation results in db
## Author: Bo Yao, Shin-yi Lin, Danni Luo
## Date: 09/18/2017
##
## Record change history of this script here
#######################################################################################

#! /usr/bin/perl -w

use warnings;
use DBI;
use strict;

require "utilities.pl";

my $STATUS_NEWJOB = 0;
my $STATUS_SUCCESS = 1;
my $STATUS_PROCESSING = 2;
my $STATUS_FAIL = 9;

# set the max number of R script processes in memory
# default value: 2

# if 

# get db config
my $db_host = $ENV{'remoter_host'};
my $db_username = $ENV{'remoter_usr'};
my $db_password = $ENV{'remoter_passwd'};
my $db_dbname = $ENV{'remoter_db'};

# connect to database
my $dbh = DBI->connect('DBI:mysql:' . $db_dbname . ';host=' . $db_host, $db_username, $db_password)
	           or die "Can't connect: " . DBI->errstr();

# Get jobid which has not been dealt with
my $sth1 = $dbh->prepare("SELECT JOBID, Analysis, Software FROM Jobs where status = ". $STATUS_NEWJOB ." order by CreateTime limit 1")
			or die("Prepare of SQL failed" . $dbh->errstr());
$sth1->execute();
my @result1 = $sth1->fetchrow_array();

$sth1->finish();
$dbh->disconnect();

# if no available job id is found in database, the perl code will stop
if($#result1 eq -1)
{
	exit;
}

my $jobid = $result1[0];
my $analysis = $result1[1];
my $software = $result1[2];


# survivalanalysis - lung cancer explorer
if($analysis eq "survivalanalysis" && $software eq "lungcancerportal")
{
	require "lce/lce.pl";

	lce_survivalanalysis($jobid);	
}

if($analysis eq "metaanalysis" && $software eq "lungcancerportal")
{
	require "lce/lce.pl";

	lce_metaanalysis($jobid);
}

if($analysis eq "comparativeanalysis" && $software eq "lungcancerportal")
{
	require "lce/lce.pl";

	lce_compaanalysis($jobid);
}

if($analysis eq "coexpanalysis" && $software eq "lungcancerportal")
{
	require "lce/lce.pl";

	lce_coexpanalysis($jobid);
}

# software: sclcnomogram   ------ start -------
if($software eq "sclcnomogram") {

	if($analysis eq 'wang2')
	{
	    require "sclcnomogram/sclc.pl";
	    nomogram_wang2($jobid);
	}

    if($analysis eq 'pan')
    {
        require "sclcnomogram/sclc.pl";
        nomogram_pan($jobid);
    }

    if($analysis eq 'xiao')
    {
        require "sclcnomogram/sclc.pl";
        nomogram_xiao($jobid);
    }
    
    if($analysis eq 'xie1')
    {
        require "sclcnomogram/sclc.pl";
        nomogram_xie1($jobid);
    }

    if($analysis eq 'xie2')
    {
         require "sclcnomogram/sclc.pl";
         nomogram_xie2($jobid);
    }

}
# software: sclcnomogram   ------ end -------

# software: geneck   ------ start -------
if($software eq "geneck") {

    require "geneck/geneck.pl";

    geneck($jobid, $analysis);

}
# software: geneck   ------ end -------
