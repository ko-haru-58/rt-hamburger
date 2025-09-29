<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  comments.php
/* ***************************************/

// コメントの受け付けや表示はしないが、テーマチェックのメッセージを消すために記載したコード。
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() ) { ?>
    <ul>
        <?php wp_list_comments(); ?>
    </ul>

    <?php the_comments_navigation(); ?>
    
<?php } ?>

<?php
if ( comments_open() ) {
    comment_form();
}
?>