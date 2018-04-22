## 1. Add sql to RemoteR database 
- use program/db_sql/geneck.sql.txt to add to RemoteR database on server

## 2. Add R packages
- install.packages('argparse', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('corpcor', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('GeneNet', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('CDLasso', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('glasso', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('space', dependencies=TRUE, repos='http://cran.rstudio.com/')
- install.packages('statmod', dependencies=TRUE, repos='http://cran.rstudio.com/')
- R CMD INSTALL 'espace_0.1.tar.gz' (this file is located program/R_Installation_Packages)

## 3. Move db connection file to /var/www/dbincloc/
- move program/db_file/geneck.inc to /var/www/dbincloc/
- 
## 4. RemoteR settings
- Copy program/RemoteR/geneck to RemoteR directory on server
- Append runremoter.pl under RemoteR directory on server by
```perl
if($software eq "geneck") {

    require "geneck/geneck.pl";

    geneck($jobid, $analysis);}
```

## 5. Copy geneck website files to /var/www/html/geneck
- After the copy, remove the filefold 'program'