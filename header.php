<?php if (!defined('ABSPATH')) exit('Restricted Access'); ?>

<?php $options = HASH_WSH()->option();?>

<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6">    <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7">    <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8">    <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9">    <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php $main_menu_output = hash_wow_themes_main_menu_output(); ?>

        <?php wp_head(); ?>
    </head>
    <body itemscope="" itemtype="http://schema.org/WebPage" <?php body_class(); ?>>

        <!-- ~~~=| Header START |=~~~ -->
        <header class="header_area">
            <div class="header_top">
                <div class="container">
                    <div class="row">
                        <?php dynamic_sidebar('top-sidebar'); ?>
                    </div>
                </div>
            </div>

            <!-- ~~~=| Logo Area START |=~~~ -->
            <div class="header_logo_area">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="logo"> 
                                <?php //print_r($options);exit;
                                $log_url = hash_wow_sh_set($options, 'logo_type', get_template_directory_uri() . '/images/logo.png');
                                $log_url = ( $log_url ) ? $log_url : get_template_directory_uri() . '/images/logo.png';
                                $logo_size = @getimagesize($log_url);
                                ?> 
                                <a title="<?php echo esc_attr(get_bloginfo('name')); ?>" href="<?php echo esc_url(home_url()); ?>">
                                    <img src="<?php echo esc_url($log_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" width="<?php echo hash_wow_sh_set($logo_size, 0); ?>" height="<?php echo hash_wow_sh_set($logo_size, 1); ?>"> 
                                </a>
                            </div>
                        </div>

                        <!-- ~~~=| ADD DIV START HERE |=~~~ -->
                        <?php if (hash_wow_sh_set($options, 'header_add')): ?>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="header_add">
                                    <a href="<?php echo hash_wow_sh_set($options, 'add_url'); ?>">
                                        <img src="<?php echo hash_wow_sh_set($options, 'header_add'); ?>" alt="Site add"/>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- ~~~=| ADD DIV END HERE |=~~~ -->

                    </div>
                </div>
            </div>
            <!-- ~~~=| Logo Area END |=~~~ --> 

            <!-- ~~~=| Main Navigation START |=~~~ -->
            <div class="mainnav">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <nav class="main_nav_box">
                                <ul id="nav">
                                    <?php echo balanceTags($main_menu_output); ?>
                                </ul>
                            </nav>
                            
                            
                            <!-- ~~~=| Mobile Navigation END |=~~~ -->
                            <div class="only-for-mobile">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <ul class="ofm">
                                  <li class="m_nav"><i class="fa fa-bars"></i> <?php bloginfo('name'); ?></li>
                                </ul>

                                <!-- MOBILE MENU -->
                                <div class="mobi-menu">
                                    <div id='cssmenu'>
                                         <ul>
                                            <?php
                                            wp_nav_menu(array('theme_location' => 'mobile_menu', 'container_id' => 'navbar-collapse-1',
                                                'container_class' => 'navbar-collapse collapse',
                                                'menu_class' => 'nav navbar-nav navbar-right',
                                                'fallback_cb' => false,
                                                'items_wrap' => '%3$s',
                                                'container' => false,
                            //'walker' => new SH_Bootstrap_walker()
                                                ));
                                                ?>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- ~~~=| Main Navigation END |=~~~ --> 
            
        </header>
        
        
        
        
        