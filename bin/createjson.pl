#! /usr/bin/perl -w

use strict;

my $sourcefile = "";
my $jasonfile = "";
my $hubgenes = "";
my $num_args = $#ARGV + 1;

#get parameter1 source file from system call
$sourcefile = $ARGV[0];

#get parameter 2 hubgene variable
if($num_args > 1){
    $hubgenes = $ARGV[1];
}

#create a jason file with same name of source file
$jasonfile = $sourcefile;
substr($jasonfile,-3,4) = "json";

open(IN, $sourcefile) || die("cannot open the source file\n");
open(OUT, '>', $jasonfile);

#store hubgene in an array
my @hubgenelist = split /,/, $hubgenes;

#start to write jason data in jasonfile
print OUT "{\"type\": \"force\", ";
print OUT "\"categories\": [";
print OUT "{\"name\": \"gene\", \"keyword\": {}, \"base\": \"gene\"}";
if($hubgenes ne ""){
	print OUT ", {\"name\": \"hub gene\", \"keyword\": {}, \"base\": \"hub gene\"}";
}
print OUT "], ";
print OUT "\"nodes\": [";

my $ishead = 0;
my $index = 1;

#create a hash table to store gene name and index
my %ht_genelist = ();
<IN>;

#read source file line by line
while(my $line = <IN>){

    #remove characters at the end of strings
	chomp($line);

	#remove double quotation
	$line =~ s/\"//g;

	#split each gene name by comma and store in an array
	my @arr = split /,/, $line;

    #filter our reduplicative gene name and store new gene name with index in the first column of source file
	if(!$ht_genelist{$arr[0]}){
		if($ishead != 0){
			print OUT "}, ";
		}
		else{
			$ishead = 1;
		}

		print OUT "{\"name\": \"" .$arr[0] ."\", ";
		print OUT "\"value\": 1, ";
		print OUT "\"category\": ";

        #check if the current gene name is in hub gene list
		if (grep { $_ eq $arr[0] } @hubgenelist){

		    #if it returns true, print 1 in category
			print OUT "1";
		}
		else{

		    #if it returns false, print 0 in category
			print OUT "0";
		}

		$ht_genelist{$arr[0]} = $index;
		$index++;
	}

    #filter our reduplicative gene name and store new gene name with index in the second column of source file
	if(!$ht_genelist{$arr[1]}){
		if($ishead != 0){
			print OUT "}, ";
		}
		else{
			$ishead = 1;
		}

		print OUT "{\"name\": \"" .$arr[1] ."\", ";
		print OUT "\"value\": 1, ";
		print OUT "\"category\": ";

        #check if the current gene name is in hub gene list
		if (grep { $_ eq $arr[1] } @hubgenelist){

		    #if it returns true, print 1 in category
			print OUT "1";
		}
		else{

		    #if it returns false, print 0 in categor
			print OUT "0";
		}
		
		$ht_genelist{$arr[1]} = $index;
		$index++;
	}
}

print OUT "}], ";
print OUT "\"links\": [";
close(IN);

#reopen source file
open(IN, "$sourcefile") || die("cannot open the source file\n");
<IN>;

while(my $line = <IN>){
	chomp($line);
	$line =~ s/\"//g;
    my @ar2 = split /,/, $line;
	if($ishead != 1){
			print OUT "}, ";
	}
	else{
			$ishead = 0;
	}

	#compare two gene indexs, make source equal to smaller index and target equal to greater index
	if($ht_genelist{$ar2[0]} < $ht_genelist{$ar2[1]}){
	    print OUT "{\"source\": ".($ht_genelist{$ar2[0]}-1).", ";
	    print OUT "\"target\": ".($ht_genelist{$ar2[1]}-1)."";
	}
	if($ht_genelist{$ar2[0]} > $ht_genelist{$ar2[1]}){
        print OUT "{\"source\": ".($ht_genelist{$ar2[1]}-1).", ";
		print OUT "\"target\": ".($ht_genelist{$ar2[0]}-1)."";
    }
}
print OUT "}]}";
close(IN);
close(OUT);

