<?php if (!defined('ABSPATH')) exit('Restricted Access'); ?>

<?php
get_header();
$settings = HASH_WSH()->option();
$post_meta = HASH_WSH()->get_meta( '_sh_single_post_options');//echo '<pre>';print_r($post_meta);exit;
$layout = (hash_wow_sh_set($post_meta, 'layout')) ? hash_wow_sh_set($post_meta, 'layout') : 'right';
$page_sidebar = '';
$sidebar = $page_sidebar ? $page_sidebar : 'default-sidebar';
$classes = ( $layout && $layout === 'full') ? 'col-md-12 col-sm-12 col-xs-12' : 'col-md-9 col-sm-9 col-xs-12';
$cols = (hash_wow_sh_set($settings, 'blog_grids_cols')) ? hash_wow_sh_set($settings, 'blog_grids_cols') : 4;
if ($cols == '6')
    $size = '530x450';
else
    $size = '399x270';
?>

<section class="main_news_wrapper cc_single_post_wrapper">
    <div class="container">
        <div class="row">
            
            <?php if ($layout == 'left' && is_active_sidebar($sidebar)): ?>
                
                <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>

            <?php endif; ?>
   
            <div class="<?php echo esc_attr($classes); ?>">
                <?php while(have_posts()) : the_post();?>
                    <div class="cc_single_post animated out" data-animation="fadeInUp" data-delay="0.2">
                    <?php get_template_part('templates/list/format', get_post_format()); ?>
                    <div class="sp_details animated out" data-animation="fadeInUp" data-delay="0.2">
                        <?php if(hash_wow_sh_set($settings, 'single_post_categories')):?>
                            <?php the_category(' ');?>
                        <?php endif;?>
                        <h2 itemprop="headline"><?php the_title();?></h2>
                        <?php if(hash_wow_sh_set($settings, 'single_post_author') || hash_wow_sh_set($settings, 'single_post_views') || hash_wow_sh_set($settings, 'single_post_comment')):?>
                            <div class="post_meta">
                                <ul>
                                    <?php echo (hash_wow_sh_set($settings, 'single_post_author')) ? '<li itemprop="author"><a href="'.get_author_posts_url(get_the_author_meta('ID')).'"><i class="fa fa-user"></i>'.esc_html__('By ', 'hash').ucwords(get_the_author_meta('display_name')).'</a></li>' : '';?>
                                    <?php echo (hash_wow_sh_set($settings, 'single_post_views')) ? '<li><a href="javascript:void(0);"><i class="fa fa-eye"></i>'.hash_wow_themes_get_post_view(get_the_ID()).'</a></li>' : '';?>
                                    <?php echo (hash_wow_sh_set($settings, 'single_post_comment')) ? '<li><a href="#comments"><i class="fa fa-comment-o"></i>'.get_comments_number().'</a></li>' : '';?>
                                </ul>
                            </div>
                        <?php endif;?>
                        <div class="post_text" itemprop="description">
                            <?php the_content();?>
                        </div>
                        
                        <?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'hash'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
                        
                        <?php if(hash_wow_sh_set($settings, 'single_post_tags')):?>
                            <div class="social_tags">
                            
                                <div class="social_tags_left">
                                    <p><?php esc_html_e('Tags :', 'hash');?></p>
                                    <ul>
                                        <?php hash_wow_themes_get_tags();?>
                                    </ul>
                                </div>
                            
                                <?php if(hash_wow_sh_set($settings, 'single_post_social')):?>
                                    <?php $social_icons = hash_wow_sh_set($settings, 'single_post_social_media');//echo '<pre>';print_r($social_icons);exit;?>
                                    <?php if(!empty($social_icons)):?>
                                        <div class="social_tags_right">
                                            <ul>
                                                <?php foreach($social_icons as $s_icon){
                                                    echo hash_wow_themes_social_share_output($s_icon);
                                                }?>
                                            </ul>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>

                        <?php endif;?>
                        <?php if(hash_wow_sh_set($settings, 'single_post_navigation')):?>
                            <div class="sp-next-prev">
                                <?php if (get_previous_post_link('%link')) : ?>
                                    <div class="sp-prev">
                                       <?php echo get_previous_post_link('%link', '<i class="fa fa-angle-double-left"></i>'.esc_html__('Previous Post', 'hash')); ?>
                                        <div class="sp-prev-post">
                                            <?php echo get_previous_post_link('%link', '%title');?>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <div class="sp-next">
                                    <?php echo get_next_post_link('%link', esc_html__('Next Post', 'hash').'<i class="fa fa-angle-double-right"></i>');?>
                                    <div class="sp-next-post">
                                        <?php echo get_next_post_link('%link', '%title');?>
                                    </div>
                                </div>
                            </div>
                        <?php endif;?>
                        <div class="animated out" data-animation="fadeInUp" data-delay="0.2">
                            <?php comments_template();?>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>

            <?php if ($layout == 'right' && is_active_sidebar($sidebar)): ?>
                <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                    <?php dynamic_sidebar($sidebar); ?>
                </div>
            <?php endif; ?>
        
        </div>
    </div>
</section>
<?php hash_wow_themes_set_post_view(get_the_ID());?>


<?php get_footer('wp_hash'); ?>