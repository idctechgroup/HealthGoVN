    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="footer-widgets">
                <div class="footer-widget-area">
                    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-1' ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-2' ); ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
                    <div class="footer-widget">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="site-info">
                <p>
                    &copy; <?php echo date( 'Y' ); ?> 
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    <?php
                    printf( esc_html__( ' | Powered by %s', 'healthgovietnam' ), '<a href="https://wordpress.org/">WordPress</a>' );
                    ?>
                </p>
                <?php
                if ( has_nav_menu( 'footer' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'depth'          => 1,
                    ) );
                endif;
                ?>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
