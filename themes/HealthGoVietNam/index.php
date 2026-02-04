<?php
/**
 * The main template file
 *
 * @package HealthGoVietNam
 */

get_header();
?>

<div class="site-content">
    <div class="container clearfix">
        <main id="primary" class="content-area">

            <?php
            if ( have_posts() ) :

                // Check if it's a page title
                if ( is_home() && ! is_front_page() ) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                // Start the Loop
                while ( have_posts() ) :
                    the_post();
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php
                            if ( is_singular() ) :
                                the_title( '<h1 class="entry-title">', '</h1>' );
                            else :
                                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                            endif;
                            ?>
                            
                            <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="byline">
                                    by <?php the_author(); ?>
                                </span>
                                <?php if ( has_category() ) : ?>
                                <span class="cat-links">
                                    in <?php the_category( ', ' ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </header>

                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                        <?php endif; ?>

                        <div class="entry-content">
                            <?php
                            if ( is_singular() ) :
                                the_content();
                                
                                wp_link_pages( array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'healthgovietnam' ),
                                    'after'  => '</div>',
                                ) );
                            else :
                                the_excerpt();
                                ?>
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e( 'Read More', 'healthgovietnam' ); ?>
                                </a>
                                <?php
                            endif;
                            ?>
                        </div>

                        <?php if ( is_singular() ) : ?>
                        <footer class="entry-footer">
                            <?php
                            if ( has_tag() ) :
                                the_tags( '<span class="tags-links">' . esc_html__( 'Tags: ', 'healthgovietnam' ), ', ', '</span>' );
                            endif;
                            ?>
                        </footer>
                        <?php endif; ?>
                    </article>

                    <?php
                endwhile;

                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '&laquo; Previous', 'healthgovietnam' ),
                    'next_text' => __( 'Next &raquo;', 'healthgovietnam' ),
                ) );

            else :
                ?>
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'healthgovietnam' ); ?></h1>
                    </header>

                    <div class="page-content">
                        <?php
                        if ( is_home() && current_user_can( 'publish_posts' ) ) :
                            ?>
                            <p>
                                <?php
                                printf(
                                    wp_kses(
                                        __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'healthgovietnam' ),
                                        array(
                                            'a' => array(
                                                'href' => array(),
                                            ),
                                        )
                                    ),
                                    esc_url( admin_url( 'post-new.php' ) )
                                );
                                ?>
                            </p>
                            <?php
                        elseif ( is_search() ) :
                            ?>
                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'healthgovietnam' ); ?></p>
                            <?php
                            get_search_form();
                        else :
                            ?>
                            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'healthgovietnam' ); ?></p>
                            <?php
                            get_search_form();
                        endif;
                        ?>
                    </div>
                </section>
                <?php
            endif;
            ?>

        </main>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
