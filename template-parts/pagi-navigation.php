<?php
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  template-parts/pagination.php
/* ***************************************/
?>

<div class="p-page-navigation">
    <?php 
    if ( function_exists( 'wp_pagenavi' ) ){ 
        wp_pagenavi();
    } else {
        // WordPress 標準のページネーション（テーマチェック対応）
        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( '« Prev', 'rt-hamburger' ),
            'next_text' => __( 'Next »', 'rt-hamburger' ),
        ) );
    }
    ?>
</div>