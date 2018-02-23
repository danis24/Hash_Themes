<?php 
   $animation = ($animation) ? $animation : 'fadeInUp';
   $anim_speed = ($anim_speed) ? $anim_speed : '0.2';
   $query_args = array('post_type' => 'sh_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['team_category'] = $cat;
   $query = new WP_Query($query_args) ;?>
<?php if($query->have_posts()): ?> 

<!--======= TEAM =========-->

<section class="our_authors_area">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="our_authors">
						<h2><?php echo balanceTags($title);?></h2>
						<div class="row">
							<?php  while($query->have_posts()): $query->the_post();
				   					global $post;
									$meta = HASH_WSH()->get_meta('_sh_team_post_options');//print_r($meta);exit;
									$desig = hash_wow_sh_set($meta, 'desig');//print_r($desig);exit;
				   			?>
							<div class="col-md-3 col-sm-3 col-xs-12 animated out" data-animation="<?php echo balanceTags($animation); ?>" data-delay="<?php echo balanceTags($anim_speed); ?>">
								<div class="single_author_about">
									<div class="autor_img"><?php the_post_thumbnail('270x361', array('class' => 'img-responsive'));?></div>
									<div class="author_desc">
										<div class="author_desc_left">
											<h4><?php the_title();?></h4>
											<p><?php echo wp_kses_post($desig);?></p>
										</div>
										<div class="author_desc_right">
										 <?php if($socials = hash_wow_sh_set($meta, 'social_media')): //printr($socials);?>
											<ul>
												<?php foreach($socials as $key => $social):?>
														<li><a class="fa <?php echo hash_wow_sh_set($social, 'social_icon');?>" href="<?php echo hash_wow_sh_set($social, 'social_link');?>"></a></li>
												<?php endforeach;?>
											</ul>
										<?Php  endif; ?>
										</div>
									</div>
								</div>
							</div>
							<?php
							endwhile;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif;  ?>
<?php wp_reset_postdata();