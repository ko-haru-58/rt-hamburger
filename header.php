<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  header.php
/* ***************************************/
?>

<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--viewportの幅をデバイスの幅にする-->  
        <meta name='robots' content='noindex,nofollow'> <!--検索エンジンのクローラーにインデックスさせない-->
        <meta name="description" content="Hamburger">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <header class="l-header" role = "banner">
            <div class="p-header">
                <button class="p-header__menu-button" id="js-menu-button" type="button" aria-label="メニュー" aria-controls="menu-list" aria-expanded="false">Menu</button>
                <div class="p-header__wrapper">
                    <a class="p-header__sitename" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <div class="c-search-form p-header__search-form">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </header>