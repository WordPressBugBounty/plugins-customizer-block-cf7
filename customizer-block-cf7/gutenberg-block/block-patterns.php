<?php
/**
 * 
 * ==== Register Block Pattern Category and 3 Block Patterns.
 * 
 * @package CF7_Customizer_Block
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
 }

/**
 *
 * ==== Block Pattern Category
 *
 * == Set up Customizer for CF7 Patterns category to hold Customizer Patterns.
 */

function cfcf7_block_register_pattern_categories()
{
    register_block_pattern_category("customizer-for-cf7", [
        "label" => __( "Customizer for Contact Form 7 Patterns", "customizer-block-cf7" ),
    ]);
}

add_action("init", "cfcf7_block_register_pattern_categories");





/**
 *
 * ==== CF7 Customizer Block Patterns
 *
 * == 3 block patterns that contain Columns, Headings, Text and a Contact form.
 */

function cfcf7_register_block_patterns()
{

    //-- Post loop to get a contact form 7 ID to display in the block patterns.
    global $post;
    
    $args = array(
          'numberposts' => 1,
          'post_type'   => 'wpcf7_contact_form'
        );
    $contactForms = get_posts( $args );
        
    $contact_post_id = '';
    
    if ($contactForms) : 
  
    foreach ( $contactForms as $contactForm ) : setup_postdata( $contactForms ); 
      
         $contact_post_id = $contactForm->ID;
      
     endforeach; 
     
     wp_reset_postdata(); 

    endif; 


/**
 *
 * ==== Pattern One - Mountains
 *
 * == 2 column layout with Cover Image block, Spacer block, h1 heading, h4 heading & Cf7 Customizer Block.
 */

  //== Get mountain cover image url.
    $mountain_tops_image =
        plugin_dir_url(__DIR__) .
        "includes/images/mountain-tops-patten-image.jpg";

    register_block_pattern("mofistudio/cf7-mountain-tops-pattern", [
        "title" => __("Mountain tops", "customizer-block-cf7"),
        "description" => __(
            "Contact info block with Mountain top background.",
            "customizer-block-cf7"
        ),
        "categories" => ["customizer-for-cf7"],
        "content" =>
            '<!-- wp:cover {"url":"' . $mountain_tops_image . '","hasParallax":true,"dimRatio":30,"minHeight":800,"gradient":"pale-ocean","isDark":false,"align":"full"} -->
			<div class="wp-block-cover alignfull is-light has-parallax" style="min-height:800px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim wp-block-cover__gradient-background has-background-gradient has-pale-ocean-gradient-background"></span><div role="img" class="wp-block-cover__image-background has-parallax" style="background-position:50% 50%;background-image:url(' . $mountain_tops_image . ')"></div><div class="wp-block-cover__inner-container"><!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50vw"} -->
			<div class="wp-block-column" style="flex-basis:50vw">
            
            <!-- wp:spacer {"height":"67px"} -->
			<div style="height:67px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"uppercase"},"color":{"text":"#91bac5"}},"fontSize":"x-large"} -->
			<h1 class="wp-block-heading has-text-align-center has-text-color has-x-large-font-size" style="color:#91bac5;font-style:normal;font-weight:600;text-transform:uppercase">join us</h1>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}},"color":{"text":"#46667c"}}} -->
			<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#46667c;margin-top:0;margin-right:0;margin-bottom:0;margin-left:0">up here where the air is clear.</h4>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"width":"30vw"} -->
			<div class="wp-block-column" style="flex-basis:30vw"><!-- wp:mofistudio/customizer-block-cf7 {"form_selector_toggle":false,"contact_form":"' . $contact_post_id . '","block_bg_color":"#ffffff","padding_top":3,"field_bg_color":"#ffffff","field_border_radius":0,"show_field_border":true,"field_border_width":1,"show_field_box_shadow":false,"field_border_style":"dashed","field_border_color":"#9CBDBF","field_border_sides":"bottom","label_font_size":1,"field_text_color":"#46667c","placeholder_text_color":"#abb8c3","submit_bg_color":"#add1d4","submit_font_size":0.9,"submit_font_case":"uppercase","submit_width":"100","submit_border_radius":0.5,"show_submit_shadow":true} /--></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns --></div></div>
			<!-- /wp:cover -->',
    ]);



/**
 *
 * ==== Pattern Two - New York Skyline
 *
 * == 2 column layout with New York Skyline cover image, h3 heading, h4 heading, h6 heading & Cf7 Customizer Block.
 */

  //== Get ny skyline cover image url.
    $ny_skyline_image =
        plugin_dir_url(__DIR__) .
        "includes/images/ny-skyline-low-resolution.jpg";

    register_block_pattern("mofistudio/cf7-ny-skyline-pattern", [
        "title" => __("New York Skyline", "customizer-block-cf7"),
        "description" => __(
            "New York Skyline contact info block.",
            "customizer-block-cf7"
        ),
        "categories" => ["customizer-for-cf7"],
        "content" =>
            '<!-- wp:cover {"url":"' . $ny_skyline_image . '","dimRatio":80,"customOverlayColor":"#242a35","focalPoint":{"x":0.21,"y":0.49},"minHeight":800,"align":"full"} -->
			<div class="wp-block-cover alignfull" style="min-height:800px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-80 has-background-dim" style="background-color:#242a35"></span><img class="wp-block-cover__image-background" alt="" src="' . $ny_skyline_image . '" style="object-position:21% 49%" data-object-fit="cover" data-object-position="21% 49%"/><div class="wp-block-cover__inner-container"><!-- wp:columns {"align":"wide"} -->
			<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50vw"} -->
			<div class="wp-block-column" style="flex-basis:50vw">
            
            <!-- wp:spacer {"height":"119px"} -->
			<div style="height:119px" aria-hidden="true" class="wp-block-spacer"></div>
			<!-- /wp:spacer -->
			
			<!-- wp:heading {"textAlign":"center","level":3,"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600"}},"fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-text-align-center has-x-large-font-size" style="font-style:normal;font-weight:600;text-transform:uppercase">DESIGN AGENCY</h3>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"0","right":"0","bottom":"0","left":"0"}}}} -->
			<h4 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0">LOCATED IN NEWYORK CITY.</h4>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"center","level":6,"textColor":"cyan-bluish-gray"} -->
			<h6 class="wp-block-heading has-text-align-center has-cyan-bluish-gray-color has-text-color">The City that never sleeps.</h6>
			<!-- /wp:heading --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"width":"30vw"} -->
			<div class="wp-block-column" style="flex-basis:30vw"><!-- wp:mofistudio/customizer-block-cf7 {"form_selector_toggle":false,"contact_form":"' .$contact_post_id .'","block_bg_color":"#ffffff","padding_top":3,"show_box_shadow":false,"field_bg_color":"#ffffff","field_border_radius":0,"show_field_border":true,"field_border_width":1,"field_border_color":"#d8dee3","field_border_sides":"bottom","show_field_box_shadow":false,"label_font_size":1,"label_color":"#abb8c3","field_text_color":"#4e4e4e","placeholder_text_color":"#abb8c3","submit_bg_color":"#cf2e2e","submit_font_size":0.9,"submit_font_case":"uppercase","submit_width":"100","submit_border_radius":0.4,"show_submit_shadow":true} /--></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns --></div></div>
			<!-- /wp:cover -->',
    ]);




/**
 *
 * ==== Pattern Three - Clip Art
 *
 * == 2 column layout with contact scene clip art image, h3 heading, Paragraph & Cf7 Customizer Block.
 */

  //== Get clip art image scene image url.

    $clip_art_image =
        plugin_dir_url(__DIR__) . "includes/images/clip-art-pattern-png.png";

    register_block_pattern("mofistudio/cf7-clip-art-pattern", [
        "title" => __("Clip Art", "customizer-block-cf7"),
        "description" => __(
            "Minimal pattern with Clip Art.",
            "customizer-block-cf7"
        ),
        "categories" => ["customizer-for-cf7"],
        "content" =>
            '<!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
            <div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"align":"center","sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image aligncenter size-full"><img <img src="' . $clip_art_image . '" alt="Contact us - clip art" /></figure>
            <!-- /wp:image -->

            <!-- wp:heading {"textAlign":"center","level":3,"style":{"color":{"text":"#fa2a9a"},"typography":{"textTransform":"capitalize"}}} -->
            <h3 class="wp-block-heading has-text-align-center has-text-color" style="color:#fa2a9a;text-transform:capitalize">customer service</h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#f471c2"}}} -->
            <p class="has-text-align-center has-text-color" style="color:#f471c2"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->

            <!-- wp:column {"verticalAlignment":"center"} -->
            <div class="wp-block-column is-vertically-aligned-center"><!-- wp:mofistudio/customizer-block-cf7 {"form_selector_toggle":false,"contact_form":"' . $contact_post_id . '","block_bg_color":"#ffffff","padding_bottom_mobile":2.3,"margin_top":3,"margin_sides":4,"margin_bottom":3,"margin_sides_tablet":1.2,"margin_sides_mobile":0.1,"top_right_corner":2,"bottom_left_corner":3.9,"block_v_offset":0.4,"block_blur":3,"block_spread":-2.2,"block_shadow_color":"#a20c31","field_bg_color":"#fefafb","label_color":"#fa2a9a","field_text_color":"#942c7d","placeholder_text_color":"#ffaee5","field_border_radius":1,"show_field_border":true,"field_border_width":2,"field_border_style":"dashed","field_border_color":"#ffbce0","show_field_box_shadow":false,"submit_bg_color":"#fa2b9d","submit_border_radius":1.1,"show_submit_shadow":true} /--></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->',
    ]);


	
}

add_action("init", "cfcf7_register_block_patterns");
