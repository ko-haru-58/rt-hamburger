<?php
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  template-parts/menu-card.php
/* ***************************************/
?>

<section <?php post_class('p-menu-card');?>>
    <div class="c-menu-card">
    <!-- アイキャッチ画像 -->    
        <?php if ( has_post_thumbnail() ) { ?>
            <?php if ( !empty( get_the_post_thumbnail_url( get_the_ID(), 'full' ) )){ ?>
                <div class="c-menu-card__image c-menu-card__image--thumbnail" style="background-image: url('<?php the_post_thumbnail_url('large' ); ?> ')"></div>
            <?php } else {?>
                <div class="c-menu-card__image c-menu-card__image--no-thumbnail" style="background-image: url('<?php echo esc_url(get_template_directory_uri()) . '/images/no-image.jpg'?>)"></div>
                <?php } ?>
        <?php } else { ?>
            <div class="c-menu-card__image c-menu-card__image--no-thumbnail" style="background-image: url('<?php echo  esc_url(get_template_directory_uri()) . '/images/no-image.jpg'?>)"></div>
        <?php } ?>
        
        <div class="c-menu-card__excerpt-container">
            <div class="c-menu-card__text-inner">
                <!-- タイトル -->
                <h3 class="c-menu-card__heading"><?php the_title(); ?></h3>

                <!-- 小見出しとテキスト（抜粋） -->
                <?php
                //抜粋、があればそちらを採用
                if ( has_excerpt() ) {                  
                    $excerpt = get_the_excerpt();
                    
                // 本文に「続きを読む」があればそれよりも前の部分を採用する。
                } elseif (! empty( get_the_content() )) { 

                    global $post;
                    $content = $post->post_content; //get_the_content()よりも、このようにした方がHTMLの構造を取得できる
                    $more = strpos($content, '<!--more-->');
                    
                    if ( $more !== false ){
                        $excerpt = substr($content, 0, $more);
                        
                    } else {                  
                        $excerpt = rtburger_cut_excerpt(120);
                    }
                }

                if( ! empty( $excerpt ) ){
                    $before_excerpt = $excerpt;

                    $excerpt = preg_replace('/<h[1-6][^>]*>/', '<h4 class="c-menu-card__sub-heading">',$excerpt);   //見出しはすべて<h4>にしてクラス名をつける
                    $excerpt = preg_replace('/<\/h[1-6]>/', '</h4>', $excerpt); //閉じタグも</h4>にする
                    $excerpt = preg_replace('/<p[^>]*>/', '<p class="c-menu-card__text">', $excerpt);   //<p>にクラス名をつける

                    if( $before_excerpt === $excerpt ){
                        $excerpt = '<p class="c-menu-card__text">'. $excerpt . '</p>';  // 管理画面の「抜粋」で入力欄にタグもなくテキストが入力されていた場合、<p>もないためここで付与する
                    }
                        
                    echo wp_kses_post( $excerpt ); 
                }             
                ?>
            </div>

            <!-- ボタン -->
            <div class="c-menu-card__button-wrapper">
                <a class="c-button c-menu-card__button" href="<?php the_permalink(); ?>">詳しく見る</a>
            </div>
        </div>
    </div>
</section>