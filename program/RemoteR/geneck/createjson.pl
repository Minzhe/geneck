#! /usr/bin/perl -w

use strict;
use List::Util qw[min max];

# -------------------------- parameters ------------------------- #
my $maxdegree = 1;
my $connectivityratio = 0.95;
my $minconnectivity = 4;

my $sourcefile = "";
my $jasonfile = "";
my $hubgenes = "";
my $num_args = $#ARGV + 1;

# get parameter1 source file from system call
$sourcefile = $ARGV[0];

# get parameter 2 hubgene variable
if($num_args > 1){
    $hubgenes = $ARGV[1];
}

#store hubgene in an array
my @hubgenelist = split /,/, $hubgenes;

# create a jason file with same name of source file
$jasonfile = $sourcefile;
substr($jasonfile,-3,4) = "json";


# ----------------------- read files -------------------------- #
open(IN, $sourcefile) || die("cannot open the source file\n");
open(OUT, '>', $jasonfile);

# create a hash table to store gene name and index
my %ht_links = ();
my %ht_nodes = ();
<IN>;

# read source file line by line
while(my $line = <IN>) {
	# remove characters at the end of strings
	chomp($line);

	# remove double quotation
	$line =~ s/"//ig;

	# split each gene name by comma and store in an array
	my @arr = split /,/, $line;

	if(!$ht_links{$arr[0]} || $ht_links{$arr[0]} eq "") {
    	$ht_links{$arr[0]} = "\"" . $arr[1] . "\"";
		if(!$ht_links{$arr[1]}) {
			$ht_links{$arr[1]} = "";
    	}
  	} elsif(!$ht_links{$arr[1]} || $ht_links{$arr[1]} eq "") {
    	$ht_links{$arr[1]} = "\"" . $arr[0] . "\"";
	} else {
		$ht_links{$arr[0]} = $ht_links{$arr[0]} . ",\"" . $arr[1] . "\"";
  	}

	if(!$ht_nodes{$arr[0]}) {
    	$ht_nodes{$arr[0]} = 1;
  	} else {
    	$ht_nodes{$arr[0]} = $ht_nodes{$arr[0]} + 1;
	}

  	if(!$ht_nodes{$arr[1]}) {
		  $ht_nodes{$arr[1]} = 1;
  	} else {
    	$ht_nodes{$arr[1]} = $ht_nodes{$arr[1]} + 1;
	}
}

foreach my $mykey (keys %ht_nodes) {
	if($ht_nodes{$mykey} > $maxdegree) {
    	$maxdegree = $ht_nodes{$mykey};
	}
}

print OUT "[\n";

# -------------------------- add gene category ------------------------- #
my $isfirstnode = 1;

foreach my $mykey (keys %ht_links) {
	if ($isfirstnode) {
    	print OUT "\t{\n";
    	$isfirstnode = 0;
  	} else {
    	print OUT "\t}, {\n";
  	}

  	print OUT "\t\t\"type\": ";
  	if (grep {$_ eq $mykey} @hubgenelist) {
		print OUT "\"Hub gene (user specified)\",\n";
  	} elsif ($ht_nodes{$mykey} >= max($maxdegree * $connectivityratio, $minconnectivity)) {
		print OUT "\"Hub gene\",\n";
	} else {
    	print OUT "\"Gene\",\n";
  	}

	print OUT "\t\t\"name\": ";
	print OUT "\"" . $mykey . "\",\n";

	print OUT "\t\t\"depends\": [";
	print OUT $ht_links{$mykey};
	print OUT "]\n";
}

print OUT "\t}\n]";

close(IN);
close(OUT);