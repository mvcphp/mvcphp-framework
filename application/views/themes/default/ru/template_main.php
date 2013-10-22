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
        
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter22201663 = new Ya.Metrika({id:22201663,
                            webvisor:true,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/22201663" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        
    </body>
</html>
