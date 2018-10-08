<?php
require_once('util.php');

$error = util::clean($_GET["error"]);
if ($error != "") {
    echo "<div class=\"alert alert-danger\" id=\"alert\" >";
    if ($error == "0") {
        echo "The entered verification code is incorrect.";
    } elseif ($error == "1") {
        echo "Your uploaded file is invalid. Please click Example to check upload file requirements";
    } elseif ($error == "2") {
        echo "The input hubgene doesn't exist in the upload file";
    } elseif ($error == "3") {
        echo "Fail to send email";
    } elseif ($error == "4") {
        echo "Expression data dimension too big the for BayesianGLASSO";
    }
    echo "</div>";
}
?>