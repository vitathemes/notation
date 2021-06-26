<?php
/**
 * wp_notes Theme Customizer
 *
 * @package wp_notes
 */

function wp_wp_notes_enqueue_customizer_style( $hook_suffix ) {
	// Load your css.
	wp_register_style( 'kirki-styles-css',
		get_template_directory_uri() . '/assets//css/kirki-controls-style.css',
		false,
		'1.0.0' );
	wp_enqueue_style( 'kirki-styles-css' );
}

add_action( 'admin_enqueue_scripts', 'wp_wp_notes_enqueue_customizer_style' );


/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_notes_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wp_notes_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wp_notes_customize_partial_blogdescription',
			)
		);
	}
}

add_action( 'customize_register', 'wp_notes_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_notes_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_notes_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_notes_customize_preview_js() {
	wp_enqueue_script( 'wp_notes-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		THEME_VERSION,
		true );
}

add_action( 'customize_preview_init', 'wp_notes_customize_preview_js' );


/**
 * Custom theme customizer
 *
 * If the Kirki customizer framework is not enabled, these controls won't show up.
 */
if ( function_exists( 'kirki' ) ) {
	add_action( 'init',
		function () {
			// Disable Kiriki help notice
			add_filter( 'kirki_telemetry', '__return_false' );


			// Add config
			Kirki::add_config( 'wp-notes',
				array(
					'option_type' => 'theme_mod',
				) );

			// Add Panels
			Kirki::add_panel( 'elements',
				array(
					'priority'    => 10,
					'title'       => esc_html__( 'Elements', 'wp-notes' ),
					'description' => esc_html__( 'Elements', 'wp-notes' ),
				) );

// Add sections \\
// <editor-fold desc="Sections">

// Branding
			Kirki::add_section( 'colors',
				array(
					'title'    => esc_html__( 'Colors', 'wp-notes' ),
					'panel'    => '',
					'priority' => 3,
				) );

// Typography
			Kirki::add_section( 'typography',
				array(
					'title'      => esc_html__( 'Typography', 'wp-notes' ),
					'panel'      => '',
					'priority'   => 4,
					'capability' => 'edit_theme_options',
				) );

			Kirki::add_section( 'blog_opts',
				array(
					'title'    => esc_html__( 'Blog Options', 'wp-notes' ),
					'panel'    => '',
					'priority' => 6,
				) );

			// Posts
			Kirki::add_section( 'single_opts',
				array(
					'title'    => esc_html__( 'Single Options', 'wp-notes' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'archive_opts',
				array(
					'title'    => esc_html__( 'Archive Options', 'wp-notes' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'sidebar_opts',
				array(
					'title'    => esc_html__( 'Sidebar Options', 'wp-notes' ),
					'panel'    => 'elements',
					'priority' => 6,
				) );

			Kirki::add_section( 'footer',
				array(
					'title'    => esc_html__( 'Footer', 'wp-notes' ),
					'panel'    => '',
					'priority' => 6,
				) );

// </editor-fold>

			// -- Typography Fields --
			// <editor-fold desc="Typography">
			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'use_google_fonts',
					'label'    => esc_html__( 'Use google Fonts', 'wp-notes' ),
					'section'  => 'typography',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'Base font', 'wp-notes' ),
					'section'         => 'typography',
					'default'         => [
						'font-family'    => 'DM Sans',
						'variant'        => '400',
						'font-size'      => false,
						'line-height'    => '1.5',
						'letter-spacing' => '0'
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
							'element' => 'html',
						),
					),
				] );

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H1', 'wp-notes' ),
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

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H2', 'wp-notes' ),
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

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H3', 'wp-notes' ),
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

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H4', 'wp-notes' ),
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

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H5', 'wp-notes' ),
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

			Kirki::add_field( 'wp-notes',
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
					'label'           => esc_html__( 'H6', 'wp-notes' ),
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

// </editor-fold>
			// -- Typography Fields --

// <editor-fold desc="colors">

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_primary_color',
					'label'    => __( 'Primary Color', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#EC7160',
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_primary_accent_color',
					'label'    => __( 'Primary Accent Color', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#DA5745',
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_1',
					'label'    => __( 'Primary Texts Color', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#303030',
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_2',
					'label'    => __( 'Secondary Texts Color', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#898989',
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_3',
					'label'    => __( 'Borders Color', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#E7E7E9',
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'color',
					'settings' => 'color_4',
					'label'    => __( 'Sidebar', 'wp-notes' ),
					'section'  => 'colors',
					'default'  => '#F6F6F6',
				] );

// </editor-fold>

			// Posts
			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_thumbnail',
					'label'    => esc_html__( 'Show posts thumbnail', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_date',
					'label'    => esc_html__( 'Show published date', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_author',
					'label'    => esc_html__( 'Show author name', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_comments',
					'label'    => esc_html__( 'Show comments count', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_cats',
					'label'    => esc_html__( 'Show post categories', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_tags',
					'label'    => esc_html__( 'Show post tags', 'wp-notes' ),
					'section'  => 'single_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_date_archive',
					'label'    => esc_html__( 'Show publish date', 'wp-notes' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_post_excerpt',
					'label'    => esc_html__( 'Show posts excerpt', 'wp-notes' ),
					'section'  => 'archive_opts',
					'default'  => 1,
					'priority' => 10,
				] );


			Kirki::add_field( 'wp-notes',
				[
					'type'     => 'toggle',
					'settings' => 'show_sidebar',
					'label'    => esc_html__( 'Show Sidebar', 'wp-notes' ),
					'section'  => 'sidebar_opts',
					'default'  => 1,
					'priority' => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'toggle',
					'settings'        => 'show_date_sidebar',
					'label'           => esc_html__( 'Show publish date', 'wp-notes' ),
					'section'         => 'sidebar_opts',
					'default'         => 1,
					'priority'        => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'toggle',
					'settings'        => 'show_post_excerpt_sidebar',
					'label'           => esc_html__( 'Show posts excerpt', 'wp-notes' ),
					'section'         => 'sidebar_opts',
					'default'         => 1,
					'priority'        => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
						[
							'setting'  => 'show_post_excerpt_sidebar',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'toggle',
					'settings'        => 'limit_sidebar_posts_excerpt_toggle',
					'label'           => esc_html__( 'Limit posts excerpt', 'wp-notes' ),
					'section'         => 'sidebar_opts',
					'default'         => 0,
					'priority'        => 10,
				] );

			Kirki::add_field( 'wp-notes',
				[
					'active_callback' => [
						[
							'setting'  => 'show_sidebar',
							'operator' => '==',
							'value'    => true,
						],
						[
							'setting'  => 'show_post_excerpt_sidebar',
							'operator' => '==',
							'value'    => true,
						],
						[
							'setting'  => 'limit_sidebar_posts_excerpt_toggle',
							'operator' => '==',
							'value'    => true,
						],
					],
					'type'            => 'number',
					'settings'        => 'limit_sidebar_posts_excerpt',
					'label'           => esc_html__( 'Limit characters', 'wp-notes' ),
					'section'         => 'sidebar_opts',
					'default'         => 100,
					'priority'        => 10,
				] );
		} );
	// PostsWooCommerce

	// Footer
	Kirki::add_field( 'wp-notes',
		[
			'type'     => 'textarea',
			'settings' => 'copyright_text',
			'label'    => esc_html__( 'Copyright', 'wp-notes' ),
			'section'  => 'footer',
			'priority' => 10,
		] );

	// Footer


	// Homepage - Blog
	Kirki::add_field( 'wp-notes',
		[
			'type'        => 'toggle',
			'settings'    => 'show_blog_title',
			'label'       => esc_html__( 'Show Blog Title', 'wp-notes' ),
			'section'     => 'blog_opts',
			'priority'    => 10,
			'default'     => 1,
		] );

	Kirki::add_field( 'wp-notes',
		[
			'active_callback' => [
				[
					'setting'  => 'show_blog_title',
					'operator' => '==',
					'value'    => true,
				],
			],
			'type'        => 'text',
			'settings'    => 'blog_title',
			'label'       => esc_html__( 'Blog Title', 'wp-notes' ),
			'description' => esc_html__( 'Leave blank to show default blog archive title.', 'wp-notes' ),
			'section'     => 'blog_opts',
			'priority'    => 10,
			'default'     => esc_html__( 'Blog', 'wp-notes' ),
		] );

	Kirki::add_field( 'blog_content',
		[
			'type'     => 'switch',
			'settings' => 'blog_content',
			'label'    => esc_html__( 'Default content of blog page', 'wp-notes' ),
			'section'  => 'blog_opts',
			'default'  => 'on',
			'priority' => 10,
			'choices'  => [
				'on'  => esc_html__( 'Show latest posts', 'wp-notes' ),
				'off' => esc_html__( 'Show latest post', 'wp-notes' ),
			],
		] );

	Kirki::add_field( 'theme_config_id',
		[
			'active_callback' => [
				[
					'setting'  => 'blog_content',
					'operator' => '==',
					'value'    => false,
				],
			],
			'type'            => 'custom',
			'settings'        => 'custom_setting',
			'section'         => 'blog_opts',
			'default'         => '<p>' . __( "*If there is any sticky post, it will show the latest published post.",
					'wp-notes' ) . '</p>',
			'priority'        => 10,
		] );
	// Homepage

	function wp_indigo_add_edit_icons( $wp_customize ) {

		$wp_customize->selective_refresh->add_partial( 'show_post_thumbnail',
			array(
				'selector' => '.c-post--single .c-post__thumbnail',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_post_date',
			array(
				'selector' => '.c-post--single .c-post__date__published',
			) );

		$wp_customize->selective_refresh->add_partial( 'show_post_tags',
			array(
				'selector' => '.c-post__footer__tags',
			) );
	}

	add_action( 'customize_preview_init', 'wp_indigo_add_edit_icons' );
}
