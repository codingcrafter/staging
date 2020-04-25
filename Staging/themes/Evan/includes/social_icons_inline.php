<div id="icon-inline-et">
	<ul class="ul-social-et">
		<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-facebook">
				<a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#nogo' ) ); ?>" class="icon" target="_blank">
					<span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
				</a>

			</li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-twitter">
				<a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#nogo' ) ); ?>" class="icon" target="_blank">
					<span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
				</a>

			</li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-google-plus">
				<a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#nogo' ) ); ?>" class="icon" target="_blank">
					<span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
				</a>

			</li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_instagram_icon', $et_instagram_default ) ) : ?>
			<li class="et-social-icon et-social-instagram">
				<a href="<?php echo esc_url( et_get_option( 'divi_instagram_url', '#' ) ); ?>" class="icon" target="_blank">
					<span><?php esc_html_e( 'Instagram', 'Divi' ); ?></span>
				</a>
			</li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
			<?php
			$et_rss_url = '' !== et_get_option( 'divi_rss_url' ) ?
				et_get_option( 'divi_rss_url' ) :
				get_bloginfo( 'rss2_url' );
			?>
			<li class="et-social-icon et-social-rss">
				<a href="<?php echo esc_url( $et_rss_url ); ?>" class="icon" target="_blank">
					<span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
				</a>

			</li>
		<?php endif; ?>
		    <li class="evan-social-icon evan-social-github">
		        <a href="//github.com/codingcrafter" class="icon fab fa-github fa-2x" target="_blank"></a>
	        </li>
	        <li class="evan-social-icon evan-social-linkedin">
		        <a href="//www.linkedin.com/in/evandrews-codingcrafter/" class="icon fab fa-linkedin-in fa-2x" target="_blank"></a>
	        </li>
	</ul>
</div>