<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  footer.php
/* ***************************************/
?>

        <footer class="l-footer">
            <div class= "p-footer">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-menu',   // 登録した場所
                        'container'      => 'nav',           // <nav>で囲む
                        'container_class'=> 'p-footer__nav',  // nav に付けるクラス
                        'menu_class'     => 'p-footer__list', // ul に付けるクラス
                        'depth'          => 1,               // フッターは1階層だけが一般的
                        'fallback_cb'    => false,           // メニュー未設定時は何も出さない
                    ) );
                ?>

                <p class="p-footer__copylight">Copyright: RaiseTech</p>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>
</html>