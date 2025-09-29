<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  archive.php
/* ***************************************/
?>

<?php get_header(); ?>

<main class="l-main">
    <!-- メインビジュアル -->
    <?php get_template_part( 'template-parts/main-visual' ); ?>
    
    <!-- 説明文 -->
    <?php
    if ( have_posts() ) : 
        $category = get_queried_object();
        $category_heading = get_field( 'category_heading', $category );
    ?>

        <div class="p-category">
            <?php if ( $category_heading ) { ?>
                <h2 class="p-category__heading"><?php echo esc_html( $category_heading ) ?></h2>
            <?php } ?>
            <div class="p-category__text"><?php echo (category_description()); ?></div>
        </div>

    <!-- 記事一覧 -->
        <div class="p-menu-cards">   
            <?php while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/menu-card' );
            endwhile; ?>
        </div>
    <?php else : ?>
        <p class="p-message--no-articles">該当する商品がありませんでした。</p>
    <?php endif; ?>

    <!-- ページネーション -->
    <?php get_template_part( 'template-parts/pagi-navigation' ); ?>
    
</main>

<?php get_sidebar(); ?>

<div class = "p-overlay"></div>

<?php get_footer(); ?>