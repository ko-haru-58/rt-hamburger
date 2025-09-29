<?php
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  index.php
/* ***************************************/
?>

<?php get_header(); ?>

<main class="l-main">

    <!-- メインビジュアル -->
    <?php get_template_part( 'template-parts/main-visual' ); ?>

    <!-- 検索結果一覧 -->
    <?php if ( have_posts() ) : ?>
        <div class="p-menu-cards">   
            <?php while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/menu-card' );
            endwhile; ?>
        </div>
    <?php else : ?>
        <p class="p-message--no-articles">商品情報の記事がありませんでした。</p>
    <?php endif; ?> 

    <!-- ページネーション -->
    <?php get_template_part( 'template-parts/pagi-navigation' ); ?>

</main>

<?php get_sidebar(); ?>

<div class = "p-overlay"></div>

<?php get_footer(); ?>
