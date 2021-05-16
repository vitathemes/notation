<?php
/**
 * holo Theme Customizer
 *
 * @package holo
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
function holo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'holo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'holo_customize_partial_blogdescription',
			)
		);
	}
}

add_action( 'customize_register', 'holo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function holo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function holo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function holo_customize_preview_js() {
	wp_enqueue_script( 'holo-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		THEME_VERSION,
		true );
}

add_action( 'customize_preview_init', 'holo_customize_preview_js' );


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
			Kirki::add_config( 'holo',
				array(
					'option_type' => 'theme_mod',
				) );

			// Add Panels
			Kirki::add_panel( 'elements',
				array(
					'priority'    => 10,
					'title'       => esc_html__( 'Elements', 'holo' ),
					'description' => esc_html__( 'Elements', 'holo' ),
				) );

// Add sections \\
// <editor-fold desc="Sections">

// Branding
			Kirki::add_section( 'colors',
				array(
					'title'    => esc_html__( 'Colors', 'holo' ),
					'panel'    => '',
					'priority' => 3,
				) );

// Typography
			Kirki::add_section( 'typography',
				array(
					'title'      => esc_html__( 'Typography', 'holo' ),
					'panel'      => '',
					'priority'   => 4,
					'capability' => 'edit_theme_options',
				) );

			// Posts
			Kirki::add_section( 'single_opts',
				array(
					'title'    => esc_html__( 'Single Options', 'holo' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'archive_opts',
				array(
					'title'    => esc_html__( 'Archive Options', 'holo' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'sidebar_opts',
				array(
					'title'    => esc_html__( 'Sidebar Options', 'holo' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

// </editor-fold>

			// -- Typography Fields --
			// <editor-fold desc="Typography">
			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'use_google_fonts',
					'label'    => esc_html__( 'Use google Fonts', 'holo' ),
					'section'  => 'typography',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H1', 'holo' ),
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

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H2', 'holo' ),
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

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H3', 'holo' ),
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

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H4', 'holo' ),
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

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H5', 'holo' ),
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

			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'H6', 'holo' ),
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


			Kirki::add_field( 'holo',
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
					'label'           => esc_html__( 'Base font', 'holo' ),
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

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_primary_color',
					'label'    => __( 'Primary Color', 'holo' ),
					'section'  => 'colors',
					'default'  => '#EC7160',
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_1',
					'label'    => __( 'Color #1', 'holo' ),
					'section'  => 'colors',
					'default'  => '#303030',
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_2',
					'label'    => __( 'Color #2', 'holo' ),
					'section'  => 'colors',
					'default'  => '#898989',
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_3',
					'label'    => __( 'Color #3', 'holo' ),
					'section'  => 'colors',
					'default'  => '#E7E7E9',
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_4',
					'label'    => __( 'Color #4', 'holo' ),
					'section'  => 'colors',
					'default'  => '#F6F6F6',
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'color',
					'settings' => 'color_5',
					'label'    => __( 'Color #5', 'holo' ),
					'section'  => 'colors',
					'default'  => '#F9F9F9',
				] );

// </editor-fold>

			// Posts
			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_thumbnail',
					'label'    => esc_html__( 'Show posts thumbnail', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_date',
					'label'    => esc_html__( 'Show published date', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_author',
					'label'    => esc_html__( 'Show author name', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_comments',
					'label'    => esc_html__( 'Show author name', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_cats',
					'label'    => esc_html__( 'Show post categories', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_tags',
					'label'    => esc_html__( 'Show post tags', 'holo' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_date_archive',
					'label'    => esc_html__( 'Show publish date', 'holo' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_excerpt',
					'label'    => esc_html__( 'Show posts excerpt', 'holo' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'holo',
				[
					'type'     => 'toggle',
					'settings' => 'show_sidebar',
					'label'    => esc_html__( 'Show Sidebar', 'holo' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
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
					'label'    => esc_html__( 'Show publish date', 'holo' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'holo',
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
					'label'    => esc_html__( 'Show posts excerpt', 'holo' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );
		} );
	// PostsWooCommerce

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
