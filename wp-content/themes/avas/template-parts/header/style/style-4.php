<?php
/**
* 
* header style 4
*
*/
global $tx;
?>

<div class="header-style-four">

    <div id="h-style-4" class="main-header">
        <div class="tx-header-overlay"></div><!-- overlay color -->
        <div class="menu-bar d-flex align-items-center tx-md-none"><!-- menu bar -->
            <div class="container<?php echo tx_header_layout(); ?> d-flex align-items-center justify-content-lg-between">
                    <!-- Main Menu -->  
                    <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
                    <div class="tx-nav-right-side-items-desktop">
                    <!-- Menu Button -->
                    <?php do_action('tx_menu_btn'); ?>
                    <!-- Search icon -->
                    <?php do_action('tx_search_icon'); ?>
                    <!-- Wishlist icon -->
                    <?php do_action('tx_wishlist_icon'); ?>
                    <!-- Cart icon -->
                    <?php do_action('tx_cart_icon'); ?>
                    <!-- Side menu -->
                    <?php do_action('tx_sidemenu_icon'); ?>
                    </div><!-- tx-nav-right-side-items-desktop -->
            </div><!-- /.container -->
        </div><!-- /.menu-bar -->
    	<div class="container<?php echo tx_header_layout(); ?> tx-main-head-contain  d-flex align-items-center justify-content-center">
            <!-- Main Menu -->
            <div class="tx-spec-mob-nav d-md-none"><?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?></div>
            <!-- logo -->
            <div class="tx-spec-logo text-center d-flex align-items-center"><?php do_action('tx_logo'); ?></div>
            
        </div><!-- /.container -->
    </div><!-- /#h-style-4 -->
</div><!-- header-style-four -->