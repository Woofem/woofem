<?php
/**
 * @file Default template file.
 */
?>

<?php include('partials/header.html.php'); ?>

    <div class="site-main">
        <h1><?php echo $app->config->site->title; ?></h1>
        <h2>404 Not Found</h2>
        <p><?php var_dump($data); ?></p>
    </div>

<?php include('partials/footer.html.php'); ?>