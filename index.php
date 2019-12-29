<?php
/**
 * The main template file.
 *
 * @package iranomag
 */

$status = ot_get_option('grid_status');
$style = ot_get_option('grid_style', array());
$source = ot_get_option('grid_source', array());
$excluded_tag_ids = ot_get_option('grid_excluded_tag_ids');
$excluded_cat_ids = ot_get_option('grid_excluded_cat_ids');
$cat = implode(',', ot_get_option('grid_cat', array()));
$post_ids = ot_get_option('grid_post_ids');
$tag_slugs = ot_get_option('grid_tag_slugs');
$author_ids = ot_get_option('grid_author_ids');

get_header(); ?>
	<?php if($status == 'on') : ?>
	<div class="im-blog-grid col-md-12">
		<?php echo im_postgrid_blog($style, $source, $excluded_tag_ids, $excluded_cat_ids, $cat, $post_ids, $tag_slugs, $author_ids); ?>
	</div>
	<?php endif; ?>
	<div class="im-content-area col-md-8 col-sm-12">
		<main class="im-blog row" role="main">
		<?php
		if ( have_posts() ) :
			echo '<div class="clearfix">';
			while ( have_posts() ) : the_post();
				switch (ot_get_option('blog_type')) {
					case '1col' :
						if(get_post_meta( get_the_ID(), 'meta_featured_post', true ) == 'on' ) {
							get_template_part( 'template-parts/content/content', '1col-featured' );
						}
						else {
							get_template_part( 'template-parts/content/content', '1col' );
						}
						break;
					case '2col' :
						get_template_part( 'template-parts/content/content', '2col' );
						break;
				}
			endwhile;
			echo '</div>';
			?>
				<div class="col-md-12">
					<?php
						the_posts_pagination(array(
							'prev_text' 			=> '<span>'.esc_html__( "&rarr;", 'iranomag' ).'</span>',
							'next_text' 			=> '<span>'.esc_html__( "&larr;", 'iranomag' ).'</span>',
							'mid_size'				=> 2
						));
						/*
						* IranoMag 2 Designed by Mohammad Ebrahim Ramazankhani (Ebiram), IranoWeb.ir
						* ایرانومگ 2 بوسیله محمد ابراهیم رمضانخانی (Ebiram), در ایرانووب.ir طراحی شده است.
						* فروش و پشتیبانی تنها در مارکت وردپرس
						*/
					?>
				</div>
			<?php
		else :
			get_template_part( 'template-parts/content/content', 'none' );
		endif; ?>
		</main>
	</div>

<?php
get_sidebar();
get_footer();
