<?php
/**
 * The template for displaying all single posts.
 */

$post_layout = 'layout-1';
if (get_post_meta(get_the_ID(), 'meta_post_layout', true) != null) {
    $post_layout = get_post_meta(get_the_ID(), 'meta_post_layout', true);
}

get_header();
while (have_posts()) : the_post();
    switch ($post_layout) {
        case 'layout-1' :
            get_template_part('template-parts/content/content', 'layout-1');
            break;
        case 'layout-2' :
            get_template_part('template-parts/content/content', 'layout-2');
            break;
        case 'layout-3' :
            get_template_part('template-parts/content/content', 'layout-3');
            break;
        case 'layout-4' :
            get_template_part('template-parts/content/content', 'layout-4');
            break;
        case 'layout-5' :
            get_template_part('template-parts/content/content', 'layout-5');
            break;
    }
endwhile;
if (esc_html(ot_get_option('related_posts')) == 'on') : ?>
    </div>
    <div class="im-main-row im-related-posts-row clearfix">
    <div class="im-related-posts">
        <div class="col-md-12">
            <div class="widget-head">
                <strong class="widget-title"><?php echo esc_html__('Related Posts', 'iranomag'); ?></strong>
                <div class="widget-head-bar"></div>
                <div class="widget-head-line"></div>
            </div>
        </div>
        <ul class="clearfix">
            <?php
            $tags = '';
            if( ot_get_option('related_posts_option') == 'tags' ) {
                $tags = wp_get_post_tags(get_the_ID(), array('fields' => 'ids'));
            }

            $categoryIDArray = [];
            if( ot_get_option('related_posts_option') == 'categories' ) {
                $categories = get_the_category();
                foreach ($categories as $category) {
                    array_push($categoryIDArray, $category->cat_ID);
                }
            }

            if( ot_get_option('related_posts_option') == 'both' ) {
                $tags = wp_get_post_tags($id, array('fields' => 'ids'));
                $categories = get_the_category();
                foreach ($categories as $category) {
                    array_push($categoryIDArray, $category->cat_ID);
                }
            }

            $count = esc_attr(ot_get_option('related_post_count'));

            // Setup $args
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => $count,
                'ignore_sticky_posts' => 1,
                'category__in' => $categoryIDArray,
                'tag__in' => $tags,
                'post__not_in' => array($id),
                'paged' => 0
            );

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<li>';
                    get_template_part('template-parts/content/content', 'related');
                    echo '</li>';
                }
            }
            wp_reset_postdata();
            ?>
        </ul>
    </div>
    <script>

        jQuery(document).ready(function () {
            var getMax = function () {
                return jQuery(document).height() - jQuery(window).height();
            }

            var getValue = function () {
                return jQuery(window).scrollTop();
            }

            if ('max' in document.createElement('progress')) {
                // Browser supports progress element
                var progressBar = jQuery('progress');

                // Set the Max attr for the first time
                progressBar.attr({max: getMax()});

                jQuery(document).on('scroll', function () {
                    // On scroll only Value attr needs to be calculated
                    progressBar.attr({value: getValue()});
                });

                jQuery(window).resize(function () {
                    // On resize, both Max/Value attr needs to be calculated
                    progressBar.attr({max: getMax(), value: getValue()});
                });
            }
            else {
                var progressBar = jQuery('.progress-bar'),
                    max = getMax(),
                    value, width;

                var getWidth = function () {
                    // Calculate width in percentage
                    value = getValue();
                    width = (value / max) * 100;
                    width = width + '%';
                    return width;
                }

                var setWidth = function () {
                    progressBar.css({width: getWidth()});
                }

                jQuery(document).on('scroll', setWidth);
                jQuery(window).on('resize', function () {
                    // Need to reset the Max attr
                    max = getMax();
                    setWidth();
                });
            }
        });

    </script>
<?php endif;
get_footer();

/*
* 3micolon official website
*/
