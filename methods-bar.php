<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$page_name = explode('/', $path)[2];

if ($page_name == 'GeneNet.php') {
    $method_index = 'GeneNet';
} elseif ($page_name == 'ns.php') {
    $method_index = 'ns';
} elseif ($page_name == 'glasso.php') {
    $method_index = 'glasso';
} elseif ($page_name == 'glassosf.php') {
    $method_index = 'glassosf';
} elseif ($page_name == 'pcacmi.php') {
    $method_index = 'pcacmi';
} elseif ($page_name == 'cmi2ni.php') {
    $method_index = 'cmi2ni';
} elseif ($page_name == 'space.php') {
    $method_index = 'space';
} elseif ($page_name == 'eglasso.php') {
    $method_index = 'eglasso';
} elseif ($page_name == 'espace.php') {
    $method_index = 'espace';
} elseif ($page_name == 'ena.php') {
    $method_index = 'ena';
} else {
    $method_index = 'analysis';
}
?>

<section class="sidebar" id="side-methods">
    <header>
        <h2>Basic Methods</h2>
    </header>
    <ul class="style1 methods">
        <li <?php if($method_index == 'GeneNet') {echo 'class="method-active"';}?>><a href="GeneNet.php" class="select">GeneNet</a></li>
        <li <?php if($method_index == 'ns') {echo 'class="method-active"';}?>><a href="ns.php">Neighborhood Selection</a></li>
        <li <?php if($method_index == 'glasso') {echo 'class="method-active"';}?>><a href="glasso.php">GLASSO</a></li>
        <li <?php if($method_index == 'glassosf') {echo 'class="method-active"';}?>><a href="glassosf.php">GLASSO-SF</a></li>
        <li <?php if($method_index == 'pcacmi') {echo 'class="method-active"';}?>><a href="pcacmi.php">PCACMI</a></li>
        <li <?php if($method_index == 'cmi2ni') {echo 'class="method-active"';}?>><a href="cmi2ni.php">CMI2NI</a></li>
        <li <?php if($method_index == 'space') {echo 'class="method-active"';}?>><a href="space.php">SPACE</a></li>
    </ul>
</section>
<section class="sidebar" id="methods">
    <header>
        <h2>Extended Methods</h2>
    </header>
    <ul class="style1 methods">
        <li <?php if($method_index == 'eglasso') {echo 'class="method-active"';}?>><a href="eglasso.php">EGLASSO</a></li>
        <li <?php if($method_index == 'espace') {echo 'class="method-active"';}?>><a href="espace.php">ESPACE</a></li>
    </ul>
</section>
<section class="sidebar" id="methods">
    <header>
        <h2>Integrative Methods</h2>
    </header>
    <ul class="style1 methods">
        <li <?php if($method_index == 'ena') {echo 'class="method-active"';}?>><a href="ena.php">ENA</a></li>
    </ul>
</section>
