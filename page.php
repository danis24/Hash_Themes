<?php
$options = HASH_WSH()->option();
get_header();
$settings = hash_wow_sh_set(hash_wow_sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true), 'sh_page_options'), 0);
$meta = HASH_WSH()->get_meta('_sh_layout_settings');
$meta1 = HASH_WSH()->get_meta('_sh_header_settings');
$meta2 = HASH_WSH()->get_meta();
//printr($meta); 
HASH_WSH()->page_settings = $meta;
$layout = hash_wow_sh_set($meta, 'layout', 'full');
if (!$layout || $layout == 'full' || hash_wow_sh_set($_GET, 'layout_style') == 'full')
    $sidebar = '';
else
    $sidebar = hash_wow_sh_set($meta, 'sidebar', 'product-sidebar');
$classes = (!$layout || $layout == 'full' || hash_wow_sh_set($_GET, 'layout_style') == 'full' ) ? ' col-md-12 col-sm-12 col-xs-12' : ' col-md-8 col-sm-8 col-xs-12';
$bg = hash_wow_sh_set($meta1, 'bg_image');
$title = hash_wow_sh_set($meta1, 'header_title');
?>

<div class="breadcumb_common_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="breadcum_c_left">
                    <p><?php the_title();?></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="breadcum_c_right">
                    <ul>
                        <li>
                            <?php echo hash_wow_themes_get_the_breadcrumb(); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="product-list-area section-padding main_news_wrapper cc_single_post_wrapper">
    <div class="container">

        <div class="cc_single_post">
            
            <div class="row"> 

                <?php if ($layout == 'left'): ?>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
                            <?php if (is_active_sidebar($sidebar)) dynamic_sidebar($sidebar); ?>
                        </div>
                    </div>

                <?php endif; ?><!-- end sidebar -->	

                <div class="<?php echo esc_attr($classes); ?>">                    
                    <?php while (have_posts()): the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="blog row m0 single_post">

                                <div class="desc">
                                    <?php the_content(); ?>
                                </div>

                                <?php the_tags('<div class="tags">', ', ', '</div>'); ?>

                                <div class="clearfix"></div>



                            </div>
                        </div>

                        <?php comments_template();?>

                    <?php endwhile; ?>

                </div>

                <?php if ($layout == 'right'): ?>

                    <div class="pull-right col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
                            <?php if (is_active_sidebar($sidebar)) dynamic_sidebar($sidebar); ?>
                        </div>
                    </div>

                <?php endif; ?><!-- end sidebar -->
            
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>