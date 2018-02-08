<?php
require_once 'Dads.class.php';

if (!include('config.php'))
    die('Error: Could not open \"config.php\", please edit and rename \"config.php.dist\"');
?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/dads.css">
</head>
<body>
<form action="FilesenderRestClient.php" method="post">
    <input type="hidden" name="itemid" value="<?php echo htmlspecialchars($_SERVER['QUERY_STRING']); ?>">

    <?php
    if (isset($_SERVER['HTTP_REFERER'])) {
        ?>
        <input type="hidden" name="referrer" value="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>">
        <?php
    }
    ?>
    <div class="wrapper">
        <header class="header">
        </header>

        <main class="content">
        <p>Content Notice : </p>
    <?php echo htmlPrettyPrint(CONTENT_NOTICE); ?>
    <p>A preview of your requested items:</p>
    <div id="" style="overflow-y: scroll; overflow-x: hidden; height:250px; max-width:80%; margin: 0 auto">
        <?php
        $basename = basename(htmlspecialchars($_SERVER['QUERY_STRING']));

        // sanitise $basename, by removing . and slashes
        $basename = preg_replace('((^\.)|\/|(\.$))', '_', $basename);

        // the OHRM/project name is the first four characters of the basename, in capitals
        $ohrmname = substr($basename, 0, 4);

        // Validate that user has specified an asset directory that DADS is allowed to operate from
        if (!in_array(strtoupper($ohrmname), $OHRMLIST)) die ("Invalid asset base directory specified for download");
        preview(ASSET_BASE . "/" . $basename);
        ?>
    </div>
    <p>Access conditions : </p>
    <?php echo htmlPrettyPrint(ACCESS_CONDITIONS); ?>
    <p>Usage conditions : </p>
    <?php echo htmlPrettyPrint(USAGE_CONDITIONS); ?>
    <i>By submitting your email address, you are agreeing to the above <i>Conditions of Access</i> and <i>Conditions of use</i>.</p>
    E-mail: <input type="text" name="email"/></p>
    <p><input type="submit" value="Request the items"></p>
    </main>
    </div>
    <footer class="footer">
    </footer><!-- .footer -->

</form>
</body>
</html>