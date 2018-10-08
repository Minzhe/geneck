<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once 'markdown/Markdown.inc.php';
use \Michelf\Markdown;

function get_html_docs($obj) {
    global $config, $data, $errors;

    $name = str_replace('/', '_', $obj['name']);

    $name = str_replace('_', '\_', $name);
    $type = $obj['type'];
    if ($config['types'][$type]) {
        $type = $config['types'][$type]['long'];
    }

    $markdown = "## Node: $name\nType: $type\n*** \n\n";

/*    if (file_exists($filename)) {
        $markdown .= "### Documentation\n\n";
        $markdown .= file_get_contents($filename);
    } else {
        $markdown .= "<div class=\"alert alert-warning\">No documentation for this object</div>";
    }*/

    if ($obj) {
        $markdown .= "\n\n";
        $markdown .= get_depends_markdown('Its neighbors:', $obj['depends'], $obj['dependedOnBy']);
    }

    // Use {{object_id}} to link to an object
    $arr      = explode('{{', $markdown);
    $markdown = $arr[0];
    for ($i = 1; $i < count($arr); $i++) {
        $pieces    = explode('}}', $arr[$i], 2);
        $name      = $pieces[0];
        $id_string = get_id_string($name);
        $name_esc  = str_replace('_', '\_', $name);
        $class     = 'select-object';
        if (!isset($data[$name])) {
            $class .= ' missing';
            $errors[] = "Object '$obj[name]' links to unrecognized object '$name'";
        }
        $markdown .= "<a href=\"#$id_string\" class=\"$class\" data-name=\"$name\">$name_esc</a>";
        $markdown .= $pieces[1];
    }

    $html = Markdown::defaultTransform($markdown);
    // IE can't handle <pre><code> (it eats all the line breaks)
    $html = str_replace('<pre><code>'  , '<pre>' , $html);
    $html = str_replace('</code></pre>', '</pre>', $html);
    return $html;
}

function get_depends_markdown($header, $arr, $arr1) {
    $markdown = "### $header";
    $markdown .= "\n\n";

    if (count($arr)) {
        foreach ($arr as $name) {
            $markdown .= "* {{" . $name . "}}\n";
        }
    }

    if (count($arr1)) {
        foreach ($arr1 as $name1) {
            $markdown .= "* {{" . $name1 . "}}\n";
        }
        $markdown .= "\n";
    }

    return $markdown;
}

function get_id_string($name) {
    return 'obj-' . preg_replace('@[^a-z0-9]+@i', '-', $name);
}

function read_config($jobid) {
    global $config;

    $config = json_decode(file_get_contents("config.json" ), true);
    $config['jsonUrl'] = "json.php?jobid=" . $jobid;
}

function read_data($jobid) {
    global $config, $data, $errors;

    if (!$config) read_config($jobid);

    include "../../../dbincloc/geneck.inc";

    //open the database connection
    $db_conn = new mysqli($hostname, $usr, $pwd, $dbname);
    if ($db_conn -> connect_error) {
        die('Unable to connect to database: ' . $db_conn -> connect_error);
    }

    $json = "";

    if(!empty($jobid) && $result = $db_conn->prepare("SELECT EstEdge_json FROM GeneckResults WHERE JobID = ?"))
    {
        $result->bind_param("s", $jobid);
        $result->execute();
        $result->store_result();
        $result->bind_result($resultjson);
        $result->fetch();

        $json   = json_decode($resultjson, true);
        
        $result->close();
    }

    $db_conn->close();


    $data   = array();
    $errors = array();

    foreach ($json as $obj) {
        $data[$obj['name']] = $obj;
    }

    foreach ($data as &$obj) {
        $obj['dependedOnBy'] = array();
    }
    unset($obj);
    foreach ($data as &$obj) {
        foreach ($obj['depends'] as $name) {
            if ($data[$name]) {
                $data[$name]['dependedOnBy'][] = $obj['name'];
            } else {
                $errors[] = "Unrecognized dependency: '$obj[name]' depends on '$name'";
            }
        }
    }
    unset($obj);
    foreach ($data as &$obj) {
        $obj['docs'] = get_html_docs($obj);
    }
    unset($obj);
}
?>
