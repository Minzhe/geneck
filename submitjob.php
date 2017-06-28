<?php
// ****************  define function  *******************
function cleanInput($inputStr) {
    $inputStr = trim($inputStr);
    $inputStr = stripcslashes($inputStr);
    $inputStr = htmlspecialchars($inputStr);
    return $inputStr;
}

// ----------- check upload file size -------------
if ($_FILES['expression_data']['size'] > 0) {
    $expression_path = $_FILES['expression_data']['tmp_name'];
    $expr_data = file_get_contents($expression_path);
    echo $expr_data . "<br>";
}

// ------------ hub genes -------------
if (isset($_POST['hubgenes'])) {
    $hubgenes = cleanInput($_POST['hubgenes']);
}

// ------------- get method --------------
$method = $_POST['method'];
echo $method . "<br>";

// ----------- check parameters -----------------
if (isset($_POST['fdr'])) {
    $fdr = $_POST['fdr'];
    echo $fdr;
}

if (isset($_POST['lambda'])) {
    $lambda = $_POST['lambda'];
    echo $lambda;
}

// ------------ check name organization and email --------------
$username = cleanInput($_POST['username']);
$organization = cleanInput($_POST['organization']);
$email = cleanInput($_POST['email']);
echo $username . " " . $organization . " " . $email . "<br>";

// ----------- prepare connect to database --------------
include "../../dbincloc/geneck.inc";

$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn -> connect_error) {
    die('Unable to connect to database: ' . $db_conn -> connect_error);
}

// -------------- insert into database ---------------
$jobid = uniqid("", True);
$hubgenes = '111';
$fdr = 0.1;
$lambda = 0.2;
$createtime = date("Y-m-d H:i:s");
if ($stmt = $db_conn -> prepare("INSERT INTO Jobs (JobID, Status, UserName, Organization, Email, GeneExpression, HubGenes, Method, FDR, Lambda, CreateTime) VALUES (?, 0, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
    $stmt -> bind_param("ssssbssdds", $jobid, $username, $organization, $email, $expr_data , $hubgenes, $method, $fdr, $lambda, $createtime);
    $stmt -> execute();
    $stmt -> close();
}

$db_conn -> close();
?>