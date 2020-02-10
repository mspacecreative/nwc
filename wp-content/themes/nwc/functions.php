<?php

function wpdocs_theme_setup() {
    add_image_size('resource-img', 960, 540, array( 'center', 'center' ));
}
add_action( 'after_setup_theme', 'wpdocs_theme_setup' );

function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    
    wp_register_style('google-font', 'https://fonts.googleapis.com/css?family=Arapey&display=swap', array(), '1.0', 'all');
    wp_enqueue_style('google-font');
    
    wp_register_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.0', 'all');
    wp_enqueue_style('slick-css');
    
    wp_register_style('slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css', array(), '1.0', 'all');
    wp_enqueue_style('slick-theme');
    
    wp_register_style('parallaxer-css', get_stylesheet_directory_uri() . '/css/dzsparallaxer.css', array(), '1.0', 'all');
    wp_enqueue_style('parallaxer-css');
    
    wp_register_style('fa-css', 'https://use.fontawesome.com/releases/v5.6.1/css/all.css', array(), '1.0', 'all');
    wp_enqueue_style('fa-css');
}

// Load scripts in footer
function footerScripts() {
	wp_register_script('custom', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), null, true);
	wp_enqueue_script('custom');
	
	wp_register_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true);
	wp_enqueue_script('slick-js');
	
	wp_register_script('parallaxer-js', get_stylesheet_directory_uri() . '/js/dzsparallaxer.js', array('jquery'), null, true);
	wp_enqueue_script('parallaxer-js');
}

// CLIENT LOGOS SHORTCODE
function clientLogos() {
	ob_start();
		get_template_part('includes/client-logos');
	return ob_get_clean();
}

// TESTIMONIALS SLIDER SHORTCODE
function testimonialsSlider() {
	ob_start();
		get_template_part('includes/testimonials-slider');
	return ob_get_clean();
}

// INTERVIEW RESOURCE TYPE LOOP
function interviewLoop() {
	ob_start();
		get_template_part('includes/loops/resource-interview');
	return ob_get_clean();
}

// PUBLICATION RESOURCE TYPE LOOP
function publicationLoop() {
	ob_start();
		get_template_part('includes/loops/resource-publication');
	return ob_get_clean();
}

// RELEVANT LINKS RESOURCE TYPE LOOP
function relevantLinksLoop() {
	ob_start();
		get_template_part('includes/loops/resource-links');
	return ob_get_clean();
}

// Shortcode Demo with Nested Capability
function pullQuote($atts, $content = null) {
    return '<span class="pullquote">' . do_shortcode($content) . '</span>';
}

// SHORTCODES, ACTIONS & FILTERS
add_shortcode( 'client_logos', 'clientLogos' );
add_shortcode( 'interview_loop', 'interviewLoop' );
add_shortcode( 'publication_loop', 'publicationLoop' );
add_shortcode( 'relevant_links_loop', 'relevantLinksLoop' );
add_shortcode( 'testimonials_slider', 'testimonialsSlider' );
add_shortcode('pullquote', 'pullQuote');
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action('wp_enqueue_scripts', 'footerScripts');