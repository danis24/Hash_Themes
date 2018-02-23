<?php

class Hash_Mega_Menu_Shortcodes {

    protected $keys;

    function __construct() {
        $this->add();
    }

    function add() {

        $options = array('posts_categories', 'featured_post', 'posts_listing');

        $this->keys = $options;
        foreach ($this->keys as $k) {
            if (method_exists($this, $k) && function_exists('sh_shortcode_setup'))
                sh_shortcode_setup('SH_'.$k, array($this, $k));
        }
    }
    
    function posts_categories($atts, $content = null) {
        extract(shortcode_atts(array(
            'categories' => ''
        ), $atts));
        $cats = explode(',', $categories);
        $output = '<div class="single_mega">
                        <ul>';
                        foreach($cats as $cat){
                            $term = get_category_by_slug($cat); 
                            $output .= '<li><a href="'.get_term_link($term).'">'.$term->name.'</a></li>';
                        }
         $output .= '</ul>
                </div>';
        return $output;
    }
    
    function featured_post($atts, $content = null) {
        extract(shortcode_atts(array(
            'post' => ''
        ), $atts));
        
        $args = array(
            'post_type' => 'post',
            'post__in' => array($post)
        );
        $query = new WP_Query($args);
        while($query->have_posts()) : $query->the_post();
            $format = get_post_format(get_the_ID());
            $output = '<div class="single_mega single_mega2">
                        <div class="single_fs_news_left_text">
                          <div class="fs_news_left_img">'.  get_the_post_thumbnail(get_the_ID(), 'hash_wow_themes_399x280').hash_wow_themes_post_formate_icon($format).'

                          </div>
                          <h4><a href="'.  get_permalink(get_the_ID()).'" class="mega_title">'.get_the_title(get_the_ID()).'</a></h4>
                          <p> <i class="fa fa-clock-o"></i> '.get_the_date().' <i class="fa fa-comment"></i> '.get_comments_number().' </p>
                        </div>
                      </div>';
        endwhile;
        wp_reset_postdata();
        return $output;
    }
    
    function posts_listing($atts, $content = null) {
        extract(shortcode_atts(array(
            'category' => '',
            'number' => '',
        ), $atts));
       
        $args = array(
            'post_type' => 'post',
            'showposts' => $number
        );
        if (!empty($category))
            $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category));
        $query = new WP_Query($args);
        
        $output = '<div class="single_mega single_mega3">';
            while($query->have_posts()) : $query->the_post();
                $output .= '<div class="fs_news_right">
                                <div class="single_fs_news_img"> '.get_the_post_thumbnail(get_the_ID(), 'hash_wow_themes_80x80').' </div>
                                <div class="single_fs_news_right_text">
                                  <h4><a href="'.  get_permalink(get_the_ID()).'" class="mega_title1">'.get_the_title(get_the_ID()).'</a></h4>
                                  <p> <i class="fa fa-clock-o"></i> '.get_the_date().' </p>
                                </div>
                            </div>';
            endwhile;
        $output .= '</div>';
        wp_reset_postdata();
        return $output;
    }

}

new Hash_Mega_Menu_Shortcodes;
?>