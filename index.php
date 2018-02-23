<?php if (!defined('ABSPATH')) exit('Restricted Access'); ?>
<?php $allowed_tags = wp_kses_allowed_html('post'); 
get_header();



$settings = HASH_WSH()->option();


if ($wp_query->is_posts_page) {

    $queried_object = get_queried_object();

    $meta = HASH_WSH()->get_meta('_sh_layout_settings', $queried_object->ID); 

    $meta1 = HASH_WSH()->get_meta('_sh_header_settings', $queried_object->ID); //printr($meta1);

    $layout = (hash_wow_sh_set($meta, 'layout')) ? hash_wow_sh_set($meta, 'layout') : 'right';

    $page_sidebar = hash_wow_sh_set($meta, 'sidebar', 'default-sidebar');

    $bg = hash_wow_sh_set($meta1, 'bg_image');

    $title = get_the_title($queried_object->ID);
} else {


    $layout = (hash_wow_sh_set($settings, 'blog_page_layout')) ? hash_wow_sh_set($settings, 'blog_page_layout') : 'right';

    $page_sidebar = hash_wow_sh_set($settings, 'blog_page_sidebar', 'default-sidebar');

    $title = hash_wow_sh_set($settings, 'blog_page_title', 'Blog');
}

$sidebar = $page_sidebar ? $page_sidebar : 'default-sidebar';
$classes = ( $layout && $layout === 'full') ? 'col-md-12 col-sm-12 col-xs-12' : 'col-md-9 col-sm-9 col-xs-12';
$cols = (hash_wow_sh_set($settings, 'blog_grids_cols')) ? hash_wow_sh_set($settings, 'blog_grids_cols') : 4;
if($cols == '6') $size = '530x450';
else $size = '399x270';
?>

<div class="breadcumb_common_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="breadcum_c_left">
                    <p><?php echo esc_html($title); ?></p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="breadcum_c_right">
                    <?php echo hash_wow_themes_get_the_breadcrumb(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="main_news_wrapper cc_single_post_wrapper">
    <div class="container">
        <div class="row">
            <?php if ($layout == 'left' && is_active_sidebar($sidebar)): ?>
                <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>
                <?php endif; ?>
                <div class="<?php echo esc_attr($classes); ?>">
                    <div class="cc_single_post">
                        <div class="row">
                            <?php if (have_posts()): ?>
                                <?php while (have_posts()): the_post(); ?>
                                    
                                    <?php if( false ) : ?>
                                    <div class="col-md-<?php echo esc_attr($cols);?> col-sm-<?php echo esc_attr($cols);?> col-xs-12 ">
                                        <div class="fs_news_left">
                                            <div class="single_fs_news_left_text">
                                                <div class="fs_news_left_img">
                                                    <?php the_post_thumbnail($size);?>
                                                    <?php echo hash_wow_themes_post_formate_icon(get_post_format(get_the_ID()));?>
                                                    
                                                </div>
                                                <h4>
                                                    <a href="<?php echo esc_url(get_permalink(get_the_ID()));?>"><?php the_title();?></a>
                                                </h4>
                                                <p><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_formate'), get_the_ID());?> <i class="fa fa-comment"></i> <?php comments_number();?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php else: ?>
                                        <?php get_template_part('blog'); ?>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                               
                            <?php else: ?>
                                <p><?php esc_html_e('No posts found', 'hash') ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="animated out" data-animation="fadeInUp" data-delay="0.2">
                            <?php hash_wow_themes_the_pagination(); ?>
                        </div>
                    </div>
                </div>
                <?php if ($layout == 'right' && is_active_sidebar($sidebar)): ?>
                    <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                        <?php dynamic_sidebar($sidebar); ?>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</section>




<?php get_footer('multi'); ?>