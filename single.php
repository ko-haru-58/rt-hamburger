<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  single.php
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

                    <?php
                    // コメントテンプレートを読み込み（テーマチェック対応 コメントはない）
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                    
                </div>

                <!-- 複数ページに分割された場合にページナビゲーションを表示 -->
                <?php
                wp_link_pages( array(
                    'before' => '<div class="p-page-links">' . __( 'ページ：', 'rt-hamburger' ),
                    'after'  => '</div>',
                ) )?>
            </article>
        <?php endwhile;
    endif; ?>
</main>

<?php get_sidebar(); ?>

<div class="p-overlay"></div>

<?php get_footer(); ?>