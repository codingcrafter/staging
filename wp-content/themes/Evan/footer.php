<?php
/*
 * This file adds the custom footer links to the Divi child theme.
 * Author:   Brad Dalton http://wpsites.net
 * @example   http://wpsites.net/
 * @package Divi Parent Theme by Elegant Themes
*/
if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}
				?>

						<p id="footer-info">Copyright &copy; <?php echo date("Y"); ?> <a href="https://www.evandrews.me">Evan Drews</a> Front End Web Development, UX Design, & Digital Marketing.
					</div>	<!-- .container -->
					<div class="clear"></div>
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
    
    <!-- Progress Bar -->
    <script src="https://evandrews.me/wp-content/themes/Evan/js/page-progress/page-progress.min.js" type="text/javascript"></script>
    <script src="https://evandrews.me/wp-content/themes/Evan/js/page-progress/pp-custom.min.js" type="text/javascript"></script> 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
	<script src="https://evandrews.me/wp-content/themes/Evan/js/paroller/jquery.paroller.min.js" type="text/javascript"></script>
    <script type="text/javascript">$('.para-ele').paroller();</script>
    <script type="text/javascript">
        const mainEl = document.querySelector('evans-body');
        const scroller = smoothScroll({ element: mainEl });
    </script>
</body>
</html>
