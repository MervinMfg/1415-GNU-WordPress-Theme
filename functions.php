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
	function html5reset_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'structured-post-formats', array( 'link', 'video' ) );
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status' ) );
		register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );
		add_theme_support( 'post-thumbnails' );
	}
	add_action( 'after_setup_theme', 'html5reset_setup' );

	// Scripts & Styles (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_scripts_styles() {
		global $wp_styles;

		// Load Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		// Load Stylesheets
//		wp_enqueue_style( 'html5reset-style', get_stylesheet_uri() );

		// Load IE Stylesheet.
//		wp_enqueue_style( 'html5reset-ie', get_template_directory_uri() . '/css/ie.css', array( 'html5reset-style' ), '20130213' );
//		$wp_styles->add_data( 'html5reset-ie', 'conditional', 'lt IE 9' );

		// Modernizr
		// This is an un-minified, complete version of Modernizr. Before you move to production, you should generate a custom build that only has the detects you need.
		// wp_enqueue_script( 'html5reset-modernizr', get_template_directory_uri() . '/_/js/modernizr-2.6.2.dev.js' );

	}
	add_action( 'wp_enqueue_scripts', 'html5reset_scripts_styles' );

	// WP Title (based on twentythirteen: http://make.wordpress.org/core/tag/twentythirteen/)
	function html5reset_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

//		 Add the site name.
		$title .= get_bloginfo( 'name' );

//		 Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

//		 Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'html5reset' ), max( $paged, $page ) );
//FIX
//		if (function_exists('is_tag') && is_tag()) {
//		   single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
//		elseif (is_archive()) {
//		   wp_title(''); echo ' Archive - '; }
//		elseif (is_search()) {
//		   echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
//		elseif (!(is_404()) && (is_single()) || (is_page())) {
//		   wp_title(''); echo ' - '; }
//		elseif (is_404()) {
//		   echo 'Not Found - '; }
//		if (is_home()) {
//		   bloginfo('name'); echo ' - '; bloginfo('description'); }
//		else {
//		    bloginfo('name'); }
//		if ($paged>1) {
//		   echo ' - page '. $paged; }

		return $title;
	}
	add_filter( 'wp_title', 'html5reset_wp_title', 10, 2 );




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
	//	function removeHeadLinks() {
	//    	remove_action('wp_head', 'rsd_link');
	//    	remove_action('wp_head', 'wlwmanifest_link');
	//    }
	//    add_action('init', 'removeHeadLinks');

	// Custom Menu
	register_nav_menu( 'primary', __( 'Navigation Menu', 'html5reset' ) );

	// Widgets
	if ( function_exists('register_sidebar' )) {
		function html5reset_widgets_init() {
			register_sidebar( array(
				'name'          => __( 'Sidebar Widgets', 'html5reset' ),
				'id'            => 'sidebar-primary',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		add_action( 'widgets_init', 'html5reset_widgets_init' );
	}

	// Navigation - update coming from twentythirteen
	function post_navigation() {
		echo '<div class="navigation">';
		echo '	<div class="next-posts">'.get_next_posts_link('&laquo; Older Entries').'</div>';
		echo '	<div class="prev-posts">'.get_previous_posts_link('Newer Entries &raquo;').'</div>';
		echo '</div>';
	}

	// Posted On
	function posted_on() {
		printf( __( '<span class="sep">Posted </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a> by <span class="byline author vcard">%5$s</span>', '' ),
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_author() )
		);
	}































/******************************
CODE FOR CUSTOM POST TYPES
******************************/
// order menus for custom post types
function set_custom_post_types_admin_order($wp_query) {  
  if (is_admin()) {  
    $post_type = $wp_query->query['post_type'];
    if ( $post_type == 'gnu_snowboards' || $post_type == 'gnu_bindings' || $post_type == 'gnu_accessories' || $post_type == 'gnu_weirdwear' || $post_type == 'gnu_technology' || $post_type == 'gnu_awards' || $post_type == 'gnu_team' ) { 
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
        'hierarchical' => true,
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
        'hierarchical' => true,
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
        'rewrite' => array("slug" => 'accessories'),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
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
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_accessories_categories', 'gnu_accessories', $args );
    // END ACCESSORIES

    // START WEIRDWEAR
    $labels = array(
        'name' => _x('Weirdwear', 'post type general name'),
        'singular_name' => _x('Weirdwear', 'post type singular name'),
        'add_new' => _x('Add New', 'gnu_weirdwear'),
        'add_new_item' => __('Add New Weirdwear'),
        'edit_item' => __('Edit Weirdwear'),
        'new_item' => __('New Weirdwear'),
        'all_items' => __('All Weirdwear'),
        'view_item' => __('View Weirdwear'),
        'search_items' => __('Search Weirdwear'),
        'not_found' =>  __('No Weirdwear Found'),
        'not_found_in_trash' => __('No Weirdwear Found In Trash'), 
        'parent_item_colon' => '',
        'menu_name' => 'Weirdwear'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true, 
        'show_in_menu' => true, 
        'query_var' => true,
        'rewrite' => array("slug" => 'weirdwear'),
        'capability_type' => 'page',
        'has_archive' => false, 
        'hierarchical' => true,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'page-attributes', 'comments' )
    ); 
    register_post_type('gnu_weirdwear',$args);
    // start taxonamy for Weirdwear
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
        //'rewrite'                       => array( 'slug' => 'outerwear' ),
        'query_var'                     => true
    );
    register_taxonomy( 'gnu_weirdwear_categories', 'gnu_weirdwear', $args );
    // END WEIRDWEAR

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
}
// run the registration
add_action( 'init', 'register_custom_post_types' );
?>
