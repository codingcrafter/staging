<?php

//* Create Portfolio Type custom taxonomy
add_action( 'init', 'divi_type_taxonomy' );
function divi_type_taxonomy() {
	register_taxonomy( 'portfolio-type', 'portfolio',
		array(
			'labels' => array(
				'name'          => _x( 'Types', 'taxonomy general name', 'divi' ),
				'add_new_item'  => __( 'Add New Portfolio Type', 'divi' ),
				'new_item_name' => __( 'New Portfolio Type', 'divi' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => true,
			'hierarchical'        => true,
			'rewrite'             => array( 'slug' => 'portfolio-type', 'with_front' => false ),
			'show_ui'             => true,
			'show_tagcloud'       => false,
		)
	);
}

//* Create portfolio custom post type
add_action( 'init', 'divi_portfolio_post_type' );
function divi_portfolio_post_type() {
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'          => __( 'Portfolio', 'divi' ),
				'singular_name' => __( 'Portfolio', 'divi' ),
			),
			'has_archive'  => true,
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-portfolio',
			'public'       => true,
			'rewrite'      => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'     => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
			'taxonomies'   => array( 'portfolio-type' ),
		)
	);
}

//* Change the number of portfolio items to be displayed (props Brad Dalton)
add_action( 'pre_get_posts', 'divi_portfolio_items' );
function divi_portfolio_items( $query ) {
	if( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '12' );
	}
}

// Remove WP Version From Styles
add_filter( 'style_loader_src', 'rf_remove_ver_css_js', 9999 );

// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'rf_remove_ver_css_js', 9999 );

// Function to remove version numbers
function rf_remove_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

function my_theme_enqueue_styles() { 
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

//php shortcode [date] to use in wordpress pages (ex: terms and conditions or privacy)
function displaydate(){
	return date('Y');
}
add_shortcode( 'date', 'displaydate' );


//php shortcode [et_social_media] to use in wordpress pages (ex: news or contact page) DO NOT add title
function show_socials() {
    ob_start();
    get_template_part( 'includes/social_icons_inline' );
    $content = ob_get_clean();
    return $content;
}
add_shortcode( 'et_social_media', 'show_socials' );

//Limit Image Dimensions
function limit_image_dimensions( $file ) {
    $image = getimagesize($file['tmp_name']);
    $maximum = array(
        'width' => '1920',
        'height' => '1280'
    );
    $image_width = $image[0];
    $image_height = $image[1];

    $too_large = "Image dimensions are too large. Maximum width is {$maximum['width']} pixels and maximum height is {$maximum['height']} pixels. Uploaded image is $image_width pixels by $image_height pixels.";

    if ( $image_width > $maximum['width'] || $image_height > $maximum['height'] ) {
        //add in the field 'error' of the $file array the message
        $file['error'] = $too_large; 
        return $file;
    }
    else
        return $file;
}
add_filter('wp_handle_upload_prefilter','limit_image_dimensions');
//Limit Image Dimensions

function enqueue_analytics_codes() { ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155263519-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-155263519-1', { 'send_page_view': true });

      gtag('set', {'user_id': '121649586'}); // Set the user ID using signed-in user_id.
    </script>

  <?php }
  
  add_action( 'wp_head', 'enqueue_analytics_codes' );

// Importing & enqueuing fontawesome
function enqueue_fontawesome () {
    wp_enqueue_script( 'fontawesome', "https://kit.fontawesome.com/5c857c5cc6.js", array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'enqueue_fontawesome' );


// Limit Image Size Uploads
function max_image_size( $file ) {
	$size = $file[ 'size' ];
	$size = $size / 1024 / 1024;
	$type = $file[ 'type' ];
	$is_image = strpos( $type, 'image' ) !== false;
	$limit = 1.2;
	$limit_output = '1.2 MB';
	if ( $is_image && $size > $limit ) {
		$file[ 'error' ] = 'ERROR: Image files must be smaller than ' . $limit_output;
	} //end if
	return $file;
} //end nelio_max_image_size()
add_filter( 'wp_handle_upload_prefilter', 'max_image_size' );
// Limit Image Size Uploads

//  For the Tag Cloud Limiter -----------------Begin------------------------
//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tag_widget_limit');
 
//Limit number of tags inside widget
function tag_widget_limit($args){
 
 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = 10; //Limit number of tags
 }
 
 return $args;
}
/*
//  For the Tag Cloud Limiter -----------------End--------------------------


//*  For the New Login Page -----------------Start--------------------------
if (isset($_GET['activated']) && is_admin()){
        $new_page_title = 'Login';
        $new_page_content = '';
        $new_page_template = 'login.php'; 
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
}

 
$page_id = "";
$product_pages_args = array(
'meta_key' => '_wp_page_template',
'meta_value' => 'login.php'
);

$product_pages = get_pages( $product_pages_args );
foreach ( $product_pages as $product_page ) {
$page_id.= $product_page->ID;
}

function goto_login_page() {
global $page_id;
$login_page = home_url( '/login' );
$page = basename($_SERVER['REQUEST_URI']);

if( $page == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
wp_redirect($login_page);
exit;
}
}
add_action('init','goto_login_page');

function login_failed() {
global $page_id;
$login_page = home_url( '/login' );
wp_redirect( $login_page . '?login=failed' );
exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function blank_username_password( $user, $username, $password ) {
global $page_id;
$login_page = home_url( '/login' );
if( $username == "" || $password == "" ) {
wp_redirect( $login_page . "?login=blank" );
exit;
}
}
add_filter( 'authenticate', 'blank_username_password', 1, 3);

//echo $login_page = $page_path ;

function logout_page() {
global $page_id;
$login_page = home_url( '/login' );
wp_redirect( $login_page . "?login=false" );
exit;
}
add_action('wp_logout', 'logout_page');

$page_showing = basename($_SERVER['REQUEST_URI']);

if (strpos($page_showing, 'failed') !== false) {
echo '<p class="error-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
}
elseif (strpos($page_showing, 'blank') !== false ) {
echo '<p class="error-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
}
//*  For the New Login Page -----------------End--------------------------

