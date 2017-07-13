<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$page_name = explode('/', $path)[2];

if ($page_name == 'GeneNet.php') {
    $method_index = 'GeneNet';
    $param = 'False discover rate:';
    $default = '0.2';
} elseif ($page_name == 'ns.php') {
    $method_index = 'ns';
    $param = 'Alpha:';
    $default = '0.2';
} elseif ($page_name == 'glasso.php') {
    $method_index = 'glasso';
    $param = 'Lambda:';
    $default = '0.6';
} elseif ($page_name == 'glassosf.php') {
    $method_index = 'glassosf';
    $param = 'Alpha:';
    $default = '0.3';
} elseif ($page_name == 'pcacmi.php') {
    $method_index = 'pcacmi';
    $param = 'Lambda:';
    $default = '0.03';
} elseif ($page_name == 'cmi2ni.php') {
    $method_index = 'cmi2ni';
    $param = 'Lambda:';
    $default = '0.03';
} elseif ($page_name == 'space.php') {
    $method_index = 'space';
    $param = 'Alpha:';
    $default = '1.0';
} elseif ($page_name == 'eglasso.php') {
    $method_index = 'eglasso';
    $param = 'Alpha:';
    $default = '0.8';
    $param_2 = 'Lambda:';
    $default_2 = '0.6';
} elseif ($page_name == 'espace.php') {
    $method_index = 'espace';
    $param = 'Alpha:';
    $default = '0.8';
    $param_2 = 'Lambda:';
    $default_2 = '1.0';
} elseif ($page_name == 'ena.php') {
    $method_index = 'ena';
    $param = 'False discover rate:';
    $default = '0.01';
} else {
    echo 'methods error: ' . $page_name . "<br>";
}

$hubgene_box = "<tr>
                    <td class=\"table-right-align\"><p>Hub genes:</p></td>
                    <td><input type=\"text\" placeholder=\"E.g. EGFR,PI3K,AKT\" class=\"inputbox\" name=\"hubgenes\"></td>
                </tr>";

$param_2_box = "<tr>
                    <td class=\"table-right-align\"><p>{$param_2}</p></td>
                    <td><input type=\"text\" placeholder=\"Default: {$default_2}\" class=\"inputbox\" name=\"param_2\"></td>
                </tr>";
?>

<form action="submitjob.php" enctype="multipart/form-data" method="POST">
    <div class="text-bg">
        <table class="para-table">
            <!-- parameters -->
            <tr>
                <td><strong>Data & parameters</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr/>
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Gene co-expression data:</p></td>
                <td>
                    <label>
                        <input name="expression_data" type="file">
                    </label>
                </td>
                <td><label class="demo-button"><a href="data/demo_data.csv">example</a></label></td>
            </tr>
            <tr>
                <td class="table-right-align"><p><?php echo $param; ?></p></td>
                <td><input type="text" placeholder="Default: <?php echo $default; ?>" class="inputbox" name="param"></td>
            </tr>
            <?php if (in_array($method_index, array('eglasso', 'espace'))) { echo $param_2_box; echo $hubgene_box; } ?>
            <tr>
                <td><br/></td>
            </tr>

            <!-- user information -->
            <tr>
                <td><strong>User information (optional)</strong></td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr/>
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Name:</p></td>
                <td colspan="2"><input type="text" placeholder="E.g. QBRC" class="inputbox fullwidth" name="username">
                </td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Organization:</p></td>
                <td colspan="2"><input type="text" placeholder="E.g. UT Southwestern" class="inputbox fullwidth"
                                       name="organization"></td>
            </tr>
            <tr>
                <td class="table-right-align"><p>Email:</p></td>
                <td colspan="2"><input type="text" placeholder="E.g. QBRC@UTSouthwestern.edu" class="inputbox fullwidth"
                                       name="email"></td>
            </tr>
            <tr>
                <td><br/></td>
            </tr>

            <tr>
                <!-- pass method -->
                <td><input name="method" value=<?php echo $method_index;?> style="display: none"></td>
                <td><label for="submitjob"><a class="button" id="submit">submit</a></label></td>
                <td><input type="submit" id="submitjob" style="display: none"></td>
            </tr>
        </table>
    </div>
</form>