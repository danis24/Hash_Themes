<?php  
   global $post;
   $num = hash_wow_sh_set($_GET, 'num' );
   $query_args = array('post_type' => 'sh_portfolio' , 'posts_per_page' => hash_wow_sh_set($_GET, 'num' ) , 'order_by' => hash_wow_sh_set($_GET, 'sort' ) , 'order' => hash_wow_sh_set($_GET, 'order' ));
   if( hash_wow_sh_set($_GET, 'cat' ) && hash_wow_sh_set($_GET, 'cat') != 'all' ) $query_args['portfolio_category'] = hash_wow_sh_set($_GET, 'cat' );
   $query = new WP_Query($query_args) ; //printr($query);?>
   
<?php $data = array();

if($query->have_posts()): 

	while( $query->have_posts() ): $query->the_post();
		ob_start() ?>

    <div class='project-bx'>
      <figure><?php the_post_thumbnail('780x480'); ?></figure>
      <div class='project-bx-text'>
        <div class='bx-table'>
          <div class='bx-cell'>
            <h4><?php the_title();?></h4>
            <a class='cell-link' href='<?php the_permalink();?>' title="<?php the_title_attribute(); ?>"></a>
          </div>
        </div>
      </div>
    </div>
		
		<?php $data[] = ob_get_clean();
	endwhile;
  wp_reset_postdata();

	$newdata = array();
	$chunks = array_chunk( $data, 2 );
	foreach( $chunks as $ch ) $newdata[] = '<div class="prod-wrap">'.implode("\n", $ch ).'</div>'."\n";
	echo json_encode( array('owl' => $newdata ) );

endif; ?>