<?php if (!defined('ABSPATH')) exit('Restricted Access'); ?>

<?php $allowed_tags = wp_kses_allowed_html('post'); ?>
<?php
get_header();

$settings = HASH_WSH()->option();
$queried_object = get_queried_object();
$layout = (hash_wow_sh_set($settings, 'category_page_layout')) ? hash_wow_sh_set($settings, 'category_page_layout') : '';
$page_sidebar = hash_wow_sh_set($settings, 'category_page_sidebar', 'blog-sidebar');
$title =$queried_object->name;	
$sidebar = $page_sidebar ? $page_sidebar : 'blog-sidebar';
$classes = ( $layout && $layout === 'full') ? 'col-md-12 col-sm-12 col-xs-12' : 'col-md-9 col-sm-9 col-xs-12';
$cols = (hash_wow_sh_set($settings, 'blog_grids_cols')) ? hash_wow_sh_set($settings, 'blog_grids_cols') : 4;
if($cols == '6') $size = 'hash_wow_themes_530x450';
else $size = 'hash_wow_themes_399x270';

$divider = ( $cols == 6 ) ? 2 : 3;?>

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
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>
                <?php endif; ?>
                <div class="<?php echo esc_attr($classes); ?>">
                    <div class="cc_single_post">
                        <div class="row">
                            <?php if (have_posts()): ?>
                                <?php while (have_posts()): the_post(); 

                                    $first_class = ( ($wp_query->current_post % $divider ) == 0 ) ? ' first' : ''; ?>
                                    <div class="col-md-<?php echo esc_attr($cols);?> col-sm-<?php echo esc_attr($cols.$first_class);?> col-xs-12 ">
                                        <div class="fs_news_left">
                                            <div class="single_fs_news_left_text">
                                                <div class="fs_news_left_img">
                                                    <?php //the_post_thumbnail($size);?>
                                                     <?php get_template_part('templates/list/format', get_post_format()); ?>
                                                </div>
                                                <h4>
                                                    <a href="<?php echo esc_url(get_permalink(get_the_ID()));?>"><?php the_title();?></a>
                                                </h4>
                                                <p><i class="fa fa-clock-o"></i> <?php echo get_the_date(get_option('date_formate'), get_the_ID());?> <i class="fa fa-comment"></i> <?php comments_number();?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                               
                            <?php else: ?>
                                <p><?php esc_html_e('No posts found', 'hash') ?></p>
                                <?php echo get_search_form();?>
                            <?php endif; ?>
                        </div>
                        <?php hash_wow_themes_the_pagination(); ?>
                    </div>
                </div>
                <?php if ($layout == 'right' && is_active_sidebar($sidebar)): ?>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                        <?php dynamic_sidebar($sidebar); ?>
                        </div>
                        <?php endif; ?>
                </div>
    </div>
</section>



<?php get_footer('wp_hash'); ?>