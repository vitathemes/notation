document.querySelector('.js-search-btn').addEventListener('click', (btn) => {
    document.querySelector('.js-search-btn').classList.toggle('is-open');
    document.querySelector('.c-header').classList.toggle('is-search-open');
});

if (document.querySelector('.js-sidebar-toggle')) {
    document.querySelector('.js-sidebar-toggle').addEventListener('click', () => {
        document.querySelector('.js-sidebar-toggle').classList.toggle('is-active');
        document.querySelector('.js-sidebar').classList.toggle('is-minimized');
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

header.addEventListener('keydown', function (e) {
    if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
        if (e.shiftKey) /* shift + tab */ {
            if (document.activeElement === firstFocusableEl) {
                navCloseBtn.focus();
                e.preventDefault();
            }
        } else /* tab */ {
            if (document.activeElement === lastFocusableEl) {
                navCloseBtn.focus();
                e.preventDefault();
            }
        }
    }
});

search.addEventListener('keydown', function (e) {
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
});

navCloseBtn.addEventListener('keydown', function (e) {
    if (e.code === "Enter") {
        navToggleBtn.focus();
    } else {
        if (e.shiftKey) /* shift + tab */ {
            lastFocusableEl.focus();
            e.preventDefault();
        } else /* tab */ {
            firstFocusableEl.focus();
            e.preventDefault();
        }
    }
});
