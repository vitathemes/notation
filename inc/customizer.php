<?php
/**
 * notation Theme Customizer
 *
 * @package notation
 */

function wp_meliora_enqueue_customizer_style( $hook_suffix ) {
	// Load your css.
	wp_register_style( 'kirki-styles-css',
		get_template_directory_uri() . '/assets//css/kirki-controls-style.css',
		false,
		'1.0.0' );
	wp_enqueue_style( 'kirki-styles-css' );
}

add_action( 'admin_enqueue_scripts', 'wp_meliora_enqueue_customizer_style' );


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function notation_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'notation_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'notation_customize_partial_blogdescription',
			)
		);
	}
}

add_action( 'customize_register', 'notation_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function notation_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function notation_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function notation_customize_preview_js() {
	wp_enqueue_script( 'notation-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		THEME_VERSION,
		true );
}

add_action( 'customize_preview_init', 'notation_customize_preview_js' );


/**
 * Custom theme customizer
 *
 * If the Kirki customizer framework is not enabled, these controls won't show up.
 */
if ( function_exists( 'Kirki' ) ) {
	add_action( 'init',
		function () {
			// Disable Kiriki help notice
			add_filter( 'kirki_telemetry', '__return_false' );


			// Add config
			Kirki::add_config( 'notation',
				array(
					'option_type' => 'theme_mod',
				) );

			// Add Panels
			Kirki::add_panel( 'elements',
				array(
					'priority'    => 10,
					'title'       => esc_html__( 'Elements', 'notation' ),
					'description' => esc_html__( 'Elements', 'notation' ),
				) );

// Add sections \\
// <editor-fold desc="Sections">

// Branding
			Kirki::add_section( 'colors',
				array(
					'title'    => esc_html__( 'Colors', 'notation' ),
					'panel'    => '',
					'priority' => 3,
				) );

// Typography
			Kirki::add_section( 'typography',
				array(
					'title'      => esc_html__( 'Typography', 'notation' ),
					'panel'      => '',
					'priority'   => 4,
					'capability' => 'edit_theme_options',
				) );

			// Posts
			Kirki::add_section( 'single_opts',
				array(
					'title'    => esc_html__( 'Single Options', 'notation' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'archive_opts',
				array(
					'title'    => esc_html__( 'Archive Options', 'notation' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'sidebar_opts',
				array(
					'title'    => esc_html__( 'Sidebar Options', 'notation' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'footer',
				array(
					'title'    => esc_html__( 'Footer', 'notation' ),
					'panel'    => '',
					'priority' => 6,
				) );

// </editor-fold>

			// -- Typography Fields --
			// <editor-fold desc="Typography">
			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'use_google_fonts',
					'label'    => esc_html__( 'Use google Fonts', 'notation' ),
					'section'  => 'typography',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h1',
					'label'           => esc_html__( 'H1', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '26px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h1', '.h1' ),
						),
					),
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h2',
					'label'           => esc_html__( 'H2', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '20px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h2', '.h2' ),
						),
					),
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h3',
					'label'           => esc_html__( 'H3', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '16px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h3', '.h3' ),
						),
					),
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h4',
					'label'           => esc_html__( 'H4', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '16px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h4', '.h4' ),
						),
					),
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h5',
					'label'           => esc_html__( 'H5', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '14px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h5', '.h5' ),
						),
					),
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'typography_h6',
					'label'           => esc_html__( 'H6', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'font-size'      => '13px',
						'font-weight'    => '400',
						'line-height'    => '1.5',
						'letter-spacing' => '0',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => array( 'h6', '.h6' ),
						),
					),
				] );


			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'use_google_fonts',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'typography',
					'settings'        => 'text_typography',
					'label'           => esc_html__( 'Base font', 'notation' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'variant'        => '400',
						'font-size'      => '16px',
						'line-height'    => '1.5',
						'letter-spacing' => '0'
						//'color'       => '#000',
					],
					'choices'         => [
						'fonts' => [
							'standard' => [
								'Arial',
								'sans-serif',
								'sans',
								'Helvetica',
								'Verdana',
								'Trebuchet',
								'Georgia',
								'Times New Roman',
								'Palatino',
								'Myriad Pro',
								'Lucida',
								'Gill Sans',
								'Impact',
								'monospace',
								'Tahoma',
							],
						],
					],
					'transport'       => 'auto',
					'priority'        => 10,
					'output'          => array(
						array(
							'element' => 'body',
						),
					),
				] );

// </editor-fold>
			// -- Typography Fields --

// <editor-fold desc="colors">

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_primary_color',
					'label'    => __( 'Primary Color', 'notation' ),
					'section'  => 'colors',
					'default'  => '#EC7160',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_primary_color',
					'label'    => __( 'Primary Accent Color', 'notation' ),
					'section'  => 'colors',
					'default'  => '#DA5745',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_1',
					'label'    => __( 'Color #1', 'notation' ),
					'section'  => 'colors',
					'default'  => '#303030',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_2',
					'label'    => __( 'Color #2', 'notation' ),
					'section'  => 'colors',
					'default'  => '#898989',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_3',
					'label'    => __( 'Color #3', 'notation' ),
					'section'  => 'colors',
					'default'  => '#E7E7E9',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_4',
					'label'    => __( 'Color #4', 'notation' ),
					'section'  => 'colors',
					'default'  => '#F6F6F6',
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'color',
					'settings' => 'color_5',
					'label'    => __( 'Color #5', 'notation' ),
					'section'  => 'colors',
					'default'  => '#F9F9F9',
				] );

// </editor-fold>

			// Posts
			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_thumbnail',
					'label'    => esc_html__( 'Show posts thumbnail', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_date',
					'label'    => esc_html__( 'Show published date', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_author',
					'label'    => esc_html__( 'Show author name', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_comments',
					'label'    => esc_html__( 'Show author name', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_cats',
					'label'    => esc_html__( 'Show post categories', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_tags',
					'label'    => esc_html__( 'Show post tags', 'notation' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_date_archive',
					'label'    => esc_html__( 'Show publish date', 'notation' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_excerpt',
					'label'    => esc_html__( 'Show posts excerpt', 'notation' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'notation',
				[
					'type'     => 'toggle',
					'settings' => 'show_sidebar',
					'label'    => esc_html__( 'Show Sidebar', 'notation' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'     => 'toggle',
					'settings' => 'show_date_sidebar',
					'label'    => esc_html__( 'Show publish date', 'notation' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'notation',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'     => 'toggle',
					'settings' => 'show_post_excerpt_sidebar',
					'label'    => esc_html__( 'Show posts excerpt', 'notation' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );
		} );
	// PostsWooCommerce

	// Footer
	Kirki::add_field( 'notation', [
		'type'     => 'textarea',
		'settings' => 'copyright_text',
		'label'    => esc_html__( 'Copyright Text', 'notation' ),
		'section'  => 'footer',
		'default'  => sprintf( '<span>%s</span><a href="%s" class="customize-unpreviewable">%s</a>', esc_html__( 'Notation theme by ', 'notation' ), esc_url( 'https://vitathemes.com' ), esc_html__( 'VitaThemes', 'notation' ) ),
		'priority' => 10,
	] );

	Kirki::add_field( 'notation', [
		'type'     => 'link',
		'settings' => 'instagram',
		'label'    => esc_html__( 'Instagram', 'notation' ),
		'section'  => 'footer',
		'priority' => 10,
	] );

	Kirki::add_field( 'notation', [
		'type'     => 'link',
		'settings' => 'twitter',
		'label'    => esc_html__( 'Twitter', 'notation' ),
		'section'  => 'footer',
		'priority' => 10,
	] );

	Kirki::add_field( 'notation', [
		'type'     => 'link',
		'settings' => 'facebook',
		'label'    => esc_html__( 'Facebook', 'notation' ),
		'section'  => 'footer',
		'priority' => 10,
	] );

	// Footer

	function wp_indigo_add_edit_icons( $wp_customize ) {
		$wp_customize->selective_refresh->add_partial( 'show_slider_menu_index',
			array(
				'selector' => '.c-categories-list',
			) );

		$wp_customize->selective_refresh->add_partial( 'search_header',
			array(
				'selector' => '.c-header .c-search-form',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_post_thumbnail',
			array(
				'selector' => '.c-post--single .c-post__thumbnail--single',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_post_date',
			array(
				'selector' => '.c-post--single .c-post__date__published',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_share_icons',
			array(
				'selector' => '.c-social-share',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_post_tags',
			array(
				'selector' => '.c-post__footer__tags',
			) );


		$wp_customize->selective_refresh->add_partial( 'show_posts_thumbnail',
			array(
				'selector' => '.c-post__thumbnail--single',
			) );
	}

	add_action( 'customize_preview_init', 'wp_indigo_add_edit_icons' );
}
