<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $tpl->html_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo $tpl->path; ?>css/main.css">
        <script type="text/javascript" src="/system/js/scriptjava-20120603.js"></script>
        <script type="text/javascript" src="<?php echo $tpl->path; ?>js/main.js"></script>
    </head>
    <body>
        <div class="logo">
            <img src="<?php echo $tpl->path; ?>img/mvcphp.png">
            <span class="red size-16">MVC</span><span class="blue size-16">PHP</span>
            <span class="green size-16"> Framework</span>
        </div>
        <div class="main">
            <?php
                 foreach ($tpl->content as $view) {
                     foreach (Booter::boot(array($view)) as $inc_file) {
                         include $inc_file;
                     }
                 }
             ?>
        </div>
    </body>
</html>
