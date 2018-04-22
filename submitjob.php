<?php
require("class.phpmailer.php");
require_once('util.php');

$email = "";
$hubgenes = "";
$username = isset($_POST['username'])?util::clean($_POST['username']):"";
$organization = isset($_POST['organization'])?util::clean($_POST['organization']):"";

/*********************************************************************************/
/* Define function                                                               */
/*********************************************************************************/
function cleanInput($inputStr) {
    $inputStr = trim($inputStr);
    $inputStr = stripcslashes($inputStr);
    $inputStr = htmlspecialchars($inputStr);
    return $inputStr;
}

function convertYesNo($inputStr) {
    if ($inputStr == 'no') {
        return 0;
    } elseif ($inputStr == 'yes') {
        return 1;
    }
    return "";
}

/*********************************************************************************/
/* Get methods                                                                   */
/*********************************************************************************/
session_start();
if (empty($_POST['input_verifycode']) || strtolower($_SESSION['imgverify_code']) != strtolower($_POST['input_verifycode'])) {
    $vercodefail=0;
    $page_index=0;
    if(isset($_SESSION['page_name'])) {
        if($_SESSION['page_name']=='GeneNet.php') {
            $page_index = 1;
        }elseif($_SESSION['page_name']=='ns.php'){
            $page_index = 2;
        }elseif($_SESSION['page_name']=='glasso.php'){
            $page_index = 3;
        }elseif($_SESSION['page_name']=='glassosf.php'){
            $page_index = 4;
        }elseif($_SESSION['page_name']=='pcacmi.php'){
            $page_index = 5;
        }elseif($_SESSION['page_name']=='cmi2ni.php'){
            $page_index = 6;
        }elseif($_SESSION['page_name']=='space.php'){
            $page_index = 7;
        }elseif($_SESSION['page_name']=='eglasso.php'){
            $page_index = 8;
        }elseif($_SESSION['page_name']=='espace.php'){
            $page_index = 9;
        }elseif($_SESSION['page_name']=='ena.php'){
            $page_index = 10;
        }elseif($_SESSION['page_name']=='bayesianglasso.php'){
            $page_index = 11;
        }else{
            header("location:analysis.php?");
            exit();
        }
        header("location:analysis.php?error=$vercodefail&&pageindex=".$page_index);
        exit();
    }
}
$source = util::clean($_POST['method']);
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
} elseif ($source == 'ena') {
    $method = 10;
} elseif ($source == 'bayesianglasso') {
    $method = 11;
} else {
    echo 'methods error: ' . $source . "<br>";
}

/*********************************************************************************/
/* Gene expression data and hub genes                                            */
/*********************************************************************************/
// ------- check upload file size ----------
$allowed = array('csv', 'xlsx', 'xlsm','xltx','xltm');
$info=pathinfo($_FILES["expression_data"]["name"]);
$ext = $info['extension'];
if ($_FILES['expression_data']['size'] < 0||$_FILES['expression_data']['size'] >12000000||(!in_array($ext,$allowed))) {
    $vercodefail=1;
    header("location:analysis.php?error=$vercodefail&&pageindex=".$method);
    exit();
} else {
    $expression_path = $_FILES['expression_data']['tmp_name'];
    $expr_data = file_get_contents($expression_path);
    $csvFile = fopen($expression_path, 'r');
    $firstline_arr=fgetcsv($csvFile);
    $colnum=sizeof($firstline_arr);
    while(($line = fgetcsv($csvFile)) !== FALSE){
        $vercodefail=1;
        $line_colnum=sizeof($line);
        $picker=rand(0,$line_colnum-1);
        //echo "picker:",$picker, "line[]:",$line[$picker];
        if($colnum!=$line_colnum||(!is_numeric($line[$picker]))){
            header("location:analysis.php?error=$vercodefail&&pageindex=".$method);
            exit();
        }
    }
}

// ------------ hub genes -------------
if (isset($_POST['hubgenes'])) {
    $hubgenes = util::clean($_POST['hubgenes']);
    $hubinput_array=explode(',',$hubgenes);
    $i=0;
    while($i<sizeof($hubinput_array)){
        if(!in_array($hubinput_array[$i],$firstline_arr)){
            $vercodefail=2;
            header("location:analysis.php?error=$vercodefail&&pageindex=".$method);
            exit();
        }
        $i++;
    }
}



// ----------- check parameters -----------------
$param = NULL;
$param_2 = NULL;
if (isset($_POST['param'])) {
    $param = util::clean($_POST['param']);
}

if (isset($_POST['param_2'])) {
    $param_2 = util::clean($_POST['param_2']);
    if ($method == 10) {
        $param_2 = convertYesNo($param_2);
    }
}

// ------------ BayesianGLASSO file size -------------
if ($method == 11 || ($method == 10 && $param_2 == 1)) {
    $rownum = count(file($expression_path));
    if ($rownum > 100 || $colnum > 50) {
        $vercodefail=4;
        header("location:analysis.php?error=$vercodefail&&pageindex=".$method);
        exit();
    }
}


/*********************************************************************************/
/* Insert into database                                                          */
/*********************************************************************************/
// ------------ check name organization and email --------------
$jobid = uniqid("", True);

if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = util::clean($_POST['email']);
    $resultpath="http://lce.biohpc.swmed.edu/geneck/waiting.php?jobid=".$jobid;
    $mail = new PHPMailer();
    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->Host = "smtp.swmed.edu"; // SMTP server
    $mail->From = "qbrcsupport@UTSouthwestern.edu"; // send email address
    $mail->AddAddress($email);
//$mail->AddCC($email); //cc to appointment

    $mail->Subject = "GeNeCK job confirmation $organization $username";  // email subject
    $mail->Body = "Thank you for using GeNeCK!\n\nThis is an auto-generated response to your job submission. Please do not replay.\n\nUsername: $username \nEmail:$email \n\nYou can view your job result at:\n$resultpath";  // email contant
    $mail->WordWrap = 80;  // maximum character number in one line
    $failtosend=3;
    if (!$mail->Send()) {
        header("location:analysis.php?error=$failtosend&&pageindex=".$method);
        exit();
    }
}
// ----------- prepare connect to database --------------
include "../../dbincloc/geneck.inc";

$db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
if ($db_conn -> connect_error) {
    die('Unable to connect to database: ' . $db_conn -> connect_error);
}

// -------------- insert into database ---------------
$status = 0;
$software = "geneck";
$createtime = date("Y-m-d H:i:s");
$null = NULL;
if ($stmt = $db_conn -> prepare("INSERT INTO Jobs (JobID, Software, Analysis, Status, CreateTime) VALUES (?, ?, ?, ?, ?);")) {
    $stmt -> bind_param("sssis", $jobid, $software, $method, $status, $createtime);
    $stmt -> execute();
    $stmt -> close();
}

if ($stmt2 = $db_conn -> prepare("INSERT INTO GeneckParameters (JobID, UserName, Organization, Email, GeneExpression, HubGenes, Param, Param_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?);")) {
    $stmt2 -> bind_param("ssssbsdd", $jobid, $username, $organization, $email, $null, $hubgenes, $param, $param_2);
    $stmt2 -> send_long_data(4, $expr_data);
    $stmt2 -> execute();
    $stmt2 -> close();
}

$db_conn -> close();
echo "<script type='text/javascript'>location.href='waiting.php?jobid=${jobid}'</script>";