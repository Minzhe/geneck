<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$page_name = explode('/', $path)[2];

if (empty($page_name)|| $page_name == 'index.php') {
    $page_index = 'index';
} else if ($page_name == 'download.php') {
    $page_index = 'download';
} else if ($page_name == 'contact.php') {
    $page_index = 'contact';
} else {
    $page_index = 'analysis';
}
?>

<!-- Header -->
<div id="header">
    <div class="container">

        <!-- Logo -->
        <div id="logo">
            <h1><a href="#">GeNe<span style="color: #888888">ck</span></a></h1>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li class="<?php if ($page_index == 'index') {echo "active";}?>"><a href="index.php">Homepage</a></li>
                <li class="<?php if ($page_index == 'analysis') {echo "active";}?>"><a href="analysis.php">Analysis</a></li>
                <li class="<?php if ($page_index == 'download') {echo "active";}?>"><a href="download.php">Download</a></li>
                <li class="<?php if ($page_index == 'contact') {echo "active";}?>"><a href="">Contact Us</a></li>
            </ul>
        </nav>

    </div>
</div>
<!-- Header -->

<!-- Banner -->
<div id="banner">
    <div class="container">
        <?php
        if ($page_index == 'index') {
            echo "<h1 class=\"tagline\">Gene Network Construction Kit</h1>";
        }
        ?>
    </div>
</div>
<!-- /Banner -->
