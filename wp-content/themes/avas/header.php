<?php
/**
* 
* @package tx
* @author theme-x
*
*  Header main file
*/
global $tx;
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1" name="viewport">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    
<body <?php body_class(); ?>>
    <?php if ($tx['preloader']) : get_template_part( 'template-parts/pre', 'loader' ); endif; ?>
    <?php wp_body_open(); ?>
    <?php if($tx['top_head'] && $tx['login_reg']) : get_template_part( 'template-parts/login', 'form'); endif; ?>

    <div id="page" class="tx-wrapper container<?php echo tx_page_layout(); ?>">
        <div class="row">
       
            <header id="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader" class="tx-header">
                <!-- search -->
                <?php do_action('tx_search'); ?>
            <?php if($tx['header-select'] != 'header10') : ?>            
                
                <!-- top header -->
                <?php if($tx['top_head']) : get_template_part( 'template-parts/header/top', 'header'); endif; ?>
            <?php endif; ?>
                <!-- main header -->
                <?php if(class_exists('ReduxFramework')) { ?>
                <?php do_action('header-style'); ?>
                <?php if($tx['side_menu']) : get_template_part( 'template-parts/header/menu/side', 'menu' ); endif; ?>

                <?php } else { ?>
                <div id="h-style-3" class="main-header">
                    <div class="container<?php echo tx_header_layout(); ?>">
                        <div class="row">
                            <!-- logo -->
                            <div class="col-lg-3 col-sm-12">
                                <?php do_action('tx_logo'); ?>
                            </div><!-- logo end -->
                            <!-- <div class="col-lg-9 col-sm-12 menu_area"> -->
                                <!-- Main Menu -->  
                                <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
                                <!-- <div class="menu-area-right"> -->
                                <!-- Side menu -->
                                <?php get_template_part( 'template-parts/header/menu/side', 'menu' ); ?>
                                <!-- Search icon -->
                                <?php do_action('tx_search_icon'); ?>
                                <!-- Menu Button -->
                                <?php do_action('tx_menu_btn'); ?>
                               <!--  </div> --><!-- /.menu-area-righ -->
                            <!-- </div> --><!-- col-lg-9 col-sm-12 menu_area -->
                        </div> <!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /#h-style-3 -->
                <?php } ?>    
                
                <?php 
                    global $tx;   
                    if($tx['elem_head_switch'] == 1) :
                ?>
                <!-- <div class="container"> -->
                <?php  
                    $tp = $tx['elem_head'];
                    echo do_shortcode( "[elementor-template id= $tp]" ); 
                ?>
                <!-- </div> -->
                <?php endif; ?><!-- Elementor Template Header -->
                
                <?php
                if( !is_front_page() && !is_404() && !is_page_template( 'templates/no-sub.php' )) :
                    if (class_exists('ReduxFramework')) {
                        if($tx['sub-header-switch']) {
                            get_template_part( 'template-parts/header/sub', 'header' );
                        }
                    } else {
                        get_template_part( 'template-parts/header/sub', 'header' );
                    }
                endif;
                ?><!-- sub header -->

            </header><!-- /#header -->   

        <!-- /.row -->