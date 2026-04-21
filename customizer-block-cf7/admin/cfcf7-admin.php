<?php
/**
 * Customizer block CF7 Main Admin page
 *
 * @package Customizer_Block_CF7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="cfcf7-admin-wrap" class="cfcf7-admin-layout">

	<div id="cfcf7-admin-main" class="cfcf7-admin-main">

		<section class="cfcf7-admin-hero" aria-labelledby="cfcf7-admin-title">
			<div id="cfcf7-admin-banner" class="cfcf7-admin-hero__media">
				<img
					class="cfcf7-admin-banner"
					src="<?php echo esc_url( CFCF7_PLUGIN_URL . '/admin/images/cfcf7-admin-banner.jpg' ); ?>"
					alt="<?php esc_attr_e( 'Admin Banner', 'customizer-block-cf7' ); ?>"
				>
			</div>

			<div class="cfcf7-admin-hero__content">
				<img
					class="cfcf7-admin-icon"
					src="<?php echo esc_url( CFCF7_PLUGIN_URL . '/admin/images/scf7-icon.svg' ); ?>"
					alt="<?php esc_attr_e( 'Style Contact Form 7 Icon', 'customizer-block-cf7' ); ?>"
				>

				<h1 id="cfcf7-admin-title">
					<?php esc_html_e( 'Style Contact Form 7', 'customizer-block-cf7' ); ?>
					<span id="cfcf7-version">
						<?php
						echo esc_html(
							sprintf(
								/* translators: %s: plugin version number. */
								__( 'Version %s', 'customizer-block-cf7' ),
								CFCF7_VERSION
							)
						);
						?>
					</span>
				</h1>
			</div>
		</section>

		<section id="cfcf7-info-block" class="cfcf7-admin-card cfcf7-admin-card--intro">
			<p>
				<?php esc_html_e( 'This plugin integrates perfectly with Contact Form 7, making it simple to create beautiful contact forms with Gutenberg blocks.', 'customizer-block-cf7' ); ?>
			</p>

			<p>
				<?php esc_html_e( 'You have the freedom to style multiple elements of the form. With user-friendly controls arranged in a logical sequence, you can easily insert the Style Contact Form 7 block and start customizing.', 'customizer-block-cf7' ); ?>
				<?php echo ' '; ?>
				<?php esc_html_e( 'To explore the features in more detail, refer to the', 'customizer-block-cf7' ); ?>
				<a href="https://stylecontactform7.com/documentation" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Documentation', 'customizer-block-cf7' ); ?>
				</a>.
			</p>
		</section>

	</div><!-- end admin main -->

	<aside id="cfcf7-admin-box-sidebar" class="cfcf7-admin-sidebar">

		<div class="cfcf7-admin-box cfcf7-admin-card">
			<a
				class="mfst-link-button docs-btn"
				href="https://stylecontactform7.com/documentation/"
				target="_blank"
				rel="noopener noreferrer"
			>
				<span class="dashicons mfst-dashicons dashicons-welcome-learn-more" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Documentation', 'customizer-block-cf7' ); ?></span>
			</a>

			<p><?php esc_html_e( 'Get started in a few simple steps with the video demonstrations.', 'customizer-block-cf7' ); ?></p>
		</div>

		<div class="cfcf7-admin-box cfcf7-admin-card">
			<a
				class="mfst-link-button support-btn"
				href="https://stylecontactform7.com/support/"
				target="_blank"
				rel="noopener noreferrer"
			>
				<span class="dashicons mfst-dashicons dashicons-format-chat" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Get Support', 'customizer-block-cf7' ); ?></span>
			</a>

			<p><?php esc_html_e( 'Questions answered, Problems solved!', 'customizer-block-cf7' ); ?></p>
		</div>

		<div class="cfcf7-admin-box cfcf7-admin-card">
			<a
				class="mfst-link-button review-btn"
				href="https://wordpress.org/plugins/customizer-block-cf7/#reviews"
				target="_blank"
				rel="noopener noreferrer"
			>
				<span class="dashicons mfst-dashicons dashicons-thumbs-up" aria-hidden="true"></span>
				<span><?php esc_html_e( 'Leave Review', 'customizer-block-cf7' ); ?></span>
			</a>

			<p><?php esc_html_e( 'If you find this plugin useful, please help it grow by leaving positive feedback!', 'customizer-block-cf7' ); ?></p>
		</div>

	</aside><!-- end admin sidebar -->

</div>

<?php
/**
 * Attach accreditation link in footer.
 *
 * @param string $footer_text Existing footer text.
 * @return string
 */
function cfcf7_update_admin_footer( $footer_text ) {

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading the current admin page slug from the URL to conditionally filter footer text; no form action is processed here.
	if ( ! isset( $_GET['page'] ) || 'cfcf7_admin_page' !== sanitize_key( wp_unslash( $_GET['page'] ) ) ) {
		return $footer_text;
	}

	return sprintf(
		'<span id="customizer-block-cf7-credits-link"><a href="%1$s" target="_blank" rel="noopener noreferrer">%2$s</a></span>',
		esc_url( 'https://stylecontactform7.com/credits/' ),
		esc_html__( 'Credits', 'customizer-block-cf7' )
	);
}
add_filter( 'admin_footer_text', 'cfcf7_update_admin_footer' );