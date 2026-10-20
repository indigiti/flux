/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ([
/* 0 */,
/* 1 */
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   csGetCookie: () => (/* binding */ csGetCookie),
/* harmony export */   csSetCookie: () => (/* binding */ csSetCookie),
/* harmony export */   csco: () => (/* binding */ csco),
/* harmony export */   isInViewport: () => (/* binding */ isInViewport),
/* harmony export */   slideDown: () => (/* binding */ slideDown),
/* harmony export */   slideToggle: () => (/* binding */ slideToggle),
/* harmony export */   slideUp: () => (/* binding */ slideUp)
/* harmony export */ });
// Create csco object.
var csco = {
	addAction: function ( x, y, z ) {
		return;
	}
};

if ( 'undefined' !== typeof wp && 'undefined' !== typeof wp.hooks ) {
	csco.addAction = wp.hooks.addAction;
}

/**
 * isInViewport
 */

function isInViewport(element) {
	const rect = element.getBoundingClientRect();
	const windowHeight = (window.innerHeight || document.documentElement.clientHeight);
	const windowWidth = (window.innerWidth || document.documentElement.clientWidth);

	return (rect.top <= windowHeight && rect.top + rect.height >= 0) && (rect.left <= windowWidth && rect.left + rect.width >= 0);
}

/**
 * slideDown \ slideUp \ slideToggle
 */

function slideDown(element, duration = 350) {
	element.style.display = 'block';
	element.style.overflow = 'hidden';
	let height = element.scrollHeight;
	element.style.height = 0;
	setTimeout(() => {
		element.style.transition = `height ${duration}ms`;
		element.style.height = height + 'px';
		element.addEventListener('transitionend', function te() {
			element.removeEventListener('transitionend', te);
			element.style.removeProperty('height');
			element.style.removeProperty('transition');
			element.style.removeProperty('overflow');
		});
	}, 0);
}

function slideUp(element, duration = 350) {
	element.style.height = element.offsetHeight + 'px';
	element.style.overflow = 'hidden';
	setTimeout(() => {
		element.style.transition = `height ${duration}ms`;
		element.style.height = '0';
		element.addEventListener('transitionend', function te() {
			element.removeEventListener('transitionend', te);
			if (element.style.height === '0px') {
				element.style.display = 'none';
			}
			element.style.removeProperty('height');
			element.style.removeProperty('transition');
			element.style.removeProperty('overflow');
		});
	}, 0);
}

function slideToggle(element, duration = 350) {
	if (window.getComputedStyle(element).display === 'none') {
		return slideDown(element, duration);
	} else {
		return slideUp(element, duration);
	}
}

/**
 * Cookies
 */
function csGetCookie( name ) {
	let matches = document.cookie.match( new RegExp(
		"(?:^|; )" + name.replace( /([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1' ) + "=([^;]*)"
	) );
	return matches ? decodeURIComponent( matches[ 1 ] ) : undefined;
}

function csSetCookie( name, value, props = {} ) {

	props = {
		path: '/'
	};

	if ( props.expires instanceof Date ) {
		props.expires = props.expires.toUTCString();
	}

	let updatedCookie = encodeURIComponent( name ) + "=" + encodeURIComponent( value );

	for ( let optionKey in props ) {
		updatedCookie += "; " + optionKey;
		let optionValue = props[ optionKey ];
		if ( optionValue !== true ) {
			updatedCookie += "=" + optionValue;
		}
	}

	document.cookie = updatedCookie;
}




/***/ })
/******/ 	]);
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Burger Navigation */


class CscoBurgerNavigation {
    constructor() {
        this.initialize();
    }

    initialize() {
        if (document.body.classList.contains('wp-admin')) {
            return;
        }
        this.bindEvents();
    }

    bindEvents() {
        const setupNav = () => this.setupBurgerNavigation();
        const showFirst = () => this.showFirstSubmenu();

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                setupNav();

                const observer = new MutationObserver(() => {
                    if (document.body.classList.contains('cs-burger-active')) {
                        showFirst();
                    }
                });

                observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
            });
        } else {
            setupNav();

            const observer = new MutationObserver(() => {
                if (document.body.classList.contains('cs-burger-active')) {
                    showFirst();
                }
            });

            observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
        }

        window.addEventListener('resize', setupNav);
    }

    setupBurgerNavigation() {
        const menuItems = document.querySelectorAll('.cs-burger-menu__nav-menu .menu-item-has-children');

        // Reset event handlers and UI
        menuItems.forEach(menuItem => {
            menuItem.classList.remove('submenu-visible', 'touch-device', 'menu-item-expanded');
            const spans = menuItem.querySelectorAll('span.expanded');
            spans.forEach(span => span.remove());

            const clone = menuItem.cloneNode(true);
            menuItem.replaceWith(clone);
        });

        const isDesktop = window.innerWidth >= 1200;

        if (isDesktop) {
            const menuItems = document.querySelectorAll('.cs-burger-menu__nav-menu .menu-item-has-children');

            let lastHoveredItem = null;
            const activeItem = Array.from(menuItems).find(el =>
                el.classList.contains('current-menu-ancestor') || el.classList.contains('current-menu-item')
            );

            menuItems.forEach(menuItem => {
                menuItem.addEventListener('mouseenter', () => {
                    menuItems.forEach(el => el.classList.remove('submenu-visible'));
                    menuItem.classList.add('submenu-visible');
                    lastHoveredItem = menuItem;
                });

                menuItem.addEventListener('mouseleave', () => {
                    menuItem.classList.remove('submenu-visible');

                    // Priority: active item (if it exists), otherwise last hovered
                    const fallbackItem = activeItem || lastHoveredItem;
                    if (fallbackItem) {
                        fallbackItem.classList.add('submenu-visible');
                    }
                });
            });

            // Initial state
            if (activeItem) {
                activeItem.classList.add('submenu-visible');
            } else if (menuItems.length) {
                menuItems[0].classList.add('submenu-visible');
            }
        }
        else {
            // Click-based behavior
            document.querySelectorAll('.cs-burger-menu__nav-menu .menu-item-has-children').forEach(menuItem => {
                let span = document.createElement('span');
                span.className = 'expanded';
                menuItem.appendChild(span);
                menuItem.classList.add('touch-device');

                span.addEventListener('click', function (e) {
                    e.preventDefault();

                    let previousElement = span.previousElementSibling;

                    if (previousElement && previousElement.classList.contains('submenu-visible')) {
                        previousElement.classList.remove('submenu-visible');
                        (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(previousElement);
                        menuItem.classList.remove('menu-item-expanded');
                    } else {
                        let parentOfParent = menuItem.parentElement;

                        parentOfParent.querySelectorAll('.menu-item .sub-menu').forEach(subMenu => {
                            subMenu.classList.remove('submenu-visible');
                            (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(subMenu);
                        });

                        parentOfParent.querySelectorAll('.menu-item-expanded').forEach(item => {
                            item.classList.remove('menu-item-expanded');
                        });

                        if (previousElement) {
                            previousElement.classList.toggle('submenu-visible');
                            (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideToggle)(previousElement);
                        }

                        menuItem.classList.toggle('menu-item-expanded');
                    }
                });
            });
        }
    }

    showFirstSubmenu() {
        const menuItems = document.querySelectorAll('.cs-burger-menu__nav-menu .menu-item-has-children');

        // Remove previous active state
        menuItems.forEach(el => el.classList.remove('submenu-visible'));

        // Try to find a menu item with current-menu-ancestor or current-menu-item
        const activeItem = Array.from(menuItems).find(el =>
            el.classList.contains('current-menu-ancestor') || el.classList.contains('current-menu-item')
        );

        // Add submenu-visible to matched item or fallback to first
        if (activeItem) {
            activeItem.classList.add('submenu-visible');
        } else if (menuItems.length) {
            menuItems[0].classList.add('submenu-visible');
        }
    }
}

new CscoBurgerNavigation();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Comments Toggle */

(function () {

    const commentsElement = document.querySelector('.cs-entry__comments');
    const headToggles = document.querySelectorAll('.cs-entry__header .cs-meta-comments');

    // Handle toggling comments visibility
    document.addEventListener('click', e => {
        const toggleBtn = e.target.closest('.cs-entry__comments-toggle');
        if (toggleBtn) {
            e.preventDefault();

            const commentsWrap = toggleBtn.closest('.cs-entry__wrap');
            if (commentsWrap) {
                const commentsElement = commentsWrap.querySelector('.cs-entry__comments');
                if (commentsElement) {
                    commentsElement.classList.toggle('cs-entry__comments-visible');
                }
            }
        }
    });

    document.addEventListener('click', function (e) {
        const headToggle = e.target.closest('.cs-entry__header .cs-meta-comments');
        if (!headToggle) {
            return;
        }

        e.preventDefault();

        const commentsWrap = headToggle.closest('.cs-entry__wrap');
        if (!commentsWrap) {
            return;
        }

        const scopedCommentsElement = commentsWrap.querySelector('.cs-entry__comments');
        if (!scopedCommentsElement) {
            return;
        }

        scopedCommentsElement.classList.add('cs-entry__comments-visible');

        // Scroll to the top of the correct comment block
        scopedCommentsElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    const scrollToHash = () => {
        if (window.location.hash && window.location.hash !== "#") {
            const target = document.querySelector(window.location.hash);

            if (target && target === commentsElement) {
                commentsElement.classList.add('cs-entry__comments-visible');
            }
        }
    };

    window.addEventListener('load', scrollToHash);

    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (event) {
            // Check if the clicked element is a reply link
            const replyLink = event.target.closest('.comment-reply-link');
            if (replyLink) {
                event.preventDefault();

                const commentsWrap = replyLink.closest('.cs-entry__wrap');
                const commentsElement = commentsWrap.querySelector('.cs-entry__comments');

                // Ensure comments form visibility toggle is handled
                if (commentsElement && commentsElement.classList.contains('cs-entry__comments-form-visible')) {
                    commentsElement.classList.remove('cs-entry__comments-form-visible');
                }

                const cancelLink = commentsWrap.querySelector('#cancel-comment-reply-link');
                const targetSpan = commentsWrap.querySelector('.form-submit .cs-cancel-reply-button');
                const commentBody = commentsWrap.querySelector('.comment-body');

                // Move the cancel link into the form's cancel button container
                if (cancelLink && targetSpan) {
                    targetSpan.appendChild(cancelLink);
                    cancelLink.style.display = 'inline';
                }

                // Show the reply form inside the current comment
                if (commentBody) {
                    setTimeout(function () {
                        const commentRespond = commentBody.querySelector('.comment-respond');
                        if (commentRespond) {
                            commentRespond.style.display = 'block';
                        }
                    }, 50);
                }
            }
        });
    });

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Floating Header */

( function() {

    const section = 'cs-floating-header';
    const activeClass = 'is-active';
    const offset = 300;

    const root = document.documentElement;
    const floatingHeader = document.querySelector(`.${section}`);
    const progressbar = document.querySelector(`.${section}__progress-bar`);

    const initReadingTimeProgress = function() {
        if (floatingHeader && progressbar && content) {
            const updateProgress = function () {
                const firstPostElement = document.querySelector('.cs-content-area');
                let firstContent = null;
                if (firstPostElement) {
                    firstContent = firstPostElement.querySelector('.entry-content') || firstPostElement;
                }
                const autoPosts = Array.from(document.querySelectorAll('.cs-nextpost-section .entry-content'));

                const contents = [];
                if (firstContent) {
                    contents.push(firstContent);
                }
                contents.push(...autoPosts);

                let activeContent = null;
                let minDistance = Infinity;
                contents.forEach(content => {
                    const rect = content.getBoundingClientRect();
                    const distance = Math.abs(rect.top);
                    if (distance < minDistance) {
                        minDistance = distance;
                        activeContent = content;
                    }
                });

                if (!activeContent) {
                    progressbar.style.width = '0%';
                    return;
                }

                const progressOffset = 180;
                const scroll = window.scrollY || document.documentElement.scrollTop;
                const contentOffsetTop = activeContent.getBoundingClientRect().top + scroll - progressOffset;
                const contentHeight = activeContent.offsetHeight;
                const headerHeight = floatingHeader.offsetHeight;
                const effectiveWindowHeight = window.innerHeight - headerHeight;
                const scrollableHeight = contentHeight - effectiveWindowHeight;

                if (scrollableHeight > 0) {
                    const relativeScroll = Math.max(0, Math.min(scroll - contentOffsetTop, scrollableHeight));
                    const progressPercent = (relativeScroll / scrollableHeight) * 100;
                    progressbar.style.width = `${progressPercent}%`;
                } else {
                    progressbar.style.width = '0%';
                }
            };

            updateProgress();

            window.addEventListener('scroll', () => {
                updateProgress();

                const scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName('html')[0].scrollTop;
                if (scrollPos > offset) {
                    floatingHeader.classList.add(activeClass);
                    root.style.setProperty('--cs-floating-header-height', `${floatingHeader.offsetHeight}px`);
                } else {
                    floatingHeader.classList.remove(activeClass);
                    root.style.setProperty('--cs-floating-header-height', `0px`);
                }
            });
            window.addEventListener('resize', updateProgress);
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const firstPost = document.querySelector('.cs-content-area');
        if (firstPost) {
            initReadingTimeProgress(firstPost);
        }
    });

    const observePosts = function() {
        const posts = document.querySelectorAll('.cs-nextpost-section');
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    initReadingTimeProgress();
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            threshold: 0.1
        });

        posts.forEach(post => {
            observer.observe(post);
        });
    };

    document.addEventListener('DOMContentLoaded', observePosts);

    document.body.addEventListener('post-load', function(e) {
        observePosts();
    });



} )();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Footer Nav Menu */



(function () {

    HTMLElement.prototype.responsiveNav = function () {
        this.classList.remove('menu-item-expanded');
        let previousElement = this.previousElementSibling;

        if (previousElement && previousElement.classList.contains('submenu-visible')) {
            previousElement.classList.remove('submenu-visible');
            (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(previousElement);
            this.parentElement.classList.remove('menu-item-expanded');
        } else {
            let parentOfParent = this.parentElement.parentElement;

            parentOfParent.querySelectorAll('.menu-item .sub-menu').forEach(subMenu => {
                subMenu.classList.remove('submenu-visible');
                (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(subMenu);
            });

            parentOfParent.querySelectorAll('.menu-item-expanded').forEach(item => {
                item.classList.remove('menu-item-expanded');
            });

            if (previousElement) {
                previousElement.classList.toggle('submenu-visible');
                (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideToggle)(previousElement);
            }

            this.parentElement.classList.toggle('menu-item-expanded');
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        let menuItems = document.querySelectorAll('.cs-footer-columns__nav .menu-item-has-children');

        menuItems.forEach(menuItem => {
            let span = document.createElement('span');
            menuItem.appendChild(span);

            span.addEventListener('click', function (e) {
                e.preventDefault();
                this.responsiveNav();
            });
        });
    });

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Section toggles header panels and overlay */

(function () {
	const body = document.body;
	const headerElement = document.querySelector('.cs-header');
	const headerOverlay = document.querySelector('.cs-header-overlay');
	const searchToggles = document.querySelectorAll('.cs-header__search-toggle, .cs-search__close');
	const burgerToggles = document.querySelectorAll('.cs-header__burger-toggle');
	const moreToggles = document.querySelectorAll('.cs-header__more-toggle');

	searchToggles.forEach(searchToggle => {
		searchToggle.addEventListener('click', function (e) {
			e.preventDefault();

			if (body.classList.contains('cs-offcanvas-active')) {
				body.classList.remove('cs-offcanvas-active');
			}

			if (headerElement.classList.contains('cs-burger-visible')) {
				headerElement.classList.remove('cs-burger-visible');
				body.classList.remove('cs-burger-active');
			}

			if (headerElement.classList.contains('cs-more-visible')) {
				headerElement.classList.remove('cs-more-visible');
				body.classList.remove('cs-more-active');
			}

			headerElement.classList.toggle('cs-search-visible');
			body.classList.toggle('cs-search-active');
		});
	});

	burgerToggles.forEach(burgerToggle => {
		burgerToggle.addEventListener('click', function (e) {
			e.preventDefault();

			if (body.classList.contains('cs-offcanvas-active')) {
				body.classList.remove('cs-offcanvas-active');
			}

			if (headerElement.classList.contains('cs-search-visible')) {
				headerElement.classList.remove('cs-search-visible');
				body.classList.remove('cs-search-active');
			}

			if (headerElement.classList.contains('cs-more-visible')) {
				headerElement.classList.remove('cs-more-visible');
				body.classList.remove('cs-more-active');
			}

			headerElement.classList.toggle('cs-burger-visible');
			body.classList.toggle('cs-burger-active');
		});
	});

	moreToggles.forEach(moreToggle => {
		moreToggle.addEventListener('click', function (e) {
			e.preventDefault();

			if (body.classList.contains('cs-offcanvas-active')) {
				body.classList.remove('cs-offcanvas-active');
			}

			if (headerElement.classList.contains('cs-search-visible')) {
				headerElement.classList.remove('cs-search-visible');
				body.classList.remove('cs-search-active');
			}

			if (headerElement.classList.contains('cs-burger-visible')) {
				headerElement.classList.remove('cs-burger-visible');
				body.classList.remove('cs-burger-active');
			}

			headerElement.classList.toggle('cs-more-visible');
			body.classList.toggle('cs-more-active');
		});
	});

	if ( headerOverlay ) {
		headerOverlay.addEventListener('click', function (e) {
			e.preventDefault();

			if (headerElement.classList.contains('cs-search-visible')) {
				headerElement.classList.remove('cs-search-visible');
				body.classList.remove('cs-search-active');
			}

			if (headerElement.classList.contains('cs-burger-visible')) {
				headerElement.classList.remove('cs-burger-visible');
				body.classList.remove('cs-burger-active');
			}

			if (headerElement.classList.contains('cs-more-visible')) {
				headerElement.classList.remove('cs-more-visible');
				body.classList.remove('cs-more-active');
			}
		});
	}

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Header Scroll Scheme */

document.addEventListener('DOMContentLoaded', function () {

	let transitionTimer;

	document.addEventListener('nav-stick', function (event) {
		if (document.body.classList.contains('cs-display-header-overlay')) {

			let headerSmart = document.querySelector('.cs-navbar-smart-enabled .cs-header, .cs-navbar-sticky-enabled .cs-header');
			let headerAlt = headerSmart.querySelector('.cs-container');

			headerAlt.classList.add("cs-header-elements-no-transition");

			clearTimeout(transitionTimer);

			transitionTimer = setTimeout(function () {
				headerAlt.classList.remove("cs-header-elements-no-transition");
			}, 300);
		}
	});

	document.addEventListener('nav-unstick', function (event) {
		if (document.body.classList.contains('cs-display-header-overlay')) {

			let headerSmart = document.querySelector('.cs-navbar-smart-enabled .cs-header, .cs-navbar-sticky-enabled .cs-header');
			let headerAlt = headerSmart.querySelector('.cs-container');

			headerAlt.classList.add("cs-header-elements-no-transition");

			clearTimeout(transitionTimer);

			transitionTimer = setTimeout(function () {
				headerAlt.classList.remove("cs-header-elements-no-transition");
			}, 300);
		}
	});

});

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Header Smart Streatch */

document.addEventListener('DOMContentLoaded', function () {

	document.addEventListener('header-smart-stretch-scroll-sticky-scroll-init', function (event) {
		let headerParams = event.detail;

		window.addEventListener('scroll', function () {
			let scrolled = window.scrollY;

			let headerSmart = document.querySelector('.cs-navbar-smart-enabled .cs-header, .cs-navbar-sticky-enabled .cs-header');
			headerParams.headerSmartPosition = headerSmart ? headerSmart.offsetTop : 0;

			if (scrolled > headerParams.smartStart + headerParams.scrollPoint + 10 && scrolled > headerParams.scrollPrev) {
				if (scrolled > headerParams.smartStart + headerParams.headerLargeHeight + 200) {
					document.dispatchEvent(new CustomEvent('sticky-nav-hide', { detail: headerParams }));
				}
			} else {
				if (headerParams.scrollUpAmount >= headerParams.scrollPoint || scrolled === 0) {
					document.dispatchEvent(new CustomEvent('sticky-nav-visible', { detail: headerParams }));
				}
			}

			if (scrolled > headerParams.smartStart + headerParams.headerLargeHeight) {
				document.dispatchEvent(new CustomEvent('nav-stick', { detail: headerParams }));
			} else if (headerParams.headerSmartPosition <= headerParams.smartStart) {
				document.dispatchEvent(new CustomEvent('nav-unstick', { detail: headerParams }));
			}

			if (scrolled < headerParams.scrollPrev) {
				headerParams.scrollUpAmount += headerParams.scrollPrev - scrolled;
			} else {
				headerParams.scrollUpAmount = 0;
			}

			let wpAdminBar = document.querySelector('#wpadminbar');
			if (wpAdminBar && window.innerWidth <= 600 && scrolled >= headerParams.wpAdminBarHeight) {
				document.dispatchEvent(new CustomEvent('adminbar-mobile-scrolled', { detail: headerParams }));
			} else {
				document.dispatchEvent(new CustomEvent('adminbar-mobile-no-scrolled', { detail: headerParams }));
			}

			headerParams.scrollPrev = scrolled;
		});

	});

});

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Hero */



(function () {

    const section = 'cs-home-slider';
    const sliders = document.querySelectorAll( `.${section}__slider` );

    if (sliders.length === 0) {
        return;
    }

    let executed = false;
    let isMouseOnControl = false; // Track if the mouse is on the controls (next/prev/pagination)
    let isMouseOnSlider = false;  // Track if the mouse is on the slider
    let isSliderVisible = true;   // Track if the slider is fully visible on the screen

    const initHero = function () {
        if ( ! executed && (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.isInViewport)( sliders[0] )) {
            executed = true;

            const head   = document.getElementsByTagName( 'head' )[0];
            const script = document.createElement( 'script' );

            script.type = 'text/javascript';
            script.src  = 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js';

            script.onload = function () {
                function setParallaxAttributes(element, duration) {
                    element.setAttribute( 'data-swiper-parallax-x', '-400' );
                    element.setAttribute( 'data-swiper-parallax-duration', duration );
                }

                sliders.forEach(
                    slider => {
                        // Section data
                        const autoplayValue    = slider.getAttribute( 'data-cs-autoplay' );
                        const autoplayDelayValue   = slider.getAttribute( 'data-cs-autoplay-delay' );
                        const parallaxValue        = slider.getAttribute( 'data-cs-parallax' );
                        const gapValue             = slider.getAttribute( 'data-cs-gap' );
                        const postContentContainer = '.cs-entry__content';
                        // Data manipulation
                        const autoplayDelay = ! isNaN( parseInt( autoplayDelayValue ) ) ? parseInt( autoplayDelayValue ) : 5000;
                        const autoplay          = autoplayValue ? { delay : autoplayDelay, disableOnInteraction : false, pauseOnMouseEnter : true, } : false;
                        const parallax          = ! ! parallaxValue ? true : false;
                        const gap               = ! isNaN( parseInt( gapValue ) ) ? parseInt( gapValue ) : 0;
                        const postContents      = slider.querySelectorAll( postContentContainer );
                        if (parallax) {
                            if (postContents.length > 0) {
                                postContents.forEach(
                                    postContent => {
                                        setParallaxAttributes( postContent, '800' );
                                    }
                                );
                            }
                        }
                        // Swiper settings
                        const wrapperClass    = `${section}__wrapper`;
                        const slideClass          = `${section}__item`;
                        const prevEl              = slider.querySelector( `.${section}__button-prev` );
                        const nextEl              = slider.querySelector( `.${section}__button-next` );
                        const paginationContainer = slider.querySelector( `.${section}__pagination` );
                        const bulletClass         = `${section}__pagination-bullet`;
                        const bulletClassActive   = `${section}__pagination-bullet-active`;

                        const swiper = new Swiper(
                            slider,
                            {
                                scrollbar: false,
                                wrapperClass: wrapperClass,
                                slideClass: slideClass,
                                direction: 'horizontal',
                                loop: true,
                                speed: 800,
                                parallax: parallax,
                                autoplay: autoplay,
                                slidesPerView: 1,
                                spaceBetween: gap,
                                a11y: {
                                    slideRole: 'article',
                                    slideLabelMessage: 'Slide {{index}} of {{slidesLength}}'
                                },
                                pagination: {
                                    el: paginationContainer,
                                    clickable: true,
                                    bulletClass: bulletClass,
                                    bulletActiveClass: bulletClassActive,
                                    renderBullet: function (index, className) {
                                        return `<div class="${className}"><span class="inner-span"></span></div>`;
                                    }
                                },
                                navigation: {
                                    nextEl: nextEl,
                                    prevEl: prevEl,
                                },
                                on: {
                                    init: function () {
                                        setTimeout(
                                            () => {
                                                const initialSlide = this.slides[this.activeIndex];
                                                if (initialSlide) {
                                                    const initialContent = initialSlide.querySelector( postContentContainer );
                                                    if (initialContent) {
                                                        initialContent.style.transform = 'none';
                                                    }
                                                }
                                            },
                                            100
                                        );
                                    },
                                    slideChange: function () {
                                        const currentSlide = this.slides[this.activeIndex];

                                        postContents.forEach(
                                            postContent => {
                                                if (postContent === currentSlide.querySelector( postContentContainer )) {
                                                    postContent.style.transform = 'none';
                                                }
                                            }
                                        );
                                    }
                                }
                            }
                        );

                        if (autoplayValue) {
                            const controls = [nextEl, prevEl, paginationContainer];

                            controls.forEach(control => {
                                if (control) {
                                    control.addEventListener('mouseenter', () => {
                                        swiper.autoplay.stop();
                                        swiper.el.classList.add('swiper-paused');

                                        isMouseOnControl = true; // Track if mouse is on a control

                                        // Pause button animation
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "paused";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "paused";
                                        }
                                    });

                                    control.addEventListener('mouseleave', () => {
                                        isMouseOnControl = false; // Mouse is no longer on a control

                                        // Resume autoplay and remove 'swiper-paused' class if mouse is not on the slider
                                        if (!isMouseOnSlider && isSliderVisible) {
                                            swiper.autoplay.start();
                                            swiper.el.classList.remove('swiper-paused');
                                        }

                                        // Resume button animation
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "running";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "running";
                                        }
                                    });

                                    control.addEventListener('click', () => {
                                        swiper.autoplay.stop();
                                        swiper.el.classList.add('swiper-paused');

                                        // Pause button animation on click
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "paused";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "paused";
                                        }
                                    });
                                }
                            });

                            slider.addEventListener('mouseenter', () => {
                                isMouseOnSlider = true;
                                swiper.autoplay.stop();
                                swiper.el.classList.add('swiper-paused');
                            });

                            slider.addEventListener('mouseleave', () => {
                                isMouseOnSlider = false;

                                if (!isMouseOnControl && isSliderVisible) {
                                    swiper.autoplay.start();
                                    swiper.el.classList.remove('swiper-paused');
                                }
                            });

                            const observer = new IntersectionObserver(
                                (entries) => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting) {
                                            isSliderVisible = true;
                                            if (!isMouseOnControl && !isMouseOnSlider) {
                                                swiper.autoplay.start();
                                                swiper.el.classList.remove('swiper-paused');
                                            }
                                        } else {
                                            isSliderVisible = false;
                                            swiper.autoplay.stop();
                                            swiper.el.classList.add('swiper-paused');
                                        }
                                    });
                                },
                                { threshold: 0.50 }
                            );

                            observer.observe(slider);
                        }
                    }
                );
            };

            head.appendChild( script );
        }
    };

    document.addEventListener(
        'DOMContentLoaded',
        () => {
            initHero();
        }
    );

    window.addEventListener(
        'resize',
        () => {
            initHero();
        }
    );

    window.addEventListener(
        'scroll',
        () => {
            initHero();
        }
    );

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/**
 * AJAX Load More.
 *
 * Contains functions for AJAX Load More.
 */

if (typeof window.load_more_query === 'undefined') {
	window.load_more_query = [];
}

// Get next posts
function csco_ajax_get_posts(object) {
	let container = object.closest( '.cs-posts-area' );
	let settings  = JSON.parse( object.dataset.settings );
	let page      = parseInt( object.dataset.page );

	object.dataset.loading = true;

	// Set button text to Loading.
	let innerSpan = object.querySelector( 'span' );
	if (innerSpan) {
		innerSpan.childNodes[0].textContent = settings.translation.loading;
	}

	let data = {
		action: 'csco_ajax_load_more',
		page: page,
		posts_per_page: settings.posts_per_page,
		query_data: settings.query_data,
		attributes: settings.attributes,
		options: settings.options,
		_ajax_nonce: settings.nonce,
	};

    if ( settings.hasOwnProperty('current_lang') && settings.current_lang ) {
        data.current_lang = settings.current_lang;
    }
    if ( settings.hasOwnProperty('current_locale') && settings.current_locale ) {
        data.current_locale = settings.current_locale;
    }

	// Request Url.
	let csco_pagination_url = (settings.type === 'ajax_restapi') ? settings.rest_url : settings.url;

	function encodeFormData(data) {
		return Object.keys( data ).map( key => encodeURIComponent( key ) + '=' + encodeURIComponent( data[key] ) ).join( '&' );
	}

	fetch(
		csco_pagination_url,
		{
			method: 'POST',
			body: encodeFormData( data ),
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded'
			}
		}
	)
		.then( response => response.json() )
		.then(
			res => {
            if (res.success) {
                let dataContent       = document.createElement( 'div' );
                dataContent.innerHTML = res.data.content;

                if (dataContent.children.length) {
                    // WP Post Load trigger. This might need more logic for your specific use-case.
                    document.body.dispatchEvent( new Event( 'post-load' ) );

                    // Reinit Facebook widgets.
                    if (document.querySelector( '#fb-root' ) && typeof FB !== 'undefined') {
                        FB.XFBML.parse();
                    }

                    // Set button text to Load More.
                    if (innerSpan) {
                        innerSpan.childNodes[0].textContent = settings.translation.load_more;
                    }

                    // Increment a page.
                    page += 1;

                    object.dataset.page = page.toString();

                    // Reset the loading state.
                    object.dataset.loading = "false";

                    // Append new content to the container
                    let mainContainer = container.querySelector( '.cs-posts-area__main' );
                    while (dataContent.firstChild) {
                        mainContainer.appendChild( dataContent.firstChild );
                    }
                }

                // Remove Button on Posts End.
                if (res.data.posts_end) {
                    // Remove Load More button.
                    object.parentNode.removeChild( object );
                }
            }
			}
		)
		.catch(
			error => {
            console.error( 'Error fetching posts:', error );
			}
		);
}

function csco_load_more_init(infinite) {
	let areas = document.querySelectorAll( '.cs-posts-area' );
	areas.forEach(
		area => {
        if (area.dataset.init) {
            return;
        }
        let csco_ajax_settings;
        let archive_data = area.dataset.postsArea;
        if (archive_data) {
            csco_ajax_settings = JSON.parse( window.atob( archive_data ) );
        } else if (typeof csco_ajax_pagination !== 'undefined' && typeof archive_data === 'undefined') {
				csco_ajax_settings = csco_ajax_pagination;
        }

			if (csco_ajax_settings) {
				if ( ! infinite && csco_ajax_settings.infinite_load) {
					return;
				}

				let pagination       = document.createElement( 'div' );
				pagination.className = 'cs-posts-area__pagination';

				let btn = document.createElement( 'button' );

				// Render animated button.
				btn.className        = 'cs-load-more cs-button-large cs-button-animated';
				let innerSpan        = document.createElement( 'span' );
				let textSpan         = document.createElement( 'span' );
				textSpan.textContent = csco_ajax_settings.translation.load_more;
				innerSpan.appendChild( textSpan );
				innerSpan.appendChild( textSpan.cloneNode( true ) );
				btn.appendChild( innerSpan );

				pagination.appendChild( btn );
				area.appendChild( pagination );

				btn.dataset.settings       = JSON.stringify( csco_ajax_settings );
				btn.dataset.page           = '2';
				btn.dataset.loading        = "false";
				btn.dataset.scrollHandling = JSON.stringify(
					{
						allow: JSON.parse( csco_ajax_settings.infinite_load ),
						delay: 400
					}
				);
			}

			area.dataset.init = true;
		}
	);
}

csco_load_more_init( true );


// On Scroll Event.
window.addEventListener(
	'scroll',
	function () {
		let buttons                = document.querySelectorAll( '.cs-posts-area .cs-load-more' );
		buttons.forEach(
			btn => {
            let loading        = btn.dataset.loading === "true";
            let scrollHandling = JSON.parse( btn.dataset.scrollHandling || '{}' );
            if (loading || ! scrollHandling.allow) {
                return;
            }
            scrollHandling.allow       = false;
            btn.dataset.scrollHandling = JSON.stringify( scrollHandling );
            setTimeout(
				function () {
					scrollHandling.allow = true;

					btn.dataset.scrollHandling = JSON.stringify( scrollHandling );
				},
				scrollHandling.delay
			);
			let offset = btn.getBoundingClientRect().top - window.innerHeight;
			if (offset < 4000) {
				csco_ajax_get_posts( btn );
			}
			}
		);
	}
);

// On Click Event.
document.body.addEventListener(
	'click',
	function (event) {
		let button = event.target.closest( '.cs-load-more' );
		if (button) {
			let loading = button.dataset.loading === "true";
			if ( ! loading) {
				csco_ajax_get_posts( button );
			}
		}
	}
);

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/**
 * AJAX Load Nextpost.
 *
 * Contains functions for AJAX Load Nextpost.
 */
if (typeof csco_ajax_nextpost !== 'undefined') {

	var objNextparent = document.querySelector('.cs-site-primary > .cs-site-content');
	var objNextsect = '.cs-nextpost-section';
	var objNextpost = null;
	var currentNTitle = document.title;
	var currentNLink = window.location.href;
	var loadingNextpost = false;
	var scrollNextpost = {
		allow: true,
		reallow: function () {
			scrollNextpost.allow = true;
		},
		delay: 400 //(milliseconds) adjust to the highest acceptable value
	};

	// Init.
	if (csco_ajax_nextpost.next_post) {
		objNextparent.insertAdjacentHTML('afterend', '<div class="cs-nextpost-inner"></div>');
		objNextpost = document.querySelector('.cs-nextpost-inner');
	}

	// Remove previous & next post elements from the Floating Header.
	var floatingHeader = document.querySelector('.cs-floating-header__content');
	if (floatingHeader) {
		var nextElement = floatingHeader.querySelector('.cs-floating-header__next');
		if (nextElement) {
			nextElement.remove();
		}
		var prevElement = floatingHeader.querySelector('.cs-floating-header__prev');
		if (prevElement) {
			prevElement.remove();
		}
		var currentElement = floatingHeader.querySelector('.cs-floating-header__current');
		if (currentElement) {
			currentElement.classList.add('fullwidth');
		}
	}
}

/**
 * Update Floating Header
 */
function updateFloatingHeader(title) {
	var floatingHeader = document.querySelector('.cs-floating-header__content');

	if (floatingHeader && title) {
		var currentPostTitle = floatingHeader.querySelector('.cs-floating-header__current span');
		if (currentPostTitle) {
			currentPostTitle.textContent = title || ''; // Fallback to empty string if title is missing
		}
	}
}

/**
 * Get next post
 */
function csco_ajax_get_nextpost() {
	loadingNextpost = true;

	// Set class loading.
	var data = {
		action: 'csco_ajax_load_nextpost',
		not_in: csco_ajax_nextpost.not_in,
		current_user: csco_ajax_nextpost.current_user,
		nonce: csco_ajax_nextpost.nonce,
		next_post: csco_ajax_nextpost.next_post,
	};

    if ( csco_ajax_nextpost.hasOwnProperty('current_lang') && csco_ajax_nextpost.current_lang ) {
        data.current_lang = csco_ajax_nextpost.current_lang;
    }
    if ( csco_ajax_nextpost.hasOwnProperty('current_locale') && csco_ajax_nextpost.current_locale ) {
        data.current_locale = csco_ajax_nextpost.current_locale;
    }

	// Request Url.
	var csco_ajax_nextpost_url;
	if ('ajax_restapi' === csco_ajax_nextpost.type) {
		csco_ajax_nextpost_url = csco_ajax_nextpost.rest_url;
	} else {
		csco_ajax_nextpost_url = csco_ajax_nextpost.url;
	}

	function encodeFormData(data) {
		return Object.keys(data).map(key => encodeURIComponent(key) + '=' + encodeURIComponent(data[key])).join('&');
	}

	// Send Request.
	fetch(csco_ajax_nextpost_url, {
		method: 'POST',
		body: encodeFormData(data),
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		}
	})
		.then(response => response.json())
		.then(res => {
			csco_ajax_nextpost.next_post = false;

			if (res.success) {
				// Get the posts.
				var tempDiv = document.createElement('div');
				tempDiv.innerHTML = res.data.content;
				var newPosts = Array.from(tempDiv.children);

				// Check if there're any posts.
				if (newPosts.length) {
					// Set the loading state.
					loadingNextpost = false;

					// Set not_in.
					csco_ajax_nextpost.not_in = res.data.not_in;

					// Set next data.
					csco_ajax_nextpost.next_post = res.data.next_post;

					// Remove loader.
					var loadingElement = objNextpost.nextElementSibling;
					if (loadingElement && loadingElement.classList.contains('cs-nextpost-loading')) {
						loadingElement.remove();
					}

					// Append new post.
					newPosts.forEach(post => objNextpost.appendChild(post.cloneNode(true)));

					// Update Floating Header with the new title.
					if (objNextpost.children.length === newPosts.length) {
						// updateFloatingHeader(res.data.title || '');
					}

					if (document.getElementById('fb-root') && typeof FB === 'object') {
						FB.XFBML.parse();
					}

					document.body.dispatchEvent(new Event('post-load'));
				}
			} else {
				// console.log(res);
			}
		})
		.catch(error => {
			// console.log(error);
		});
}

/**
 * Check if Load Nextpost is defined by the wp_localize_script
 */
if (typeof csco_ajax_nextpost !== 'undefined') {

	// On Scroll Event.
	window.addEventListener('scroll', function () {
		var scrollTop = window.scrollY || window.pageYOffset;

		// Init nextpost.
		if (csco_ajax_nextpost.next_post) {

			if (objNextpost && !loadingNextpost && scrollNextpost.allow) {
				scrollNextpost.allow = false;
				setTimeout(scrollNextpost.reallow, scrollNextpost.delay);
				// Calc current offset.
				var offset = objNextpost.offsetTop + objNextpost.offsetHeight - scrollTop;
				// Load nextpost.
				if (4000 > offset) {
					objNextpost.insertAdjacentHTML('afterend', '<div class="cs-nextpost-loading"></div>');

					csco_ajax_get_nextpost();
				}
			}
		}

		// Reset browser data link.
		var objFirst = document.querySelector(objNextsect + ':first-child');

		if (objFirst) {
			var firstTop = objFirst.offsetTop;
			// If there has been a change.
			if (scrollTop < firstTop && window.location.href !== currentNLink) {
				document.title = currentNTitle;
				history.pushState(null, currentNTitle, currentNLink);
				updateFloatingHeader(currentNTitle); // Update header when scrolling back to the top
			}
		}

		// Set browser data link.
		document.querySelectorAll(objNextsect).forEach(function (elem) {
			var elemTop = elem.offsetTop;
			var elemHeight = elem.offsetHeight;

			if (scrollTop > elemTop && scrollTop < elemTop + elemHeight) {
				// If there has been a change.
				if (window.location.href !== elem.dataset.url) {
					// New title.
					document.title = elem.dataset.title;
					// New link.
					history.pushState(null, elem.dataset.title, elem.dataset.url);

					// Update Floating Header with the new title.
					updateFloatingHeader(elem.dataset.title);

					// Google Analytics.
					if (typeof gtag === 'function' && typeof window.gaData === 'object') {
						var trackingId = Object.keys(window.gaData)[0];
						if (trackingId) {
							gtag('config', trackingId, {
								'page_title': elem.dataset.title,
								'page_location': elem.dataset.url
							});

							gtag('event', 'page_view', {
								'send_to': trackingId
							});
						}
					}
				}
			}
		});
	});
}

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Running Line */

let section = '.cs-footer-marquee';

function generateMarqueeAnimation() {
    const container = document.querySelector(`${section}__content`);
    if (!container) {
        return;
    }

    const firstItem = container.querySelector(`${section}__item`);
    if (!firstItem) {
        return;
    }

    const isRTL = document.documentElement.dir === 'rtl' || document.body.dir === 'rtl';
    const itemWidth = firstItem.offsetWidth;

    const existingStyle = document.getElementById('marquee-animation-style');
    if (existingStyle) {
        existingStyle.remove();
    }

    const style = document.createElement('style');
    style.id = 'marquee-animation-style';

    const fromTransform = isRTL ? `translateX(${itemWidth}px)` : `translateX(-${itemWidth}px)`;
    const toTransform = 'translateX(0)';

    style.textContent = `
		@keyframes marqueeAnimation {
			from { transform: ${fromTransform}; }
			to { transform: ${toTransform}; }
		}
	`;
    document.head.appendChild(style);
}

document.addEventListener('DOMContentLoaded', generateMarqueeAnimation);
window.addEventListener('resize', generateMarqueeAnimation);

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Metabar */

(function () {
	var ticking = false;

	var update = function () {
		document.querySelectorAll( '.cs-site-content .cs-content-area' ).forEach(
			function (mainContent) {
				var content = mainContent.querySelector( '.entry-content' );

				if ( ! content) {
					return;
				}

				var metabar = mainContent.querySelector( '.cs-entry__metabar-inner' );

				if ( ! metabar) {
					return;
				}

				var offsetTop    = 20;
				var offsetBottom = -20;
				var elements     = ['.alignfull', '.alignwide'];
				var layouts      = Array.from( content.querySelectorAll( elements.join( ',' ) ) );

				if ( ! metabar || layouts.length === 0) {
					return;
				}

				var disabled = false;

				var metabarTop    = metabar.getBoundingClientRect().top + window.scrollY;
				var metabarHeight = metabar.offsetHeight;

				layouts.forEach(
					function (layout) {
						if (getComputedStyle( layout ).transform === 'none') {
							return;
						}

						var layoutTop    = layout.getBoundingClientRect().top + window.scrollY;
						var layoutHeight = layout.offsetHeight;
						var pointTop     = layoutTop - offsetTop;
						var pointBottom  = layoutTop + layoutHeight + offsetBottom;

						if (metabarTop + metabarHeight >= pointTop && metabarTop <= pointBottom) {
							disabled = true;
						}
					}
				);

				metabar.style.opacity = disabled ? '0' : '1';
			}
		);

		ticking = false;
	};

	var requestTick = function () {
		if ( ! ticking) {
			window.requestAnimationFrame( update );
			ticking = true;
		}
	};

	var onProcess = function () {
		requestTick();
	};

	// window.addEventListener( 'scroll', onProcess );
	// window.addEventListener( 'resize', onProcess );
	// window.addEventListener( 'load', onProcess );

    function initMetaBar(){
        var entries = document.querySelectorAll('.cs-entry__wrap');

        function setupEntry(toggle, share) {
            var isOverToggle = false;
            var isOverShare = false;
            var openedByClick = false;

            function updateState() {
                if (openedByClick) {
                    return;
                }

                if (isOverToggle || isOverShare) {
                    toggle.classList.add('is-active');
                    share.classList.add('visible');
                } else {
                    toggle.classList.remove('is-active');
                    share.classList.remove('visible');
                }
            }

            toggle.addEventListener('mouseenter', function () {
                isOverToggle = true;
                updateState();
            });

            toggle.addEventListener('mouseleave', function () {
                isOverToggle = false;
                setTimeout(updateState, 100);
            });

            share.addEventListener('mouseenter', function () {
                isOverShare = true;
                updateState();
            });

            share.addEventListener('mouseleave', function () {
                isOverShare = false;
                setTimeout(updateState, 100);
            });

            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                var isVisible = share.classList.contains('visible');
                openedByClick = !isVisible;

                if (isVisible) {
                    toggle.classList.remove('is-active');
                    share.classList.remove('visible');
                } else {
                    toggle.classList.add('is-active');
                    share.classList.add('visible');
                }
            });

            document.addEventListener('click', function (e) {
                if (!toggle.contains(e.target) && !share.contains(e.target)) {
                    toggle.classList.remove('is-active');
                    share.classList.remove('visible');
                    openedByClick = false;
                }
            });
        }

        for (var i = 0; i < entries.length; i++) {
            var entry = entries[i];
            var toggle = entry.querySelector('.cs-entry__metabar-toggle');
            var share = entry.querySelector('.cs-share');
            if (!toggle || !share) {
                continue;
            }

            // Individual state for this entry
            setupEntry(toggle, share);
        }
    }

    window.addEventListener( 'scroll', initMetaBar );
    window.addEventListener( 'resize', initMetaBar );
    window.addEventListener( 'load', initMetaBar );

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Navigation */

class CscoNavigation {
	constructor() {
		this.headerParams = {
			headerLargeHeight: parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-initial-height')),
			headerCompactHeight: parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-height')),
			headerSmart: document.querySelector('.cs-navbar-smart-enabled .cs-header, .cs-navbar-sticky-enabled .cs-header'),
			wpAdminBar: document.querySelector('#wpadminbar'),
			headerBefore: document.querySelector('.cs-header-before'),
			headerStretch: document.querySelector('.cs-navbar-smart-enabled .cs-header-stretch'),
			wpAdminBarHeight: null,
			smartStart: null,
			scrollPoint: 200,
			scrollPrev: 200,
			scrollUpAmount: 0,
			headerSmartPosition: 0
		};

		this.initialize();
	}

	initialize() {
		if (document.body.classList.contains('wp-admin')) {
			return;
		}
		this.bindEvents();
	}

	bindEvents() {
		document.addEventListener('DOMContentLoaded', () => {
			this.smartLevels();
			this.adaptTablet();
			this.stickyScroll();
			this.headerClassesChange();
            this.onHover();
		});

		window.addEventListener('resize', () => {
			this.smartLevels();
			this.adaptTablet();
			this.stickyScroll();
		});
	}

	smartLevels() {
		let windowWidth = window.innerWidth;

		// Reset Calc.
		document.querySelectorAll('.cs-header__nav-inner li').forEach(el => {
			el.classList.remove('cs-sm__level', 'cs-sm-position-left', 'cs-sm-position-right');
		});
		document.querySelectorAll('.cs-header__nav-inner li .sub-menu').forEach(el => {
			el.classList.remove('cs-mm__position-init');
		});

		// Set Settings.
		document.querySelectorAll('.cs-header__nav-inner > li.menu-item:not(.cs-mm)').forEach(parent => {
			let position = 'cs-sm-position-right'; //default
			let objPrevWidth = 0;

			parent.querySelectorAll('.sub-menu').forEach(el => {
				// Reset child levels.
				if (el.parentElement.nextElementSibling) {
					el.parentElement.nextElementSibling.classList.add('cs-sm__level');
				}

				if (el.parentElement.classList.contains('cs-sm__level')) {
					el.parentElement.classList.remove('cs-mm-level');
					position = 'cs-sm-position-right'; //reset
					objPrevWidth = 0;
				}

				// Find out position items.
				let offset = el.getBoundingClientRect().left;

				if (position === 'cs-sm-position-right' && el.offsetWidth + offset > windowWidth) {
					position = 'cs-sm-position-left';
				}

				if (position === 'cs-sm-position-left' && offset - (el.offsetWidth + objPrevWidth) < 0) {
					position = 'cs-sm-position-right';
				}

				objPrevWidth = el.offsetWidth;

				el.classList.add('cs-sm-position-init');
				el.parentElement.classList.add(position);
			});
		});
	}

	adaptTablet() {
		// Click outside.
		document.addEventListener('touchstart', (e) => {
			if (!e.target.closest('.cs-header__nav-inner')) {
				document.querySelectorAll('.cs-header__nav-inner .menu-item-has-children').forEach(el => {
					el.classList.remove('submenu-visible');
				});
			} else {
				let parentMenuItem = e.target.closest('.menu-item');
				if (parentMenuItem) {
					if (parentMenuItem.previousElementSibling) {
						parentMenuItem.previousElementSibling.querySelectorAll('.menu-item').forEach(el => {
							el.classList.remove('submenu-visible');
						});
					}
					if (parentMenuItem.nextElementSibling) {
						parentMenuItem.nextElementSibling.classList.remove('submenu-visible');
					}
				}
			}
		});

		document.querySelectorAll('.cs-header__nav-inner .menu-item-has-children').forEach(el => {
			// Reset class.
			el.classList.remove('submenu-visible');

			// Remove expanded if exists.
			let expandedElem = el.querySelector('a > .expanded');
			if (expandedElem) {
				expandedElem.remove();
			}

			// Add a caret.
			if ('ontouchstart' in document.documentElement) {
				let aTag = el.querySelector('a');
				if (aTag) {
					let span = document.createElement('span');
					span.className = 'expanded';
					aTag.appendChild(span);
				}
			}

			// Check touch device.
			if ('ontouchstart' in document.documentElement) {
				el.classList.add('touch-device');
			}

			let expandedElement = el.querySelector('a .expanded');
			if (expandedElement) {
				expandedElement.addEventListener('touchstart', (e) => {
					e.preventDefault();
					el.classList.toggle('submenu-visible');
				}, { passive: false });
			}

			let anchor = el.querySelector('a');
			if (anchor && anchor.getAttribute('href') === '#') {
				anchor.addEventListener('touchstart', (e) => {
					e.preventDefault();
					if (!e.target.classList.contains('expanded')) {
						el.classList.toggle('submenu-visible');
					}
				}, { passive: false });
			}
		});
	}

	stickyScroll() {
		this.headerParams = {
			headerLargeHeight: parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-initial-height')),
			headerCompactHeight: parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-height')),
			headerSmart: document.querySelector('.cs-navbar-smart-enabled .cs-header, .cs-navbar-sticky-enabled .cs-header'),
			wpAdminBar: document.querySelector('#wpadminbar'),
			headerBefore: document.querySelector('.cs-header-before'),
			headerStretch: document.querySelector('.cs-navbar-smart-enabled .cs-header-stretch'),
			wpAdminBarHeight: null,
			smartStart: null,
			scrollPoint: 200,
			scrollPrev: 200,
			scrollUpAmount: 0,
			headerSmartPosition: 0
		};

		this.headerParams.wpAdminBarHeight = this.headerParams.wpAdminBar ? this.headerParams.wpAdminBar.offsetHeight : 0;

		if (this.headerParams.headerBefore) {
			this.headerParams.smartStart = this.headerParams.headerBefore.offsetTop;
		} else {
			this.headerParams.smartStart = this.headerParams.wpAdminBarHeight + (this.headerParams.headerSmart ? this.headerParams.headerSmart.offsetTop : 0);
		}

		window.addEventListener('scroll', () => {
			let scrolled = window.scrollY;
			this.headerParams.headerSmartPosition = this.headerParams.headerSmart ? this.headerParams.headerSmart.offsetTop : 0;

			if (scrolled > this.headerParams.smartStart + this.headerParams.scrollPoint + 10 && scrolled > this.headerParams.scrollPrev) {
				if (scrolled > this.headerParams.smartStart + this.headerParams.headerCompactHeight + 200) {
					document.dispatchEvent(new Event('sticky-nav-hide'));
				}
			} else {
				if (this.headerParams.scrollUpAmount >= this.headerParams.scrollPoint || scrolled === 0) {
					document.dispatchEvent(new Event('sticky-nav-visible'));
				}
			}

			if ( this.headerParams.headerSmart ) {
				if ( scrolled > this.headerParams.smartStart + this.headerParams.headerCompactHeight ) {

					document.dispatchEvent(new Event('nav-stick', { detail: this.headerParams }));

				} else if ( this.headerParams.headerSmartPosition <= this.headerParams.smartStart ) {
					document.dispatchEvent(new Event('nav-unstick', { detail: this.headerParams }));
				}
			}

			if (scrolled < this.headerParams.scrollPrev) {
				this.headerParams.scrollUpAmount += this.headerParams.scrollPrev - scrolled;
			} else {
				this.headerParams.scrollUpAmount = 0;
			}

			if (this.headerParams.wpAdminBar && window.innerWidth <= 600 && scrolled >= this.headerParams.wpAdminBarHeight) {
				document.dispatchEvent(new Event('adminbar-mobile-scrolled'));
			} else {
				document.dispatchEvent(new Event('adminbar-mobile-no-scrolled'));
			}

			this.headerParams.scrollPrev = scrolled;
		});
	}

	headerClassesChange() {
		document.addEventListener("sticky-nav-visible", event => {
			this.headerParams.headerSmart.classList.add('cs-header-smart-visible');
		});

		document.addEventListener("sticky-nav-hide", event => {
			this.headerParams.headerSmart.classList.remove('cs-header-smart-visible');
		});

		document.addEventListener("nav-stick", event => {
			this.headerParams.headerSmart.classList.add('cs-scroll-sticky');
		});

		document.addEventListener("nav-unstick", event => {
			this.headerParams.headerSmart.classList.remove('cs-scroll-sticky', 'cs-header-smart-visible');
		});

		document.addEventListener("adminbar-mobile-scrolled", event => {
			document.body.classList.add('cs-adminbar-mobile-scrolled');
		});

		document.addEventListener("adminbar-mobile-no-scrolled", event => {
			document.body.classList.remove('cs-adminbar-mobile-scrolled');
		});
	}

    onHover() {
        document.querySelectorAll('.cs-header__nav-inner > li').forEach(el => {
            el.addEventListener('mouseenter', () => {
                el.classList.add('active-menu');
            });

            el.addEventListener('mouseleave', () => {
                el.classList.remove('active-menu');
            });
        });
    }
}

new CscoNavigation();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Offcanvas */

(function () {
	const body = document.body;
	const headerElement = document.querySelector('.cs-header');
	const offcanvasToggles = document.querySelectorAll('.cs-header__offcanvas-toggle, .cs-site-overlay, .cs-offcanvas__close-toggle');

	offcanvasToggles.forEach(offcanvasToggle => {
		offcanvasToggle.addEventListener('click', function (e) {
			e.preventDefault();

			if (headerElement.classList.contains('cs-search-visible')) {
				headerElement.classList.remove('cs-search-visible');
				body.classList.remove('cs-search-active');
			}

			if (headerElement.classList.contains('cs-burger-visible')) {
				headerElement.classList.remove('cs-burger-visible');
				body.classList.remove('cs-burger-active');
			}

			if (!body.classList.contains('cs-offcanvas-active')) {
				body.classList.add('cs-offcanvas-transition');
			} else {
				setTimeout(() => {
					body.classList.remove('cs-offcanvas-transition');
				}, 400);
			}

			body.classList.toggle('cs-offcanvas-active');
		});
	});

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Posts Slider */



(function () {

    const section = 'cs-widget-post-slider';

    const initSection = function () {
        const sliders = document.querySelectorAll(`.${section}__slider`);

        if (sliders.length === 0) {
            return;
        }

        const loadSwiperScript = new Promise(
            (resolve, reject) => {
                if (window.Swiper) {
                    resolve();
                    return;
                }
                const head = document.getElementsByTagName('head')[0];
                const script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js';
                script.onload = resolve;
                script.onerror = reject;
                head.appendChild(script);
            }
        );

        loadSwiperScript.then(
            () => {
                sliders.forEach(
                    slider => {

                        if (slider.dataset.initialized === 'true') {
                            return;
                        }

                        if (!(0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.isInViewport)(slider)) {
                            return;
                        }

                        slider.dataset.initialized = 'true';

                        let isMouseOnControl = false;
                        let isMouseOnSlider = false;
                        let isSliderVisible = true;

                        // Section data
                        const autoplayValue = slider.getAttribute('data-cs-autoplay');
                        const autoplayDelayValue = slider.getAttribute('data-cs-autoplay-delay');
                        const postContentContainer = '.cs-entry__content';
                        // Swiper settings
                        const wrapperClass = `${section}__wrapper`;
                        const slideClass = `${section}__item`;
                        const prevEl = slider.querySelector(`.${section}__button-prev`);
                        const nextEl = slider.querySelector(`.${section}__button-next`);
                        let paginationContainer = slider.querySelector(`.${section}__pagination`);
                        const bulletClass = `${section}__pagination-bullet`;
                        const bulletClassActive = `${section}__pagination-bullet-active`;
                        const autoplayDelay = !isNaN(parseInt(autoplayDelayValue)) ? parseInt(autoplayDelayValue) : 5000;
                        const autoplay = autoplayValue ? {
                            delay: autoplayDelay,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                        } : false;
                        const postContents = slider.querySelectorAll( postContentContainer );

                        const swiper = new Swiper(
                            slider,
                            {
                                scrollbar: false,
                                wrapperClass: wrapperClass,
                                slideClass: slideClass,
                                direction: 'horizontal',
                                loop: true,
                                speed: 800,
                                parallax: false,
                                autoplay: autoplay,
                                a11y: {
                                    slideRole: 'article',
                                    slideLabelMessage: 'Slide {{index}} of {{slidesLength}}'
                                },
                                pagination: {
                                    el: paginationContainer,
                                    clickable: true,
                                    bulletElement: 'span',
                                    bulletClass: bulletClass,
                                    bulletActiveClass: bulletClassActive,
                                    renderBullet: function (index, className) {
                                        return `<span class="${className}"><span class="inner-span"></span></span>`;
                                    }
                                },
                                navigation: {
                                    nextEl: nextEl,
                                    prevEl: prevEl,
                                },
                                slidesPerView: 1,
                                on: {
                                    init: function () {
                                        setTimeout(
                                            () => {
                                                const initialSlide = this.slides[this.activeIndex];
                                                if (initialSlide) {
                                                    const initialContent = initialSlide.querySelector( postContentContainer );
                                                    if (initialContent) {
                                                        initialContent.style.transform = 'none';
                                                    }
                                                }
                                            },
                                            100
                                        );
                                    },
                                    slideChange: function () {
                                        const currentSlide = this.slides[this.activeIndex];

                                        postContents.forEach(
                                            postContent => {
                                                if (postContent === currentSlide.querySelector( postContentContainer )) {
                                                    postContent.style.transform = 'none';
                                                }
                                            }
                                        );
                                    }
                                }
                            }
                        );

                        if (autoplayValue) {
                            const controls = [nextEl, prevEl, paginationContainer];

                            controls.forEach(control => {
                                if (control) {
                                    control.addEventListener('mouseenter', () => {
                                        swiper.autoplay.stop();
                                        swiper.el.classList.add('swiper-paused');

                                        isMouseOnControl = true; // Track if mouse is on a control

                                        // Pause button animation
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "paused";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "paused";
                                        }
                                    });

                                    control.addEventListener('mouseleave', () => {
                                        isMouseOnControl = false; // Mouse is no longer on a control

                                        // Resume autoplay and remove 'swiper-paused' class if mouse is not on the slider
                                        if (!isMouseOnSlider && isSliderVisible) {
                                            swiper.autoplay.start();
                                            swiper.el.classList.remove('swiper-paused');
                                        }

                                        // Resume button animation
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "running";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "running";
                                        }
                                    });

                                    control.addEventListener('click', () => {
                                        swiper.autoplay.stop();
                                        swiper.el.classList.add('swiper-paused');

                                        // Pause button animation on click
                                        if (nextEl) {
                                            nextEl.style.animationPlayState = "paused";
                                        }
                                        if (prevEl) {
                                            prevEl.style.animationPlayState = "paused";
                                        }
                                    });
                                }
                            });

                            slider.addEventListener('mouseenter', () => {
                                isMouseOnSlider = true;
                                swiper.autoplay.stop();
                                swiper.el.classList.add('swiper-paused');
                            });

                            slider.addEventListener('mouseleave', () => {
                                isMouseOnSlider = false;

                                if (!isMouseOnControl && isSliderVisible) {
                                    swiper.autoplay.start();
                                    swiper.el.classList.remove('swiper-paused');
                                }
                            });

                            const observer = new IntersectionObserver(
                                (entries) => {
                                    entries.forEach(entry => {
                                        if (entry.isIntersecting) {
                                            isSliderVisible = true;
                                            if (!isMouseOnControl && !isMouseOnSlider) {
                                                swiper.autoplay.start();
                                                swiper.el.classList.remove('swiper-paused');
                                            }
                                        } else {
                                            isSliderVisible = false;
                                            swiper.autoplay.stop();
                                            swiper.el.classList.add('swiper-paused');
                                        }
                                    });
                                },
                                { threshold: 0.50 }
                            );

                            observer.observe(slider);
                        }
                    }
                );

            });
    };

    document.addEventListener(
        'DOMContentLoaded',
        () => {
            initSection();
        }
    );

    window.addEventListener(
        'resize',
        () => {
            initSection();
        }
    );

    window.addEventListener(
        'scroll',
        () => {
            initSection();
        }
    );

    document.body.addEventListener(
        'post-load',
        () => {
            initSection();
        }
    );

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Responsive Embeds */

(function () {
	/**
	 * Add max-width & max-height to <iframe> elements, depending on their width & height props.
	 */
	function initResponsiveEmbeds() {
		let proportion, parentWidth;
		let iframes = document.querySelectorAll('.entry-content iframe');

		// Loop through iframe elements.
		iframes.forEach(iframe => {
			// Don't handle if the parent automatically resizes itself.
			if (iframe.closest('div[data-video-start], div[data-video-end]')) {
				return;
			}
			// Only continue if the iframe has a width & height defined.
			if (iframe.width && iframe.height) {
				// Calculate the proportion/ratio based on the width & height.
				proportion = parseFloat(iframe.width) / parseFloat(iframe.height);
				// Get the parent element's width.
				parentWidth = parseFloat(window.getComputedStyle(iframe.parentElement).width);
				// Set the max-width & height.
				iframe.style.maxWidth = '100%';
				iframe.style.maxHeight = Math.round(parentWidth / proportion) + 'px';
			}
		});
	}

	// Document ready.
	document.addEventListener('DOMContentLoaded', function () {
		initResponsiveEmbeds();
	});

	// Post load. This assumes you have an event "post-load" being dispatched on the body element.
	document.body.addEventListener('post-load', function () {
		initResponsiveEmbeds();
	});

	// Window resize.
	window.addEventListener('resize', function () {
		initResponsiveEmbeds();
	});

	// Run on initial load.
	initResponsiveEmbeds();

})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
/** ----------------------------------------------------------------------------
 * Color Scheme Toogle */



const cscoDarkMode = {
	init: function () {
		this.initMode();

		window.matchMedia('(prefers-color-scheme: dark)').addListener((e) => {
			this.initMode();
		});

		document.querySelectorAll('.cs-site-scheme-toggle').forEach(toggle => {
			toggle.onclick = () => {
				let siteScheme = document.body.getAttribute('data-scheme');

				if ('dark' === siteScheme) {
					this.changeScheme('light', true);
				} else if ( 'light' === siteScheme ) {
					this.changeScheme('dark', true);
				} else if ( 'auto' === siteScheme ) {
					const systemDark = window.matchMedia( '(prefers-color-scheme: dark)' ).matches;
					if (systemDark) {
						this.changeScheme('light', true);
					} else {
						this.changeScheme('dark', true);
					}
				}
			};
		});
	},

	detectColorScheme: function (color) {
		var level = 190;
		var alpha = 1;
		var rgba = [255, 255, 255];
		var color_rgba = false;

		color = color.trim();

		// Excludes.
		if ( ['#0e131a'].includes( color ) ) {
			return 'dark';
		}

		if ('#' === color[0]) {
			color = color.replace('#', '').trim();

			if (3 === color.length) {
				color = color[0] + color[0] + color[1] + color[1] + color[2] + color[2];
			}

			rgba[0] = parseInt(color.substr(0, 2), 16);
			rgba[1] = parseInt(color.substr(2, 2), 16);
			rgba[2] = parseInt(color.substr(4, 2), 16);
		} else if ((color_rgba = color.replace(/\s/g, '').match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i))) {
			rgba[0] = parseInt(color_rgba[1]);
			rgba[1] = parseInt(color_rgba[2]);
			rgba[2] = parseInt(color_rgba[3]);

			if (color_rgba[4] !== undefined) {
				alpha = parseFloat(color_rgba[4]);
			}
		}

		rgba.forEach(function myFunction(channel, key, stack) {
			stack[key] = String(channel + Math.ceil((255 - channel) * (1 - alpha))).padStart(2, '0');
		});

		var scheme = 'light';

		var brightness = ((rgba[0] * 299) + (rgba[1] * 587) + (rgba[2] * 114)) / 1000;

		if (rgba[0] === rgba[1] && rgba[1] === rgba[2]) {
			if (brightness < level) {
				scheme = 'dark';
			}
		} else {
			if (brightness < level) {
				scheme = 'inverse';
			}
		}

		return scheme;
	},

	setIndividualScheme: function () {
		var list = {
			'.cs-header': '--cs-header-background',
			'.cs-header__nav-inner .sub-menu': '--cs-header-submenu-background',
			'.cs-burger-menu': '--cs-header-submenu-background',
			'.cs-floating-header' : '--cs-header-submenu-background',
			'.cs-header-topbar__top': '--cs-header-topbar-background',
			'.cs-offcanvas': '--cs-offcanvas-background',
			'.cs-footer': '--cs-footer-background',
		};

		function createClosure(key) {
			return function (element) {
				var color = getComputedStyle(element).getPropertyValue(list[key]);
				var scheme = cscoDarkMode.detectColorScheme(color);
				element.setAttribute('data-scheme', scheme);
			};
		}

		for (var key in list) {
			if (list.hasOwnProperty(key)) {
				var elements = document.querySelectorAll(key);

				if (elements.length <= 0) {
					continue;
				}

				elements.forEach(createClosure(key));
			}
		}
	},

	initMode: function () {
		let siteScheme = false;

		switch (csLocalize.siteSchemeMode) {
			case 'dark':
				siteScheme = 'dark';
				break;
			case 'light':
				siteScheme = 'light';
				break;
			case 'system':
				siteScheme = 'auto';
				break;
		}

		if (csLocalize.siteSchemeToogle) {
			if ('light' === (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.csGetCookie)('_color_schema')) {
				siteScheme = 'light';
			}
			if ('dark' === (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.csGetCookie)('_color_schema')) {
				siteScheme = 'dark';
			}
		}

		this.setIndividualScheme();

		if (siteScheme && siteScheme !== document.body.getAttribute('data-scheme')) {
			this.changeScheme(siteScheme, false);
		}
	},

	changeScheme: function (siteScheme, cookie) {
		document.body.classList.add('cs-scheme-toggled');
		document.body.setAttribute('data-scheme', siteScheme);

		this.setIndividualScheme();

		if (cookie) {
			(0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.csSetCookie)('_color_schema', siteScheme, { expires: 2592000 });
		}

		setTimeout(() => {
			document.body.classList.remove('cs-scheme-toggled');
		}, 100);
	}
};

cscoDarkMode.init();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Scroll to top */

( function() {

	const section = 'cs-scroll-top';
	const activeClass = 'is-active';
	const offset = 300;

	const scrollToTop = () => {
		window.scrollTo({ top: 0, behavior: 'smooth' });
	};

	const scrollToTopButton = document.querySelector(`.${section}`);

	if (scrollToTopButton) {
		scrollToTopButton.addEventListener('click', scrollToTop);

		window.addEventListener('scroll', () => {

			const scrollPos = window.scrollY || window.scrollTop || document.getElementsByTagName('html')[0].scrollTop;
			if (scrollPos > offset) {
				scrollToTopButton.classList.add(activeClass);
			} else {
				scrollToTopButton.classList.remove(activeClass);
			}
		});
	}

} )();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Metabar Share copy link */



(function () {
	function copyToClipboard(str) {
		const area = document.createElement( 'textarea' );
		document.body.appendChild( area );
		area.value = str;
		area.select();
		document.execCommand( 'copy' );
		document.body.removeChild( area );
	}

	function showTooltip(button, message) {
		const tooltip       = document.createElement( 'div' );
		tooltip.className   = 'cs-share__copy-link-tooltip';
		tooltip.textContent = message;
		button.appendChild( tooltip );

		setTimeout(
			() => {
				tooltip.classList.add( 'hide' );
			},
			1500
		);

		setTimeout(
			() => {
				button.removeChild( tooltip );
			},
			2000
		);
	}

	document.addEventListener(
		'click',
		function (event) {
			const button = event.target.closest( '.cs-share__copy-link' );
			if ( ! button) {
				return;
			}

			event.preventDefault();

			const pageURL = button.getAttribute( 'href' );
			copyToClipboard( pageURL );

			showTooltip( button, csLocalize.shareCopiedText );
		}
	);
})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/** ----------------------------------------------------------------------------
 * Sticky Sidebar */

(function() {
    let stickyElementsSmart = [],
        stickyElements = [];

    stickyElementsSmart.push(
        '.cs-sticky-sidebar-enabled.cs-navbar-smart-enabled.cs-stick-to-top .cs-sidebar__inner',
        '.cs-sticky-sidebar-enabled.cs-navbar-smart-enabled.cs-stick-last .cs-sidebar__inner .widget:last-child'
    );

    stickyElements.push(
        '.cs-sticky-sidebar-enabled.cs-navbar-sticky-enabled.cs-stick-to-top .cs-sidebar__inner',
        '.cs-sticky-sidebar-enabled.cs-navbar-sticky-enabled.cs-stick-last .cs-sidebar__inner .widget:last-child'
    );

    document.addEventListener("DOMContentLoaded", function() {
        let headerStick = document.querySelector('.cs-header'),
            wpAdminBar = document.querySelector('#wpadminbar'),
            floatingHeader = document.querySelector('.cs-floating-header__content'),
            headerStickHeight = headerStick ? headerStick.offsetHeight : 0,
            wpAdminBarHeight = wpAdminBar ? wpAdminBar.offsetHeight : 0,
            floatingHeaderHeight = floatingHeader ? floatingHeader.offsetHeight + 2 : 0,
            headerStretch = document.querySelector('.cs-header-stretch'),
            headerStretchHeight = headerStretch ? headerStretch.offsetHeight : 0,
            allHeight = headerStickHeight + wpAdminBarHeight + floatingHeaderHeight + 20,
            windowWidth = window.innerWidth;

        if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
            stickyElementsSmart.push('.cs-sticky-sidebar-enabled.cs-stick-to-bottom .cs-sidebar__inner');
            stickyElements.push('.cs-sticky-sidebar-enabled.cs-stick-to-bottom .cs-sidebar__inner');
        }

        stickyElementsSmart = stickyElementsSmart.join(',');
        stickyElements = stickyElements.join(',');

        document.addEventListener('sticky-nav-visible', function() {
            headerStickHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-height'));
            allHeight = (headerStretchHeight || 0) + (wpAdminBarHeight || 0) + (floatingHeaderHeight || 0) + 20;

            document.querySelectorAll(stickyElementsSmart).forEach(el => {
                el.style.top = allHeight + 'px';
            });
        });

        document.addEventListener('sticky-nav-hide', function() {
            headerStickHeight = 0;
            allHeight = (headerStickHeight || 0) + (wpAdminBarHeight || 0) + (floatingHeaderHeight || 0) + 20;

            document.querySelectorAll(stickyElementsSmart).forEach(el => {
                el.style.top = allHeight + 'px';
            });
        });

        document.addEventListener('stretch-nav-to-small', function() {
            headerStretchHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-height'));
            allHeight = (headerStretchHeight || 0) + (wpAdminBarHeight || 0) + (floatingHeaderHeight || 0) + 20;

            if (headerStretch && headerStretch.classList.contains("cs-scroll-sticky") && !headerStretch.classList.contains("cs-scroll-active")) {
                document.querySelectorAll(stickyElementsSmart).forEach(el => {
                    el.style.top = allHeight + 'px';
                });
            }
        });

        document.addEventListener('stretch-nav-to-big', function() {
            headerStretchHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--cs-header-initial-height'));
        });

        if (document.body.classList.contains('cs-navbar-smart-enabled') && windowWidth >= 1020) {
            allHeight = (headerStretchHeight || 0) + (wpAdminBarHeight || 0) + (floatingHeaderHeight || 0) + 20;

            document.querySelectorAll(stickyElementsSmart).forEach(el => {
                el.style.top = allHeight + 'px';
            });
        } else if (document.body.classList.contains('cs-navbar-sticky-enabled') && windowWidth >= 1020) {
            allHeight = (headerStretchHeight || 0) + (wpAdminBarHeight || 0) + (floatingHeaderHeight || 0) + 20;

            document.querySelectorAll(stickyElements).forEach(el => {
                el.style.top = allHeight + 'px';
            });
        }

        window.addEventListener('resize', function() {
            let windowWidthResize = window.innerWidth;
            if (windowWidthResize < 1020) {
                document.querySelectorAll(stickyElements).forEach(el => {
                    el.removeAttribute('style');
                });
                document.querySelectorAll(stickyElementsSmart).forEach(el => {
                    el.removeAttribute('style');
                });
            }
        });
    });
})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
var __webpack_exports__ = {};
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);


(function () {
	var initAPI = {
		youtube: false,
	};
	var process = false;
	var contex = [];
	var players = {
		youtube: [],
		self: []
	};
	var attrs = [];

	// Create deferred objects for APIs
	var YTdeferred = new Promise(function (resolve) {
		window.onYouTubePlayerAPIReady = function () {
			resolve(window.YT);
		};
	});

	// Embed YouTube API
	function embedYoutubeAPI() {
		var tag = document.createElement('script');
		tag.src = 'https://www.youtube.com/iframe_api';
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		initAPI.youtube = true;
	}

	// Rescale video background based on container size
	function rescaleVideoBackground() {
		document.querySelectorAll('.cs-video-init').forEach(function (el) {
			var w = el.parentElement.offsetWidth;
			var h = el.parentElement.offsetHeight;
			var hideControl = 400;
			var id = el.getAttribute('data-uid');
			var provider = el.getAttribute('data-provider');

			if (provider === 'youtube') {
				if (w / h > 16 / 9) {
					players.youtube[id].setSize(w, w / 16 * 9 + hideControl);
				} else {
					players.youtube[id].setSize(h / 9 * 16, h + hideControl);
				}
			} else if (provider === 'self') {
				var video = el.querySelector('video');
				if (video) {
					if (w / h > video.videoWidth / video.videoHeight) {
						video.style.width = '100%';
						video.style.height = 'auto';
					} else {
						video.style.width = 'auto';
						video.style.height = '100%';
					}
				}
			}
		});
	}

	// Initialize self-hosted video
	function initSelfHostedVideo(container) {
		var id = Math.random().toString(36).substr(2, 9);
		container.classList.add('cs-video-init');
		container.setAttribute('data-uid', id);
		container.setAttribute('data-provider', 'self');

		var video = container.querySelector('video');
		if (!video) {
			return null;
		}

		var wrapper = container.closest('.cs-video-wrapper');
		var videoStart = parseFloat(wrapper.dataset.videoStart) || 0;
		var videoEnd = parseFloat(wrapper.dataset.videoEnd) || video.duration;

		players.self[id] = {
			playVideo: function() {
				if (video.currentTime < videoStart || video.currentTime >= videoEnd) {
					video.currentTime = videoStart;
				}
				video.play().catch(function(error) {
					console.error('Error playing self-hosted video:', error);
				});
			},
			pauseVideo: function() {
				video.pause();
			},
			mute: function() {
				video.muted = true;
			},
			unMute: function() {
				video.muted = false;
			},
			seekTo: function(time) {
				video.currentTime = time;
			}
		};

		video.addEventListener('timeupdate', function() {
			if (video.currentTime >= videoEnd) {
				video.currentTime = videoStart;
				video.play();
			}
		});

		video.addEventListener('loadeddata', function() {
			video.currentTime = videoStart;
			players.self[id].playVideo();
		});

		video.addEventListener('playing', function() {
			container.classList.add('active');
			var parentElement = container.closest('.cs-overlay, .cs-video-wrap');
			if (parentElement) {
				parentElement.classList.add('cs-video-bg-init');
			}
		});

		contex[id] = container;
		return id;
	}

	// Initialize video background
	function initVideoBackground() {
		if (document.body.classList.contains('wp-admin')) {
			return;
		}

		if (process) {
			return;
		}

		process = true;

		var youtubeElements = document.querySelectorAll('.cs-video-wrapper[data-video-provider="youtube"]');
		var selfElements = document.querySelectorAll('.cs-video-wrapper[data-video-provider="self"]');

		if (!initAPI.youtube && youtubeElements.length) {
			embedYoutubeAPI();
		}

		// Process YouTube videos
		if (youtubeElements.length) {
			YTdeferred.then(function (YT) {
				youtubeElements.forEach(function (wrapper) {
					var container = wrapper.querySelector('.cs-video-inner');
					if (!container) {
						return;
					}

					var isInit = container.classList.contains('cs-video-init');
					var id = !isInit ? Math.random().toString(36).substr(2, 9) : container.getAttribute('data-uid');

					contex[id] = container;
					var isActive = contex[id].classList.contains('active');
					var isInView = (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.isInViewport)(contex[id]);

					if (isInView && !isInit) {
						contex[id].classList.add('cs-video-init');
						contex[id].setAttribute('data-uid', id);
						contex[id].setAttribute('data-provider', 'youtube');

						var videoID = wrapper.dataset.videoId;
						var videoStart = parseFloat(wrapper.dataset.videoStart) || 0;
						var videoEnd = parseFloat(wrapper.dataset.videoEnd) || 0;

						if (typeof videoID === 'undefined' || !videoID) {
							return;
						}

						attrs[id] = {
							'videoId': videoID,
							'startSeconds': videoStart,
							'endSeconds': videoEnd,
							'suggestedQuality': 'hd720'
						};

						players.youtube[id] = new YT.Player(contex[id], {
							playerVars: {
								autoplay: 0,
								autohide: 1,
								modestbranding: 1,
								rel: 0,
								showinfo: 0,
								controls: 0,
								disablekb: 1,
								enablejsapi: 0,
								iv_load_policy: 3,
								playsinline: 1,
								loop: 1
							},
							events: {
								'onReady': function () {
									players.youtube[id].loadVideoById(attrs[id]);
									players.youtube[id].mute();
								},
								'onStateChange': function (e) {
									if (e.data === 1) {
										var parentElement = contex[id].closest('.cs-overlay, .cs-video-wrap');
										if (parentElement) {
											parentElement.classList.add('cs-video-bg-init');
										}
										contex[id].classList.add('active');
									} else if (e.data === 0) {
										players.youtube[id].seekTo(attrs[id].startSeconds);
									}
								}
							}
						});
						rescaleVideoBackground();
					}

					var parentElement = contex[id].closest('.cs-overlay, .cs-video-wrap');
					if (isActive && isInit && parentElement.querySelector('.cs-player-state') &&
						!parentElement.querySelector('.cs-player-state').classList.contains('cs-player-upause')) {
						var control = parentElement.querySelector('.cs-player-state');

						if (control) {
							if (isInView && control.classList.contains('cs-player-play')) {
								control.classList.remove('cs-player-play');
								control.classList.add('cs-player-pause');
								players.youtube[id].playVideo();
							}

							if (!isInView && control.classList.contains('cs-player-pause')) {
								control.classList.remove('cs-player-pause');
								control.classList.add('cs-player-play');
								players.youtube[id].pauseVideo();
							}
						}
					}
				});
			});
		}

		// Process self-hosted videos
		if (selfElements.length) {
			selfElements.forEach(function (wrapper) {
				var container = wrapper.querySelector('.cs-video-inner');
				if (!container) {
					return;
				}

				var isInit = container.classList.contains('cs-video-init');
				var isInView = (0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.isInViewport)(container);

				if (isInView && !isInit) {
					var videoID = wrapper.dataset.videoId;
					if (typeof videoID === 'undefined' || !videoID) {
						return;
					}

					var selfId = initSelfHostedVideo(container);
					if (selfId) {
						rescaleVideoBackground();
						players.self[selfId].playVideo();
					}
				} else if (isInit) {
					var videoId = container.getAttribute('data-uid');
					var isActive = container.classList.contains('active');
					var parentElement = container.closest('.cs-overlay, .cs-video-wrap');

					if (isActive && parentElement.querySelector('.cs-player-state') &&
						!parentElement.querySelector('.cs-player-state').classList.contains('cs-player-upause')) {
						var control = parentElement.querySelector('.cs-player-state');

						if (control && players.self[videoId]) {
							if (isInView && control.classList.contains('cs-player-play')) {
								control.classList.remove('cs-player-play');
								control.classList.add('cs-player-pause');
								players.self[videoId].playVideo();
							}

							if (!isInView && control.classList.contains('cs-player-pause')) {
								control.classList.remove('cs-player-pause');
								control.classList.add('cs-player-play');
								players.self[videoId].pauseVideo();
							}
						}
					}
				}
			});
		}

		process = false;
	}

	// Get player instance by provider and ID
	function getPlayer(container) {
		if (!container) {
			return null;
		}

		var id = container.getAttribute('data-uid');
		var provider = container.getAttribute('data-provider');

		if (!id || !provider) {
			return null;
		}

		return players[provider][id];
	}

	// Play/Pause control
	document.addEventListener('click', function (event) {
		if (event.target.classList.contains('cs-player-state')) {
			var container = event.target.closest('.cs-overlay, .cs-video-wrap').querySelector('.cs-video-inner');
			var player = getPlayer(container);

			if (!player) {
				return;
			}

			event.target.classList.toggle('cs-player-pause');
			event.target.classList.toggle('cs-player-play');

			if (event.target.classList.contains('cs-player-pause')) {
				event.target.classList.remove('cs-player-upause');
				player.playVideo();
			} else {
				event.target.classList.add('cs-player-upause');
				player.pauseVideo();
			}
		}
	});

	// Stop control
	document.addEventListener('click', function (event) {
		if (event.target.classList.contains('cs-player-stop')) {
			var container = event.target.closest('.cs-overlay, .cs-video-wrap').querySelector('.cs-video-inner');
			var player = getPlayer(container);

			if (!player) {
				return;
			}

			var stateControl = event.target.closest('.cs-video-controls').querySelector('.cs-player-state');
			if (stateControl) { // Ensure stateControl exists
				stateControl.classList.remove('cs-player-pause');
				stateControl.classList.add('cs-player-play', 'cs-player-upause');
			}

			player.pauseVideo();
		}
	});

	// Volume control
	document.addEventListener('click', function (event) {
		if (event.target.classList.contains('cs-player-volume')) {
			var container = event.target.closest('.cs-overlay, .cs-video-wrap').querySelector('.cs-video-inner');
			var player = getPlayer(container);

			if (!player) {
				return;
			}

			event.target.classList.toggle('cs-player-mute');
			event.target.classList.toggle('cs-player-unmute');

			if (event.target.classList.contains('cs-player-unmute')) {
				player.unMute();
			} else {
				player.mute();
			}

			// Prevent pausing when toggling volume
			event.stopPropagation();
		}
	});

	// Event listeners
	window.addEventListener('load', initVideoBackground);
	window.addEventListener('scroll', initVideoBackground);
	window.addEventListener('resize', initVideoBackground);
	window.addEventListener('scrollstop', initVideoBackground);
	document.addEventListener('DOMContentLoaded', initVideoBackground);
	document.body.addEventListener('post-load', initVideoBackground);
	window.addEventListener('resize', rescaleVideoBackground);

	// Initial call
	initVideoBackground();
})();

})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _utility_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(1);
/** ----------------------------------------------------------------------------
 * Widget Nav Menu */



(function () {

	HTMLElement.prototype.responsiveNav = function () {
		this.classList.remove('menu-item-expanded');
		let previousElement = this.previousElementSibling;

		if (previousElement && previousElement.classList.contains('submenu-visible')) {
			previousElement.classList.remove('submenu-visible');
			(0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(previousElement);
			this.parentElement.classList.remove('menu-item-expanded');
		} else {
			let parentOfParent = this.parentElement.parentElement;

			parentOfParent.querySelectorAll('.menu-item .sub-menu').forEach(subMenu => {
				subMenu.classList.remove('submenu-visible');
				(0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideUp)(subMenu);
			});

			parentOfParent.querySelectorAll('.menu-item-expanded').forEach(item => {
				item.classList.remove('menu-item-expanded');
			});

			if (previousElement) {
				previousElement.classList.toggle('submenu-visible');
				(0,_utility_js__WEBPACK_IMPORTED_MODULE_0__.slideToggle)(previousElement);
			}

			this.parentElement.classList.toggle('menu-item-expanded');
		}
	};

	document.addEventListener('DOMContentLoaded', function () {
		let menuItems = document.querySelectorAll('.widget_nav_menu .menu-item-has-children');

		menuItems.forEach(menuItem => {
			let span = document.createElement('span');
			menuItem.appendChild(span);

			span.addEventListener('click', function (e) {
				e.preventDefault();
				this.responsiveNav();
			});

			let anchor = menuItem.children[0];
			if (anchor && anchor.tagName === 'A' && anchor.getAttribute('href') === '#') {
				anchor.addEventListener('click', function (e) {
					e.preventDefault();
					this.nextElementSibling.nextElementSibling.responsiveNav();
				});
			}
		});
	});

})();

})();

/******/ })()
;