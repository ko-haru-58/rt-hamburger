<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  front-page.php
/* ***************************************/
?>

<?php get_header(); ?>

<main class="l-main">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();

            /* アイキャッチ画像 */
            get_template_part( 'template-parts/main-visual' ); 
            
            $cat_id_takeout = 99;
            $cat_id_eatin = 98;

            $category_takeout = get_category( $cat_id_takeout);
            $category_eatin = get_category( $cat_id_eatin);
            ?>
            
            <div class="p-service-type">
                <section class="p-service-type-item p-service-type-item--take-out">
                    <div class="c-service-card">
                        <div class="c-service-card__heading-wrapper">
                            <h2 class="c-service-card__heading">
                                <a href = "<?php echo esc_url( get_category_link( $cat_id_takeout ) ); ?>" >
                                    <?php echo esc_html( $category_takeout->name ); ?>
                                </a>
                            </h2>
                            <div class="c-service-card__heading-underline"></div>
                        </div>
                        <div class="c-service-card__text-wrapper">
                            <div class="c-service-card__text-container">
                                <p class="c-service-card__text--large">Take Out</p>
                                <p class="c-service-card__text">
                                    当店のテイクアウトで利用できる商品を掲載しています当店のテイクアウトで利用できる商品を掲載しています
                                </p>
                            </div>
                            <div class="c-service-card__text-container">
                                <p class="c-service-card__text--large">Take Out</p>
                                <p class="c-service-card__text">
                                    当店のテイクアウトで利用できる商品を掲載しています当店のテイクアウトで利用できる商品を掲載しています
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="p-service-type-item p-service-type-item--eat-in">
                    <div class="c-service-card">
                        <div class="c-service-card__heading-wrapper">
                            <h2 class="c-service-card__heading">
                                <a href = "<?php echo esc_url( get_category_link( $cat_id_eatin ) ); ?>" >
                                    <?php echo esc_html( $category_eatin->name ); ?>
                                </a>
                            </h2>
                            <div class="c-service-card__heading-underline"></div>
                        </div>
                        <div class="c-service-card__text-wrapper">
                            <div class="c-service-card__text-container">
                                <p class="c-service-card__text--large">Eat In</p>
                                <p class="c-service-card__text">
                                    店内でお食事いただけるメニューです店内でお食事いただけるメニューです店内でお食事いただけるメニューです
                                </p>
                            </div>
                            <div class="c-service-card__text-container">
                                <p class="c-service-card__text--large">Eat In</p>
                                <p class="c-service-card__text">
                                    店内でお食事いただけるメニューです店内でお食事いただけるメニューです店内でお食事いただけるメニューです
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <section class="p-access">
                <div class="p-access__mask--dark"></div>
                <div class="p-access__map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12963.301125922208!2d139.7544701267226!3d35.68130385930044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bfbd89f700b%3A0x277c49ba34ed38!2z5p2x5Lqs6aeF!5e0!3m2!1sja!2sjp!4v1758161107543!5m2!1sja!2sjp" 
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="p-access__mask--darker"></div>
                <div class="p-access__top-layer">
                    <div class="p-access__heading-wrapper">
                        <h2 class="p-access__heading">見出しが入ります</h2>
                        <div class="p-access__heading-underline"></div>
                    </div>
                    <div class="p-access__text">
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。
                        テキストが入ります。テキストが入ります。テキストが入りま
                    </div>
                </div>
            </section>
    <?php  
        endwhile;
    endif;
    ?>        

</main>

<?php get_sidebar(); ?>

<div class="p-overlay"></div>

<?php get_footer(); ?>