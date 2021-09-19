document.querySelector('.js-search-btn').addEventListener('click', (btn) => {
    document.querySelector('.js-search-btn').classList.toggle('is-open');
    document.querySelector('.c-header').classList.toggle('is-search-open');
});

if (document.querySelector('.js-sidebar-toggle')) {
    document.querySelector('.js-sidebar-toggle').addEventListener('click', () => {
        document.querySelector('.js-sidebar-toggle').classList.toggle('is-active');
        document.querySelector('.js-sidebar').classList.toggle('is-minimized');
        document.querySelector('.js-main').classList.toggle('is-centered');
    });
}

const wp_notes_header = document.querySelector('.js-header');
const wp_notes_search = document.querySelector('.js-header-search');
const wp_notes_nav = document.querySelector('.js-nav');

const wp_notes_navItems = wp_notes_nav.getElementsByTagName('a');

const wp_notes_lastFocusableEl = wp_notes_navItems[wp_notes_navItems.length - 1];
const wp_notes_navCloseBtn = document.querySelector('.js-menu-btn--close');
const wp_notes_navToggleBtn = document.querySelector('.js-menu-btn--toggle');

const wp_notes_searchBtn = wp_notes_search.querySelector('.js-search-btn');
const wp_notes_searchFormBtn = wp_notes_search.querySelector('.js-search-form-btn');

const WP_NOTES_KEYCODE_TAB = 9;
let wp_notes_isBackward;

document.addEventListener('keydown', function (e) {
    if (e.shiftKey && e.keyCode == WP_NOTES_KEYCODE_TAB) {
        wp_notes_isBackward = true;
    } else {
        wp_notes_isBackward = false;
    }
});

wp_notes_search.addEventListener('keydown', function (e) {
    if (window.matchMedia("(max-width: 1024px)").matches && wp_notes_header.classList.contains('is-search-open')) {
        if (e.key === 'Tab' || e.keyCode === WP_NOTES_KEYCODE_TAB) {
            if (e.shiftKey) /* shift + tab */ {
                if (document.activeElement === wp_notes_searchBtn) {
                    wp_notes_searchFormBtn.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if (document.activeElement === wp_notes_searchFormBtn) {
                    wp_notes_searchBtn.focus();
                    e.preventDefault();
                }
            }
        }
    }
});

wp_notes_navCloseBtn.addEventListener('blur', function (e) {
    if (wp_notes_isBackward) {
        wp_notes_.focus();
    }
});

wp_notes_lastFocusableEl.addEventListener('blur', function (e) {
    if (!wp_notes_isBackward) {
        wp_notes_navCloseBtn.focus();
    }
});

wp_notes_navCloseBtn.addEventListener('click', function (e) {
    wp_notes_navToggleBtn.focus();
});

wp_notes_navToggleBtn.addEventListener('blur', function (e) {
    if (document.querySelector('.c-header__nav.toggled')) {
        if (wp_notes_isBackward) {
            wp_notes_lastFocusableEl.focus();
        }
    }
});
