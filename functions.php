<?php
/**
 * gc functions and definitions
 *
 * @package One Portfolio
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'gc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function gc_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on gc, use a find and replace
	 * to change 'gc' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gc', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'gc' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // gc_setup
add_action( 'after_setup_theme', 'gc_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function gc_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'gc_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'gc_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function gc_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'gc' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'gc_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function gc_scripts() {
	wp_enqueue_style( 'gc-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js', array(), '20130515', true );

	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array(), '20130515', true );

	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/js/waypoints-sticky.min.js', array(), '20130515', true );

	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '20130515', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gc_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
* (gc) Additional Image Size.
*/
if ( function_exists( 'add_theme_support' ) ) {
	add_image_size( 'small-thumb', 140, 98, true);
	add_image_size( 'large-post', 640, false);
}

/**
* (gc) Custom Post Type Portfolio
*/
add_action('init', 'portfolio_register');
 
function portfolio_register() {
 
	$labels = array(
		'name' => _x('Portfolio', 'post type general name'),
		'singular_name' => _x('Portfolio', 'post type singular name'),
		'add_new' => _x('Add New Work', 'post type item'),
		'add_new_item' => __('Add New Work'),
		'edit_item' => __('Edit Work'),
		'new_item' => __('New Work'),
		'view_item' => __('View Work'),
		'search_items' => __('Search Work'),
		'not_found' =>  __('No Results'),
		'not_found_in_trash' => __('No Results in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_stylesheet_directory_uri() . '/img/posts.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	  ); 
	
 
	register_post_type( 'portfolio' , $args );
	flush_rewrite_rules();
}

/**
* (gc) Add Custom Fields.
*/

add_action("admin_init", "admin_init");
 
function admin_init(){
  add_meta_box("buttonlabel_meta", "Button Label", "buttonlabel", "portfolio", "normal", "low");
  add_meta_box("buttonlink_meta", "Button Link", "buttonlink", "portfolio", "normal", "low");
 }
 
function buttonlabel(){
  global $post;
  $custom = get_post_custom($post->ID);
  $buttonlabel = $custom["buttonlabel"][0];
  ?>
  <label>Button Label:</label>
  <input style="width:200px"  name="buttonlabel" value="<?php echo $buttonlabel; ?>" />
  <?php
}

function buttonlink(){
  global $post;
  $custom = get_post_custom($post->ID);
  $buttonlink = $custom["buttonlink"][0];
  ?>
  <label>Button Link:</label>
  <input style="width:400px"  name="buttonlink" value="<?php echo $buttonlink; ?>" />
  <?php
}
 
global $post;
$custom = get_post_custom($post->ID);

add_action('save_post', 'save_details');

function save_details(){
  global $post; 
  update_post_meta($post->ID, "buttonlabel", $_POST["buttonlabel"]);
  update_post_meta($post->ID, "buttonlink", $_POST["buttonlink"]);
 }

add_action("manage_posts_custom_column",  "buttonlabel_custom_columns","");
add_filter("manage_edit-button_columns", "buttonlabel_edit_columns");
 
function buttonlabel_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Button Label",
    "buttonlabel" => "Button Label",
  );
 
  return $columns;
}
function buttonlabel_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "buttonlabel":
      $custom = get_post_custom();
      echo $custom["buttonlabel"][0];
      break;
  }
}

add_action("manage_posts_custom_column",  "buttonlink_custom_columns","");
add_filter("manage_edit-button_columns", "buttonlink_edit_columns");
 
function buttonlink_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Button Link",
    "buttonlink" => "Button Link",
  );
 
  return $columns;
}
function buttonlink_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "buttonlink":
      $custom = get_post_custom();
      echo $custom["buttonlink"][0];
      break;
  }
}

/**
* (gc) Add Custom Taxonomy.
*/

function add_custom_taxonomies() {
	register_taxonomy('skills', 'portfolio', array(
		'hierarchical' => false,
		'labels' => array(
			'name' => _x( 'Skills', 'taxonomy general name' ),
			'singular_name' => _x( 'Skill', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Skill' ),
			'all_items' => __( 'All Skills' ),
			'parent_item' => __( 'Parent Skill' ),
			'parent_item_colon' => __( 'Parent Skill:' ),
			'edit_item' => __( 'Edit Skill' ),
			'update_item' => __( 'Update Skill' ),
			'add_new_item' => __( 'Add New Skill' ),
			'new_item_name' => __( 'New Skill Name' ),
			'menu_name' => __( 'Skills' ),
		),
		'rewrite' => array(
			'slug' => 'skills', 
			'with_front' => false, 
			'hierarchical' => false 
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 ); 


/**
* (gc) Add Post Thumbnails Support.
*/
add_theme_support('post-thumbnails', array( 'post', 'portfolio'));


