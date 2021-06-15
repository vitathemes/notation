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

const header = document.querySelector('.js-header');
const search = document.querySelector('.js-header-search');
const nav = document.querySelector('.js-nav');

const navItems = nav.getElementsByTagName('a');

const firstFocusableEl = navItems[0];
const lastFocusableEl = navItems[navItems.length - 1];
const navCloseBtn = document.querySelector('.js-menu-btn--close');
const navToggleBtn = document.querySelector('.js-menu-btn--toggle');

const searchBtn = search.querySelector('.js-search-btn');
const searchFormBtn = search.querySelector('.js-search-form-btn');

//document.activeElement
const KEYCODE_TAB = 9;
let notation_focus, notation_isToggleItem, notation_isBackward;

document.addEventListener('keydown', function (e) {
    if (e.shiftKey && e.keyCode == KEYCODE_TAB) {
        notation_isBackward = true;
    } else {
        notation_isBackward = false;
    }
});

search.addEventListener('keydown', function (e) {
    if (window.matchMedia("(max-width: 1024px)").matches && header.classList.contains('is-search-open')) {
        if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
            if (e.shiftKey) /* shift + tab */ {
                if (document.activeElement === searchBtn) {
                    searchFormBtn.focus();
                    e.preventDefault();
                }
            } else /* tab */ {
                if (document.activeElement === searchFormBtn) {
                    searchBtn.focus();
                    e.preventDefault();
                }
            }
        }
    }
});

navCloseBtn.addEventListener('blur', function (e) {
    if (notation_isBackward) {
        lastFocusableEl.focus();
    }
});

lastFocusableEl.addEventListener('blur', function (e) {
    if (!notation_isBackward) {
        navCloseBtn.focus();
    }
});

navCloseBtn.addEventListener('click', function (e) {
    navToggleBtn.focus();
});

navToggleBtn.addEventListener('blur', function (e) {
    if (document.querySelector('.c-header__nav.toggled')) {
        if (notation_isBackward) {
            lastFocusableEl.focus();
        }
    }
});
