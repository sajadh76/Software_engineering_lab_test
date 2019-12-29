<?php
/**
 * The template for displaying the footer.
 */
?>

</div>
</div><!-- im-container -->

<?php ( ot_get_option( 'top_btn_position' ) == 'left' ) ? $back_to_top = 'back-to-top-left' : $back_to_top = 'back-to-top-right'; ?>

<a href="#" id="back-to-top" class="<?php echo $back_to_top; ?>"
   title="<?php echo esc_attr( "بازگشت به ابتدای صفحه" ); ?>"><i class="fa fa-arrow-up"></i></a>

<?php if(ot_get_option('bc_status') === 'on' && in_array(ot_get_option('bc_position'), array('bottom', 'both'))) : ?>
<div class="im-breadcrumb">
    <div class="container">
		<?php if ( class_exists( 'WooCommerce' ) ) {
			if ( ! is_woocommerce() ) {
				the_breadcrumb();
			} elseif ( is_woocommerce() ) {
				woocommerce_breadcrumb();
			}
		} else {
			the_breadcrumb();
		} ?>
    </div>
</div>
<?php endif; ?>

<?php get_template_part( 'template-parts/footer/footer' );
/*
* 3micolon official website
?>

<?php wp_footer(); ?>
<?php if ( ot_get_option( 'Lazy_load' ) == 'on' ) : ?>
    <script type="text/javascript">
        jQuery('.lazy-img').unveil(300, function () {
            "use strict";
            jQuery(this).load(function () {
                this.style.opacity = 1;
            });
        });
    </script>
<?php endif;
if ( ot_get_option( 'sticky_kit' ) == 'on' ) : ?>
    <script type="text/javascript">
        enquire.register("screen and (min-width:992px)", {
            match: function () {
                "use strict";
                jQuery(".sticky-sidebar").stick_in_parent({offset_top: fixed_header_height});
            },
            unmatch: function () {
                "use strict";
                jQuery(".sticky-sidebar").trigger("sticky_kit:detach");
            },
        });
    </script>
<?php endif; ?>
</body>
</html>
