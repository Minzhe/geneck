<?php
// ****************  define function  *******************
function cleanInput($inputStr) {
    $inputStr = trim($inputStr);
    $inputStr = stripcslashes($inputStr);
    $inputStr = htmlspecialchars($inputStr);
    return $inputStr;
}


// **************  methods  **********************
$source = $_POST['method'];
if ($source == 'GeneNet') {
    $method = 1;
} elseif ($source == 'ns') {
    $method = 2;
} elseif ($source == 'glasso') {
    $method = 3;
} elseif ($source == 'glassosf') {
    $method = 4;
} elseif ($source == 'pcacmi') {
    $method = 5;
} elseif ($source == 'cmi2ni') {
    $method = 6;
} elseif ($source == 'space') {
    $method = 7;
} elseif ($source == 'eglasso') {
    $method = 8;
} elseif ($source == 'espace') {
    $method = 9;
} else {
    echo 'methods error: ' . $source . "<br>";
}


// ************** gene expression data & hub genes *****************
// ------- check upload file size ----------
if ($_FILES['expression_data']['size'] > 0) {
    $expression_path = $_FILES['expression_data']['tmp_name'];
    $expr_data = file_get_contents($expression_path);
} else {
    echo "<script>location.href='$source.php?isNoDataFile=1'</script>";
}

// ------------ hub genes -------------
if (isset($_POST['hubgenes'])) {
    echo $_POST['hubgenes'] . "<br>";
    $hubgenes = cleanInput($_POST['hubgenes']);
    echo $hubgenes . "<br>";
}




// ----------- check parameters -----------------
$fdr = NULL;
$lambda = NULL;
if (isset($_POST['fdr'])) {
    $fdr = $_POST['fdr'];
}

if (isset($_POST['lambda'])) {
    $lambda = $_POST['lambda'];
}


// ********************  insert into database  *************************
// ------------ check name organization and email --------------
$username = cleanInput($_POST['username']);
$organization = cleanInput($_POST['organization']);
$email = cleanInput($_POST['email']);

// ----------- prepare connect to database --------------
include "../../dbincloc/geneck.inc";

$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn -> connect_error) {
    die('Unable to connect to database: ' . $db_conn -> connect_error);
}

// -------------- insert into database ---------------
$jobid = uniqid("", True);
$status = 0;
$createtime = date("Y-m-d H:i:s");
$null = NULL;
if ($stmt = $db_conn -> prepare("INSERT INTO Jobs (JobID, Status, UserName, Organization, Email, GeneExpression, HubGenes, Method, FDR, Lambda, CreateTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
    $stmt -> bind_param("sisssbsidds", $jobid, $status, $username, $organization, $email, $null , $hubgenes, $method, $fdr, $lambda, $createtime);
    $stmt -> send_long_data(5, $expr_data);
    $stmt -> execute();
    $stmt -> close();
}
$db_conn -> close();
?>