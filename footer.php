<?php $options = HASH_WSH()->option(); 
$show_footer =  hash_wow_sh_set( $options, 'show_footer' );
if($show_footer):
    ?>

<footer class="footer_area">

    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="footer_top_box">
                        
                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-xs-12">
                               <?php if(is_active_sidebar('footer-sidebar-1')) dynamic_sidebar('footer-sidebar-1'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                               <?php if(is_active_sidebar('footer-sidebar-2')) dynamic_sidebar('footer-sidebar-2'); ?>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                               <?php if(is_active_sidebar('footer-sidebar-3')) dynamic_sidebar('footer-sidebar-3'); ?>
                            </div>

                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="footer_bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="footer_bottom_box">
            <p> <?php echo balanceTags(hash_wow_sh_set($options, 'copy_right'));?> </p>
        </div>
    </div>
</div>
</div>
</div>
</footer>

<?php endif; ?>

<?php wp_footer(); ?>

</body>

</html>