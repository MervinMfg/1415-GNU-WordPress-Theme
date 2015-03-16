<?php
/**
 * Mervin Mfg. WordPress Theme Template functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage 1415-GNU-WordPress-Theme
 * @since 1415 GNU WordPress Theme 1.0.0
 */

// Theme Setup (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function gnu_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
	add_theme_support( 'post-formats', array( 'audio', 'video', 'chat', 'gallery', 'image', 'quote' ) );
	register_nav_menu( 'primary', 'Primary Navigation Menu' );
    register_nav_menu( 'secondary', 'Secondary Navigation Menu' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'gnu_setup' );

if ( function_exists( 'add_image_size' ) ) {
	// thumbnail - 200x200
	// medium - 640x640
	// large - 1024x1024
    // additional image sizes
    add_image_size('square-medium', 400, 400, true);
    add_image_size('blog-feature', 640, 360, true);
}

// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
function html5reset_scripts_styles() {
	global $wp_styles;
	// Load Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );
//OLD STUFF BELOW
// Load jQuery
if ( !function_exists( 'core_mods' ) ) {
	function core_mods() {
        if ( !is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', ( "//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ), false);
			wp_enqueue_script( 'jquery' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'core_mods' );
}
// Clean up the <head>, if you so desire.
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
// Custom Menu
register_nav_menu( 'primary', 'Navigation Menu' );

// Navigation - update coming from twentythirteen
function post_navigation() {
	/*echo '<div class="navigation">';
	echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
	echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
	echo '</div>';*/
    global $wp_query;
    if ( $wp_query->max_num_pages > 1 ) {
        echo '<div class="pagination">';
        $big = 999999999; // need an unlikely integer
        echo paginate_links(
            array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'prev_text'    => __('Prev'),
                'next_text'    => __('Next')
            )
        );
        echo '</div>';
    }
}

// REMOVE AUTOMATED CSS MENU CLASSES, CLEAN 'EM UP!
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('menu-item', 'current-menu-item', 'boards', 'bindings', 'supplies', 'team', 'blog', 'events', 'about', 'locator')) : '';
}

// GET REGION CODE
function getCurrencyCode () {
	if (isset($_COOKIE["gnu_currency"])) {
		$GLOBALS['gnu_currency'] = $_COOKIE["gnu_currency"];
	} else {
		$GLOBALS['gnu_currency'] = "USD";
	}
	return $GLOBALS['gnu_currency'];
}

// GET PRICE DISPLAY
function getPrice ($usPrice, $caPrice, $eurPrice, $sale, $salePercent) {
	$price = '<div class="price">';
	if ($sale == "Yes") {
		// US Sale Price
		$price .= '<p class="us-price strike">$' . $usPrice . ' <span class="currency-note">USD</span></p><p class="us-price"><span itemprop="priceCurrency" content="USD">$</span><span itemprop="price">' . round($usPrice * ((100 - $salePercent) / 100), 2) . '</span> <span class="currency-note">USD (' . $salePercent . '% off)</span></p>';
		// CA Sale Price
		$price .= '<p class="ca-price strike">$' . $caPrice . ' <span class="currency-note">CAD</span></p><p class="ca-price">$' . round($caPrice * ((100 - $salePercent) / 100), 2) . ' <span class="currency-note">CAD (' . $salePercent . '% off)</span></p>';
		// EU Sale Price
		$price .= '<p class="eur-price strike">€' . $eurPrice . ' <span class="currency-note">EUR incl. VAT</span></p><p class="eur-price">€' . round($eurPrice * ((100 - $salePercent) / 100), 2) . ' <span class="currency-note">EUR incl. VAT (' . $salePercent . '% off)<span></p>';
	} else {
		// US Price
		$price .= '<p class="us-price"><span itemprop="priceCurrency" content="USD">$</span><span itemprop="price" content="' . $usPrice . '">' . $usPrice . '</span> <span class="currency-note">USD</span></p>';
		// CA Price
		$price .= '<p class="ca-price">$' . $caPrice . ' <span class="currency-note">CAD</span></p>';
		// EU Price
		$price .= '<p class="eur-price">€' . $eurPrice . ' <span class="currency-note">EUR incl. VAT</span></p>';
	}
	$price .= '</div><!-- .price -->';
	return $price;
}

// get the featured image of a post in a specified size, if no featured image set grab 1st image in post, if no image return default
function get_post_image($imageSize = "thumbnail", $imageName = "") {
    global $post;
    if ($imageName == "") {
        // just getting default thumbnail for post
        if ( has_post_thumbnail() ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $imageSize);
        }else{
            $files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
            if($files){
                $keys = array_reverse(array_keys($files));
                $j=0;
                $num = $keys[$j];
                $image = wp_get_attachment_image_src($num, $imageSize, false);
            }else{
                // if no image is found use default image
                $image = array(get_bloginfo('template_url')."/_/img/blog-stock-image.png",300,300);
            }
        }
    } else {
        // getting a specific image for the post
        $image = get_post_meta($post->ID, $imageName, true);
        $image = wp_get_attachment_image_src($image, $imageSize, false);
    }
    return $image;
}
// EXCERPT LENGTH CONTROLLERS
// Puts link in excerpts more tag
function new_excerpt_more($more) {
    global $post;
    //return '... <a class="moretag" href="'. get_permalink($post->ID) . '">Continue Reading</a>';
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
// default excerpt length
function new_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');
// custom excerpt length for home page
function gnu_excerptlength_home($length) {
    return 20;
}
// custom excerpt length for home page
function gnu_excerptlength_blog($length) {
    return 40;
}
function gnu_excerpt($length_callback='gnu_excerptlength_home') {
    global $post;
    add_filter('excerpt_length', $length_callback);
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    echo $output;
}
// removes auto paragraph wrapper
remove_filter('the_excerpt', 'wpautop');

// function to determine the proper size to display for bindings
function bindingSizeLookup ($sizeString, $verbose = true) {
    $returnString = "";
    switch ($sizeString) {
        case "XS (US 1-4)":
            if ($verbose) {
                $returnString = "XS (US 1-4), (MP 19-22)";
            } else {
                $returnString = "XS";
            }
            break;
        case "S (US W 5-7)":
            if ($verbose) {
                $returnString = "S (US W 5-7), (MP 22-24)";
            } else {
                $returnString = "S";
            }
            break;
        case "S (US M 4-7)":
            if ($verbose) {
                $returnString = "S (US M 4-7), (MP 22-25)";
            } else {
                $returnString = "S";
            }
            break;
        case "S (US M 6-8 – US W 7-9)":
            if ($verbose) {
                $returnString = "S (US M 6-8 – US W 7-9)";
            } else {
                $returnString = "S";
            }
            break;
        case "S/M (US W 4-7)":
            if ($verbose) {
                $returnString = "S/M (US W 4-7), (MP 21-24)";
            } else {
                $returnString = "S/M";
            }
            break;
        case "S/M (US M 5-9)":
            if ($verbose) {
                $returnString = "S/M (US M 5-9)";
            } else {
                $returnString = "S/M";
            }
            break;
        case "M (US W 7-9)":
            if ($verbose) {
                $returnString = "M (US W 7-9), (MP 24-26)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 7-9)":
            if ($verbose) {
                $returnString = "M (US M 7-9), (MP 25-27)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 7-10)":
            if ($verbose) {
                $returnString = "M (US M 7-10), (MP 25-28)";
            } else {
                $returnString = "M";
            }
            break;
        case "M (US M 8.5-11 – US W 9.5+)":
            if ($verbose) {
                $returnString = "M (US M 8.5-11 – US W 9.5+)";
            } else {
                $returnString = "M";
            }
            break;
        case "M/L (US W 6-9)":
            if ($verbose) {
                $returnString = "M/L (US W 6-9), (MP 23-26)";
            } else {
                $returnString = "M/L";
            }
            break;
        case "M/L (US M 9-14)":
            if ($verbose) {
                $returnString = "M/L (US M 9-14)";
            } else {
                $returnString = "M/L";
            }
            break;
        case "L (US W 9-10)":
            if ($verbose) {
                $returnString = "L (US W 9-10), (MP 26-27)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 9-11)":
            if ($verbose) {
                $returnString = "L (US M 9-11), (MP 27-29)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 9-12)":
            if ($verbose) {
                $returnString = "L (US M 9-12), (MP 27-30)";
            } else {
                $returnString = "L";
            }
            break;
        case "L (US M 11.5-13)":
            if ($verbose) {
                $returnString = "L (US M 11.5-13)";
            } else {
                $returnString = "L";
            }
            break;
        case "XL (US M 11-14)":
            if ($verbose) {
                $returnString = "XL (US M 11-14), (MP 29-32)";
            } else {
                $returnString = "XL";
            }
            break;
    }
    return $returnString;
}

// REWRITE WORDPRESS GALLERY FUNCTIONALITY
function gnu_gallery_shortcode($attr) {
    $post = get_post();
    static $instance = 0;
    $instance++;
    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }
    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;
    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => 'li',
        'icontag'    => 'div',
        'captiontag' => 'div',
        'columns'    => 3,
        'size'       => 'large',
        'include'    => '',
        'exclude'    => ''
    ), $attr, 'gallery'));
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';
    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
    $selector = "gallery-{$instance}";
    $output = "<div id=\"$selector\" class=\"gallery galleryid-{$id}\">\n\t\t\t\t\t\t<div class=\"gallery-list owl-carousel owl-theme\">\n";
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        // always make it grab the link to the file
        $image_output = wp_get_attachment_link( $id, $size, false, false );
        $image_meta  = wp_get_attachment_metadata( $id );
        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) )
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        $output .= "\t\t\t\t\t\t\t<div class='gallery-item'>\n\t\t\t\t\t\t\t\t<div class='gallery-icon {$orientation}'>$image_output</div>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "\n\t\t\t<p class='gallery-caption small'>" . wptexturize($attachment->post_excerpt) . "</p>";
        }
        $output .= "\n\t\t\t\t\t\t\t</div>\n";
    }
    $output .= "\t\t\t\t\t\t</div>\n\t\t\t\t\t</div><!-- END .gallery -->\n";
    return $output;
}
add_shortcode('gallery', 'gnu_gallery_shortcode');

/******************************
CODE FOR CUSTOM POST TYPES
******************************/
// order menus for custom post types
function set_custom_post_types_admin_order($wp_query) {
  if (is_admin()) {
    $post_type = $wp_query->query['post_type'];
    if ( $post_type == 'gnu_snowboards' || $post_type == 'gnu_bindings' || $post_type == 'gnu_accessories' || $post_type == 'gnu_weirdwear' || $post_type == 'gnu_technology' || $post_type == 'gnu_awards' || $post_type == 'gnu_team' || $post_type == 'gnu_partners' || $post_type == 'gnu_faqs' ) {
      $wp_query->set('orderby', 'menu_order');
      $wp_query->set('order', 'ASC');
    }
  }
}
add_filter('pre_get_posts', 'set_custom_post_types_admin_order');

// SET UP CUSTOM POST TYPES
function register_custom_post_types() {
    // START SNOWBOARDS
    $labels = array(
        'name' => _x('Snowboards', 'post type general name'),
        'singular_name' => _x('Snowboard', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_snowboards'),
        'add_new_item' => __('Add New Snowboard'),
        'edit_item' => __('Edit Snowboard'),
        'new_item' => __('New Snowboard'),
        'all_items' => __('All Snowboards'),
        'view_item' => __('View Snowboard'),
        'search_items' => __('Search Snowboards'),
        'not_found' =>  __('No Snowboard Found'),
        'not_found_in_trash' => __('No Snowbaords Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Snowboards'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "snowboards"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    );
    register_post_type('gnu_snowboards',$args);
    // start taxonamy for Snowboards
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_snowboard_categories', 'gnu_snowboards', $args );
    // END SNOWBOARDS

    // START BINDINGS
    $labels = array(
        'name' => _x('Bindings', 'post type general name'),
        'singular_name' => _x('Binding', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_bindings'),
        'add_new_item' => __('Add New Binding'),
        'edit_item' => __('Edit Binding'),
        'new_item' => __('New Binding'),
        'all_items' => __('All Bindings'),
        'view_item' => __('View Binding'),
        'search_items' => __('Search Bindings'),
        'not_found' =>  __('No Binding Found'),
        'not_found_in_trash' => __('No Bindings Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Bindings'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "bindings"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    );
    register_post_type('gnu_bindings',$args);
    // start taxonamy for Bindings
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_bindings_categories', 'gnu_bindings', $args );
    // END BINDINGS

    // START ACCESSORIES
    $labels = array(
        'name' => _x('Accessories', 'post type general name'),
        'singular_name' => _x('Accessory', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_accessories'),
        'add_new_item' => __('Add New Accessory'),
        'edit_item' => __('Edit Accessory'),
        'new_item' => __('New Accessory'),
        'all_items' => __('All Accessories'),
        'view_item' => __('View Accessory'),
        'search_items' => __('Search Accessories'),
        'not_found' =>  __('No Accessories Found'),
        'not_found_in_trash' => __('No Accessories Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Accessories'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => 'supplies/accessories'),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    );
    register_post_type('gnu_accessories',$args);
    // start taxonamy for Accessories
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_accessories_categories', 'gnu_accessories', $args );
    // END ACCESSORIES

    // START APPAREL
    $labels = array(
        'name' => _x('Apparel', 'post type general name'),
        'singular_name' => _x('Apparel', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_apparel'),
        'add_new_item' => __('Add New Apparel'),
        'edit_item' => __('Edit Apparel'),
        'new_item' => __('New Apparel'),
        'all_items' => __('All Apparel'),
        'view_item' => __('View Apparel'),
        'search_items' => __('Search Apparel'),
        'not_found' =>  __('No Apparel Found'),
        'not_found_in_trash' => __('No Apparel Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Apparel'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => 'supplies/apparel'),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    );
    register_post_type('gnu_apparel',$args);
    // start taxonamy for Apparel
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_apparel_categories', 'gnu_apparel', $args );
    // END APPAREL

    // START TECHNOLOGY
    $labels = array(
        'name' => _x('Technology', 'post type general name'),
        'singular_name' => _x('Technology', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_technology'),
        'add_new_item' => __('Add New Tech Item'),
        'edit_item' => __('Edit Tech Item'),
        'new_item' => __('New Technology'),
        'all_items' => __('All Technology'),
        'view_item' => __('View Tech Item'),
        'search_items' => __('Search Technology'),
        'not_found' =>  __('No Tech Item Found'),
        'not_found_in_trash' => __('No Technology Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Technology'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "technology"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    );
    register_post_type('gnu_technology',$args);
    // END TECHNOLOGY

    // START AWARDS
    $labels = array(
        'name' => _x('Awards', 'post type general name'),
        'singular_name' => _x('Award', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_awards'),
        'add_new_item' => __('Add New Award'),
        'edit_item' => __('Edit Award'),
        'new_item' => __('New Award'),
        'all_items' => __('All Awards'),
        'view_item' => __('View Award'),
        'search_items' => __('Search Awards'),
        'not_found' =>  __('No Award Found'),
        'not_found_in_trash' => __('No Awards Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Awards'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "awards"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'page-attributes' )
    );
    register_post_type('gnu_awards',$args);
    // END AWARDS

    // START TEAM
    $labels = array(
        'name' => _x('Team', 'post type general name'),
        'singular_name' => _x('Team Member', 'post type singular name'),
        'add_new' => _x('Add Team Member', 'gnu_team'),
        'add_new_item' => __('Add New Team Member'),
        'edit_item' => __('Edit Team Member'),
        'new_item' => __('New Team Member'),
        'all_items' => __('All Team Members'),
        'view_item' => __('View Team Member'),
        'search_items' => __('Search Team'),
        'not_found' =>  __('No Team Member Found'),
        'not_found_in_trash' => __('No Team Member Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Team'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "team"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    );
    register_post_type('gnu_team',$args);
    // start taxonamy for Team
    $labels = array(
        'name'                          => 'Team Categories',
        'singular_name'                 => 'Team Category',
        'search_items'                  => 'Search Team Catagories',
        'popular_items'                 => 'Popular Team Categories',
        'all_items'                     => 'All Team Categories',
        'parent_item'                   => 'Parent Team Category',
        'edit_item'                     => 'Edit Team Category',
        'update_item'                   => 'Update Team Category',
        'add_new_item'                  => 'Add New Team Category',
        'new_item_name'                 => 'New Team Category',
        'separate_items_with_commas'    => 'Separate Team Categories with commas',
        'add_or_remove_items'           => 'Add or remove Team Categories',
        'choose_from_most_used'         => 'Choose from most used Team Categories'
    );
    $args = array(
        'label'                         => 'Team Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_team_categories', 'gnu_team', $args );
    // END TEAM

    // START PARTNERS
    $labels = array(
        'name' => _x('Partners', 'post type general name'),
        'singular_name' => _x('Partner', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_partners'),
        'add_new_item' => __('Add New Partner'),
        'edit_item' => __('Edit Partner'),
        'new_item' => __('New Partner'),
        'all_items' => __('All Partners'),
        'view_item' => __('View Partner'),
        'search_items' => __('Search Partners'),
        'not_found' =>  __('No Partner Found'),
        'not_found_in_trash' => __('No Partner Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'Partners'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        //'rewrite' => array("slug" => "dealers"),
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    );
    register_post_type('gnu_partners',$args);
    // start taxonamy for Partners
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_partner_categories', 'gnu_partners', $args );
    // END PARTNERS

    // START FAQS
    $labels = array(
        'name' => _x('FAQs', 'post type general name'),
        'singular_name' => _x('FAQ', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_faqs'),
        'add_new_item' => __('Add New FAQ'),
        'edit_item' => __('Edit FAQ'),
        'new_item' => __('New FAQ'),
        'all_items' => __('All FAQs'),
        'view_item' => __('View FAQ'),
        'search_items' => __('Search FAQs'),
        'not_found' =>  __('No FAQ Found'),
        'not_found_in_trash' => __('No FAQ Found In Trash'),
        'parent_item_colon' => '',
        'menu_name' => 'FAQs'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes' )
    );
    register_post_type('gnu_faqs',$args);
    // start taxonamy for FAQs
    $labels = array(
        'name'                          => 'Categories',
        'singular_name'                 => 'Category',
        'search_items'                  => 'Search Category',
        'popular_items'                 => 'Popular Categories',
        'all_items'                     => 'All Categories',
        'parent_item'                   => 'Parent Category',
        'edit_item'                     => 'Edit Category',
        'update_item'                   => 'Update Category',
        'add_new_item'                  => 'Add New Category',
        'new_item_name'                 => 'New Category',
        'separate_items_with_commas'    => 'Separate Categories with commas',
        'add_or_remove_items'           => 'Add or remove Categories',
        'choose_from_most_used'         => 'Choose from most used Categories'
    );
    $args = array(
        'label'                         => 'Categories',
        'labels'                        => $labels,
        'public'                        => true,
        'hierarchical'                  => true,
        'show_ui'                       => true,
        'show_in_nav_menus'             => true,
        'args'                          => array( 'orderby' => 'term_order' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_faq_categories', 'gnu_faqs', $args );
    // END FAQS
}
// run the registration
add_action( 'init', 'register_custom_post_types' );
?>
