<?php
require_once('util.php');
include "../../dbincloc/geneck.inc";

//open the database connection
$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn -> connect_error) {
    die('Unable to connect to database: ' . $db_conn -> connect_error);
}

if (isset($_GET['jobid'])) {
    $jobid = util::clean($_GET['jobid']);
}

header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=geneNetwork.csv");
header("Content-Description: Gene Network Result");
header("Content-transfer-encoding: binary");

if(!empty($jobid) && $result = $db_conn->prepare("SELECT EstEdge_csv FROM GeneckResults WHERE JobID = ?"))
{
    $result->bind_param("s", $jobid);
    $result->execute();
    $result->store_result();
    $result->bind_result($resultgene);
    $result->fetch();

    echo $resultgene;

    $result->close();
}

$db_conn->close();