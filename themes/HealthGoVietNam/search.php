<?php
/**
 * Template for displaying search results
 *
 * @package HealthGoVietNam
 */

get_header();
?>

<div class="site-content">
    <div class="container clearfix">
        <main id="primary" class="content-area">

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <h1 class="page-title">
                        <?php
                        printf( esc_html__( 'Search Results for: %s', 'healthgovietnam' ), '<span>' . get_search_query() . '</span>' );
                        ?>
                    </h1>
                </header>

                <?php
                while ( have_posts() ) :
                    the_post();
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

                            <?php if ( 'post' === get_post_type() ) : ?>
                            <div class="entry-meta">
                                <span class="posted-on"><?php echo get_the_date(); ?></span>
                            </div>
                            <?php endif; ?>
                        </header>

                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                <?php esc_html_e( 'Read More', 'healthgovietnam' ); ?>
                            </a>
                        </div>
                    </article>

                    <?php
                endwhile;

                the_posts_pagination();

            else :
                ?>
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'healthgovietnam' ); ?></h1>
                    </header>

                    <div class="page-content">
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'healthgovietnam' ); ?></p>
                        <?php get_search_form(); ?>
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
