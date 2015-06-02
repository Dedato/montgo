/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // Sticky Footer
      var footerHeight = 0,
          footerTop = 0,
          $footer = $('.content-info');
      function positionFooter() {
        footerHeight = $footer.height();
        footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
        if ( ($(document.body).height()+footerHeight) < $(window).height()) {
          $footer.css({
            position: "absolute",
            top:      footerTop,
            left:     0,
            right:    0
          });
        } else {
          $footer.css({
            position: "static"
          });
        }
      }   
      if (!$('body').hasClass('one-page')) {
        // Minimize Header when scrolling
        $(window).scroll(function() {
          if( $(window).scrollTop() > 0) {
            $('.banner, .wrap').addClass('mini');
            $('.wrap .one-page').attr('data-menu-offset', '-40');
          } else {
            $('.banner, .wrap').removeClass('mini');
            $('.wrap .one-page').attr('data-menu-offset', '-120');
          }
        });
        // Sticky Footer
        positionFooter();
        $(window)
          .scroll(positionFooter)
          .resize(positionFooter);
      }  
    }
  },
  // One Page
  one_page: {
    init: function() {
      // Skrollr Variables
      var current_classname, original_menu_item_hash, original_menu_item_title;
      window.$menu_items       = $('.one-page .navbar-nav li');
      window.$window           = $(window);
      current_classname        = '-current';
      original_menu_item_hash  = window.$menu_items.find("a[href='" + window.location.hash + "']").get(0);
      original_menu_item_title = $menu_items.find('a[title="' + document.title + '"]');
      // Init Skrollr
      window.skrollr_instance = skrollr.init({
        forceHeight: false,
        smoothScrolling: true,
        mobileDeceleration: 0.008,
        render: function(skrollr_data) {
          // Minimize Header when 'scrolling'
          if (skrollr_data.curTop > 0){
            $('.banner, .wrap').addClass('mini');
            $('.wrap .one-page').attr('data-menu-offset', '-40');
          } else {
            $('.banner, .wrap').removeClass('mini');
            $('.wrap .one-page').attr('data-menu-offset', '-120');
          }
          // Update hashtag & title
          var $active_menu_items, $current_menu_item, href, title;
          $active_menu_items = $menu_items.filter('.skrollable-between');
          $current_menu_item = skrollr_data.curTop < $window.height() / 2 ? $menu_items.first() : $active_menu_items.length === 1 ? $active_menu_items : $active_menu_items.length > 1 ? $active_menu_items.eq(1) : $menu_items.last();
          if ($current_menu_item.get(0) === $menu_items.get(0)) {
            title = $current_menu_item.find('a').attr('title');
            document.title = title;
            //return typeof history !== "undefined" && history !== null ? typeof history.pushState === "function" ? history.pushState(null, null, window.location.pathname + window.location.search) : void 0 : void 0;
          } else {
            title = $current_menu_item.find('a').attr('title');
            document.title = title;
            href = $current_menu_item.find('a').attr('href') || '#';
            if ($('body').hasClass('en')) {
              href = '/en/' + href;
            }
            //return typeof history !== "undefined" && history !== null ? typeof history.pushState === "function" ? history.pushState({}, '', href) : void 0 : void 0;
          }
        }
      });
      // Init Skrollr Menu      
      skrollr.menu.init(window.skrollr_instance, {
        animate: true,
        easing: 'swing',
        duration: function(currentTop, targetTop) {
          return 500;
          //return Math.abs(currentTop - targetTop);
        }
      });
      // Refresh Skrollr after all image shave loaded
      $('#skrollr-body').imagesLoaded(function() {
        window.skrollr_instance.refresh();
      });
      // Simulate click when url has hashtag
      if (original_menu_item_hash) {
        $.delay(1000, function() {
          return skrollr.menu.click(original_menu_item_hash);
        });
      }
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
