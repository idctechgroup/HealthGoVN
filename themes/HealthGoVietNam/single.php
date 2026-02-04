<?php
/**
 * Template for displaying single posts
 *
 * @package HealthGoVietNam
 */

get_header();
?>

<div class="site-content">
    <div class="container clearfix">
        <main id="primary" class="content-area">

            <?php
            while ( have_posts() ) :
                the_post();
                ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

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
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'healthgovietnam' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <footer class="entry-footer">
                        <?php
                        if ( has_tag() ) :
                            the_tags( '<span class="tags-links">' . esc_html__( 'Tags: ', 'healthgovietnam' ), ', ', '</span>' );
                        endif;
                        ?>
                    </footer>
                </article>

                <?php
                // Post navigation
                the_post_navigation( array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'healthgovietnam' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'healthgovietnam' ) . '</span> <span class="nav-title">%title</span>',
                ) );

                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile;
            ?>

        </main>

        <?php get_sidebar(); ?>
    </div>
</div>

<?php
get_footer();
