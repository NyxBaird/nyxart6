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
/******/ 	return __webpack_require__(__webpack_require__.s = 56);
/******/ })
/************************************************************************/
/******/ ({

/***/ 11:
/***/ (function(module, exports) {


//Once the page is done loading
$(document).ready(function () {
    collapseMenu();
    checkForTitleScroll();

    //Look for a link containing our current url
    var $target = $('a[href="' + window.location.href + '"]');

    //If that link exists toggle that link open in the sidebar, else toggle the first link in the sidebar
    if ($target.length) $target.parent().toggleClass('active').parent('ul').toggleClass('active').parent().toggleClass('active');else $('#sidebarContent > ol > li > ul > li').first().toggleClass('active').parents('.year').first().click();
});

$(window).resize(function () {
    checkForTitleScroll();
});

$('.blogLinkLi').click(function (e) {
    window.location = $('a', $(e.target)).attr('href');
});

$('#frontendContent').click(function (e) {
    if ($('#sidebar').position().left === 0 && !$(e.target).parents('#sidebar').length) collapseMenu();
});

$('#menuBurger').click(function (e) {
    e.preventDefault();

    if (this.classList.contains("active") === true) collapseMenu();else expandMenu();
});

$('#sidebarContent .year').on('click', function () {
    if (!$(this).hasClass('active')) $('.year.active').first().find('ul').first().toggleClass('active').parent().toggleClass('active');

    $(this).find('ul').first().toggleClass('active').parent().toggleClass('active');
});

function checkForTitleScroll() {
    if ($('#title')[0].offsetLeft + $('#title')[0].offsetWidth > $('#header')[0].offsetWidth - $('#header')[0].offsetHeight && !$('marquee', $('#title')).length) {
        var title = $('#title').html(),
            titleW = $('#title').offsetWidth;

        $('#title').css({ width: titleW + 'px' });
        $('#title').html("<marquee align='left' speed='3' style='width: 100%;'>" + title + "</marquee>");
    } else {
        if ($('marquee', $('#title')).length) {
            var $marquee = $('#title').children('marquee').first(),
                title = $marquee.html();

            $marquee.remove();
            $('#title').html(title);
        }
    }
}

function collapseMenu() {
    $('#menuBurger').removeClass("active");
    $('#sidebar').animate({ left: '-' + ($('#sidebar').width() - 1) + 'px' });
}

function expandMenu() {
    $('#menuBurger').addClass("active");
    $('#sidebar').animate({ left: '0' });
}

/***/ }),

/***/ 56:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(11);


/***/ })

/******/ });