<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="<?php echo esc_attr(ot_get_option('accent_color')); ?>"/>
    <meta name="fontiran.com:license" content="P9REM">
    <?php wp_site_icon(); ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php esc_html(body_class()); ?>>

<?php if (!is_single()) : ?>
    <h1 class="hidden"><?php bloginfo('name') . wp_title('-'); ?></h1>
<?php endif; ?>

<progress class="im-post-progress" value="0"></progress>

<div class="hidden visible-sm visible-xs">
    <?php get_template_part('template-parts/header/header', 'mobile'); ?>
</div>

<div class="hidden visible-sm visible-xs">
    <?php get_template_part('template-parts/header/header', 'offcanvas'); ?>
</div>

<div class="hidden-sm hidden-xs">
    <?php header_style(ot_get_option('header_style')); ?>
</div>

<div class="hidden-sm hidden-xs">
    <?php get_template_part('template-parts/header/header', 'fixed'); ?>
</div>

<?php if (esc_html(ot_get_option('top_ad')) != null) { ?>
    <div class="im-top-ad container">
        <div class="col-md-12">
            <?php echo ot_get_option("top_ad"); ?>
        </div>
    </div>
<?php }
/*
* 3micolon official website
*/
?>

<?php if (ot_get_option('bc_status') === 'on' && in_array(ot_get_option('bc_position'), array ('top', 'both'))) : ?>
<?php if (is_single() && !in_array(get_post_meta(get_the_ID(), 'meta_post_layout', true), array ('layout-4', 'layout-5'))) : ?>
<div class="container">
    <?php endif; ?>
    <div class="im-breadcrumb im-breadcrumb-top row<?php echo (is_single() && in_array(get_post_meta(get_the_ID(), 'meta_post_layout', true), array ('layout-4', 'layout-5'))) ? ' im-breadcrumb-full' : '' ?>">
        <div class="container">
            <?php if (class_exists('WooCommerce')) {
                if (!is_woocommerce()) {
                    the_breadcrumb();
                } elseif (is_woocommerce()) {
                    woocommerce_breadcrumb();
                }
            } else {
                the_breadcrumb();
            } ?>
        </div>
    </div>
    <?php endif; ?>
    <?php if (is_single() && !in_array(get_post_meta(get_the_ID(), 'meta_post_layout', true), array ('layout-4', 'layout-5'))) : ?>
</div>
<?php endif; ?>

<div class="im-content container">
    <div class="im-main-row clearfix">
