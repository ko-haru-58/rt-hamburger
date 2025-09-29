<?php 
/* ***************************************
/*  Hamburger｜RaiseTech Bread
/*  searchform.php
/* ***************************************/
?>

<search>
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET" class="c-search-form__form">
        <div class="c-search-form__input-wrap">
            <input type="search" class="c-search-form__input" id="site-search"
                value="<?php echo get_search_query(); ?>" name="s" />
        </div>
        <button type="submit" class="c-search-form__button">検索</button>                
    </form>
</search>
