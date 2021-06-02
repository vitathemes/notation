# Notation - [Demo](https://demo.vitathemes.com/notation/) | [Download](https://wordpress.org/themes/notation/)
Notation is a simple, super fast, and content-first blog theme

![Home Page](screenshot.png)

## Features
* Notebook design
* No additional JS
* Sass for stylesheets
* Fast & lightweight (Google Speed (PageSpeed Insights): 100/100)
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

See a working example at [https://demo.vitathemes.com/notation/](https://demo.vitathemes.com/notation/).

## Theme installation

1. Simply install as a normal WordPress theme and activate.
2. Install recommended plugins
3. In your admin panel, navigate to `Appearance > Customize`.
4. Put the finishing touches on your website by adding a logo, typography settings, custom colors and etc.

## Theme structure

```shell
themes/notation/          # → Root of your theme
│── assets/               # → All assets goes here
│   │── css               # → Compiled css
│   │── fonts             # → Fonts
│   │── js                # → Js files
│   └── src               # → source files
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

## License

Notation is licensed under [GNU GPL](LICENSE).
