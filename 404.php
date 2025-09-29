<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  404.php
/* ***************************************/
?>

<?php get_header(); ?>

<main class="l-main">
    <section class="p-404__wrapper">
        <h1 class="p-404__title">404 - Page Not Found</h1>
        <p class="p-404__text">
            お探しのページは見つかりませんでした。<br>
            URLが間違っているか、ページが削除された可能性があります。
        </p>

        <div class="p-404__button-wrapper">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="c-button p-404__button">
                トップページへ
            </a>
        </div>

        <p class="p-404__text">
            お探しのコンテンツに該当するキーワードを入力して検索
        </p>

        <div class="p-404__search-wrapper">
            <div class="c-search-form p-404__search-form">
                <?php get_search_form(); ?>
            </div>
        </div>
        
    </section>
</main>

<?php get_sidebar(); ?>

<div class="p-overlay"></div>

<?php get_footer(); ?>