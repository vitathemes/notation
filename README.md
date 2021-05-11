# Notation - [Demo](https://demo.vitathemes.com/notation/) | [Download](https://wordpress.org/themes/notation/)
Notation is a Shopping theme and ready to use WooCommerce as your e-commerce WordPress plugin

![Home Page](screenshot.png)

## Features
* No additional JS
* Sass for stylesheets
* Fast & lightweight (Google Speed: 99/100)
* Theme options built directly into WordPress native live theme customizer
* Responsive design
* Cross-browser compatibility
* Custom Google WebFonts
* Child themes support
* Developer friendly extendable code
* Translation ready (with .POT files included)
* Right-to-left (RTL) languages support
* SEO optimized
* GNU GPL version 2.0 licensed
* …and much more

See a working example at [https://demo.vitathemes.com/notation/](https://demo.vitathemes.com/meliora/).

## Theme installation
1. Simply install as a normal WordPress theme and activate.
2. In your admin panel, navigate to `Appearance > Customize`.
3. Put the finishing touches on your website by adding a logo, typography settings, custom colors and etc.

## Theme structure

```shell
themes/Shoppe/        # → Root of your theme
│── css/                  # → Compiled CSS file
│── js/                   # → Theme js files
│── sass/                 # → Theme scss files
├── languages/            # → Theme Language files
├── template-parts/       # → Theme Part files (Include)
├── node_modules/         # → Node.js packages
├── package.json          # → Node.js dependencies and scripts
│── classes/              # → Custom PHP classes
├── inc/                  # → Theme functions
│   ├── TGMPA/            # → TGMPA library
│   ├── customizer.php    # → All codes related to WordPress Customizer (We use Kirki Framework)
│   ├── template-functions.php    # → Custom template tweaks
│   └── template-tags.php         # → Custom template tags
│   └── hooks.php         # → Theme custom hooks
│   └── tgmpa-config.php         # → Configuration file for TGMPA
└── page-templates/       # → Page Templates
```

## Theme setup

Edit `functions.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

## Theme development

* Run `npm install` from the theme directory to install dependencies
* Run `gulp` from the root of theme directory and it's starting to watch any changes in scss files from the `assets/src/sass` folder

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## License

Notation is licensed under [GNU GPL](LICENSE).
