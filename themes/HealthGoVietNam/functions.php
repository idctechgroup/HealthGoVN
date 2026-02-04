<?php
/**
 * Theme functions and definitions
 *
 * @package HealthGoVietNam
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function healthgovietnam_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'healthgovietnam', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 675, true );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'healthgovietnam' ),
        'footer'  => esc_html__( 'Footer Menu', 'healthgovietnam' ),
    ) );

    // Switch default core markup to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Add support for custom background
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
    ) );

    // Add support for custom header
    add_theme_support( 'custom-header', array(
        'default-image' => '',
        'width'         => 1200,
        'height'        => 400,
        'flex-height'   => true,
        'flex-width'    => true,
    ) );

    // Add support for editor styles
    add_theme_support( 'editor-styles' );

    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Add support for block styles
    add_theme_support( 'wp-block-styles' );

    // Add support for wide alignment
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'healthgovietnam_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function healthgovietnam_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'healthgovietnam_content_width', 1200 );
}
add_action( 'after_setup_theme', 'healthgovietnam_content_width', 0 );

/**
 * Register widget areas.
 */
function healthgovietnam_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'healthgovietnam' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'healthgovietnam' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'healthgovietnam' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'healthgovietnam' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'healthgovietnam' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'healthgovietnam' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'healthgovietnam' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'healthgovietnam' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'healthgovietnam_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function healthgovietnam_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style( 'healthgovietnam-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Enqueue custom JavaScript
    wp_enqueue_script( 'healthgovietnam-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

    // Enqueue comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'healthgovietnam_scripts' );

/**
 * Custom excerpt length.
 */
function healthgovietnam_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'healthgovietnam_excerpt_length', 999 );

/**
 * Custom excerpt more.
 */
function healthgovietnam_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'healthgovietnam_excerpt_more' );

/**
 * Add custom classes to body tag.
 */
function healthgovietnam_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'healthgovietnam_body_classes' );

/**
 * Custom comment form fields.
 */
function healthgovietnam_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req       = get_option( 'require_name_email' );
    $aria_req  = ( $req ? " aria-required='true'" : '' );

    $fields['author'] = '<p class="comment-form-author">' .
        '<label for="author">' . esc_html__( 'Name', 'healthgovietnam' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email">' .
        '<label for="email">' . esc_html__( 'Email', 'healthgovietnam' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>' .
        '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

    $fields['url'] = '<p class="comment-form-url">' .
        '<label for="url">' . esc_html__( 'Website', 'healthgovietnam' ) . '</label>' .
        '<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'healthgovietnam_comment_form_fields' );

/**
 * Adds custom classes to the array of posts classes.
 */
function healthgovietnam_post_classes( $classes, $class, $post_id ) {
    if ( has_post_thumbnail( $post_id ) ) {
        $classes[] = 'has-post-thumbnail';
    }

    return $classes;
}
add_filter( 'post_class', 'healthgovietnam_post_classes', 10, 3 );

add_action('init', function() {

    register_post_type('procedures', [
        'labels' => [
            'name' => 'Procedures',
            'singular_name' => 'Procedure',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-heart',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_ui' => true,
        'show_in_rest' => true, // ⭐ BẮT BUỘC cho Elementor
        'rewrite' => [
            'slug' => 'procedures',
            'with_front' => false
        ],
    ]);

}, 0);

add_action('init', function() {

    register_taxonomy('specialties', ['procedures'], [
        'labels' => [
            'name' => 'Specialties',
            'singular_name' => 'Specialty',
        ],
        'public' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'specialties',
            'with_front' => false
        ],
    ]);

}, 0);
register_post_type('locations', [
    'labels' => [
        'name' => 'Locations',
        'singular_name' => 'Location',
    ],
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-location',
    'supports' => ['title','editor','thumbnail'],
    'show_in_rest' => true,
    'rewrite' => [
        'slug' => 'locations',
        'with_front' => false
    ],
]);

add_action('init', function() {

    register_post_type('articles', [
        'labels' => [
            'name' => 'Articles',
            'singular_name' => 'Article',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Article',
            'edit_item' => 'Edit Article',
            'new_item' => 'New Article',
            'view_item' => 'View Article',
            'search_items' => 'Search Articles',
            'not_found' => 'No articles found',
            'not_found_in_trash' => 'No articles found in trash',
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'revisions'],
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'articles',
            'with_front' => false
        ],
        'taxonomies' => ['category', 'post_tag'],
    ]);

}, 0);

function procedure_compare_prices() {
    if (!have_rows('compare_prices')) return;

    ob_start();
    echo '<div class="compare-prices">';

    while (have_rows('compare_prices')) {
        the_row();
        $country = get_sub_field('country');
        $price = get_sub_field('price_range');
        echo '<span class="country">' . esc_html($country) . '</span>';
        echo '<span class="price">' . esc_html($price) . '</span>';
    }

    echo '</div>';
    return ob_get_clean();
}
add_shortcode('compare_prices', 'procedure_compare_prices');

function procedure_locations_shortcode($atts) {

    // Đúng slug CPT
    if (!is_singular('procedures')) return '';

    $post_id = get_the_ID();

    $atts = shortcode_atts([
        'limit'  => -1,
        'layout' => 'list'
    ], $atts);

    // Relationship field
    $location_ids = get_field('available_locations', $post_id);

    if (empty($location_ids)) return '<p>No locations available.</p>';

    $args = [
        'post_type'      => 'locations', // đúng slug
        'post__in'       => $location_ids,
        'posts_per_page' => intval($atts['limit']),
        'orderby'        => 'post__in'
    ];

    $query = new WP_Query($args);
    if (!$query->have_posts()) return '';

    ob_start();

    echo '<div class="procedure-locations layout-' . esc_attr($atts['layout']) . '">';

    while ($query->have_posts()) {
        $query->the_post();

        $hospital_location = get_field('hospital_location');
        $hospital_type     = get_field('hospital_type');
        $hospital_summary  = get_field('hospital_summary');
        $aacredit          = get_field('aaci_accredited'); // true/false nếu có

        ?>

        <div class="location-card">

            <div class="location-thumb-wrap">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large', ['class' => 'location-thumb']); ?>
                <?php endif; ?>

                <?php if ($aacredit) : ?>
                    <div class="badge-aaci">AACI-Accredited</div>
                <?php endif; ?>
            </div>

            <div class="location-body">

                <h3 class="location-title"><?php the_title(); ?></h3>

                <?php if ($hospital_location) : ?>
                    <div class="meta-item">
                        <span class="icon">📍</span>
                        <span><?php echo esc_html($hospital_location); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($hospital_type) : ?>
                    <div class="meta-item">
                        <span class="icon">🏥</span>
                        <span><?php echo esc_html($hospital_type); ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($hospital_summary) : ?>
                    <div class="location-summary">
                        <?php echo wp_trim_words($hospital_summary, 35); ?>
                    </div>
                <?php endif; ?>

                <div class="location-footer">
                    <div class="price">
                        <span class="label">Starting from</span>
                        <span class="value">Price on request</span>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="learn-more-btn">
                        Learn more
                    </a>
                </div>

            </div>
        </div>

        <?php
    }

    echo '</div>';

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('procedure_locations', 'procedure_locations_shortcode');

function hospital_faq_shortcode($atts) {
    
    $atts = shortcode_atts([
        'post_id' => get_the_ID(),
        'title' => 'Frequently Asked Questions'
    ], $atts);

    $post_id = intval($atts['post_id']);

    // Lấy ACF repeater field
    if (!have_rows('hospital_faq', $post_id)) {
        return '<p>.</p>';
    }

    ob_start();

    echo '<div class="hospital-faq-wrapper">';

    echo '<div class="faq-list">';

    $index = 0;
    while (have_rows('hospital_faq', $post_id)) {
        the_row();
        $index++;

        $question = get_sub_field('question');
        $answer = get_sub_field('answer');

        if (!$question || !$answer) continue;

        ?>
        <div class="faq-item" data-faq="<?php echo $index; ?>">
            <div class="faq-question">
                <span class="faq-icon">❓</span>
                <h3><?php echo esc_html($question); ?></h3>
                <span class="faq-toggle">+</span>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-content">
                    <?php echo wpautop($answer); ?>
                </div>
            </div>
        </div>
        <?php
    }

    echo '</div>'; // .faq-list
    echo '</div>'; // .hospital-faq-wrapper

    return ob_get_clean();
}
add_shortcode('hospital_faq', 'hospital_faq_shortcode');

function hospital_gallery_shortcode($atts) {
    
    $atts = shortcode_atts([
        'post_id' => get_the_ID(),
        'title' => 'Photo Gallery'
    ], $atts);

    $post_id = intval($atts['post_id']);

    // Lấy ACF Gallery field
    $gallery = get_field('hospital_gallery', $post_id);

    if (!$gallery || !is_array($gallery)) {
        return '<p></p>';
    }

    ob_start();

    echo '<div class="hospital-gallery-wrapper">';
    
    // Main viewer (ảnh lớn)
    echo '<div class="gallery-main-viewer">';
    $first_image = $gallery[0];
    echo '<img src="' . esc_url($first_image['url']) . '" alt="' . esc_attr($first_image['alt']) . '" class="main-image" data-index="0">';
    
    // Navigation arrows
    echo '<button class="gallery-nav gallery-prev" aria-label="Previous">‹</button>';
    echo '<button class="gallery-nav gallery-next" aria-label="Next">›</button>';
    
    // Image counter
    echo '<div class="gallery-counter"><span class="current">1</span> / <span class="total">' . count($gallery) . '</span></div>';
    echo '</div>';

    // Thumbnail slider
    echo '<div class="gallery-thumbnails-container">';
    
    // Thumbnail navigation buttons
    echo '<button class="thumb-nav thumb-prev" aria-label="Previous thumbnails">‹</button>';
    echo '<button class="thumb-nav thumb-next" aria-label="Next thumbnails">›</button>';
    
    echo '<div class="gallery-thumbnails">';
    foreach ($gallery as $index => $image) {
        $active_class = $index === 0 ? ' active' : '';
        echo '<div class="gallery-thumb' . $active_class . '" data-index="' . $index . '" data-full-url="' . esc_url($image['url']) . '">';
        echo '<img src="' . esc_url($image['sizes']['medium'] ?? $image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
        echo '</div>';
    }
    echo '</div>';
    
    echo '</div>'; // .gallery-thumbnails-container

    echo '</div>'; // .hospital-gallery-wrapper

    return ob_get_clean();
}
add_shortcode('hospital_gallery', 'hospital_gallery_shortcode');

