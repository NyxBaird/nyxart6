/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 57);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

var pageColor = $('#header').css('background-color'),
    liLength = 0;

$('li', $("#headerLinks")).each(function (k, t) {
    liLength += t.offsetWidth;
});

//Double check our links on page load
$(document).ready(function () {
    minimizeHeaderLinks();
});

//Double check our links on window resize
$(window).resize(function () {
    minimizeHeaderLinks();
});

//Minimizes the minimized link menu
$('#headerLinks > i').click(function () {

    //If our links are expanded
    if ($(this).siblings('.linksNotch').css('border-width').split(" ").length === 3) {
        $(this).siblings('.linksNotch').animate({ 'border-width': 0 }, 500);
        $(this).animate({ 'background-color': pageColor }, 500);
        $('#headerLinks').animate({ top: '-' + $('#headerLinks')[0].offsetHeight + 'px' }, 500);

        //If our links are minified
    } else {
        $(this).animate({ 'background-color': lighten(pageColor, 20) }, 500);
        $(this).siblings('.linksNotch').animate({ 'border-width': 10 }, 500);
        $('#headerLinks').animate({ top: $('#header')[0].offsetHeight - 1 }, 500);
    }
});

//Minimizes/Maximizes Header Links
function minimizeHeaderLinks() {
    var $links = $('#headerLinks'),
        $icon = $('.fa-link', $links);

    //Minimize links
    if (headerOverflown() && !roomForLinks()) {
        if (!$links.hasClass('minimized')) $links.addClass('minimized');

        $('.linkMinimizer', $links).each(function (k, t) {
            $(t).css({ display: 'initial' });
        });

        $links.css({ 'background-color': pageColor });

        if ($icon.siblings('.linksNotch').css('border-width').split(" ").length === 3) $icon.css({ 'background-color': lighten(pageColor, 20) });else $icon.css({ 'background-color': pageColor });

        $('.linksNotch', $links).css({ 'border-top-color': lighten(pageColor, 20) });

        //Put in header
    } else {
        if ($links.hasClass('minimized')) $links.removeClass('minimized');

        $('.linkMinimizer', $links).each(function (k, t) {
            $(t).css({ display: 'none' });
        });

        $links.css({ 'background-color': 'transparent' });
    }
}

//Lightens a given rgb() color by a given amount
function lighten(color, percent) {
    color = color.replace("rgb(", "").replace(")", "").split(", ");

    if (color.length < 3) console.log("Looks like you're trying to lighten a non-color!");

    //Grabs decimal point percentages of each value
    color = {
        r: color[0] / 255,
        g: color[1] / 255,
        b: color[2] / 255
    };

    //Grabs decimal point percentage of requested percent
    percent = percent / 100;

    //Get the new rgb values
    for (var c in color) {
        color[c] += percent;

        if (color[c] > 1) color[c] = 1;

        color[c] = parseFloat(color[c].toFixed(2));
        color[c] *= 255;
    }

    return "rgb(" + color.r + ", " + color.g + ", " + color.b + ")";
}

//Have our links spilled out of our header?
function headerOverflown() {
    return !!+$('#headerLinks').offset().top;
}

//not quite working
function roomForLinks() {
    var $title = $('#title'),
        offset = $title[0].offsetLeft + $title[0].offsetWidth + 130;

    if ($('#header')[0].offsetWidth - offset > liLength) return true;

    return false;
}

/***/ }),

/***/ 57:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });