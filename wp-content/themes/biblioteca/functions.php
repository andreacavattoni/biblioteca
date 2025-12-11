<?php
add_action( 'after_setup_theme', 'biblioteca_setup' );
function biblioteca_setup() {
load_theme_textdomain( 'biblioteca', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'search-form', 'navigation-widgets' ) );
add_theme_support( 'woocommerce' );
global $content_width;
if ( !isset( $content_width ) ) { $content_width = 1920; }
register_nav_menus( array( 'main-menu' => esc_html__( 'Main Menu', 'biblioteca' ) ) );
}
add_action( 'admin_notices', 'biblioteca_notice' );
function biblioteca_notice() {
$user_id = get_current_user_id();
$admin_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$param = ( count( $_GET ) ) ? '&' : '?';
if ( !get_user_meta( $user_id, 'biblioteca_notice_dismissed_8' ) && current_user_can( 'manage_options' ) )
echo '<div class="notice notice-info"><p><a href="' . esc_url( $admin_url ), esc_html( $param ) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__( 'Ⓧ', 'biblioteca' ) . '</big></a>' . wp_kses_post( __( '<big><strong>📝 Thank you for using biblioteca!</strong></big>', 'biblioteca' ) ) . '<br /><br /><a href="https://wordpress.org/support/theme/biblioteca/reviews/#new-post" class="button-primary" target="_blank">' . esc_html__( 'Review', 'biblioteca' ) . '</a> <a href="https://github.com/tidythemes/biblioteca/issues" class="button-primary" target="_blank">' . esc_html__( 'Feature Requests & Support', 'biblioteca' ) . '</a> <a href="https://calmestghost.com/donate" class="button-primary" target="_blank">' . esc_html__( 'Donate', 'biblioteca' ) . '</a></p></div>';
}
add_action( 'admin_init', 'biblioteca_notice_dismissed' );
function biblioteca_notice_dismissed() {
$user_id = get_current_user_id();
if ( isset( $_GET['dismiss'] ) )
add_user_meta( $user_id, 'biblioteca_notice_dismissed_8', 'true', true );
}
add_action( 'wp_enqueue_scripts', 'biblioteca_enqueue' );
function biblioteca_enqueue() {
wp_enqueue_style( 'biblioteca-style', get_stylesheet_uri() );
wp_enqueue_script( 'jquery' );
}
add_action( 'wp_footer', 'biblioteca_footer' );
function biblioteca_footer() {
?>
<script>
jQuery(document).ready(function($) {
var deviceAgent = navigator.userAgent.toLowerCase();
if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
$("html").addClass("ios");
$("html").addClass("mobile");
}
if (deviceAgent.match(/(Android)/)) {
$("html").addClass("android");
$("html").addClass("mobile");
}
if (navigator.userAgent.search("MSIE") >= 0) {
$("html").addClass("ie");
}
else if (navigator.userAgent.search("Chrome") >= 0) {
$("html").addClass("chrome");
}
else if (navigator.userAgent.search("Firefox") >= 0) {
$("html").addClass("firefox");
}
else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
$("html").addClass("safari");
}
else if (navigator.userAgent.search("Opera") >= 0) {
$("html").addClass("opera");
}
});
</script>
<?php
}
add_filter( 'document_title_separator', 'biblioteca_document_title_separator' );
function biblioteca_document_title_separator( $sep ) {
$sep = esc_html( '|' );
return $sep;
}
add_filter( 'the_title', 'biblioteca_title' );
function biblioteca_title( $title ) {
if ( $title == '' ) {
return esc_html( '...' );
} else {
return wp_kses_post( $title );
}
}
function biblioteca_schema_type() {
$schema = 'https://schema.org/';
if ( is_single() ) {
$type = "Article";
} elseif ( is_author() ) {
$type = 'ProfilePage';
} elseif ( is_search() ) {
$type = 'SearchResultsPage';
} else {
$type = 'WebPage';
}
echo 'itemscope itemtype="' . esc_url( $schema ) . esc_attr( $type ) . '"';
}
add_filter( 'nav_menu_link_attributes', 'biblioteca_schema_url', 10 );
function biblioteca_schema_url( $atts ) {
$atts['itemprop'] = 'url';
return $atts;
}
if ( !function_exists( 'biblioteca_wp_body_open' ) ) {
function biblioteca_wp_body_open() {
do_action( 'wp_body_open' );
}
}
add_action( 'wp_body_open', 'biblioteca_skip_link', 5 );
function biblioteca_skip_link() {
echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__( 'Skip to the content', 'biblioteca' ) . '</a>';
}
add_filter( 'the_content_more_link', 'biblioteca_read_more_link' );
function biblioteca_read_more_link() {
if ( !is_admin() ) {
return ' <a href="' . esc_url( get_permalink() ) . '" class="more-link">' . sprintf( __( '...%s', 'biblioteca' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'excerpt_more', 'biblioteca_excerpt_read_more_link' );
function biblioteca_excerpt_read_more_link( $more ) {
if ( !is_admin() ) {
global $post;
return ' <a href="' . esc_url( get_permalink( $post->ID ) ) . '" class="more-link">' . sprintf( __( '...%s', 'biblioteca' ), '<span class="screen-reader-text">  ' . esc_html( get_the_title() ) . '</span>' ) . '</a>';
}
}
add_filter( 'big_image_size_threshold', '__return_false' );
add_filter( 'intermediate_image_sizes_advanced', 'biblioteca_image_insert_override' );
function biblioteca_image_insert_override( $sizes ) {
unset( $sizes['medium_large'] );
unset( $sizes['1536x1536'] );
unset( $sizes['2048x2048'] );
return $sizes;
}
add_action( 'widgets_init', 'biblioteca_widgets_init' );
function biblioteca_widgets_init() {
register_sidebar( array(
'name' => esc_html__( 'Sidebar Widget Area', 'biblioteca' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => '</li>',
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
add_action( 'wp_head', 'biblioteca_pingback_header' );
function biblioteca_pingback_header() {
if ( is_singular() && pings_open() ) {
printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
}
}
add_action( 'comment_form_before', 'biblioteca_enqueue_comment_reply_script' );
function biblioteca_enqueue_comment_reply_script() {
if ( get_option( 'thread_comments' ) ) {
wp_enqueue_script( 'comment-reply' );
}
}
function biblioteca_custom_pings( $comment ) {
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url( comment_author_link() ); ?></li>
<?php
}
add_filter( 'get_comments_number', 'biblioteca_comment_count', 0 );
function biblioteca_comment_count( $count ) {
if ( !is_admin() ) {
global $id;
$get_comments = get_comments( 'status=approve&post_id=' . $id );
$comments_by_type = separate_comments( $get_comments );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}



add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
	add_image_size('progetto_preview', 770, 540, true);
	add_image_size('instagram', 550, 550,true);
	add_image_size('progetto_slide', 5000, 430);
  add_image_size('page', 820, 760);


	add_filter('jpeg_quality', function($arg){return 95;});
}

function biblioteca_scripts(){
        wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), '5.3.3' );
        wp_enqueue_style( 'mobile', get_template_directory_uri() . '/css/mobile.css', array());

        wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.3', true );
        wp_enqueue_script('all', get_template_directory_uri() . '/js/all.js', array('jquery'), true);

        if ( is_front_page() ) {
                wp_enqueue_style( 'home', get_template_directory_uri() . '/css/home.css', array( 'bootstrap' ), '1.0.0' );
                wp_enqueue_script( 'home', get_template_directory_uri() . '/js/home.js', array( 'jquery' ), '1.0.0', true );
        }
}
add_action("wp_enqueue_scripts", "biblioteca_scripts");

add_filter( 'auto_theme_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );

