<?php

/**
 * Customizer block CF7 Main Admin page
 *
 * @package Customizer_Block_CF7
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div id="cfcf7-admin-wrap">

    <div id="cfcf7-admin-main">

        <div id="cfcf7-admin-banner">
            <img class="cfcf7-admin-banner" src="<?php echo esc_url(CFCF7_PLUGIN_URL . '/admin/images/cfcf7-admin-banner.jpg'); ?>" alt="<?php esc_attr_e('Admin Banner', 'customizer-block-cf7'); ?>">
        </div>
        <h1 id="cfcf7-admin-title">
            <?php esc_html_e('Style Contact Form 7', 'customizer-block-cf7'); ?>
            <span id="cfcf7-version">
                <?php esc_html_e('Version 1.3', 'customizer-block-cf7'); ?>
                <a class="cfcf7-new-additions-link" href="https://stylecontactform7.com/blog/2025/04/11/1-3-updates/" target="_blank" rel="noopener noreferrer"><?php esc_attr_e('Updates', 'customizer-block-cf7'); ?></a>
            </span>
        </h1>

        <img class="cfcf7-admin-icon" src="<?php echo esc_url(CFCF7_PLUGIN_URL . '/admin/images/scf7-icon.svg'); ?>" alt="<?php esc_attr_e('Style Contact Form 7 Icon', 'customizer-block-cf7'); ?>">

        <div id="cfcf7-info-block">
            <p><?php esc_html_e('This plugin integrates perfectly with Contact Form 7, making it simple to create beautiful contact forms with Gutenberg blocks.', 'customizer-block-cf7'); ?></p>
            <p><?php esc_html_e('You have the freedom to style multiple elements of the form. With user-friendly controls arranged in a logical sequence, you can easily insert the Style Contact Form 7 block and start customizing.', 'customizer-block-cf7'); ?>    <?php esc_html_e('To explore the features in more detail, refer to the', 'customizer-block-cf7'); ?>
            <a href="https://stylecontactform7.com/documentation" target="_blank"><?php esc_html_e('Documentation', 'customizer-block-cf7'); ?></a></p>
        </div>

       
    </div><!-- end admin main -->


<div id="cfcf7-admin-box-sidebar">

     <div class="cfcf7-admin-box">
            <a class="cfcf7-admin-box-link" href="https://stylecontactform7.com/documentation/" target="_blank">
                <button class="mfst-link-button docs-btn" type="button">
                    <span class="dashicons mfst-dashicons dashicons-welcome-learn-more"></span>
                    <?php esc_html_e('Documentation', 'customizer-block-cf7'); ?>
                </button>
            </a>
            <p><?php esc_html_e('Get started in a few simple steps with the video demonstrations.', 'customizer-block-cf7'); ?></p>
        </div>

        <div class="cfcf7-admin-box">
            <a href="https://stylecontactform7.com/support/" target="_blank">
                <button class="mfst-link-button support-btn" type="button">
                    <span class="dashicons mfst-dashicons dashicons-format-chat"></span>
                    <?php esc_html_e('Get Support', 'customizer-block-cf7'); ?>
                </button>
            </a>
            <p><?php esc_html_e('Questions answered, Problems solved!', 'customizer-block-cf7'); ?></p>
        </div>


      <div class="cfcf7-admin-box">
            <a class="cfcf7-admin-box-link" href="https://wordpress.org/plugins/customizer-block-cf7/#reviews" target="_blank">
                <button class="mfst-link-button review-btn" type="button">
                    <span class="dashicons mfst-dashicons dashicons-thumbs-up"></span>
                    <?php esc_html_e('Leave Review', 'customizer-block-cf7'); ?>
                </button>
            </a>
            <p><?php esc_html_e('If you find this plugin useful, please help it grow by leaving positive feedback!', 'customizer-block-cf7'); ?></p>
        </div>
    
</div> <!-- end admin sidebar -->






<?php
/**
 * Attach accreditation link in footer
 */
function cfcf7_update_admin_footer() {
    ?>
    <div id="customizer-block-cf7-credits-link">
        <a href="https://stylecontactform7.com/credits/" target="_blank">
            <?php esc_html_e('Credits', 'customizer-block-cf7'); ?>
        </a>
    </div>
    <?php
}
add_filter('admin_footer_text', 'cfcf7_update_admin_footer');
?>
