<?php
/**
 * The Footer for our theme.
 *
 * @since alterna 7.0
 */
?>
            </div><!-- end content-wrap -->

            <div class="footer-wrap">
                <footer class="footer-content">
                    <?php get_template_part( 'template/footer/widgets' );?>
                    <div class="footer-bottom-content">
                        <?php get_template_part( 'template/footer/copyrights' );?>
                    </div>
                </footer>
                <?php get_template_part( 'template/footer/banner' );?>
            </div><!-- end footer-wrap -->
        </div><!-- end wrapper -->
        <?php wp_footer() ?>
    </body>
</html>