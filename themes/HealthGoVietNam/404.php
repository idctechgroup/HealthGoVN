<?php
/**
 * Template for displaying 404 pages
 *
 * @package HealthGoVietNam
 */

get_header();
?>

<div class="site-content">
    <div class="container">
        <main id="primary" class="content-area">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'healthgovietnam' ); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching?', 'healthgovietnam' ); ?></p>

                    <?php get_search_form(); ?>

                    <h2><?php esc_html_e( 'Recent Posts', 'healthgovietnam' ); ?></h2>
                    <?php
                    $recent_posts = wp_get_recent_posts( array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ) );

                    if ( $recent_posts ) :
                        echo '<ul>';
                        foreach ( $recent_posts as $post ) :
                            echo '<li><a href="' . get_permalink( $post['ID'] ) . '">' . $post['post_title'] . '</a></li>';
                        endforeach;
                        echo '</ul>';
                    endif;
                    ?>
                </div>
            </section>

        </main>
    </div>
</div>

<?php
get_footer();
