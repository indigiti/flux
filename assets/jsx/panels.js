"use strict";

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
/**
 * Register Panel
 */

function csRegisterPanels() {
  var __ = wp.i18n.__;
  var compose = wp.compose.compose;
  var Component = wp.element.Component;
  var _wp$components = wp.components,
    SelectControl = _wp$components.SelectControl,
    CheckboxControl = _wp$components.CheckboxControl,
    ToggleControl = _wp$components.ToggleControl,
    TextControl = _wp$components.TextControl,
    RangeControl = _wp$components.RangeControl;
  var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
  var _wp$data = wp.data,
    withSelect = _wp$data.withSelect,
    withDispatch = _wp$data.withDispatch;
  var registerPlugin = wp.plugins.registerPlugin;

  // Fetch the post meta.
  var applyWithSelect = withSelect(function (select) {
    var _select = select("core/editor"),
      getEditedPostAttribute = _select.getEditedPostAttribute;
    return {
      meta: getEditedPostAttribute("meta")
    };
  });

  // Provide method to update post meta.
  var applyWithDispatch = withDispatch(function (dispatch, _ref) {
    var meta = _ref.meta;
    var _dispatch = dispatch("core/editor"),
      editPost = _dispatch.editPost;
    return {
      updateMeta: function updateMeta(newMeta) {
        editPost({
          meta: _objectSpread(_objectSpread({}, meta), newMeta)
        });
      }
    };
  });

  /**
   * ==================================
   * Layout Options
   * ==================================
   */
  if ("post" === csPanelsData.postType || "page" === csPanelsData.postType) {
    var csThemeLayoutOptions = /*#__PURE__*/function (_Component) {
      function csThemeLayoutOptions() {
        _classCallCheck(this, csThemeLayoutOptions);
        return _callSuper(this, csThemeLayoutOptions, arguments);
      }
      _inherits(csThemeLayoutOptions, _Component);
      return _createClass(csThemeLayoutOptions, [{
        key: "render",
        value: function render() {
          var _this$props = this.props,
            _this$props$meta = _this$props.meta,
            _this$props$meta2 = _this$props$meta === void 0 ? {} : _this$props$meta,
            csco_singular_sidebar = _this$props$meta2.csco_singular_sidebar,
            csco_page_header_type = _this$props$meta2.csco_page_header_type,
            csco_page_load_nextpost = _this$props$meta2.csco_page_load_nextpost,
            updateMeta = _this$props.updateMeta;
          return /*#__PURE__*/React.createElement(PluginDocumentSettingPanel, {
            title: __("Layout Options", "flux")
          }, /*#__PURE__*/React.createElement(SelectControl, {
            label: __("Sidebar", "flux"),
            value: csco_singular_sidebar,
            onChange: function onChange(value) {
              updateMeta({
                csco_singular_sidebar: value || "default"
              });
            },
            options: csPanelsData.singularSidebar
          }), /*#__PURE__*/React.createElement(SelectControl, {
            label: __("Page Header Type", "flux"),
            value: csco_page_header_type,
            onChange: function onChange(value) {
              updateMeta({
                csco_page_header_type: value || "default"
              });
            },
            options: csPanelsData.pageHeaderType
          }), /*#__PURE__*/React.createElement(SelectControl, {
            label: __("Auto Load Next Post", "flux"),
            value: csco_page_load_nextpost,
            onChange: function onChange(value) {
              updateMeta({
                csco_page_load_nextpost: value || "default"
              });
            },
            options: csPanelsData.pageLoadNextpost
          }));
        }
      }]);
    }(Component); // Combine the higher-order components.
    var _render = compose([applyWithSelect, applyWithDispatch])(csThemeLayoutOptions);

    // Register panel.
    registerPlugin("cs-theme-layout-options", {
      icon: false,
      render: _render
    });
  }

  /**
   * ==================================
   * Video Background
   * ==================================
   */
  var csThemeVideoOptions = /*#__PURE__*/function (_Component2) {
    function csThemeVideoOptions() {
      _classCallCheck(this, csThemeVideoOptions);
      return _callSuper(this, csThemeVideoOptions, arguments);
    }
    _inherits(csThemeVideoOptions, _Component2);
    return _createClass(csThemeVideoOptions, [{
      key: "render",
      value: function render() {
        var _this$props2 = this.props,
          _this$props2$meta = _this$props2.meta,
          _this$props2$meta2 = _this$props2$meta === void 0 ? {} : _this$props2$meta,
          csco_post_video_location = _this$props2$meta2.csco_post_video_location,
          csco_post_video_location_hash = _this$props2$meta2.csco_post_video_location_hash,
          csco_post_video_url = _this$props2$meta2.csco_post_video_url,
          csco_post_video_bg_start_time = _this$props2$meta2.csco_post_video_bg_start_time,
          csco_post_video_bg_end_time = _this$props2$meta2.csco_post_video_bg_end_time,
          csco_post_video_bg_volume = _this$props2$meta2.csco_post_video_bg_volume,
          updateMeta = _this$props2.updateMeta;
        return /*#__PURE__*/React.createElement(PluginDocumentSettingPanel, {
          title: __("Video Background", "flux")
        }, /*#__PURE__*/React.createElement("p", null, __("Location", "flux")), /*#__PURE__*/React.createElement("ul", null, csPanelsData.videoLocationList.map(function (item) {
          var isChecked = (csco_post_video_location || []).indexOf(item.value) !== -1 ? true : false;
          return /*#__PURE__*/React.createElement("li", null, /*#__PURE__*/React.createElement(CheckboxControl, {
            label: item.label,
            checked: isChecked,
            onChange: function onChange(value) {
              var list = csco_post_video_location || [];
              if (value && list.indexOf(item.value) === -1) {
                list.push(item.value);
              }
              if (!value && list.indexOf(item.value) !== -1) {
                list.splice(list.indexOf(item.value), 1);
              }
              updateMeta({
                csco_post_video_location: list || []
              });
              updateMeta({
                csco_post_video_location_hash: String(Math.random().toString(36).substring(2) + Date.now().toString(36))
              });
            },
            value: item.value
          }));
        })), /*#__PURE__*/React.createElement(TextControl, {
          label: __("YouTube / MP4 link", "flux"),
          help: __("Enter a YouTube URL or a link to an MP4 video from the Media Library.", "flux"),
          value: csco_post_video_url,
          onChange: function onChange(value) {
            updateMeta({
              csco_post_video_url: value || ""
            });
          }
        }), /*#__PURE__*/React.createElement(RangeControl, {
          label: __("Start Time (sec)", "flux"),
          value: csco_post_video_bg_start_time,
          onChange: function onChange(value) {
            updateMeta({
              csco_post_video_bg_start_time: value || 0
            });
          },
          step: 1,
          min: 0,
          max: 10000
        }), /*#__PURE__*/React.createElement(RangeControl, {
          label: __("End Time (sec)", "flux"),
          value: csco_post_video_bg_end_time,
          onChange: function onChange(value) {
            updateMeta({
              csco_post_video_bg_end_time: value || 0
            });
          },
          step: 1,
          min: 0,
          max: 10000
        }), /*#__PURE__*/React.createElement(CheckboxControl, {
          label: __("Enable Volume", "flux"),
          checked: csco_post_video_bg_volume ? true : false,
          onChange: function onChange(value) {
            updateMeta({
              csco_post_video_bg_volume: value || false
            });
          },
          value: csco_post_video_bg_volume
        }));
      }
    }]);
  }(Component); // Combine the higher-order components.
  var render = compose([applyWithSelect, applyWithDispatch])(csThemeVideoOptions);

  // Register panel.
  registerPlugin("cs-theme-video-options", {
    icon: false,
    render: render
  });
}
csRegisterPanels();