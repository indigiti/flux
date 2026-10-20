"use strict";

function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/**
 * Editor Wrapper
 */

function csEditorWrapper() {
  var Component = wp.element.Component;
  var registerPlugin = wp.plugins.registerPlugin;
  var _wp$data = wp.data,
    select = _wp$data.select,
    subscribe = _wp$data.subscribe;
  var cscoGutenberg = {};
  var cscoIframeContext = {};
  function setIframeContext(key, val) {
    cscoIframeContext[key] = val;
    sessionStorage.setItem('cscoIframeContext', JSON.stringify(cscoIframeContext));
  }
  (function () {
    var $this;
    cscoGutenberg = {
      /*
      * Variables
      */
      wrapper: false,
      content: false,
      template: null,
      singularLayout: null,
      /*
      * Initialize
      */
      init: function init(e) {
        $this = cscoGutenberg;

        // Find wrapper and content elements.
        $this.content = document.querySelector('.block-editor-editor-skeleton__content, .interface-interface-skeleton__content');
        $this.wrapper = document.querySelector('.editor-styles-wrapper');

        // Init events.
        if ('undefined' === typeof window.cscoGutenbergInit) {
          $this.events(e);
          window.cscoGutenbergInit = true;
        }
      },
      /*
      * Events
      */
      events: function events(e) {
        // Update singular layout.
        subscribe(function () {
          var meta = select('core/editor').getEditedPostAttribute('meta');
          if ('object' === _typeof(meta) && meta['csco_singular_sidebar']) {
            var newSingularLayout = meta['csco_singular_sidebar'];
            if (newSingularLayout !== $this.singularLayout) {
              $this.singularLayout = newSingularLayout;
              $this.changeLayout();
            }
          }
        });

        // Update template.
        subscribe(function () {
          var newTemplate = select('core/editor').getEditedPostAttribute('template');
          if (newTemplate !== $this.template) {
            $this.template = newTemplate;
            $this.changeLayout();
          }
        });

        // Update Breakpoints during resize.
        window.addEventListener('resize', function (e) {
          $this.initBreakpoints();
          $this.initChanges();
        });

        // Update Breakpoints.
        var observer = new MutationObserver(function (mutations) {
          mutations.forEach(function (mutation) {
            if (mutation.oldValue !== mutation.target.classList.value) {
              $this.initBreakpoints();
              $this.initChanges();
            }
          });
        });
        observer.observe(document.getElementsByTagName('body')[0], {
          attributes: true,
          subtree: false,
          attributeOldValue: true,
          attributeFilter: ["class"]
        });
        observer.observe(document.getElementsByClassName('edit-post-layout')[0], {
          attributes: true,
          subtree: false,
          attributeOldValue: true,
          attributeFilter: ["class"]
        });
      },
      /*
      * Get page template
      */
      getPageTemplate: function getPageTemplate() {
        return select('core/editor').getEditedPostAttribute('template');
      },
      /*
      * Initialize changes
      */
      initChanges: function initChanges() {
        setTimeout(function () {
          document.body.dispatchEvent(new Event('editor-render'));
        }, 200);
      },
      /*
      * Initialize the breakpoints system
      */
      initBreakpoints: function initBreakpoints() {
        if ('undefined' === typeof $this) {
          return;
        }
        if (!$this.wrapper || !$this.content) {
          return;
        }

        // Default breakpoints that should apply to all observed
        // elements that don't define their own custom breakpoints.
        var breakpoints = cscoGWrapper.breakpoints;

        // Update the matching breakpoints on the observed element.
        Object.keys(breakpoints).forEach(function (breakpoint) {
          var minWidth = breakpoints[breakpoint];
          if ($this.wrapper.clientWidth >= minWidth) {
            $this.content.classList.add(breakpoint);
          } else {
            $this.content.classList.remove(breakpoint);
          }
        });
      },
      /**
       * Init page layout.
       */
      initLayout: function initLayout() {
        if ('undefined' === typeof $this || !$this.wrapper) {
          return;
        }
        $this.wrapper.classList.add('cs-editor-styles-wrapper');
        $this.wrapper.classList.add(cscoGWrapper.page_layout);
        $this.wrapper.classList.add(cscoGWrapper.post_type);
        $this.wrapper.classList.add(cscoGWrapper.post_sidebar);
      },
      /**
       * Get new page layout.
       */
      newLayout: function newLayout(layout) {
        if ('right' === layout || 'left' === layout) {
          return 'cs-sidebar-enabled';
        } else if ('disabled' === layout) {
          return 'cs-sidebar-disabled';
        } else {
          return cscoGWrapper.default_layout;
        }
      },
      /**
       * Update when page layout has changed.
       */
      changeLayout: function changeLayout() {
        if ('undefined' === typeof $this) {
          return;
        }
        var layout = $this.singularLayout;
        if ($this.newLayout(layout) === cscoGWrapper.page_layout) {
          return;
        }
        if ('right' === layout || 'left' === layout) {
          cscoGWrapper.page_layout = 'cs-sidebar-enabled';
        } else if ('disabled' === layout) {
          cscoGWrapper.page_layout = 'cs-sidebar-disabled';
        } else {
          cscoGWrapper.page_layout = cscoGWrapper.default_layout;
        }
        setIframeContext('page_layout', cscoGWrapper.page_layout);
        if ($this.wrapper) {
          $this.wrapper.classList.remove('cs-sidebar-enabled');
          $this.wrapper.classList.remove('cs-sidebar-disabled');

          // Add new class.
          $this.wrapper.classList.add(cscoGWrapper.page_layout);
        }
        $this.initChanges();
      }
    };
  })();
  var cscoGutenbergComponent = /*#__PURE__*/function (_Component) {
    function cscoGutenbergComponent() {
      _classCallCheck(this, cscoGutenbergComponent);
      return _callSuper(this, cscoGutenbergComponent, arguments);
    }
    _inherits(cscoGutenbergComponent, _Component);
    return _createClass(cscoGutenbergComponent, [{
      key: "componentDidMount",
      value:
      /**
       * Add initial class.
       */
      function componentDidMount() {
        // Initialize.
        cscoGutenberg.init();

        // Initialize Page Layout.
        cscoGutenberg.initLayout();

        // Initialize Breakpoints
        cscoGutenberg.initBreakpoints();
      }
    }, {
      key: "componentDidUpdate",
      value: function componentDidUpdate() {
        // Initialize.
        cscoGutenberg.init();

        // Update Page Layout.
        cscoGutenberg.initLayout();

        // Update Breakpoints
        cscoGutenberg.initBreakpoints();
      }
    }, {
      key: "render",
      value: function render() {
        return null;
      }
    }]);
  }(Component);
  registerPlugin('cs-editor-wrapper', {
    render: cscoGutenbergComponent
  });
}
csEditorWrapper();