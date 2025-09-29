<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  page.php
/* ***************************************/
?>

<?php get_header(); ?>

<main class="l-main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();?>
            <article <?php post_class('p-article'); ?>>
                <!-- アイキャッチ画像 -->
                <?php get_template_part( 'template-parts/main-visual' ); ?>              
                
                <!-- 本文 -->
                <div class="p-article__content">
                    <?php the_content(); ?>
                </div>

                <!-- 複数ページに分割された場合にページナビゲーションを表示 -->
                <?php
                wp_link_pages( array(
                    'before' => '<div class="p-page-links">' . __( 'ページ：', 'rt-hamburger' ),    //. __() は翻訳の対応
                    'after'  => '</div>',
                ) )?>
            </article>              
        <?php endwhile;
    endif; ?>
</main>

<?php get_sidebar(); ?>

<div class="p-overlay"></div>

<?php get_footer(); ?>