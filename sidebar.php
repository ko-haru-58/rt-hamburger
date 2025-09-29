<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  sidebar.php
/* ***************************************/
?>

<div class="l-sidebar">
    <!-- メニューの表示 -->
    <section class="p-menu">
        <button class="p-menu__close-button"  id = "js-close-button" aria-label = "メニューを閉じる"></button>
        <h2 class="p-menu__heading">Menu</h2>
        
        <?php
        wp_nav_menu( array(
            'theme_location' => 'sidebar-menu',  // functions.php で登録した場所
            'container'      => 'nav',
            'container_class'=> 'p-menu__nav',
            'menu_class'     => 'p-menu__list',
            'fallback_cb'    => false,
            'depth'          => 2,
        ) );
        ?>
    </section>

    <!-- ウィジェットの表示（テーマチェック対応のため中身は空） -->
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php endif; ?>    
</div>