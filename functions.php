<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  functions.php
/* ***************************************/

/* Google フォントの読み込みを早くするpreconnect */
function rtburger_google_fonts_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}

add_action( 'wp_head', 'rtburger_google_fonts_preconnect', 1 ); //Googleフォントより先に呼び出されるよう優先度1

/* Googleフォント・CSS・JavaScriptの読み込み */
function rtburger_enqueue_assets(){
    wp_enqueue_style('mplus1p', '//fonts.googleapis.com/css2?family=M+PLUS+1p:wght@100;300;400;500;700;800;900&display=swap');
    wp_enqueue_style('roboto', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    wp_enqueue_style('rtburger-style', get_template_directory_uri() . '/css/style.css', array('wp-block-library')); //WordPressのデフォルトの設定の'wp-block-library'の次に読み込む（style.cssの方が優先されるように）
    wp_enqueue_script('jquery');
    wp_enqueue_script('rtburger-script', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}

add_action( 'wp_enqueue_scripts', 'rtburger_enqueue_assets' );

/* <head> 内の description */
function rtburger_meta_description() {
    if ( is_singular( 'post' ) ) {
        global $post;
        $description = esc_attr( mb_substr( strip_tags( $post->post_content ), 0, 100 ) );
    } elseif ( is_front_page() ) {
        $description = esc_attr( get_bloginfo( 'description' ) );
    } else {
        $description = esc_attr( get_the_title() );
    }
    echo '<meta name="description" content="' . $description . '">' . "\n";
}
add_action( 'wp_head', 'rtburger_meta_description' );

/* タイトル */
function rtburger_title( $title ) {
    if ( is_singular('post') ) {
        // 投稿ページの場合（記事一覧、固定ページ。ただしフロントページは除く）
        $title = single_post_title( '', false ) . ' ❘ ' . get_bloginfo('name') .' - ' . get_bloginfo('description');
    } else {
        $title = get_bloginfo('name') .' - ' . get_bloginfo('description');
    }

    return $title;
}

add_filter( 'pre_get_document_title', 'rtburger_title' );

/* OGP & Twitterカードを出力 */
function rtburger_add_ogp_tags() {
    if ( is_singular('post') ) {
        global $post;
        $title       = esc_attr( get_the_title() );
        $description = esc_attr( mb_substr( strip_tags( $post->post_content ), 0, 100 ) );
        $url         = esc_url( get_permalink() );

        if ( has_post_thumbnail( $post->ID ) ) {
            $thumbnail_id = get_post_thumbnail_id( $post->ID );
            $image        = wp_get_attachment_image_url( $thumbnail_id, 'full' );
        } else {
            $image = esc_url(get_template_directory_uri() . '/images/ogp-default.jpg');
        }
    } else {
        // 投稿ページ以外
        $title       = get_bloginfo( 'name' );
        $description = get_bloginfo( 'description' );
        $url         = esc_url( home_url() );
        $image       = esc_url(get_template_directory_uri() . '/images/ogp-default.jpg');
    }

    ?>
    <!-- OGP -->
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:image" content="<?php echo esc_url( $image ); ?>">
    <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $title; ?>">
    <meta name="twitter:description" content="<?php echo $description; ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">

    <?php
}
add_action( 'wp_head', 'rtburger_add_ogp_tags' );

/* 管理画面にCSSを適用して見やすくする */
function rtburger_add_editor_styles() {
    add_theme_support( 'editor-styles' ); 
    add_editor_style( '/css/editor-style.css' ); 
}

add_action( 'after_setup_theme', 'rtburger_add_editor_styles' );

/* メニュー（サイドバー、フッター） */
register_nav_menus( array(
    'sidebar-menu' => 'サイドバーメニュー',
    'footer-menu'  => 'フッターメニュー',
));

/* フロントページを編集不可にする。サムネイル設定欄の操作も不可とする */
function rtburger_editor_uneditable() {
    $front_page_id = get_option( 'page_on_front' );
    $current_post_id = isset($_GET['post']) ? intval($_GET['post']) : 0;

    if ( $current_post_id && $current_post_id === intval($front_page_id)  ) {
        remove_post_type_support( 'page', 'editor' ); 
        remove_post_type_support( 'page', 'thumbnail' );
    }
}
add_action( 'admin_init', 'rtburger_editor_uneditable' );

/* タイトル、パーマリンク、ゴミ箱へ移動、更新ボタンも非表示にして箱編集不可にする */
function rtburger_title_uneditable() {
    $front_page_id = get_option( 'page_on_front' );
    $screen = get_current_screen();

    if ( $screen->base === 'post' && isset($_GET['post']) && intval($_GET['post']) === intval($front_page_id) ) {
        echo '<style>
            #titlewrap, 
            #edit-slug-box, 
            #delete-action, 
            #publishing-action { display: none !important; }
        </style>';
    }
}
add_action( 'admin_head-post.php', 'rtburger_title_uneditable' );

/* フロントページは編集不可である旨を表示する */
function rtburger_editor_message( $post ) {
    $front_page_id = get_option( 'page_on_front' );

    if ( $post->ID === intval( $front_page_id ) ) {
        $home_url = home_url( '/' );
        
        echo '<div class="notice notice-info">
            <p>このページは編集することはできません。
                編集したい場合は、WordPress開発のエンジニアにお問い合わせください。</p>
            <a href="' . esc_url( $home_url ) . '" target="_blank">
                このページの表示を確認するにはこちらをクリックしてください</a>
        </div>';
    }
}
add_action( 'edit_form_after_title', 'rtburger_editor_message' ); 

/* 適切な文字数で切り取って抜粋を作成する */
function rtburger_cut_excerpt( $max_count = 120 ){
    $post_id = get_the_ID();
    $post_obj  = get_post( $post_id );
    //$content = get_the_content(null, false, $post_id);
    $content = $post_obj->post_content;

    //echo $content.'<p>あ</p>';

    $doc = new DOMDocument();   //HTML文書をツリー構造の階層的なデータとして扱う
    @$doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));   //文字化けしないようにエンコーディング。HTMLの構造に不備があってもエラーが表示されないよう@をつける。
    $body = $doc->getElementsByTagName('body')->item(0);    //bodyタグで囲まれた箇所は1つだけなのでitem(0)に設定。bodyに格納されている要素が子要素となってこれからアクセスできるようになる。

    $output_excerpt = '';
    $char_count = 0;

    foreach ($body->childNodes as $node) {
        $node_html = $doc->saveHTML($node);
        $node_text = trim(strip_tags($node_html, '<br>'));

        if ($node_text === '') continue;    // HTMLタグを除いた結果、空になったものはスキップ

        // 見出しは丸ごと残す。（あまりにも長い見出しはない）
        if (strtolower($node->nodeName) === 'h1' || strtolower($node->nodeName) === 'h2' || 
            strtolower($node->nodeName) === 'h3' || strtolower($node->nodeName) === 'h4' ||
            strtolower($node->nodeName) === 'h5' || strtolower($node->nodeName) === 'h6' ) {
            
            $char_count += mb_strlen($node_text);
            
            if ($char_count > $max_count){
                break;
            }

            $output_excerpt .= $node_html;
        }
        // 見出し以外の文字列は<p>にする。句点などで区切り、所定の文字数を超えたら処理を抜ける。（一文は数十文字という前提）
        else{
            $pattern = '/(?<=。|\.|!|！|‼|\?|？)/u';
            $parts = preg_split($pattern, $node_text, -1, PREG_SPLIT_NO_EMPTY); //区切って配列に格納する

            $paragraph_chars = '<p>';
            
            foreach ($parts as $parts) {
                $char_count += mb_strlen($parts);

                if ($char_count > $max_count){
                    if( $paragraph_chars != '<p>'){
                        $paragraph_chars .= '</p>';
                        $output_excerpt .= $paragraph_chars;
                    }

                    break 2;    //全体ループを抜ける
                }

                $paragraph_chars .= $parts;
            }

            $paragraph_chars .= '</p>';
            $output_excerpt .= $paragraph_chars;
        }
    }

    return $output_excerpt;
}

/* その他、必要なテーマサポート */
function rtburger_theme_support() {

    /* HTML5 の機能を有効化する */
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'navigation-entries',
        'search-form',
        'script',
        'style'
    ) );

    /* タイトル */
    add_theme_support( 'title-tag' );

    /* サムネイル（アイキャッチ画像） */
    add_theme_support( 'post-thumbnails' ); 
}
add_action( 'after_setup_theme', 'rtburger_theme_support' );

/* ==================== Theme Check ==================== */

// 以下、仕様にはない設定だが、テーマチェックのメッセージを消すために記載したもの

// ウィジェットエリアの登録（テーマチェック対応のため中身は空）
function rtburger_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'サイドバー', 'rt-hamburger' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'rtburger_widgets_init' );

// 通常コメント一覧の最後にあるフォームを、返信ボタンを押した所に表示するためのスクリプト
function rtburger_comment_reply_script() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'rtburger_comment_reply_script' );

// register_block_style で独自のスタイルを追加する
function rtburger_register_block_styles() {
    register_block_style(
        'core/paragraph',
        array(
            'name'  => 'highlight',
            'label' => __( '蛍光ペン', 'rt-hamburger' ),
        )
    );
}
add_action( 'init', 'rtburger_register_block_styles' );

// register_block_patternで独自のパターンを追加する
function rtburger_register_block_patterns() {
    register_block_pattern(
        'rt-hamburger/two-columns-text',
        array(
            'title'       => __( '2カラムテキスト', 'rt-hamburger' ),
            'description' => _x( 'シンプルな2カラムのテキストレイアウトです。', 'Block pattern description', 'rt-hamburger' ),
            'content'     => '
                <!-- wp:columns -->
                <div class="wp-block-columns">
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:paragraph -->
                        <p>左カラムの内容</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        <!-- wp:paragraph -->
                        <p>右カラムの内容</p>
                        <!-- /wp:paragraph -->
                    </div>
                    <!-- /wp:column -->
                </div>
                <!-- /wp:columns -->
            ',
        )
    );
}
add_action( 'init', 'rtburger_register_block_patterns' );

function rtburger_theme_check() {
    // RSSフィード（WordPress 5.2 以降では不要だがテーマチェックの警告を消すため）
    add_theme_support( 'automatic-feed-links' );

    // ブロックエディタの標準スタイルを有効化する
    add_theme_support( 'wp-block-styles' );

    // YouTube などの埋め込みをレスポンシブ対応にする
    add_theme_support( 'responsive-embeds' ); 

    // サイトロゴ機能
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // 背景色・背景画像の変更機能
    add_theme_support( 'custom-background', array(
        'default-color' => 'FFFDFA',
        'default-image' => '',
    )); 

    // ヘッダー画像の設定機能（不要のため操作できない設定）
    add_theme_support( 'custom-header', array(
        'default-image' => '',   // 画像は設定しない
        'width'         => 1200, // サイズは適当
        'height'        => 280,
        'flex-width'    => true,
        'flex-height'   => true,
        'uploads'       => false, // 画像アップロードも禁止
        'header-text'   => false, // ヘッダーテキストなし
    ));

    // ブロックエディタの幅広・全幅レイアウト
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'rtburger_theme_check' );

?>
