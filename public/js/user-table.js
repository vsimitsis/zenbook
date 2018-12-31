/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/user-table.js":
/*!***********************************************!*\
  !*** ./resources/js/components/user-table.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DatatablesAdvancedColumnRendering = function () {
  var initUsersTable = function initUsersTable() {
    var table = $('#users-table');
    table.DataTable({
      responsive: true,
      paging: true,
      columnDefs: [{
        targets: 0,
        title: 'Agent',
        render: function render(data, type, full, meta) {
          var number = KUtil.getRandomInt(1, 14);
          var user_img = '100_' + number + '.jpg';
          var output;

          if (number > 8) {
            output = "\n                                <div class=\"k-user-card-v2\">\n                                    <div class=\"k-user-card-v2__pic\">\n                                        <img src=\"https://keenthemes.com/keen/themes/themes/keen/dist/preview/assets/media/users/" + user_img + "\" class=\"k-img-rounded k-marginless\" alt=\"photo\">\n                                    </div>\n                                    <div class=\"k-user-card-v2__details\">\n                                        <span class=\"k-user-card-v2__name\">" + full[2] + "</span>\n                                        <a href=\"#\" class=\"k-user-card-v2__email k-link\">" + full[3] + "</a>\n                                    </div>\n                                </div>";
          } else {
            var stateNo = KUtil.getRandomInt(0, 7);
            var states = ['success', 'brand', 'danger', 'accent', 'warning', 'metal', 'primary', 'info'];
            var state = states[stateNo];
            output = "\n                                <div class=\"k-user-card-v2\">\n                                    <div class=\"k-user-card-v2__pic\">\n                                        <div class=\"k-badge k-badge--xl k-badge--" + state + "\"><span>" + full[2].substring(0, 1) + "</div>\n                                    </div>\n                                    <div class=\"k-user-card-v2__details\">\n                                        <span class=\"k-user-card-v2__name\">" + full[2] + "</span>\n                                        <a href=\"#\" class=\"k-user-card-v2__email k-link\">" + full[3] + "</a>\n                                    </div>\n                                </div>";
          }

          return output;
        }
      }, {
        targets: 1,
        render: function render(data, type, full, meta) {
          return '<a class="k-link" href="mailto:' + data + '">' + data + '</a>';
        }
      }, {
        targets: -1,
        title: 'Actions',
        orderable: false,
        render: function render(data, type, full, meta) {
          return "\n                        <span class=\"dropdown\">\n                            <a href=\"#\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" data-toggle=\"dropdown\" aria-expanded=\"true\">\n                              <i class=\"la la-ellipsis-h\"></i>\n                            </a>\n                            <div class=\"dropdown-menu dropdown-menu-right\">\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-edit\"></i> Edit Details</a>\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-leaf\"></i> Update Status</a>\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-print\"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href=\"#\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">\n                          <i class=\"la la-edit\"></i>\n                        </a>";
        }
      }, {
        targets: 4,
        render: function render(data, type, full, meta) {
          var status = {
            1: {
              'title': 'Pending',
              'class': 'k-badge--brand'
            },
            2: {
              'title': 'Delivered',
              'class': ' k-badge--metal'
            },
            3: {
              'title': 'Canceled',
              'class': ' k-badge--primary'
            },
            4: {
              'title': 'Success',
              'class': ' k-badge--success'
            },
            5: {
              'title': 'Info',
              'class': ' k-badge--info'
            },
            6: {
              'title': 'Danger',
              'class': ' k-badge--danger'
            },
            7: {
              'title': 'Warning',
              'class': ' k-badge--warning'
            }
          };

          if (typeof status[data] === 'undefined') {
            return data;
          }

          return '<span class="k-badge ' + status[data].class + ' k-badge--inline k-badge--pill">' + status[data].title + '</span>';
        }
      }, {
        targets: 5,
        render: function render(data, type, full, meta) {
          var status = {
            1: {
              'title': 'Online',
              'state': 'danger'
            },
            2: {
              'title': 'Retail',
              'state': 'primary'
            },
            3: {
              'title': 'Direct',
              'state': 'accent'
            }
          };

          if (typeof status[data] === 'undefined') {
            return data;
          }

          return '<span class="k-badge k-badge--' + status[data].state + ' k-badge--dot"></span>&nbsp;' + '<span class="k-font-bold k-font-' + status[data].state + '">' + status[data].title + '</span>';
        }
      }]
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      initUsersTable();
    }
  };
}();

jQuery(document).ready(function () {
  DatatablesAdvancedColumnRendering.init();
});

/***/ }),

/***/ 1:
/*!*****************************************************!*\
  !*** multi ./resources/js/components/user-table.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/thanagor/www/zenbook/resources/js/components/user-table.js */"./resources/js/components/user-table.js");


/***/ })

/******/ });