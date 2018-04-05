#!/bin/bash

alwaystrue=1

#it is always true in order to enable timejob.sh run all the time
while [ $alwaystrue -lt 2 ]
do
	perl /home/danni/public_html/geneck/bin/runremoteR.pl

	echo "start sleep 6s..."
	sleep 6
	echo "end sleep"
done


