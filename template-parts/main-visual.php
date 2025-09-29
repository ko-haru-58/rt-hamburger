<?php
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  template-parts/main-visual.php
/* ***************************************/

// ページによってクラス名とタイトルを変更する
if ( is_front_page() ){
    $mv_class = 'p-main-visual p-main-visual--front';
    $mv_title = 'ダミーサイト';
    $mv_subtitle = '';
} elseif ( is_single() ) {
    $mv_class = 'p-main-visual p-main-visual--single';
    $mv_title = get_the_title();
    $mv_subtitle = '';
} elseif ( is_page() ) {
    $mv_class = 'p-main-visual p-main-visual--page';
    $mv_title = get_the_title();
    $mv_subtitle = '';
} elseif ( is_archive()) {
    $mv_class = 'p-main-visual p-main-visual--archive'; 
    $mv_title = 'Menu:';
    $mv_subtitle = single_cat_title('',false);
} elseif ( is_search()) {
    $mv_class = 'p-main-visual p-main-visual--archive'; 
    $mv_title = 'Search:';
    $mv_subtitle = get_search_query();   
} else{
    $mv_class = 'p-main-visual p-main-visual--front';   //フロントページとメインビジュアルは同じにする
    $mv_title = 'ダミーサイト';
    $mv_subtitle = '';
}

// アイキャッチ画像の有無のチェック
$check_thumbnail = false;

if(is_single() || is_page()){
    if ( has_post_thumbnail() ) {
        if ( !empty( get_the_post_thumbnail_url( get_the_ID(), 'full' ) )){
            $check_thumbnail = true;
        }
    }
}
?>

<?php 
// アイキャッチ画像とタイトルを表示する

if ( is_front_page()){ ?>
    <div class="<?php echo esc_attr( $mv_class ); ?>">
        <div class="p-main-visual__image"></div>
        <h1 class="p-main-visual__title"><?php echo esc_html( $mv_title ); ?></h1>
    </div>
<?php } elseif ( is_single() || is_page() ) { ?>
    <div class="<?php echo esc_attr( $mv_class ); ?>">
        <?php if ( $check_thumbnail ) { ?>
            <div class="p-main-visual__image" style="background-image: url('<?php the_post_thumbnail_url('large' ); ?> ')"></div>
        <?php } else { ?>
            <div class="p-main-visual__image" style="background-image: url(<?php echo esc_url(get_template_directory_uri() . '/images/main-visual-default.jpg')?>">
                <div class="p-main-visual__mask"></div>
            </div>

        <?php } ?>

        <h1 class="p-main-visual__title"><?php echo esc_html( $mv_title ); ?></h1>
    </div>
<?php } elseif ( is_archive() || is_search() ) { ?>
    <div class="<?php echo esc_attr( $mv_class ); ?>">
        <div class="p-main-visual__image"></div>

        <h1 class = "p-main-visual__title">
            <?php echo esc_html( $mv_title ); ?>
            <span class="p-main-visual__subtitle"><?php echo esc_html( $mv_subtitle ); ?></span>
        </h1>
    </div>
<?php } else{ ?>
    <div class="<?php echo esc_attr( $mv_class ); ?>">
        <div class="p-main-visual__image"></div>
        <h1 class="p-main-visual__title"><?php echo esc_html( $mv_title ); ?></h1>
    </div>
<?php } ?>    
