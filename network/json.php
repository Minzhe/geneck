<?php
require_once 'common.php';
require_once '../util.php';

$jobid = "";
if (isset($_GET['jobid'])) {
    $jobid = util::clean($_GET['jobid']);
}

read_data($jobid);

header('Content-type: application/json');
echo json_encode(array(
    'data'   => $data,
    'errors' => $errors
));
?>
