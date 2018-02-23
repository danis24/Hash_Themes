<?php /* Template Name: VC Page */

get_header() ;

$meta = HASH_WSH()->get_meta();

$meta1 = HASH_WSH()->get_meta('_sh_header_settings');

?>

<?php $bg = hash_wow_sh_set( $meta1, 'bg_image' ) ? $meta1['bg_image'] : ''; ?>



<?php if(hash_wow_sh_set($meta1, 'bread_crumb')):?>

<section class="page-title-area" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>

	<div class="page-title-overlay">

		<div class="container">

			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">

					<div class="page-title">

						<h3><?php if(hash_wow_sh_set($meta1, 'header_title')) echo hash_wow_sh_set($meta1, 'header_title'); else echo wp_title('');?></h3>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>


<div class="title-breadcrumb">

	<div class="container">

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">

				<div class="bred-title">

					<h3><?php if(hash_wow_sh_set($meta1, 'header_title')) echo hash_wow_sh_set($meta1, 'header_title'); else echo wp_title('');?></h3>

				</div>

					<?php echo hash_wow_themes_get_the_breadcrumb(); ?>

			</div>

		</div>

	</div>

</div>


<?php endif;?>

<section>
    <div class="container">
        
        <?php //if( !hash_wow_sh_set( $meta, 'is_home' ) ) get_template_part( 'includes/modules/header/header', 'single' ); ?>

    	<?php while( have_posts() ): the_post(); ?>
    
    	     <?php the_content(); ?>
    
    	<?php endwhile;  ?>
    </div>
</section>


<?php get_footer() ; ?>