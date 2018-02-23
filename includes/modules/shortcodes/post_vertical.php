<?php
$animation = ($animation) ? $animation : 'fadeInUp';
$anim_speed = ($anim_speed) ? $anim_speed : '0.2';   
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['category_name'] = $cat;
   $query = new WP_Query($query_args) ;
   if( $query->have_posts() ): 
       //echo print_r($cat);exit;
   $extra_class .= ($style2) ? ' ht_banner_right' : ''; ?>
   <div class="hp_banner_left <?php echo esc_attr( $extra_class ); ?>">
        
        <?php   while($query->have_posts()): $query->the_post();?>
        
        <div class="bl_single_news animated out"  data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>"> 
          <?php the_post_thumbnail('hash_wow_themes_276x450', array('class' => 'img-responsive'));
              echo ( ($query->current_post) == 0) ? '<div class="tag_new" ><a href="'. $tagurl .'">'. $tagline .'</a></div>' : '';
          ?>
          <div class="bl_single_text"> 
            <a href="<?php the_permalink(); ?>">
              <h4>
                <?php the_title();?>
              </h4>
            </a> <span><i class="fa fa-clock-o"></i>
        <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
        
        </span> 
          </div>
        </div>

    <?php endwhile;?>
</div>
<?php endif;
wp_reset_postdata();
