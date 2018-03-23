/**
 * jQuery FocusPoint; version: 1.1.1
 * Author: http://jonathonmenz.com
 * Source: https://github.com/jonom/jquery-focuspoint
 * Copyright (c) 2014 J. Menz; MIT License
 * @preserve
 */
;
(function($) {

	var defaults = {
		reCalcOnWindowResize: true,
		throttleDuration: 17 //ms - set to 0 to disable throttling
	};

	//Setup a container instance
	var setupContainer = function($el) {
		var imageSrc = $el.find('img').attr('src');
		$el.data('imageSrc', imageSrc);

		resolveImageSize(imageSrc, function(err, dim) {
			$el.data({
				imageW: dim.width,
				imageH: dim.height
			});
			adjustFocus($el);
		});
	};

	//Get the width and the height of an image
	//by creating a new temporary image
	var resolveImageSize = function(src, cb) {
		//Create a new image and set a
		//handler which listens to the first
		//call of the 'load' event.
		$('<img />').one('load', function() {
			//'this' references to the new
			//created image
			cb(null, {
				width: this.width,
				height: this.height
			});
		}).attr('src', src);
	};

	//Create a throttled version of a function
	var throttle = function(fn, ms) {
		var isRunning = false;
		return function() {
			var args = Array.prototype.slice.call(arguments, 0);
			if (isRunning) return false;
			isRunning = true;
			setTimeout(function() {
				isRunning = false;
				fn.apply(null, args);
			}, ms);
		};
	};

	//Calculate the new left/top values of an image
	var calcShift = function(conToImageRatio, containerSize, imageSize, focusSize, toMinus) {
		var containerCenter = Math.floor(containerSize / 2); //Container center in px
		var focusFactor = (focusSize + 1) / 2; //Focus point of resize image in px
		var scaledImage = Math.floor(imageSize / conToImageRatio); //Can't use width() as images may be display:none
		var focus =  Math.floor(focusFactor * scaledImage);
		if (toMinus) focus = scaledImage - focus;
		var focusOffset = focus - containerCenter; //Calculate difference between focus point and center
		var remainder = scaledImage - focus; //Reduce offset if necessary so image remains filled
		var containerRemainder = containerSize - containerCenter;
		if (remainder < containerRemainder) focusOffset -= containerRemainder - remainder;
		if (focusOffset < 0) focusOffset = 0;

		return (focusOffset * -100 / containerSize)  + '%';
	};

	//Re-adjust the focus
	var adjustFocus = function($el) {
		var imageW = $el.data('imageW');
		var imageH = $el.data('imageH');
		var imageSrc = $el.data('imageSrc');

		if (!imageW && !imageH && !imageSrc) {
			return setupContainer($el); //Setup the container first
		}

		var containerW = $el.width();
		var containerH = $el.height();
		var focusX = parseFloat($el.data('focusX'));
		var focusY = parseFloat($el.data('focusY'));
		var $image = $el.find('img').first();

		//Amount position will be shifted
		var hShift = 0;
		var vShift = 0;

		if (!(containerW > 0 && containerH > 0 && imageW > 0 && imageH > 0)) {
			return false; //Need dimensions to proceed
		}

		//Which is over by more?
		var wR = imageW / containerW;
		var hR = imageH / containerH;

		//Reset max-width and -height
		$image.css({
			'max-width': '',
			'max-height': ''
		});

		//Minimize image while still filling space
		if (imageW > containerW && imageH > containerH) {
			$image.css((wR > hR) ? 'max-height' : 'max-width', '100%');
		}

		if (wR > hR) {
			hShift = calcShift(hR, containerW, imageW, focusX);
		} else if (wR < hR) {
			vShift = calcShift(wR, containerH, imageH, focusY, true);
		}

		$image.css({
			top: vShift,
			left: hShift
		});
	};

	var $window = $(window);

	var focusPoint = function($el, settings) {
		var thrAdjustFocus = settings.throttleDuration ?
			throttle(function(){adjustFocus($el);}, settings.throttleDuration)
			: function(){adjustFocus($el);};//Only throttle when desired
		var isListening = false;

		adjustFocus($el); //Focus image in container

		//Expose a public API
		return {

			adjustFocus: function() {
				return adjustFocus($el);
			},

			windowOn: function() {
				if (isListening) return;
				//Recalculate each time the window is resized
				$window.on('resize', thrAdjustFocus);
				return isListening = true;
			},

			windowOff: function() {
				if (!isListening) return;
				//Stop listening to the resize event
				$window.off('resize', thrAdjustFocus);
				isListening = false;
				return true;
			}

		};
	};

	$.fn.focusPoint = function(optionsOrMethod) {
		//Shortcut to functions - if string passed assume method name and execute
		if (typeof optionsOrMethod === 'string') {
			return this.each(function() {
				var $el = $(this);
				$el.data('focusPoint')[optionsOrMethod]();
			});
		}
		//Otherwise assume options being passed and setup
		var settings = $.extend({}, defaults, optionsOrMethod);
		return this.each(function() {
			var $el = $(this);
			var fp = focusPoint($el, settings);
			//Stop the resize event of any previous attached
			//focusPoint instances
			if ($el.data('focusPoint')) $el.data('focusPoint').windowOff();
			$el.data('focusPoint', fp);
			if (settings.reCalcOnWindowResize) fp.windowOn();
		});

	};

	$.fn.adjustFocus = function() {
		//Deprecated v1.2
		return this.each(function() {
			adjustFocus($(this));
		});
	};

})(jQuery);
window.require.define({"index": function(exports, require, module) {(function() {
  var App, ContactPageController, Route, Spine,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  Spine = require('spine');

  Route = require('spine/lib/route');

  ContactPageController = require('contactPage');

  App = (function(_super) {
    __extends(App, _super);

    App.prototype.className = 'wrapper';

    function App() {
      App.__super__.constructor.apply(this, arguments);
      console.log('LOADED');
      this.contactPage = new ContactPageController();
    }

    return App;

  })(Spine.Controller);

  module.exports = App;

}).call(this);
}});

window.require.define({"modules/about-skin": function(exports, require, module) {(function() {
  var $document, $window, AboutSkin, body, contentEl, faqContentTitle, faqElHead, faqElement, fraction, loadMore, loadMoreLink, mainWrapper, navItem, serviceImage, textAnim, videoContainers, videos,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  serviceImage = $('.service-image-container');

  loadMoreLink = $('.load-more-link-container');

  faqElement = $('.faq-element');

  contentEl = $('.content-maxwidth');

  faqElHead = $('.faq-title-head');

  navItem = $('.nav-about');

  faqContentTitle = $('.faq-content-title');

  mainWrapper = $('.main-wrapper');

  loadMore = $('#load-more');

  videoContainers = $('.container-video');

  videos = $('.video');

  textAnim = $('.text-anim');

  fraction = 0.01;

  $.fn.is_on_screen = function() {
    var bounds, viewport, win;
    win = $(window);
    viewport = {
      top: win.scrollTop(),
      left: win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    return !(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom + 200 < bounds.top || viewport.top - 200 > bounds.bottom);
  };

  AboutSkin = (function() {
    function AboutSkin() {
      this._onClickLoadElement = __bind(this._onClickLoadElement, this);
      this._onResize = __bind(this._onResize, this);
      this._useAboutSkin = __bind(this._useAboutSkin, this);
      this._onServiceClick = __bind(this._onServiceClick, this);
      this._bindEvents = __bind(this._bindEvents, this);
      this._checkScroll = __bind(this._checkScroll, this);
      var configProfile, dateFormatter, link, time, timeConverter, userFeed,
        _this = this;
      this.hideElementsIFNecessary();
      this.setImageSize();
      this.setImageSrc();
      this._bindEvents();
      this._useAboutSkin();
      timeConverter = function(UNIX_timestamp) {
        var a, date, hour, min, month, months, sec, time, year;
        a = new Date(UNIX_timestamp * 1000);
        months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        year = a.getFullYear();
        month = months[a.getMonth()];
        date = a.getDate();
        hour = a.getHours();
        min = a.getMinutes();
        sec = a.getSeconds();
        time = month + ' ' + date;
        return time;
      };
      time = 'a';
      link = null;
      userFeed = new Instafeed({
        get: 'tagged',
        tagName: 'sixthirtystudio',
        userId: '21849904',
        clientId: 'stabilo_boss',
        accessToken: '21849904.ba4c844.f359d08725ea44a9ba517dfafefcaf06',
        resolution: 'standard_resolution',
        sortBy: 'most-recent',
        template: '<div class="instagram">\
									<div class="wrap">\
										<div class="instaimage">\
											<a href="{{link}}" target="_blank" style="background-image: url({{image}});">\
												<div class="instafeed-image" style="background-image: url({{image}});"></div>\
											</a>\
										</div>\
										<div class="instacaption">\
											<div class="caption">{{caption}}</div>\
											<p class="instadate">{{model.created_time}}</p>\
										</div>\
									</div>\
								</div>',
        filter: function(image) {
          image.created_time = timeConverter(image.created_time);
          return true;
        },
        after: function() {
          $("#instafeed").slick({});
          return $('.instafeed-image').css('width', $('.instaimage').width());
        }
      });
      userFeed.run();
      dateFormatter = function(date) {
        var dateDay, dateMonth, dateString, monthNames;
        monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        date = new Date(date);
        dateDay = date.getDay();
        dateMonth = monthNames[date.getMonth()];
        dateString = dateMonth + ' ' + dateDay;
        return dateString;
      };
      configProfile = {
        'profile': {
          'screenName': 'sixthirtystudio'
        },
        'domId': 'example1',
        'maxTweets': 1,
        'enableLinks': true,
        'showUser': false,
        'showTime': true,
        "dateFunction": dateFormatter,
        'showImages': false,
        'lang': 'en'
      };
      twitterFetcher.fetch(configProfile);
      setTimeout(function() {
        return _this._onResize();
      }, 0);
    }

    AboutSkin.prototype._checkScroll = function(e) {
      var _this = this;
      videos.map(function(index, elem) {
        if ($(elem).is_on_screen()) {
          return elem.play();
        } else {
          return elem.pause();
        }
      });
      textAnim.map(function(index, elem) {
        if ($(elem).is_on_screen()) {
          if (!elem.classList.contains('slide-in-page')) {
            return elem.className += " slide-in-page";
          }
        }
      });
    };

    AboutSkin.prototype._bindEvents = function() {
      $window.on('resize', this._onResize);
      $window.on('orientationchange', this._onOrientationChange);
      window.addEventListener('scroll', this._checkScroll);
      loadMoreLink.on('click', this._onClickLoadElement);
      serviceImage.on('click', this._onServiceClick);
      return loadMore.on('click', this._checkScroll);
    };

    AboutSkin.prototype._onServiceClick = function(ev) {
      var projectsURL;
      ev.preventDefault();
      projectsURL = $(ev.currentTarget).attr('href');
      return $window.trigger('requestProjectsLoad', [projectsURL]);
    };

    AboutSkin.prototype._onOrientationChange = function() {
      return $window.trigger('resize');
    };

    AboutSkin.prototype._slideInHeader = function() {
      setTimeout(function() {
        return $window.trigger('checkMenu');
      }, 700);
      return $('.slide-in-page').removeClass('loading');
    };

    AboutSkin.prototype._useAboutSkin = function() {
      body.addClass('about');
      mainWrapper.addClass('about');
      this._slideInHeader();
      $('.header-wrapper').addClass('transparent').removeClass('nav-up');
      if ($('body').hasClass('home')) {
        return $('.header-wrapper').removeClass('transparent');
      }
    };

    AboutSkin.prototype._onResize = function() {
      this._checkScroll();
      this.setImageSize();
      this.hideElementsIFNecessary();
      return $('.instafeed-image').css('width', $('.instaimage').width());
    };

    AboutSkin.prototype._onClickLoadElement = function() {
      faqElement.css({
        'display': 'inline-block'
      });
      loadMoreLink.css({
        'display': 'none'
      });
      faqElement.each(function() {
        return $(this).addClass('expand-element');
      });
      return loadMoreLink.removeClass('expand-element');
    };

    AboutSkin.prototype.hideElements = function(elem, n) {
      var elemNr,
        _this = this;
      elemNr = elem.length;
      elem.each(function(i, el) {
        if (i >= n) {
          $(el).removeClass('expand-element');
          return $(el).css({
            'display': 'none'
          });
        } else {
          $(el).addClass('expand-element');
          return $(el).css({
            'display': 'inline-block'
          });
        }
      });
      if (elemNr > n) {
        loadMoreLink.addClass('expand-element');
        return loadMoreLink.css({
          'display': 'inline-block'
        });
      } else {
        loadMoreLink.removeClass('expand-element');
        return loadMoreLink.css({
          'display': 'none'
        });
      }
    };

    AboutSkin.prototype.hideElementsIFNecessary = function() {
      var screenWidth, scrollBarWidth;
      if (this.getScrollBarWidth() === void 0) {
        scrollBarWidth = 0;
      } else {
        scrollBarWidth = this.getScrollBarWidth();
      }
      screenWidth = $window.width() + scrollBarWidth;
      if (screenWidth > 768) {
        return this.hideElements($('.faq-element'), 6);
      } else if (screenWidth > 640) {
        return this.hideElements($('.faq-element'), 4);
      } else {
        if (!faqContentTitle.data('expanded')) {
          this.hideElements($('.faq-element'), 2);
          loadMoreLink.css({
            'display': 'none'
          });
          return $('.faq-element').css({
            'display': 'none'
          });
        }
      }
    };

    AboutSkin.prototype.setImageSize = function() {
      var picHeight, picWidth, ratio, screenWidth, scrollBarWidth;
      if (this.getScrollBarWidth() === void 0) {
        scrollBarWidth = 0;
      } else {
        scrollBarWidth = this.getScrollBarWidth();
      }
      screenWidth = $window.width() + scrollBarWidth;
      if (screenWidth > 640) {
        picWidth = serviceImage.width();
      } else {
        picWidth = contentEl.width();
      }
      ratio = 1.5;
      picHeight = parseInt(picWidth / ratio);
      return serviceImage.css({
        'height': picHeight + 'px'
      });
    };

    AboutSkin.prototype.setImageSrc = function() {
      var _this = this;
      return serviceImage.each(function(i, pic) {
        var src;
        src = $(pic).data('src');
        return $(pic).css({
          'background-image': "url('" + src + "')"
        });
      });
    };

    AboutSkin.prototype.getScrollBarWidth = function() {
      var inner, outer, w1, w2;
      inner = document.createElement('p');
      inner.style.width = "100%";
      inner.style.height = "200px";
      outer = document.createElement('div');
      outer.style.position = "absolute";
      outer.style.top = "0px";
      outer.style.left = "0px";
      outer.style.visibility = "hidden";
      outer.style.width = "200px";
      outer.style.height = "150px";
      outer.style.overflow = "hidden";
      outer.appendChild(inner);
      document.body.appendChild(outer);
      w1 = inner.offsetWidth;
      outer.style.overflow = 'scroll';
      w2 = inner.offsetWidth;
      if (w1 === w2) {
        w2 = outer.clientWidth;
      }
      document.body.removeChild(outer);
      return w1 - w2;
    };

    return AboutSkin;

  })();

  module.exports = new AboutSkin;

}).call(this);
}});

window.require.define({"modules/back-to-top": function(exports, require, module) {(function() {
  var $body, $document, $htmlBody, $window, BackToTop, backToTop, scrollDown, scrollDownContainer, scrollTop, threshold,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  $body = $('body');

  $htmlBody = $('html, body');

  scrollTop = 0;

  backToTop = $('.back-to-top');

  scrollDown = $('.scroll-down');

  scrollDownContainer = scrollDown.parent();

  threshold = 820;

  BackToTop = (function() {
    function BackToTop() {
      this._onWindowScroll = __bind(this._onWindowScroll, this);
      this._onajaxSuccessTriggered = __bind(this._onajaxSuccessTriggered, this);
      this._bindEvents();
    }

    BackToTop.prototype._bindEvents = function() {
      $window.on('scroll', this._onWindowScroll);
      $window.on('mousewheel', this._onWindowMouseWheel);
      $document.ready(this._checkPage);
      backToTop.on('click', this._onBackToTopClick);
      scrollDown.on('click', this._onScrollDownClick);
      return $window.on('ajaxSuccessTriggered', this._onajaxSuccessTriggered);
    };

    BackToTop.prototype._onajaxSuccessTriggered = function() {
      var backToTopVisible;
      scrollTop = 0;
      backToTop = $('.back-to-top');
      backToTopVisible = false;
      backToTop.on('click', this._onBackToTopClick);
      scrollDown.on('click', this._onScrollDownClick);
      return this._checkPage();
    };

    BackToTop.prototype._checkPage = function() {
      if ($body.hasClass('projects')) {
        return threshold = 200;
      } else {
        return threshold = 820;
      }
    };

    BackToTop.prototype._onWindowMouseWheel = function() {
      return $htmlBody.stop();
    };

    BackToTop.prototype._onWindowScroll = function() {
      scrollTop = $window.scrollTop();
      if (scrollTop > threshold) {
        return this._showButton();
      } else {
        return this._hideButton();
      }
    };

    BackToTop.prototype._showButton = function() {
      return backToTop.addClass('visible');
    };

    BackToTop.prototype._hideButton = function() {
      return backToTop.removeClass('visible');
    };

    BackToTop.prototype._onScrollDownClick = function() {
      var scrollTo;
      scrollTo = scrollDownContainer.offset().top + scrollDownContainer.height();
      return $htmlBody.animate({
        scrollTop: scrollTo
      }, {
        duration: 800
      });
    };

    BackToTop.prototype._onBackToTopClick = function() {
      return $htmlBody.animate({
        scrollTop: 0
      }, {
        duration: 1000
      });
    };

    return BackToTop;

  })();

  module.exports = new BackToTop;

}).call(this);
}});

window.require.define({"modules/contact-skin": function(exports, require, module) {(function() {
  var $document, $window, ContactSkin, body, mainWrapper, navItem,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  navItem = $('.nav-contact');

  mainWrapper = $('.main-wrapper');

  ContactSkin = (function() {
    function ContactSkin() {
      this._useContactSkin = __bind(this._useContactSkin, this);
      this._bindEvents();
    }

    ContactSkin.prototype._bindEvents = function() {
      return $document.ready(this._useContactSkin);
    };

    ContactSkin.prototype._slideInHeader = function() {
      return setTimeout(function() {
        $window.trigger('checkMenu');
        return $('.footer-details').addClass('slide-in');
      }, 700);
    };

    ContactSkin.prototype._useContactSkin = function() {
      body.addClass('contact');
      mainWrapper.addClass('contact');
      return this._slideInHeader();
    };

    return ContactSkin;

  })();

  module.exports = new ContactSkin;

}).call(this);
}});

window.require.define({"modules/footer-slide": function(exports, require, module) {(function() {
  var $body, $window, FooterSliding, footerForm, isScrolled, subscribeCTA;

  $window = $(window);

  $body = $('body');

  isScrolled = false;

  subscribeCTA = $(".newsletter-cta");

  footerForm = $(".footer-form");

  FooterSliding = (function() {
    function FooterSliding() {
      this._bindEvents();
    }

    FooterSliding.prototype._bindEvents = function() {
      $window.on('scroll', this._onWindowScroll);
      return subscribeCTA.on('click', this._onSubscribeBtnClick);
    };

    FooterSliding.prototype._onWindowScroll = function() {
      if ($window.scrollTop() > 95) {
        if (isScrolled) {
          return;
        }
        isScrolled = true;
        return $body.addClass('scrolled');
      } else {
        if (!isScrolled) {
          return;
        }
        isScrolled = false;
        return $body.removeClass('scrolled');
      }
    };

    FooterSliding.prototype._onSubscribeBtnClick = function() {
      return footerForm.toggleClass('visible');
    };

    return FooterSliding;

  })();

  module.exports = new FooterSliding;

}).call(this);
}});

window.require.define({"modules/header-controller": function(exports, require, module) {(function() {
  var $body, $document, $html, $htmlBody, $window, HeaderController, ajaxResponse, ajaxResponseWrapper, animatingHeader, bodyClasses, cachedPage, filterIcon, header, headerInnerWrapper, headerIsVisible, headerNav, headerNavWrapper, is_touch, lastScrollTop, lastScrolledVal, mainWrapper, menuOffsetDelimiter, mobileBtn, mobileMenuOpened, mobileNavBar, navLink, projectsBtn, projectsOverlay, scrollerActive, switchPoint,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  $body = $('body');

  $html = $('html');

  $htmlBody = $('html, body');

  projectsBtn = $('.nav-projects');

  ajaxResponse = '';

  ajaxResponseWrapper = $('.ajax-response');

  mainWrapper = $('body > .main-wrapper');

  navLink = $('.header-nav--wrapper.language-menu a');

  bodyClasses = [];

  header = $('.header-wrapper');

  mobileBtn = $('.mobile-menu-btn');

  mobileNavBar = $('.mobile-menu-overlay');

  headerNav = $('.header-nav--wrapper .nano');

  headerNavWrapper = $('.header-nav--wrapper');

  headerInnerWrapper = $('.header-inner-wrapper');

  filterIcon = $('.icon-filter-plus');

  lastScrolledVal = 0;

  switchPoint = 0;

  lastScrollTop = 0;

  headerIsVisible = true;

  mobileMenuOpened = false;

  projectsOverlay = $('.projects-overlay');

  menuOffsetDelimiter = $('.menu-offset-delimiter');

  scrollerActive = false;

  is_touch = window.ontouchstart !== void 0;

  window.cachedScroll = 0;

  cachedPage = null;

  animatingHeader = false;

  HeaderController = (function() {
    var cacheProjectsPage, getProjectsPage,
      _this = this;

    function HeaderController() {
      this._resetBody = __bind(this._resetBody, this);
      this._onLogoClick = __bind(this._onLogoClick, this);
      this._onProjectsLoadRequest = __bind(this._onProjectsLoadRequest, this);
      this._onProjectLoadRequest = __bind(this._onProjectLoadRequest, this);
      this._hideProjectsPage = __bind(this._hideProjectsPage, this);
      this._displayProjectsPage = __bind(this._displayProjectsPage, this);
      this._slideOutAndShow = __bind(this._slideOutAndShow, this);
      this._slideOutAndNavigate = __bind(this._slideOutAndNavigate, this);
      this._onNavLinkClick = __bind(this._onNavLinkClick, this);
      this._onMobileBtnClick = __bind(this._onMobileBtnClick, this);
      this._preventScrolling = __bind(this._preventScrolling, this);
      this._onWindowLoad = __bind(this._onWindowLoad, this);
      this._onDocReady = __bind(this._onDocReady, this);
      this._onKeyDown = __bind(this._onKeyDown, this);
      this._onResize = __bind(this._onResize, this);
      var checkPassword;
      if (window.location.pathname === '/') {
        $('.return-home-logo').css({
          'opacity': 0
        });
      } else {
        $('.return-home-logo').css({
          'opacity': 1
        });
      }
      if (is_touch) {
        $html.addClass('touchscreen');
      }
      $(".nano").nanoScroller();
      $('.js-contact-click').on('click', function(e) {
        var offsetTop,
          _this = this;
        if (window.location.pathname === '/about/') {
          $('.return-home-logo').fadeIn();
          offsetTop = $('#contact').offset().top;
          if (mobileMenuOpened) {
            mobileMenuOpened = !mobileMenuOpened;
            mobileNavBar.removeClass('active');
            $('.projects-overlay-image').removeClass('active');
            mobileBtn.removeClass('active');
            $htmlBody.removeClass('noscroll');
          }
          return setTimeout(function() {
            return $htmlBody.animate({
              scrollTop: offsetTop
            }, {
              duration: 500,
              easing: 'swing'
            });
          }, 300);
        } else {
          return window.location.href = location.protocol + '//' + location.host + '/about#contact';
        }
      });
      $('.projects-overlay').on('click', function() {
        return $('.projects-overlay-wrapper, .projects-overlay-image').addClass('active');
      });
      $('.projects-overlay-close-button').on('click', function() {
        $('.projects-overlay-wrapper').removeClass('active');
        if (!mobileMenuOpened) {
          return $('.projects-overlay-image').removeClass('active');
        }
      });
      $(document).on('click touchend touchcancel', function(e) {
        if ($(e.target).hasClass('projects-overlay')) {
          return;
        }
        if ($(e.target).parents('.projects-overlay').length) {
          return;
        }
        if ($(e.target).hasClass('mobile-menu-btn')) {
          return;
        }
        if ($(e.target).parents('.mobile-menu-btn').length) {
          return;
        }
        if ($(e.target).hasClass('projects-overlay-wrapper')) {
          return;
        }
        if ($(e.target).parents('.projects-overlay-wrapper').length) {
          return;
        }
        if ($(e.target).hasClass('mobile-menu-overlay')) {
          return;
        }
        if ($(e.target).parents('.mobile-menu-overlay').length) {
          return;
        }
        if ($(e.target).hasClass('above-footer__link')) {
          return;
        }
        if ($(e.target).parents('.above-footer__link').length) {
          return;
        }
        $('.projects-overlay-wrapper, .projects-overlay-image').removeClass('active');
        if (mobileMenuOpened) {
          mobileMenuOpened = !mobileMenuOpened;
          mobileNavBar.removeClass('active');
          $('.projects-overlay-image').removeClass('active');
          mobileBtn.removeClass('active');
          $('html, body').removeClass('noscroll');
        }
        e.stopPropagation();
      });
      checkPassword = function(form) {
        var formErrorMessage, password, passwordInput;
        formErrorMessage = form.find('.form-error-message');
        passwordInput = form.find('.password-input');
        password = passwordInput.val();
        if (form.attr('data-password') !== password) {
          formErrorMessage.show();
          return passwordInput.hide();
        } else {
          return window.location.href = form.attr('data-link');
        }
      };
      $('.password-input').on('keypress', function(e) {
        if (e.which === 13) {
          $('.single-project.opened').removeClass('opened');
          $(this).parent().parent().parent().addClass('opened');
          e.preventDefault();
          return checkPassword($(this).parent());
        }
      });
      $('.form-error-message').on('click', function() {
        $(this).parent().find('.form-error-message').hide();
        return $(this).parent().find('.password-input').show();
      });
      $('.single-project--info').on('mouseenter', function(ev) {
        var imageCloneUrl;
		var tagsCloneText;
        imageCloneUrl = $(this).siblings('.single-project--tumbnail').css('background-image').slice(5, -2);
		tagsCloneText = $(this).children('.single-project-tags').html();
        $('.project-image-clone').attr("src", imageCloneUrl).addClass('active');
		$('.project-tags-clone').empty().append(tagsCloneText).addClass('active');
        $('.single-project').removeClass('active opened');
        return $(this).parent().addClass('active');
      });
      $('.single-project--info').on('mouseleave', function(ev) {
        $('.project-image-clone').removeClass('active');
		$('.project-tags-clone').removeClass('active');
        return $('.single-project').removeClass('active');
      });
      $('.single-project--info').on('click', function(ev) {
        if ($(this).parent().attr('data-type') === 'Confidential') {
          $(this).parent().addClass('opened');
          return $(this).find('.single-project--name').addClass('active');
        } else {
          return window.location.href = $(this).find('.single-project--confidential').attr('data-link');
        }
      });

      $('.project-filter').on('click', function(ev) {
        var thisCategory = $(this).text();
        $('.project-filter').removeClass('active');
        $(this).addClass('active');

        if (thisCategory == 'All') {
          $(".single-project").fadeIn();
        } else {
          $(".single-project").hide().each(function(index) {
            $(this).find(".single-project--test").each(function(index) {
              if ($(this).text() == thisCategory) {
                $(this).closest(".single-project").fadeIn();
              }
            });
          });
        }
      });

      this._bindEvents();
    }

    HeaderController.prototype._bindEvents = function() {
      var _this = this;
      navLink.on('click', this._onNavLinkClick);
      $document.ready(this._onDocReady);
      $window.on('load', this._onWindowLoad);
      $window.on('touchmove', this._preventScrolling);
      $window.on('resize', this._onResize);
      $window.on('scroll', this._onWindowScroll);
      $window.on('keydown', this._onKeyDown);
      $window.on('resetBody', this._resetBody);
      mobileBtn.on('click', this._onMobileBtnClick);
      $window.on('checkMenu', this._checkMenuOffset);
      $window.on('requestProjectLoad', function(event, url) {
        return _this._onProjectLoadRequest(url);
      });
      $window.on('requestProjectsLoad', function(event, url) {
        return _this._onProjectsLoadRequest(url);
      });
      return $('.mobile-menu-overlay').on('touchmove', function(e) {
        return e.preventDefault();
      });
    };

    HeaderController.prototype._onResize = function(ev) {
      if (ev.isTrigger) {
        return;
      }
      if ($('.return-home-logo').css('display') === 'none') {
        $('.return-home-logo').toggle();
      }
      $('.projects-overlay-wrapper').css('padding-right', ($('.projects-overlay-wrapper').innerWidth() * 10) / 100);
      $('.projects-overlay-wrapper').css('padding-left', ($('.projects-overlay-wrapper').innerWidth() * 10) / 100);
      if ($window.width() >= 768) {
        $('.projects-overlay-wrapper, .projects-overlay-image').removeClass('active');
        mobileNavBar.removeClass('active');
        mobileBtn.removeClass('active');
        $('html, body').removeClass('noscroll');
      }
      if (mobileMenuOpened) {
        return mobileMenuOpened = !mobileMenuOpened;
      }
    };

    HeaderController.prototype._onKeyDown = function(ev) {
      if (ev.keyCode !== 27) {
        return;
      }
      $('.projects-overlay-wrapper, .projects-overlay-image').removeClass('active');
      $('html, body').removeClass('noscroll');
      return header.show();
    };

    HeaderController.prototype._onDocReady = function() {
      $('.projects-overlay-wrapper').css('padding-right', ($('.projects-overlay-wrapper').innerWidth() * 10) / 100);
      $('.projects-overlay-wrapper').css('padding-left', ($('.projects-overlay-wrapper').innerWidth() * 10) / 100);
      cacheProjectsPage();
      navLink.each(function(index, item) {
        var currentItem;
        currentItem = $(item);
        switch (index) {
          case 0:
            return currentItem.data('page', 'projects');
          case 1:
            return currentItem.data('page', 'about');
          case 2:
            return currentItem.data('page', 'contact');
          case 3:
            return currentItem.data('page', 'press');
          default:
            return currentItem.data('page', 'project-planner');
        }
      });
      return this._getBodyClasses();
    };

    HeaderController.prototype._onWindowScroll = function() {
      var delta, navbarHeight, st;
      if (window.preventHeaderSlide) {
        return;
      }
      st = $window.scrollTop();
      if (st <= 0) {
        return;
      }
      delta = 5;
      navbarHeight = menuOffsetDelimiter.height() - header.height() + 25;
      if (Math.abs(lastScrollTop - st) <= delta) {
        return;
      }
      if (st > lastScrollTop && st > navbarHeight) {
        header.addClass('nav-up');
      }
      if (st > lastScrollTop && st > navbarHeight + 10) {
        setTimeout(function() {
          return header.addClass('transparent');
        }, 100);
      } else {
        if (st < lastScrollTop && st < navbarHeight) {
          header.removeClass('transparent');
        }
        if (st + $(window).height() < $(document).height()) {
          header.removeClass('nav-up');
        }
      }
      lastScrollTop = st;
    };

    HeaderController.prototype._onWindowLoad = function() {
      return this._checkMenuOffset();
    };

    HeaderController.prototype._preventScrolling = function(e) {
      if ($('html, body').hasClass('noscroll')) {
        return e.preventDefault();
      }
    };

    HeaderController.prototype._checkMenuOffset = function() {
      menuOffsetDelimiter = $('.container-video--home');
      return $window.trigger('scroll');
    };

    HeaderController.prototype._initScroller = function() {
      return scrollerActive = true;
    };

    HeaderController.prototype._onMobileBtnClick = function() {
      mobileMenuOpened = !mobileMenuOpened;
      mobileBtn.addClass('active');
      mobileNavBar.addClass('active');
      $('.projects-overlay-image').addClass('active');
      $('html, body').addClass('noscroll');
      if (mobileMenuOpened) {
        this._cacheScrollTop();
        this._applyCachedScroll($html);
      } else {
        $html.removeClass('fixed-doc');
        this._removeCachedScroll($html, true);
        mobileNavBar.removeClass('active');
        $('.projects-overlay-image').removeClass('active');
        mobileBtn.removeClass('active');
        $('html, body').removeClass('noscroll');
      }
      headerNav.height($window.height());
      headerNav.stop().slideToggle(0);
      filterIcon.removeClass('icon-filter-x');
      return setTimeout(function() {
        window.preventHeaderSlide = false;
        return lastScrolledVal = $window.scrollTop();
      }, 500);
    };

    HeaderController.prototype._getBodyClasses = function() {
      navLink.each(function() {
        return bodyClasses.push($(this).data('page'));
      });
      bodyClasses.push('home');
      return bodyClasses.push('project');
    };

    HeaderController.prototype._selectLink = function(link) {
      navLink.each(function() {
        return $(this).removeClass('selected');
      });
      return link.addClass('selected');
    };

    cacheProjectsPage = function() {
      var url;
      url = $('.projects-link a').attr('href');
      return $.get(url).then(function(response) {
        var content, e, html;
        content = $(response).filter('.main-wrapper').children().filter(function() {
          return this.nodeName !== 'SCRIPT';
        });
        html = $(response).filter('.main-wrapper').html(content).wrap('<div>').parent().html();
        try {
          sessionStorage.setItem('projects-main-wrapper', html);
        } catch (_error) {
          e = _error;
          cachedPage = html;
        }
        return html;
      });
    };

    getProjectsPage = function() {
      var def, html;
      def = $.Deferred();
      if (cachedPage) {
        html = cachedPage;
      } else {
        html = sessionStorage.getItem('projects-main-wrapper');
      }
      if (html) {
        def.resolve(html);
      } else {
        cacheProjectsPage().then(function(html) {
          return def.resolve(html);
        });
      }
      return def;
    };

    HeaderController.prototype._getProjectsPage = function() {
      return getProjectsPage().then(function(html) {
        $('body').append($(html));
        $('body .main-wrapper').eq(1).addClass('inactive-wrapper').addClass('preslide').addClass('slide').addClass('projects');
        return $('.lazy').lazyload({
          effect: "fadeIn",
          container: $('body'),
          event: "sporty"
        }).trigger("sporty");
      });
    };

    HeaderController.prototype._onNavLinkClick = function(ev) {
      var isProjects, target, targetLink, targetPage;
      ev.preventDefault();
      if ($body.hasClass('projects')) {
        isProjects = true;
      } else {
        isProjects = false;
      }
      target = $(ev.currentTarget);
      targetLink = target.attr('href');
      targetPage = target.data('page');
      if (!targetLink) {
        return;
      }
      if ($body.hasClass(targetPage)) {
        return;
      }
      switch (targetPage) {
        case 'projects':
          this._cacheScrollTop();
          if (!$('.main-wrapper.projects').length) {
            this._getProjectsPage();
            this._displayProjectsPage();
          } else {
            this._displayProjectsPage();
          }
          break;
        case 'project-planner':
          if (!isProjects) {
            window.location.href = targetLink;
          } else {
            if (!$('.main-wrapper.project-planner').length) {
              this._slideOutAndNavigate(targetLink);
            } else {
              this._slideOutAndShow('project-planner');
            }
          }
          break;
        case 'about':
          if (!isProjects) {
            window.location.href = targetLink;
          } else {
            if (!$('.main-wrapper.about').length) {
              this._slideOutAndNavigate(targetLink);
            } else {
              this._slideOutAndShow('about');
            }
          }
          break;
        case 'contact':
          if (!isProjects) {
            window.location.href = targetLink;
          } else {
            if (!$('.main-wrapper.contact').length) {
              this._slideOutAndNavigate(targetLink);
            } else {
              this._slideOutAndShow('contact');
            }
          }
          break;
        case 'press':
          if (!isProjects) {
            window.location.href = targetLink;
          } else {
            if (!$('.main-wrapper.press').length) {
              this._slideOutAndNavigate(targetLink);
            } else {
              this._slideOutAndShow('press');
            }
          }
      }
      return window.history.pushState({
        page: targetPage
      }, null, targetLink);
    };

    HeaderController.prototype._cacheScrollTop = function() {
      return window.cachedScroll = $window.scrollTop();
    };

    HeaderController.prototype._applyCachedScroll = function(el, disableHeaderToggling) {
      el.css({
        top: -window.cachedScroll,
        'transition': 'none'
      });
      if (disableHeaderToggling) {
        return window.preventHeaderSlide = true;
      }
    };

    HeaderController.prototype._removeCachedScroll = function(el, disableHeaderToggling) {
      el.removeAttr('style');
      $window.scrollTop(window.cachedScroll);
      if (disableHeaderToggling) {
        return window.preventHeaderSlide = true;
      }
    };

    HeaderController.prototype._slideOutAndNavigate = function(url) {
      var animationDelay, mainWP,
        _this = this;
      mainWP = $('.main-wrapper.projects');
      $('.projects-left-btn').removeClass('visible');
      mainWP.removeClass('static').addClass('slide');
      if (header.hasClass('hidden')) {
        animationDelay = 0;
      } else {
        animationDelay = 700;
      }
      header.addClass('hidden');
      $('.projects-nav').removeClass('slide-in');
      setTimeout(function() {
        $('.projects-nav').hide();
        return $('.projects-nav').removeClass('slide-in');
      }, 850);
      setTimeout(function() {
        return $('.projects-nav').hide();
      }, 500);
      return setTimeout(function() {
        var topTransTimer;
        mainWP.removeAttr('style');
        topTransTimer = Math.max(500, window.cachedScroll / 2);
        mainWP.css({
          'transition': 'top ' + topTransTimer + 'ms'
        });
        mainWP.addClass('preslide');
        return setTimeout(function() {
          return window.location.href = url;
        }, topTransTimer);
      }, animationDelay);
    };

    HeaderController.prototype._slideOutAndShow = function(page) {
      var mainWP, targetMainW,
        _this = this;
      targetMainW = $('.main-wrapper.' + page);
      mainWP = $('.main-wrapper.projects');
      header.addClass('hidden');
      setTimeout(function() {
        $('.projects-nav').hide();
        return $('.projects-nav').removeClass('slide-in');
      }, 850);
      targetMainW.removeClass('hidden');
      mainWP.removeClass('static');
      $('.projects-left-btn').removeClass('visible');
      return setTimeout(function() {
        mainWP.addClass('preslide');
        targetMainW.removeClass('inactive-wrapper');
        _this._resetBody();
        $body.addClass(page);
        return setTimeout(function() {
          mainWP.addClass('inactive-wrapper');
          return header.removeClass('hidden');
        }, 600);
      }, 250);
    };

    HeaderController.prototype._displayProjectsPage = function() {
      var mainW, mainWP,
        _this = this;
      mainW = $('.main-wrapper').eq(0);
      mainWP = $('.main-wrapper.projects');
      header.addClass('hidden');
      mainWP.removeClass('inactive-wrapper');
      mainW.addClass('inactive-wrapper');
      this._applyCachedScroll(mainW);
      return setTimeout(function() {
        if (!window.projectsSkinBuilt) {
          require('modules/projects-skin');
        }
        mainWP.removeClass('preslide');
        setTimeout(function() {
          _this._resetBody();
          return $body.addClass('projects');
        }, 300);
        return setTimeout(function() {
          header.removeClass('hidden');
          $('.projects-left-btn').addClass('visible');
          $('.projects-nav').show().addClass('slide-in');
          return setTimeout(function() {
            mainW.addClass('hidden');
            mainWP.addClass('static');
            return document.title = "Case studies « Vuzum";
          }, 500);
        }, 500);
      }, 250);
    };

    HeaderController.prototype._hideProjectsPage = function(page) {
      var mainW, mainWP,
        _this = this;
      mainW = $('.main-wrapper').eq(0);
      mainWP = $('.main-wrapper.projects');
      header.addClass('hidden');
      setTimeout(function() {
        $('.projects-nav').hide();
        return $('.projects-nav').removeClass('slide-in');
      }, 850);
      mainWP.removeClass('static');
      $('.projects-left-btn').removeClass('visible');
      return setTimeout(function() {
        mainW.removeClass('hidden').removeClass('inactive-wrapper');
        _this._removeCachedScroll(mainW);
        mainWP.addClass('inactive-wrapper').addClass('preslide');
        _this._resetBody();
        $body.addClass(page);
        return setTimeout(function() {
          return header.removeClass('hidden');
        }, 500);
      }, 250);
    };

    HeaderController.prototype._onProjectLoadRequest = function(url) {
      this._cacheScrollTop();
      this._applyCachedScroll($('.main-wrapper.projects'), true);
      return this._slideOutAndNavigate(url);
    };

    HeaderController.prototype._onProjectsLoadRequest = function(url) {
      if (!$('.main-wrapper.projects').length) {
        this._getProjectsPage();
        this._displayProjectsPage();
      } else {
        this._displayProjectsPage();
      }
      window.history.pushState({
        page: 'projects'
      }, null, url);
      return $window.trigger('ajaxSuccessTriggered');
    };

    window.onpopstate = function(ev) {
      if (window.disablePopStateListener) {
        window.disablePopStateListener = false;
        return;
      }
      header.addClass('hidden');
      if (ev.state != null) {
        switch (ev.state.page) {
          case 'projects':
            if (!$('.main-wrapper.projects').length) {
              HeaderController.prototype._getProjectsPage();
              return HeaderController.prototype._displayProjectsPage();
            } else {
              return HeaderController.prototype._displayProjectsPage();
            }
            break;
          default:
            HeaderController.prototype._hideProjectsPage(ev.state.page);
            return window.location.reload();
        }
      } else {
        HeaderController.prototype._hideProjectsPage('home');
        return header.removeClass('hidden');
      }
    };

    HeaderController.prototype._onLogoClick = function(ev) {
      var mainW, target, targetLink;
      ev.preventDefault();
      if (mobileMenuOpened) {
        this._onMobileBtnClick();
      }
      target = $(ev.currentTarget);
      targetLink = target.attr('href');
      if (!$body.hasClass('projects')) {
        return setTimeout(function() {
          return window.location.href = targetLink;
        });
      } else {
        mainW = $('.main-wrapper.home');
        if (mainW.length) {
          this._hideProjectsPage('home');
          return window.history.pushState({
            page: 'home'
          }, null, targetLink);
        } else {
          return this._slideOutAndNavigate(targetLink);
        }
      }
    };

    HeaderController.prototype._resetBody = function() {
      var i, _i, _len;
      for (_i = 0, _len = bodyClasses.length; _i < _len; _i++) {
        i = bodyClasses[_i];
        $body.removeClass(i);
        this;
      }
      return this._checkMenuOffset();
    };

    return HeaderController;

  }).call(this);

  module.exports = new HeaderController;

}).call(this);
}});

window.require.define({"modules/homepage-gal": function(exports, require, module) {(function() {
  var $window, HomepageGallery, sectionImage, sectionTitle;

  $window = $(window);

  sectionImage = $('.project-image--overlay');

  sectionTitle = $('.featured-section--wrapper .section-title').not('.main-section-title');

  HomepageGallery = (function() {
    function HomepageGallery() {
      var type;
      this._bindEvents();
      $(document).ready(function() {
        return setInterval(type, 400);
      });
      return;
      type = function() {
        var dots;
        if (dots < 1) {
          $('#Fill-5, #Fill-7').append(':');
          return dots++;
        } else {
          $('#Fill-5, #Fill-7').html('');
          return dots = 0;
        }
      };
      return;
    }

    HomepageGallery.prototype._bindEvents = function() {
      sectionImage.on('mouseenter', this._onImageEnter);
      sectionImage.on('mouseleave', this._onItemLeave);
      sectionTitle.on('mouseenter', this._onTitleEnter);
      sectionTitle.on('mouseleave', this._onItemLeave);
      sectionImage.on('touchstart', this._onImageEnter);
      sectionImage.on('touchend', this._onItemLeave);
      sectionTitle.on('touchstart', this._onTitleEnter);
      return sectionTitle.on('touchend', this._onItemLeave);
    };

    HomepageGallery.prototype._onImageEnter = function(ev) {
      var target, targetTitle;
      target = $(ev.currentTarget);
      targetTitle = target.parents('.section-preview--wrapper').find('.section-title');
      return targetTitle.addClass('hover');
    };

    HomepageGallery.prototype._onTitleEnter = function(ev) {
      var target, targetImage;
      target = $(ev.currentTarget);
      target.addClass('hover');
      return targetImage = target.parents('.section-preview--wrapper').find('.project-image--overlay');
    };

    HomepageGallery.prototype._onItemLeave = function() {
      return sectionTitle.each(function() {
        return $(this).removeClass('hover');
      });
    };

    return HomepageGallery;

  })();

  module.exports = new HomepageGallery;

}).call(this);
}});

window.require.define({"modules/homepage-preloader": function(exports, require, module) {(function() {
  var $document, $window, HomepagePreloader, carousel, preloadOverlay;

  $window = $(window);

  $document = $(document);

  preloadOverlay = $('.preload-overlay');

  carousel = $('.royalSlider-wrapper');

  HomepagePreloader = (function() {
    function HomepagePreloader() {
      this._bindEvents();
      $(document).ready(function() {
        $('.showreel').click(function() {
          var video, videoOv;
          $('#fade-wrapper').fadeIn();
          videoOv = $('.videoOv');
          videoOv.get(0).play();
          video = $('.video');
          video.get(0).pause();
        });
        return $('#fade-wrapper').click(function() {
          var videoOv;
          $(this).fadeOut();
          videoOv = $('.videoOv');
          videoOv.get(0).pause();
        });
      });
      return;
    }

    HomepagePreloader.prototype._bindEvents = function() {
      return $window.on('onPageLoad', this._onPageLoad);
    };

    HomepagePreloader.prototype._onPageLoad = function() {
      return setTimeout(function() {
        $window.trigger('resize');
        $window.trigger('slideNav');
        preloadOverlay.fadeOut(700);
        setTimeout(function() {
          return carousel.removeClass('init');
        }, 500);
        return setTimeout(function() {
          return carousel.removeClass('wait');
        }, 2000);
      }, 700);
    };

    return HomepagePreloader;

  })();

  module.exports = new HomepagePreloader;

}).call(this);
}});

window.require.define({"modules/homepage-scrolling": function(exports, require, module) {(function() {
  var $content, $mainWrapper, $rs, $window, HomepageScrolling, is_touch,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $mainWrapper = $('.homepage--main-wrapper');

  $content = $('.homepage--main-wrapper .content-maxwidth');

  is_touch = window.ontouchstart !== void 0;

  $rs = $('.royalSlider-wrapper');

  HomepageScrolling = (function() {
    function HomepageScrolling() {
      this._onWindowScroll = __bind(this._onWindowScroll, this);
      this._bindEvents();
    }

    HomepageScrolling.prototype._bindEvents = function() {
      $window.on('resize', this._onWindowScroll);
      return $window.on('scroll', this._onWindowScroll);
    };

    HomepageScrolling.prototype._onWindowScroll = function() {
      var contentHeight, mainOffset, marginTop, scrollTop;
      if ($('.main-wrapper.home.inactive-wrapper').length || is_touch) {
        return false;
      }
      scrollTop = $window.scrollTop();
      mainOffset = $mainWrapper.offset().top;
      contentHeight = $content.find('.homepage-heading-quote').height();
      $rs.css({
        '-webkit-transform': "translateY(-" + (scrollTop / 3) + "px",
        '-moz-transform': "translateY(-" + (scrollTop / 3) + "px",
        '-o-transform': "translateY(-" + (scrollTop / 3) + "px",
        'transform': "translateY(-" + (scrollTop / 3) + "px"
      });
      if (scrollTop <= contentHeight || contentHeight >= $window.height()) {
        marginTop = 0;
      } else {
        marginTop = (scrollTop - contentHeight) / 2 - 65;
        if (marginTop < 0) {
          marginTop = 0;
        }
      }
      return $content.css('margin-top', marginTop + 'px');
    };

    return HomepageScrolling;

  })();

  module.exports = new HomepageScrolling;

}).call(this);
}});

window.require.define({"modules/homepage-skin": function(exports, require, module) {(function() {
  var $document, $window, HomepageSkin, body, header, homepageWrapper, videos,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  header = $('.header-wrapper');

  homepageWrapper = $('.homepage--main-wrapper');

  videos = $('.video');

  HomepageSkin = (function() {
    function HomepageSkin() {
      this._useHomepageSkin = __bind(this._useHomepageSkin, this);
      this._onResize = __bind(this._onResize, this);
      this._onReady = __bind(this._onReady, this);
      var checkPassword, divs, logo, videoLogo;
      videoLogo = $('.video-logo');
      this._onResize();
      $window.on('slideNav', this._navSlideIn);
      $window.on('resize', this._onResize);
      $document.on('ready', this._onReady);
      $('.conf-box').on('click', this._openConfProject);
      $('.public-box').on('click', this._openPublicProject);
      if (videoLogo.length > 0) {
        videoLogo.get(0).play();
      }
      this._useHomepageSkin();
      checkPassword = function(form) {
        var formErrorMessage, password, passwordInput;
        formErrorMessage = form.find('.form-error-message');
        passwordInput = form.find('.project-input');
        password = passwordInput.val();
        if (form.attr('data-password') !== password) {
          formErrorMessage.show();
          passwordInput.hide();
        } else {
          window.location.href = form.attr('data-link');
        }
      };
      $('.project-input').on('keypress', function(e) {
        if (e.which === 13) {
          e.preventDefault();
          return checkPassword($(this).parent());
        }
      });
	  $('.projects-overlay').on('click', function() {
        return $('.projects-overlay-wrapper, .projects-overlay-image').addClass('active');
      });
      $('.form-error-message').click(function() {
        $(this).parent().find('.form-error-message').hide();
        return $(this).parent().find('.project-input').show();
      });
      divs = $('.showreel');
      logo = $('.return-home-logo');
      $(window).on('scroll', function() {
        var offset, st;
        st = $(this).scrollTop();
        offset = 1 - (st / 310);
        divs.css({
          'opacity': offset
        });
        logo.css({
          'opacity': 0
        });
        if (offset <= 0) {
          logo.css({
            'opacity': 0 + ((st / 310) - 1)
          });
        }
      });
    }

    HomepageSkin.prototype._onReady = function() {
      var size_li, x;
      size_li = $('#myList .list-porject').size();
      x = 4;
      $('#myList .list-porject:lt(' + x + ')').show();
      return $('#load-more').click(function() {
        x = x + 5 <= size_li ? x + 5 : size_li;
        $('#myList .list-porject:lt(' + x + ')').show();
        if (x === size_li) {
          $('.see-more').hide();
        }
      });
    };

    HomepageSkin.prototype._onResize = function() {
      var headerOffsetLeft,
        _this = this;
      headerOffsetLeft = $('.header-inner-wrapper')[0].offsetLeft;
      $('.showreel').css('left', headerOffsetLeft);
      videos.map(function(index, elem) {
        if ($window.width() < 768) {
          return elem.play();
        } else {
          return elem.pause();
        }
      });
    };

    HomepageSkin.prototype._openConfProject = function(ev) {
      var isCloseButton;
      isCloseButton = $(ev.target).hasClass('confidential-project-close-button');
      if (isCloseButton) {
        $(this).find('.confidential-project').removeClass("active");
        $(this).find('.confidential-project').find('.confidential-content').removeClass("active");
        $(this).find('.confidential-project').find('.confidential-hide-element').removeClass("confidential-show-element");
      } else {
        $(this).find('.confidential-project').addClass("active");
        $(this).find('.confidential-project').find('.confidential-content').addClass("active");
        $(this).find('.confidential-project').find('.confidential-hide-element').addClass("confidential-show-element");
      }
    };

    HomepageSkin.prototype._openPublicProject = function(ev) {
      return window.location.href = $(this).attr('data-link');
    };

    HomepageSkin.prototype._navSlideIn = function() {
      return setTimeout(function() {
        return $window.trigger('checkMenu');
      }, 1400);
    };

    HomepageSkin.prototype._useHomepageSkin = function() {
      body.addClass('home');
      return homepageWrapper.parents('.main-wrapper').addClass('home');
    };

    return HomepageSkin;

  })();

  module.exports = new HomepageSkin;

}).call(this);
}});

window.require.define({"modules/homepage-slider": function(exports, require, module) {(function() {
  var $document, $firstSlider, $htmlBody, $nextArrow, $prevArrow, $secondSlider, $window, HomepageSlider, contentWrap, delay, header, is_touch,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $htmlBody = $('html, body');

  $document = $(document);

  header = $('.header-wrapper');

  contentWrap = $('.homepage--main-wrapper');

  $firstSlider = $('.first-slider__slick');

  $secondSlider = $('.second-slider__slick');

  $prevArrow = $('.first-slider__buttons__prev');

  $nextArrow = $('.first-slider__buttons__next');

  is_touch = window.ontouchstart !== void 0;

  delay = 0;

  HomepageSlider = (function() {
    function HomepageSlider() {
      this.firstSliderBeforeChange = __bind(this.firstSliderBeforeChange, this);
      this.configSecondSlider = __bind(this.configSecondSlider, this);
      this.initSecondSlider = __bind(this.initSecondSlider, this);
      this.firstSliderAfterChange = __bind(this.firstSliderAfterChange, this);
      this.configFirstSlider = __bind(this.configFirstSlider, this);
      this.initFirstSlider = __bind(this.initFirstSlider, this);
      this.initFirstSlider();
      this.configFirstSlider();
      this.firstSliderAfterChange();
      this.configSecondSlider();
      this.firstSliderBeforeChange();
    }

    HomepageSlider.prototype.initFirstSlider = function() {
      return $firstSlider.on('init', function(event, slick) {
        if (slick.currentSlide === 0) {
          $prevArrow.hide();
        } else if (slick.currentSlide === slick.slideCount) {
          $nextArrow.hide();
        }
      });
    };

    HomepageSlider.prototype.configFirstSlider = function() {
      return $firstSlider.slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: false,
        swipe: false,
        prevArrow: $prevArrow,
        nextArrow: $nextArrow
      });
    };

    HomepageSlider.prototype.firstSliderAfterChange = function() {
      return $firstSlider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
        if (slick.currentSlide === 0) {
          $prevArrow.hide();
          $nextArrow.show();
        } else if (slick.currentSlide === slick.slideCount - 1) {
          $nextArrow.hide();
          $prevArrow.show();
        }
        if (slick.currentSlide > 0 && slick.currentSlide < slick.slideCount - 1) {
          $prevArrow.show();
          return $nextArrow.show();
        }
      });
    };

    HomepageSlider.prototype.initSecondSlider = function() {
      return $secondSlider.on('init', function(event, slick) {
        $('.second-slider__slick__image').css('padding-top', $('.first-slider').outerHeight());
      });
    };

    HomepageSlider.prototype.configSecondSlider = function() {
      return $secondSlider.slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        adaptiveHeight: true,
        draggable: false
      });
    };

    HomepageSlider.prototype.firstSliderBeforeChange = function() {
      var _this = this;
      return $firstSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        return $secondSlider.slick('slickGoTo', nextSlide);
      });
    };

    return HomepageSlider;

  })();

  module.exports = new HomepageSlider;

}).call(this);
}});

window.require.define({"modules/lazy-load": function(exports, require, module) {(function() {
  var $body, $document, $window, LazyLoadImages;

  $window = $(window);

  $document = $(document);

  $body = $('body');

  LazyLoadImages = (function() {
    function LazyLoadImages() {
      $window.on('load', this._lazy);
    }

    LazyLoadImages.prototype._lazy = function() {
      return $('.lazy').lazyload({
        effect: "fadeIn",
        container: $('body'),
        skip_invisible: false
      });
    };

    return LazyLoadImages;

  })();

  module.exports = new LazyLoadImages;

}).call(this);
}});

window.require.define({"modules/lazy-load_sporty": function(exports, require, module) {(function() {
  var $document, $window, LazyLoadSporty,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  LazyLoadSporty = (function() {
    function LazyLoadSporty() {
      this._lazy = __bind(this._lazy, this);
      $window.on('load', this._lazy);
    }

    LazyLoadSporty.prototype._lazy = function() {
      $('.lazy').lazyload({
        effect: "fadeIn",
        container: $('body'),
        event: "sporty",
        skip_invisible: false
      });
      return this._lazyShow();
    };

    LazyLoadSporty.prototype._lazyShow = function() {
      return $(".lazy").trigger("sporty");
    };

    return LazyLoadSporty;

  })();

  module.exports = new LazyLoadSporty;

}).call(this);
}});

window.require.define({"modules/mobile-template": function(exports, require, module) {(function() {
  var $document, $window, MobileTemplate, body, mobileFrame, projectBlock, wrapper;

  $window = $(window);

  $document = $(document);

  body = $('body');

  wrapper = $('.content-maxwidth');

  mobileFrame = $('.mobile');

  projectBlock = $('.project-block');

  MobileTemplate = (function() {
    function MobileTemplate() {
      this._bindEvents();
    }

    MobileTemplate.prototype._bindEvents = function() {
      $window.on('load', this._setFrameSize);
      return $window.on('resize', this._setFrameSize);
    };

    MobileTemplate.prototype._setFrameSize = function(ev) {
      var _this = this;
      return projectBlock.map(function(index, elem) {
        var windowW, wrapperH;
        if ($(elem).children().hasClass('mobile')) {
          windowW = $window.width();
          wrapperH = $(elem).height();
          return $(elem).children().children().css({
            'height': Math.floor(wrapperH / 1.2),
            'width': Math.floor((wrapperH / 1.2) / 2)
          });
        }
      });
    };

    return MobileTemplate;

  })();

  module.exports = new MobileTemplate;

}).call(this);
}});

window.require.define({"modules/planner-skin": function(exports, require, module) {(function() {
  var $about, $budget, $company, $deadline, $document, $email, $name, ProjectsSkin, body, form, header, requiredFields, submitBtn, thankYou,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $document = $(document);

  body = $('body');

  header = $('.header-wrapper');

  requiredFields = $('form .required');

  $name = $('form .name');

  $email = $('form .email');

  $about = $('form .about');

  $company = $('form .company');

  $budget = $('form .budget');

  $deadline = $('form .deadline');

  form = $('form');

  thankYou = $('.thank-you--message');

  submitBtn = $('form button');

  ProjectsSkin = (function() {
    function ProjectsSkin() {
      this._usePlannerSkin = __bind(this._usePlannerSkin, this);
      this._onFormSubmit = __bind(this._onFormSubmit, this);
      this.validateField = __bind(this.validateField, this);
      var _this = this;
      $document.ready(this._usePlannerSkin);
      submitBtn.on('click', this._onFormSubmit);
      requiredFields.on('change', function(ev) {
        var cTarget, val;
        cTarget = $(ev.currentTarget);
        cTarget.removeClass('error');
        val = cTarget.val();
        if (cTarget.hasClass('name')) {
          localStorage.setItem('name', val);
        }
        if (cTarget.hasClass('email')) {
          localStorage.setItem('email', val);
        }
        if (cTarget.hasClass('about')) {
          localStorage.setItem('about', val);
        }
        if (cTarget.hasClass('budget')) {
          localStorage.setItem('budget', val);
        }
        if (cTarget.hasClass('deadline')) {
          return localStorage.setItem('deadline', val);
        }
      });
    }

    ProjectsSkin.prototype.validateEmail = function(email) {
      var re;
      re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      return re.test(email);
    };

    ProjectsSkin.prototype.validateField = function($el) {
      var error;
      error = false;
      $el.removeClass('error');
      if ($el.hasClass('input')) {
        if ($el.val().length < 3) {
          error = true;
        }
      }
      if ($el.hasClass('select')) {
        if (!$el.find('option:selected').val()) {
          error = true;
        }
      }
      if ($el.hasClass('email')) {
        if (!this.validateEmail($el.val())) {
          error = true;
        }
      }
      if (error) {
        return $el.addClass('error');
      }
    };

    ProjectsSkin.prototype._onFormSubmit = function(ev) {
      var _this = this;
      ev.preventDefault();
      requiredFields.each(function(i, el) {
        var $el;
        $el = $(el);
        return _this.validateField($el);
      });
      if ($('form .error').length || $company.val().length > 0) {
        return false;
      }
      return $.ajax({
        type: 'POST',
        dataType: 'html',
        cache: true,
        url: window.ajaxUrl,
        data: {
          action: 'send_planner',
          name: $name.val(),
          email: $email.val(),
          about: $about.val(),
          budget: $budget.val(),
          deadline: $deadline.val()
        },
        beforeSend: function() {
          form.addClass('hidden');
          return thankYou.addClass('sending visible');
        },
        success: function() {
          return _this._onSubmitSuccess();
        }
      });
    };

    ProjectsSkin.prototype._onSubmitSuccess = function() {
      thankYou.removeClass('sending');
      $("select").selectBoxIt('destroy');
      return setTimeout(function() {
        $name.val('');
        $email.val('');
        $about.val('');
        $budget.val('');
        $deadline.val('');
        localStorage.setItem('name', '');
        localStorage.setItem('email', '');
        localStorage.setItem('about', '');
        localStorage.setItem('budget', '');
        localStorage.setItem('deadline', '');
        $("select").selectBoxIt();
        thankYou.removeClass('visible');
        return form.removeClass('hidden');
      }, 5000);
    };

    ProjectsSkin.prototype._usePlannerSkin = function() {
      var _ref, _ref1, _ref2, _ref3, _ref4;
      if (!window.throttleSkinChange) {
        body.addClass('project-planner');
      }
      if ((_ref = localStorage.getItem('name')) != null ? _ref.length : void 0) {
        $name.val(localStorage.getItem('name'));
      }
      if ((_ref1 = localStorage.getItem('email')) != null ? _ref1.length : void 0) {
        $email.val(localStorage.getItem('email'));
      }
      if ((_ref2 = localStorage.getItem('about')) != null ? _ref2.length : void 0) {
        $about.val(localStorage.getItem('about'));
      }
      if ((_ref3 = localStorage.getItem('budget')) != null ? _ref3.length : void 0) {
        $budget.val(localStorage.getItem('budget'));
      }
      if ((_ref4 = localStorage.getItem('deadline')) != null ? _ref4.length : void 0) {
        $deadline.val(localStorage.getItem('deadline'));
      }
      return this._checkPage();
    };

    ProjectsSkin.prototype._checkPage = function() {
      $("select").selectBoxIt();
      setTimeout(function() {
        return $(window).trigger('checkMenu');
      }, 700);
      return $('.slide-in-page').removeClass('loading');
    };

    return ProjectsSkin;

  })();

  module.exports = new ProjectsSkin;

}).call(this);
}});

window.require.define({"modules/press-skin": function(exports, require, module) {(function() {
  var $body, $document, $firstSlider, $headerWrapper, $mainWrapper, $nextArrow, $prevArrow, $secondSlider, $window, PressSkin,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  $body = $('body');

  $mainWrapper = $('.main-wrapper');

  $headerWrapper = $('.header-wrapper');

  $firstSlider = $('.first-slider__slick');

  $secondSlider = $('.second-slider__slick');

  $prevArrow = $('.first-slider__buttons__prev');

  $nextArrow = $('.first-slider__buttons__next');

  PressSkin = (function() {
    function PressSkin() {
      this.firstSliderBeforeChange = __bind(this.firstSliderBeforeChange, this);
      this.configSecondSlider = __bind(this.configSecondSlider, this);
      this.firstSliderAfterChange = __bind(this.firstSliderAfterChange, this);
      this.configFirstSlider = __bind(this.configFirstSlider, this);
      this.initFirstSlider = __bind(this.initFirstSlider, this);
      this._useAboutSkin = __bind(this._useAboutSkin, this);
      this._useAboutSkin();
      this.initFirstSlider();
      this.configFirstSlider();
      this.firstSliderAfterChange();
      this.configSecondSlider();
      this.firstSliderBeforeChange();
    }

    PressSkin.prototype._useAboutSkin = function() {
      $body.addClass('press');
      $mainWrapper.addClass('press');
      this._slideInHeader();
      $headerWrapper.addClass('transparent').removeClass('nav-up');
      if ($body.hasClass('home')) {
        return $headerWrapper.removeClass('transparent');
      }
    };

    PressSkin.prototype._slideInHeader = function() {
      setTimeout(function() {
        return $window.trigger('checkMenu');
      }, 700);
      return $('.slide-in-page').removeClass('loading');
    };

    PressSkin.prototype.initFirstSlider = function() {
      return $firstSlider.on('init', function(event, slick) {
        if (slick.currentSlide === 0) {
          $prevArrow.hide();
        } else if (slick.currentSlide === slick.slideCount) {
          $nextArrow.hide();
        }
      });
    };

    PressSkin.prototype.configFirstSlider = function() {
      return $firstSlider.slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        draggable: false,
        swipe: false,
        prevArrow: $prevArrow,
        nextArrow: $nextArrow
      });
    };

    PressSkin.prototype.firstSliderAfterChange = function() {
      return $firstSlider.on('afterChange', function(event, slick, currentSlide, nextSlide) {
        if (slick.currentSlide === 0) {
          $prevArrow.hide();
          $nextArrow.show();
        } else if (slick.currentSlide === slick.slideCount - 1) {
          $nextArrow.hide();
          $prevArrow.show();
        }
        if (slick.currentSlide > 0 && slick.currentSlide < slick.slideCount - 1) {
          $prevArrow.show();
          return $nextArrow.show();
        }
      });
    };

    PressSkin.prototype.configSecondSlider = function() {
      return $secondSlider.slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        adaptiveHeight: true,
        draggable: false
      });
    };

    PressSkin.prototype.firstSliderBeforeChange = function() {
      var _this = this;
      return $firstSlider.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        return $secondSlider.slick('slickGoTo', nextSlide);
      });
    };

    return PressSkin;

  })();

  module.exports = new PressSkin;

}).call(this);
}});

window.require.define({"modules/project-scrolling": function(exports, require, module) {(function() {
  var $window, ProjectScrolling, columns, header, heroImage, isLoaded, is_touch, stickyActive, wW, wrapper,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  columns = $('.sticky-block');

  wrapper = $('.content-maxwidth');

  stickyActive = false;

  isLoaded = false;

  header = $('.header-main-nav');

  heroImage = $('.project-hero-image');

  wW = 0;

  is_touch = window.ontouchstart !== void 0;

  ProjectScrolling = (function() {
    function ProjectScrolling() {
      this._onWindowResize = __bind(this._onWindowResize, this);
      this._onWindowScroll = __bind(this._onWindowScroll, this);
      this._initScroll = __bind(this._initScroll, this);
      this._bindEvents();
    }

    ProjectScrolling.prototype._bindEvents = function() {
      $window.on('load', this._initScroll);
      $window.on('resize', this._onWindowResize);
      $window.on('scroll', this._onWindowScroll);
      return $(document).ready(this._checkDevice);
    };

    ProjectScrolling.prototype._checkDevice = function() {
      if (is_touch) {
        return $('.project-content-wrapper').addClass('transformed');
      }
    };

    ProjectScrolling.prototype._initScroll = function() {
      isLoaded = true;
      if (wW > 640 && !is_touch) {
        stickyActive = true;
        return columns.stick_in_parent({
          parent: '.sticky-row--wrapper',
          offset_top: 65
        });
      }
    };

    ProjectScrolling.prototype._onWindowScroll = function() {
      $(document.body).trigger("sticky_kit:recalc");
      if ($window.scrollTop() > heroImage.height()) {
        return header.addClass('bordered');
      } else {
        return header.removeClass('bordered');
      }
    };

    ProjectScrolling.prototype._onWindowResize = function() {
      wW = $window.width() + window.scrollBarWidth;
      if (wW > 640 && !is_touch) {
        if (stickyActive) {
          return $(document.body).trigger("sticky_kit:recalc");
        } else {
          if (isLoaded) {
            return this._initScroll();
          }
        }
      } else {
        if (stickyActive) {
          columns.trigger("sticky_kit:detach");
          return stickyActive = false;
        }
      }
    };

    return ProjectScrolling;

  })();

  module.exports = new ProjectScrolling;

}).call(this);
}});

window.require.define({"modules/project-sidebar": function(exports, require, module) {(function() {
  var $doc, $window, PageNav, allowBsSkin, animatingScroll, bottomSection, bsOffset, bsSkinActive, currentSectionName, offsetsArray, pageNav, pageNavItem, pageNavVisible, projectSection, scrollTop, wHeight,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $doc = $('html');

  wHeight = 0;

  scrollTop = 0;

  pageNav = $('.page-nav');

  pageNavItem = $('.page-nav ul li');

  pageNavVisible = false;

  projectSection = $('.project-section');

  currentSectionName = null;

  animatingScroll = false;

  bottomSection = $('.project--bottom-section');

  bsSkinActive = false;

  bsOffset = 0;

  allowBsSkin = false;

  offsetsArray = [];

  PageNav = (function() {
    function PageNav() {
      this._checkSectionVisibility = __bind(this._checkSectionVisibility, this);
      this._onPageNavClick = __bind(this._onPageNavClick, this);
      this._onWindowScroll = __bind(this._onWindowScroll, this);
      this._getSectionsOffsets = __bind(this._getSectionsOffsets, this);
      this._getBottomSectionOffset = __bind(this._getBottomSectionOffset, this);
      this._onPageLoad = __bind(this._onPageLoad, this);
      this._onWindowLoad = __bind(this._onWindowLoad, this);
      this._bindEvents();
    }

    PageNav.prototype._bindEvents = function() {
      this._getSectionsOffsets();
      $window.on('load', this._onWindowLoad);
      $window.on('resize', this._getBottomSectionOffset);
      $window.on('scroll', this._onWindowScroll);
      $window.on('mousewheel', this._onWindowMouseWheel);
      $window.on('resize', this._getSectionsOffsets);
      $window.on('onPageLoad', this._onPageLoad);
      return pageNavItem.on('click', this._onPageNavClick);
    };

    PageNav.prototype._onWindowLoad = function() {
      return this._getBottomSectionOffset();
    };

    PageNav.prototype._onPageLoad = function() {
      this._getBottomSectionOffset();
      return allowBsSkin = !allowBsSkin;
    };

    PageNav.prototype._getBottomSectionOffset = function() {
      wHeight = $window.height();
      return bsOffset = 0;
    };

    PageNav.prototype._getSectionsOffsets = function() {
      offsetsArray.length = 0;
      return projectSection.each(function() {
        var currentSection, sectionOffset;
        currentSection = $(this);
        sectionOffset = currentSection.offset().top - 65;
        return offsetsArray.push(sectionOffset);
      });
    };

    PageNav.prototype._onWindowMouseWheel = function() {
      return $doc.stop();
    };

    PageNav.prototype._onWindowScroll = function() {
      scrollTop = $window.scrollTop();
      if (scrollTop > 816) {
        if (!pageNavVisible) {
          pageNavVisible = true;
          this._toggleNav();
        }
      } else {
        if (pageNavVisible) {
          pageNavVisible = false;
          this._toggleNav();
        }
      }
      this._getSectionsOffsets();
      this._checkSectionVisibility();
      if (!allowBsSkin) {
        return;
      }
      if (scrollTop + wHeight > bsOffset) {
        if (!bsSkinActive) {
          bsSkinActive = true;
          return this._toggleBottomSkin();
        }
      } else {
        if (bsSkinActive) {
          bsSkinActive = false;
          return this._toggleBottomSkin();
        }
      }
    };

    PageNav.prototype._toggleBottomSkin = function() {
      return $doc.toggleClass('bottom-section--skin');
    };

    PageNav.prototype._toggleNav = function() {
      return pageNav.toggleClass('visible');
    };

    PageNav.prototype._onPageNavClick = function(ev) {
      var target, targetDataSection, targetOffset, targetSection;
      target = $(ev.currentTarget);
      targetDataSection = target.data('section');
      this._deselectItems();
      target.addClass('selected');
      targetSection = $('.' + targetDataSection);
      targetOffset = offsetsArray[offsetsArray.length - target.index() - 1];
      animatingScroll = true;
      return $('html, body').animate({
        scrollTop: targetOffset
      }, {
        duration: 1000,
        complete: function() {
          return animatingScroll = false;
        }
      });
    };

    PageNav.prototype._checkSectionVisibility = function() {
      var i, _i, _ref, _results;
      if (animatingScroll) {
        return;
      }
      _results = [];
      for (i = _i = _ref = offsetsArray.length - 1; _ref <= 0 ? _i <= 0 : _i >= 0; i = _ref <= 0 ? ++_i : --_i) {
        if (scrollTop >= offsetsArray[i]) {
          this._deselectItems();
          pageNavItem.eq(offsetsArray.length - i - 1).addClass('selected');
          break;
        } else {
          _results.push(void 0);
        }
      }
      return _results;
    };

    PageNav.prototype._deselectItems = function() {
      return pageNavItem.each(function() {
        return $(this).removeClass('selected');
      });
    };

    return PageNav;

  })();

  module.exports = new PageNav;

}).call(this);
}});

window.require.define({"modules/project-skin": function(exports, require, module) {(function() {
  var $document, $html, $window, ProjectSkin, animContainers, body, countFlag, debounce, desktopDesc, fraction, header, heroImage, maxwidth, preloadOverlay, projectContent, rangeClick, slickModule, videoContControlls, videoContainers, videos, wWidth, windowWidth,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  $html = $('html');

  maxwidth = $('.content-maxwidth');

  projectContent = $('.project-content-wrapper');

  heroImage = $('.project-hero-image');

  preloadOverlay = $('.project--preload-overlay');

  desktopDesc = $('.project-section.project-info > .project-details--wrapper');

  header = $('.header-wrapper');

  wWidth = 0;

  videoContainers = $('.container-video');

  videoContControlls = $('.with-controls');

  videos = $('.video');

  animContainers = $('.section-animation');

  fraction = 0.01;

  slickModule = $(".slick-module");

  rangeClick = false;

  countFlag = 0;

  windowWidth = 0;

  window.preventHeaderSlide = false;

  $.fn.is_on_screen = function() {
    var bounds, viewport, win;
    win = $(window);
    viewport = {
      top: win.scrollTop(),
      left: win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();
    bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();
    return !(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom + 200 < bounds.top || viewport.top - 200 > bounds.bottom);
  };

  debounce = function(func, wait, immediate) {
    var timeout;
    timeout = void 0;
    return function() {
      var args, callNow, context, later;
      context = this;
      args = arguments;
      later = function() {
        timeout = null;
        if (!immediate) {
          func.apply(context, args);
        }
      };
      callNow = immediate && !timeout;
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
      if (callNow) {
        func.apply(context, args);
      }
    };
  };

  ProjectSkin = (function() {
    function ProjectSkin() {
      this._useProjectsSkin = __bind(this._useProjectsSkin, this);
      this._setRowSpacing = __bind(this._setRowSpacing, this);
      this._onPageLoad = __bind(this._onPageLoad, this);
      this._checkScroll = __bind(this._checkScroll, this);
      this._onResize = __bind(this._onResize, this);
      this.setVideoControlls = __bind(this.setVideoControlls, this);
      var _ref,
        _this = this;
      windowWidth = $window.width();
      this._bindEvents();
      if ((_ref = $(".slick-module")) != null) {
        _ref.slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          useTransform: false,
          focusOnSelect: true,
          centerMode: true,
          centerPadding: '135px',
          speed: 400,
          useTransform: true,
          cssEase: 'ease-out',
          responsive: [
            {
              breakpoint: 768,
              settings: {
                centerPadding: '0px'
              }
            }
          ]
        });
      }
      this.onResizeDebounce = debounce(function() {
        _this._setRowSpacing();
        return setTimeout(function() {
          return _this._setRowSpacing();
        }, 600);
      }, 300);
      $('.above-footer__link').on('click', function() {
        return $('.projects-overlay-wrapper').addClass('active');
      });
      $('.slick-nav--prev').on('click', function() {
        return $(this).siblings('.slick-module').slick("slickPrev");
      });
      $('.slick-nav--next').on('click', function() {
        return $(this).siblings('.slick-module').slick("slickNext");
      });
      $('.header-wrapper').addClass('transparent').removeClass('nav-up');
      if ($window.width() < 768) {
        $('.video')[0].pause();
      }
      this.setVideoControlls();
    }

    ProjectSkin.prototype.setVideoControlls = function() {
      var _this = this;
      return videoContControlls.map(function(index, elem) {
        var muteButton, playButton, seekBar, videoControls, videoPlayer;
        videoPlayer = $(elem).find('.video');
        videoControls = $(elem).find('.video-controls');
        playButton = videoControls.find('.play-button');
        seekBar = videoControls.find('.seek-bar');
        muteButton = videoControls.find('.mute-button');
        videoPlayer[0].muted = true;
        muteButton.find('.mute-button__off').attr("class", "mute-button__off");
        muteButton.find('.mute-button__on').attr("class", "mute-button__on active");
        playButton.on('click', function() {
          if (videoPlayer[0].paused) {
            videoPlayer[0].play();
            playButton.find('.play-button__play').removeClass('active');
            return playButton.find('.play-button__pause').addClass('active');
          } else {
            videoPlayer[0].pause();
            playButton.find('.play-button__pause').removeClass('active');
            return playButton.find('.play-button__play').addClass('active');
          }
        });
        muteButton.on('click', function() {
          if (!videoPlayer[0].muted) {
            videoPlayer[0].muted = true;
            muteButton.find('.mute-button__off').attr("class", "mute-button__off");
            return muteButton.find('.mute-button__on').attr("class", "mute-button__on active");
          } else {
            videoPlayer[0].muted = false;
            muteButton.find('.mute-button__on').attr("class", "mute-button__on");
            return muteButton.find('.mute-button__off').attr("class", "mute-button__off active");
          }
        });
        seekBar.on('mousedown', function() {
          rangeClick = true;
          return videoPlayer[0].pause();
        });
        seekBar.on('mousemove', function() {
          var buf, value;
          if (!rangeClick) {
            return;
          }
          value = $(this).val();
          buf = ((100 - value) / 4) + parseInt(value);
          return seekBar.css({
            'background': 'linear-gradient(to right, #3E005C 0%, #3E005C ' + value + '%, #979797 ' + value + '%, #979797 ' + buf + '%, #979797 ' + buf + '%, #979797 100%)'
          });
        });
        seekBar.on('mouseup', function() {
          rangeClick = false;
          return videoPlayer[0].play();
        });
        seekBar.on('change', function() {
          var time;
          time = videoPlayer[0].duration * (seekBar[0].value / 100);
          return videoPlayer[0].currentTime = time;
        });
        return videoPlayer.on('timeupdate', function() {
          var buf, value, _ref;
          value = (100 / videoPlayer[0].duration) * videoPlayer[0].currentTime;
          if ((_ref = seekBar[0]) != null) {
            _ref.value = value;
          }
          if (value >= 100 || videoPlayer[0].paused) {
            playButton.find('.play-button__pause').removeClass('active');
            playButton.find('.play-button__play').addClass('active');
          } else {
            playButton.find('.play-button__play').removeClass('active');
            playButton.find('.play-button__pause').addClass('active');
          }
          buf = ((100 - value) / 4) + parseInt(value);
          return seekBar.css({
            'background': 'linear-gradient(to right, #3E005C 0%, #3E005C ' + value + '%, #979797 ' + value + '%, #979797 ' + buf + '%, #979797 ' + buf + '%, #979797 100%)'
          });
        });
      });
    };

    ProjectSkin.prototype._bindEvents = function() {
      var _this = this;
      $document.ready(this._useProjectsSkin);
      $window.on('resize', this._onResize);
      $window.on('onPageLoad', this._onPageLoad);
      window.addEventListener('scroll', this._checkScroll);
      $('.mobile-playable svg').on('touchend touchcancel', this._playMobileVideo);
      return $window.on('load', function() {
        return setTimeout(function() {
          $window.trigger('resize');
          return $('.setting-up').removeClass('setting-up');
        }, 500);
      });
    };

    ProjectSkin.prototype._onResize = function() {
      windowWidth = $window.width();
      if (windowWidth < 992) {
        $('.mobile-playable').css('height', $('.mobile-video').height());
      }
      this._checkScroll();
      return this.onResizeDebounce();
    };

    ProjectSkin.prototype._playMobileVideo = function(e) {
      var thisVideo;
      thisVideo = $(this).parent().parent().find('.mobile-video')[0];
      thisVideo.play();
      if (typeof thisVideo.webkitEnterFullscreen !== 'undefined') {
        return thisVideo.webkitEnterFullscreen();
      } else if (typeof thisVideo.webkitRequestFullscreen !== 'undefined') {
        return thisVideo.webkitRequestFullscreen();
      } else if (typeof thisVideo.mozRequestFullScreen !== 'undefined') {
        return thisVideo.mozRequestFullScreen();
      }
    };

    ProjectSkin.prototype._checkScroll = function() {
      var _this = this;
      if ($window.width() >= 768) {
        videos.map(function(index, elem) {
          if ($(elem).is_on_screen()) {
            return elem.play();
          } else {
            return elem.pause();
          }
        });
      }
      animContainers.map(function(index, elem) {
        if ($(elem).is_on_screen()) {
          return $(elem).addClass('anim-active');
        }
      });
    };

    ProjectSkin.prototype._onPageLoad = function() {
      var _this = this;
      preloadOverlay.fadeOut(700);
      return setTimeout(function() {
        return $window.trigger('checkMenu');
      }, 1400);
    };

    ProjectSkin.prototype._setRowSpacing = function() {
      var containerWidth, wHeight;
      wHeight = $window.height();
      containerWidth = $(maxwidth[1]).width();
      this._setHeroImageSize(wHeight, containerWidth);
      return this._setHeadingColsSpacing(containerWidth);
    };

    ProjectSkin.prototype._setHeroImageSize = function(wHeight, containerWidth) {
      var linearGradient, oldBI;
      if (heroImage.css('background-image') !== 'none' && countFlag === 0) {
        countFlag++;
        oldBI = heroImage.css('background-image');
        linearGradient = ', linear-gradient(-180deg, rgba(0,0,0,0) 0%, #646464 100%)';
        heroImage.css('background-image', oldBI + linearGradient);
      }
      if (wWidth + window.scrollBarWidth < 640) {
        return projectContent.css({
          'margin-top': heroImage.height()
        });
      } else {
        return projectContent.css({
          'margin-top': heroImage.height()
        });
      }
    };

    ProjectSkin.prototype._setHeadingColsSpacing = function(containerWidth) {
      var viewPortWidth, wrapper;
      viewPortWidth = wWidth + window.scrollBarWidth;
      wrapper = containerWidth;
      if (viewPortWidth > 640) {
        if (viewPortWidth > 768) {
          return desktopDesc.css({
            'margin-left': wrapper * .02
          });
        } else {
          return desktopDesc.css({
            'margin-left': wrapper * .03
          });
        }
      } else {
        return desktopDesc.css({
          'margin-left': 0
        });
      }
    };

    ProjectSkin.prototype._useProjectsSkin = function() {
      body.addClass('project');
      setTimeout(function() {
        return $('.overlay--page-title').fadeIn(700);
      }, 200);
      return this.onResizeDebounce();
    };

    ProjectSkin.prototype._lazyLoadImg = function() {
      return $('.lazy').lazyload({
        effect: "fadeIn",
        event: "sporty"
      });
    };

    ProjectSkin.prototype._displayImages = function() {
      return $('.lazy').trigger('sporty');
    };

    return ProjectSkin;

  })();

  module.exports = new ProjectSkin;

}).call(this);
}});

window.require.define({"modules/projects-skin": function(exports, require, module) {(function() {
  var $document, $window, ProjectsSkin, body, header, projectsPage, projectsWrap,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  header = $('.header-wrapper');

  projectsPage = $('.main-wrapper.projects');

  projectsWrap = projectsPage.find('.projects-page');

  ProjectsSkin = (function() {
    function ProjectsSkin() {
      this._useProjectsSkin = __bind(this._useProjectsSkin, this);
      $document.ready(this._useProjectsSkin);
      $window.on('resize', this._onResize);
    }

    ProjectsSkin.prototype._onResize = function() {
      return projectsWrap.css('min-height', $window.height() - parseInt(projectsPage.css('padding-top')));
    };

    ProjectsSkin.prototype._useProjectsSkin = function() {
      if (!window.throttleSkinChange) {
        body.addClass('projects');
      }
      return this._checkPage();
    };

    ProjectsSkin.prototype._checkPage = function() {
      projectsWrap = $('.projects-page');
      projectsPage = projectsWrap.parents('.main-wrapper');
      projectsPage.addClass('projects');
      this._onResize();
      return setTimeout(function() {
        $(window).trigger('checkMenu');
        return $('.projects-nav').show().addClass('slide-in');
      }, 700);
    };

    return ProjectsSkin;

  })();

  module.exports = new ProjectsSkin;

}).call(this);
}});

window.require.define({"modules/slidecontent-animation": function(exports, require, module) {(function() {
  var $document, $window, slideContent, slideContentAnim;

  $window = $(window);

  $document = $(document);

  slideContent = $('.toggle-visibility');

  slideContentAnim = (function() {
    function slideContentAnim() {
      this._bindEvents();
    }

    slideContentAnim.prototype._bindEvents = function() {
      $window.on('load', this._setVisibility);
      return $window.on('scroll', this._setVisibility);
    };

    slideContentAnim.prototype._setVisibility = function() {
      var opacityVal, scrollTop;
      scrollTop = $window.scrollTop();
      opacityVal = Math.min(Math.max((100 - scrollTop * 100 / 145) / 100, 0), 1);
      return slideContent.css({
        'opacity': opacityVal
      });
    };

    return slideContentAnim;

  })();

  module.exports = new slideContentAnim;

}).call(this);
}});

window.require.define({"modules/structured-page": function(exports, require, module) {(function() {
  var $window, StructuredPageController, aboutContentDetails, contentDetail, contentHeadTitle, contentService, contentTitle, contentWrap, expandElActive, expandElement, footer, header, lastContentDetailElem, structuredPage,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  header = $('.header-wrapper');

  footer = $('.footer-wrapper');

  structuredPage = $('.structured-line-page');

  contentDetail = $('.content-detail-col');

  contentService = $('.content-service-col');

  contentTitle = $('.content-title-col');

  contentWrap = $('.content-wrap');

  expandElActive = $('.expand-active');

  expandElement = $('.expand-element');

  contentHeadTitle = $('.content-title-head-col');

  aboutContentDetails = $('.about-content-details');

  lastContentDetailElem = [];

  StructuredPageController = (function() {
    function StructuredPageController() {
      this._onClickHeaderCol = __bind(this._onClickHeaderCol, this);
      this._onResize = __bind(this._onResize, this);
      this.setPageSize();
      this.setContentSize();
      this._bindEvents();
    }

    StructuredPageController.prototype._bindEvents = function() {
      $window.on('resize', this._onResize);
      return contentTitle.on('click', this._onClickHeaderCol);
    };

    StructuredPageController.prototype._onResize = function() {
      this.setContentSize();
      return this.setPageSize();
    };

    StructuredPageController.prototype._onClickHeaderCol = function(ev) {
      var elem;
      console.log('clicked');
      elem = $(ev.currentTarget);
      if (elem.hasClass('expand-active')) {
        if (elem.data('expanded')) {
          elem.data('expanded', false);
          elem.removeClass('is-expanded');
          elem.parent().find('.expand-element').slideUp(250);
          return elem.parent().find('.faq-element').slideUp(250);
        } else {
          elem.data('expanded', true);
          elem.addClass('is-expanded');
          return elem.parent().find('.expand-element').slideDown(250);
        }
      }
    };

    StructuredPageController.prototype.setPageSize = function() {
      var footerHeight, headerHeight, pageHeight, screenHeight;
      headerHeight = header.outerHeight();
      footerHeight = footer.outerHeight();
      screenHeight = $window.height();
      pageHeight = screenHeight - headerHeight;
      return structuredPage.css({
        'min-height': pageHeight - headerHeight + 'px'
      });
    };

    StructuredPageController.prototype.setElementsForScreenSize = function(col) {
      var n,
        _this = this;
      lastContentDetailElem = [];
      n = col + 1;
      expandElement.css({
        'display': 'inline-block'
      });
      contentDetail.removeClass('offset-top');
      contentDetail.removeClass('offset-bottom');
      contentService.removeClass('offset-service-top');
      contentTitle.removeClass('expand-active');
      contentWrap.last().css({
        'border-width': '1px'
      });
      contentWrap.each(function(k, line) {
        var elem1, elem2;
        elem1 = $(line).find('.content-detail-col');
        elem2 = $(line).find('.content-service-col');
        elem1.each(function(i, el1) {
          if (i !== 0) {
            if (i % col === 0 || i === col) {
              lastContentDetailElem.push(elem1[i]);
            }
          }
          if (i > col - 1) {
            return $(el1).addClass('offset-top');
          }
        });
        if (elem2.length > 0) {
          return elem2.each(function(ii, el2) {
            if (ii !== 0) {
              if (ii % 2 === 0 || ii === 2) {
                lastContentDetailElem.push(elem2[ii]);
              }
            }
            if (ii > 1) {
              return $(el2).addClass('offset-service-top');
            }
          });
        }
      });
      contentDetail.removeClass('offset-2');
      if (lastContentDetailElem.length > 1) {
        return $(lastContentDetailElem).each(function(j, item) {
          return $(item).addClass('offset-2');
        });
      } else {
        return $(lastContentDetailElem[0]).addClass('offset-2');
      }
    };

    StructuredPageController.prototype.setElementsForSmallSize = function() {
      var _this = this;
      contentTitle.each(function(i, element) {
        if ($(element).data('expanded')) {
          return $(element).parent().find('.expand-element').css({
            'display': 'inline-block'
          });
        } else {
          return $(element).parent().find('.expand-element').css({
            'display': 'none'
          });
        }
      });
      contentTitle.addClass('expand-active');
      $('.content-service-col:not(:first)').addClass('offset-service-top');
      contentService.removeClass('offset-top').removeClass('offset-2');
      contentDetail.removeClass('offset-top');
      contentDetail.removeClass('offset-2');
      contentWrap.last().css({
        'border-width': '0'
      });
      return contentWrap.each(function(k, line) {
        var elem, l;
        elem = $(line).find('.content-detail-col');
        l = elem.length - 1;
        return elem.each(function(i, el) {
          if (i < l) {
            return $(el).addClass('offset-bottom');
          }
        });
      });
    };

    StructuredPageController.prototype.setContentSize = function() {
      var screenWidth, scrollBarWidth;
      scrollBarWidth = window.scrollBarWidth;
      screenWidth = $window.width() + scrollBarWidth;
      if (screenWidth > 1024) {
        this.setElementsForScreenSize(3);
        contentDetail.removeClass('col-1').removeClass('col-3').addClass('col-2');
        return aboutContentDetails.removeClass('col-6').addClass('col-4');
      } else {
        if (screenWidth > 640) {
          this.setElementsForScreenSize(2);
          contentDetail.removeClass('col-1').removeClass('col-2').addClass('col-3');
          return aboutContentDetails.removeClass('col-4').addClass('col-6');
        } else {
          this.setElementsForSmallSize();
          return contentDetail.removeClass('col-2').removeClass('col-3').addClass('col-1');
        }
      }
    };

    return StructuredPageController;

  })();

  module.exports = new StructuredPageController;

}).call(this);
}});

window.require.define({"modules/tablet-template": function(exports, require, module) {(function() {
  var $document, $window, TabletTemplate, body, hwLandscapeScr, hwLandscapeTab, landScapeScreenMulti, landScapeTabMulti, landscapeScreen, landscapeTablet, mosaicLeft, mosaicRight, projectBlock, sliderLarge, sliderSmall, tabletFrame, threeImagesTemplate, twoImages, twoImagesStacked, twoImagesTemplate, wrapper,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $window = $(window);

  $document = $(document);

  body = $('body');

  wrapper = $('.content-maxwidth');

  tabletFrame = $('.portrait .tablet');

  landscapeTablet = $('.landscape .tablet');

  landscapeScreen = $('.landscape .screen');

  landScapeTabMulti = $('.landscape.fw-multiple .tablet');

  landScapeScreenMulti = $('.landscape.fw-multiple .screen');

  hwLandscapeTab = $('.half-width--tab .tablet');

  hwLandscapeScr = $('.half-width--tab .screen');

  mosaicLeft = $('.mosaic-left');

  mosaicRight = $('.mosaic-right');

  twoImagesTemplate = $('.two-images--template');

  twoImages = $('.two-images--template .project-image, .two-images--template .content');

  twoImagesStacked = $('.two-images--stacked .project-image');

  sliderLarge = $('.col-8 .project-block--slider');

  sliderSmall = $('.col-4 .project-block--slider');

  projectBlock = $('.project-block');

  threeImagesTemplate = $('.three-images');

  TabletTemplate = (function() {
    var _getOriginalRatio;

    function TabletTemplate() {
      this._setFrameSize = __bind(this._setFrameSize, this);
      this._bindEvents();
    }

    TabletTemplate.prototype._bindEvents = function() {
      $window.on('load', this._setFrameSize);
      return $window.on('resize', this._setFrameSize);
    };

    TabletTemplate.prototype._setFrameSize = function() {
      var windowW, wrapperW;
      wrapperW = $('.project-block').width();
      windowW = $window.width() + window.scrollBarWidth;
      if (windowW > 640) {
        tabletFrame.css({
          'height': Math.floor(wrapperW * .4)
        });
        landscapeTablet.css({
          'height': Math.floor(wrapperW * .4237)
        });
        landscapeScreen.css({
          'height': Math.floor(landscapeTablet.outerHeight() - 50)
        });
        hwLandscapeTab.css({
          'height': Math.floor(wrapperW * .2118)
        });
        hwLandscapeScr.css({
          'height': Math.floor(hwLandscapeTab.outerHeight() - 50)
        });
        landScapeTabMulti.css({
          'height': Math.floor(wrapperW * .2118)
        });
        landScapeScreenMulti.css({
          'height': Math.floor(landScapeTabMulti.outerHeight() - 50)
        });
      } else {
        tabletFrame.css({
          height: Math.floor(wrapperW * .98),
          marginBottom: Math.floor(wrapperW * .02)
        });
        hwLandscapeTab.css({
          height: Math.floor(wrapperW / 3),
          marginBottom: Math.floor(wrapperW * .02)
        });
        hwLandscapeScr.css({
          height: Math.floor(hwLandscapeTab.outerHeight() - 50)
        });
        landscapeTablet.css({
          height: Math.floor(wrapperW / 3),
          marginBottom: Math.floor(wrapperW * .02)
        });
        landscapeScreen.css({
          height: Math.floor(landscapeTablet.outerHeight() - 50)
        });
      }
      twoImagesStacked.each(function() {
        var currentItem;
        currentItem = $(this);
        if (currentItem.index() === 0) {
          return currentItem.css({
            'margin-bottom': Math.floor(wrapperW * .02)
          });
        }
      });
      mosaicLeft.each(function() {
        var rowHeight;
        rowHeight = $(this).children().eq(0).find('.project-image').outerHeight();
        return $(this).children().eq(1).find('.project-image').each(function(index, item) {
          if (windowW < 768) {
            return $(this).css('height', Math.floor((rowHeight / 1.942) - (wrapperW * .01)));
          } else {
            return $(this).css('height', '100%');
          }
        });
      });
      mosaicRight.each(function() {
        var rowHeight;
        rowHeight = $(this).children().eq(1).find('.project-image').outerHeight();
        return $(this).children().eq(0).find('.project-image').each(function(index, item) {
          if (windowW < 768) {
            return $(this).css('height', Math.floor((rowHeight / 1.942) - (wrapperW * .01)));
          } else {
            return $(this).css('height', '100%');
          }
        });
      });
      twoImagesTemplate.each(function() {
        var blockImages, currentBlock, minHeight, video;
        currentBlock = $(this);
        video = currentBlock.find('.videoo_text').find('.video');
        minHeight = 10000;
        blockImages = currentBlock.find('.project-image');
        return blockImages.each(function(index, item) {
          var currentItem;
          currentItem = $(item);
          return _getOriginalRatio(currentItem).then(function(ratio) {
            var itemHeight;
            if (windowW > 640) {
              itemHeight = currentItem.parent().width() / ratio;
            } else {
              itemHeight = currentItem.parent().width() / ratio;
            }
            currentItem.css({
              'height': Math.floor(itemHeight)
            });
            if (video && video.height() !== null) {
              currentItem.css({
                'height': Math.floor(video.height())
              });
            }
            if (itemHeight < minHeight) {
              minHeight = itemHeight;
            }
            minHeight += parseFloat(currentItem.parent().css('padding-top')) + parseFloat(currentItem.parent().css('padding-top'));
            if (index === 1) {
              if (windowW > 640) {
                return currentBlock.css({
                  'height': Math.floor(minHeight),
                  'margin-bottom': Math.floor(wrapperW * .02)
                });
              } else {
                return currentBlock.css({
                  'height': 'auto',
                  'margin-bottom': Math.floor(wrapperW * .02)
                });
              }
            }
          });
        });
      });
      threeImagesTemplate.each(function() {
        var currentBlock, doubleImage, doubleImageFirst, doubleImageSecond, singleImage,
          _this = this;
        currentBlock = $(this);
        singleImage = currentBlock.find('.three-images__one-image');
        doubleImage = currentBlock.find('.three-images__two-image');
        doubleImageFirst = $(doubleImage.children()[0]);
        doubleImageSecond = $(doubleImage.children()[1]);
        return setTimeout(function() {
          var singleImageHeight;
          if (singleImage.height()) {
            singleImageHeight = singleImage.height();
            doubleImageFirst.css('height', singleImageHeight / 2);
            return doubleImageSecond.css('height', singleImageHeight / 2);
          }
        }, 1000);
      });
      sliderLarge.each(function() {
        var innerSlides, innerSlidesNo, minHeight;
        minHeight = 10000;
        innerSlides = $(this).find('.project-image');
        innerSlidesNo = innerSlides.length - 1;
        return innerSlides.each(function(index, item) {
          var currentItem, currentSlider;
          currentItem = $(item);
          currentSlider = currentItem.parent('.project-block--slider');
          return _getOriginalRatio(currentItem).then(function(ratio) {
            var itemHeight;
            itemHeight = wrapperW / ratio;
            currentItem.css({
              'height': Math.floor(itemHeight)
            });
            if (itemHeight < minHeight) {
              minHeight = itemHeight;
            }
            if (index === innerSlidesNo) {
              return currentSlider.css({
                'height': Math.floor(minHeight)
              });
            }
          });
        });
      });
      return sliderSmall.each(function() {
        var innerSlides, innerSlidesNo, minHeight;
        minHeight = 10000;
        innerSlides = $(this).find('.project-image');
        innerSlidesNo = innerSlides.length - 1;
        return innerSlides.each(function(index, item) {
          var currentItem, currentSlider;
          currentItem = $(item);
          currentSlider = currentItem.parent('.project-block--slider');
          return _getOriginalRatio(currentItem).then(function(ratio) {
            var itemHeight;
            if (windowW > 640) {
              itemHeight = wrapperW / 2 / ratio;
            } else {
              itemHeight = wrapperW / ratio;
            }
            currentItem.css({
              'min-height': Math.floor(itemHeight)
            });
            if (itemHeight < minHeight) {
              minHeight = itemHeight;
            }
            if (index === innerSlidesNo) {
              currentSlider.css({
                'min-height': Math.floor(minHeight)
              });
              return $(document.body).trigger("sticky_kit:recalc");
            }
          });
        });
      });
    };

    _getOriginalRatio = function(arg) {
      var def, image, imageRatio, image_url;
      def = $.Deferred();
      imageRatio = 0;
      image_url = arg.data('original');
      if (image_url) {
        image = new Image();
        $(image).load(function() {
          imageRatio = image.width / image.height;
          return def.resolve(imageRatio);
        });
        image.src = image_url;
      }
      return def;
    };

    return TabletTemplate;

  })();

  module.exports = new TabletTemplate;

}).call(this);
}});

window.require.define({"spine/index": function(exports, require, module) {module.exports = require('./lib/spine');}});

window.require.define({"spine/lib/ajax": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var $, Ajax, Base, Collection, Extend, Include, Model, Queue, Singleton, Spine,
    __slice = [].slice,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  Spine = this.Spine || require('spine');

  $ = Spine.$;

  Model = Spine.Model;

  Queue = $({});

  Ajax = {
    getURL: function(object) {
      return (typeof object.url === "function" ? object.url() : void 0) || object.url;
    },
    getScope: function(object) {
      return (typeof object.scope === "function" ? object.scope() : void 0) || object.scope;
    },
    generateURL: function() {
      var args, collection, object, path, scope;

      object = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      if (object.className) {
        collection = object.className.toLowerCase() + 's';
        scope = Ajax.getScope(object);
      } else {
        if (typeof object.constructor.url === 'string') {
          collection = object.constructor.url;
        } else {
          collection = object.constructor.className.toLowerCase() + 's';
        }
        scope = Ajax.getScope(object) || Ajax.getScope(object.constructor);
      }
      args.unshift(collection);
      args.unshift(scope);
      path = args.join('/');
      path = path.replace(/(\/\/)/g, "/");
      path = path.replace(/^\/|\/$/g, "");
      if (path.indexOf("../") !== 0) {
        return Model.host + "/" + path;
      } else {
        return path;
      }
    },
    enabled: true,
    disable: function(callback) {
      var e;

      if (this.enabled) {
        this.enabled = false;
        try {
          return callback();
        } catch (_error) {
          e = _error;
          throw e;
        } finally {
          this.enabled = true;
        }
      } else {
        return callback();
      }
    },
    queue: function(request) {
      if (request) {
        return Queue.queue(request);
      } else {
        return Queue.queue();
      }
    },
    clearQueue: function() {
      return this.queue([]);
    }
  };

  Base = (function() {
    function Base() {}

    Base.prototype.defaults = {
      dataType: 'json',
      processData: false,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    };

    Base.prototype.queue = Ajax.queue;

    Base.prototype.ajax = function(params, defaults) {
      return $.ajax(this.ajaxSettings(params, defaults));
    };

    Base.prototype.ajaxQueue = function(params, defaults) {
      var deferred, jqXHR, promise, request, settings;

      jqXHR = null;
      deferred = $.Deferred();
      promise = deferred.promise();
      if (!Ajax.enabled) {
        return promise;
      }
      settings = this.ajaxSettings(params, defaults);
      request = function(next) {
        return jqXHR = $.ajax(settings).done(deferred.resolve).fail(deferred.reject).then(next, next);
      };
      promise.abort = function(statusText) {
        var index;

        if (jqXHR) {
          return jqXHR.abort(statusText);
        }
        index = $.inArray(request, this.queue());
        if (index > -1) {
          this.queue().splice(index, 1);
        }
        deferred.rejectWith(settings.context || settings, [promise, statusText, '']);
        return promise;
      };
      this.queue(request);
      return promise;
    };

    Base.prototype.ajaxSettings = function(params, defaults) {
      return $.extend({}, this.defaults, defaults, params);
    };

    return Base;

  })();

  Collection = (function(_super) {
    __extends(Collection, _super);

    function Collection(model) {
      this.model = model;
      this.failResponse = __bind(this.failResponse, this);
      this.recordsResponse = __bind(this.recordsResponse, this);
    }

    Collection.prototype.find = function(id, params) {
      var record;

      record = new this.model({
        id: id
      });
      return this.ajaxQueue(params, {
        type: 'GET',
        url: Ajax.getURL(record)
      }).done(this.recordsResponse).fail(this.failResponse);
    };

    Collection.prototype.all = function(params) {
      return this.ajaxQueue(params, {
        type: 'GET',
        url: Ajax.getURL(this.model)
      }).done(this.recordsResponse).fail(this.failResponse);
    };

    Collection.prototype.fetch = function(params, options) {
      var id,
        _this = this;

      if (params == null) {
        params = {};
      }
      if (options == null) {
        options = {};
      }
      if (id = params.id) {
        delete params.id;
        return this.find(id, params).done(function(record) {
          return _this.model.refresh(record, options);
        });
      } else {
        return this.all(params).done(function(records) {
          return _this.model.refresh(records, options);
        });
      }
    };

    Collection.prototype.recordsResponse = function(data, status, xhr) {
      return this.model.trigger('ajaxSuccess', null, status, xhr);
    };

    Collection.prototype.failResponse = function(xhr, statusText, error) {
      return this.model.trigger('ajaxError', null, xhr, statusText, error);
    };

    return Collection;

  })(Base);

  Singleton = (function(_super) {
    __extends(Singleton, _super);

    function Singleton(record) {
      this.record = record;
      this.failResponse = __bind(this.failResponse, this);
      this.recordResponse = __bind(this.recordResponse, this);
      this.model = this.record.constructor;
    }

    Singleton.prototype.reload = function(params, options) {
      return this.ajaxQueue(params, {
        type: 'GET',
        url: Ajax.getURL(this.record)
      }).done(this.recordResponse(options)).fail(this.failResponse(options));
    };

    Singleton.prototype.create = function(params, options) {
      return this.ajaxQueue(params, {
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(this.record),
        url: Ajax.getURL(this.model)
      }).done(this.recordResponse(options)).fail(this.failResponse(options));
    };

    Singleton.prototype.update = function(params, options) {
      return this.ajaxQueue(params, {
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(this.record),
        url: Ajax.getURL(this.record)
      }).done(this.recordResponse(options)).fail(this.failResponse(options));
    };

    Singleton.prototype.destroy = function(params, options) {
      return this.ajaxQueue(params, {
        type: 'DELETE',
        url: Ajax.getURL(this.record)
      }).done(this.recordResponse(options)).fail(this.failResponse(options));
    };

    Singleton.prototype.recordResponse = function(options) {
      var _this = this;

      if (options == null) {
        options = {};
      }
      return function(data, status, xhr) {
        var _ref, _ref1;

        if (Spine.isBlank(data) || _this.record.destroyed) {
          data = false;
        } else {
          data = _this.model.fromJSON(data);
        }
        Ajax.disable(function() {
          if (data) {
            if (data.id && _this.record.id !== data.id) {
              _this.record.changeID(data.id);
            }
            return _this.record.updateAttributes(data.attributes());
          }
        });
        _this.record.trigger('ajaxSuccess', data, status, xhr);
        if ((_ref = options.success) != null) {
          _ref.apply(_this.record);
        }
        return (_ref1 = options.done) != null ? _ref1.apply(_this.record) : void 0;
      };
    };

    Singleton.prototype.failResponse = function(options) {
      var _this = this;

      if (options == null) {
        options = {};
      }
      return function(xhr, statusText, error) {
        var _ref, _ref1;

        _this.record.trigger('ajaxError', xhr, statusText, error);
        if ((_ref = options.error) != null) {
          _ref.apply(_this.record);
        }
        return (_ref1 = options.fail) != null ? _ref1.apply(_this.record) : void 0;
      };
    };

    return Singleton;

  })(Base);

  Model.host = '';

  Include = {
    ajax: function() {
      return new Singleton(this);
    },
    url: function() {
      var args;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      args.unshift(encodeURIComponent(this.id));
      return Ajax.generateURL.apply(Ajax, [this].concat(__slice.call(args)));
    }
  };

  Extend = {
    ajax: function() {
      return new Collection(this);
    },
    url: function() {
      var args;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      return Ajax.generateURL.apply(Ajax, [this].concat(__slice.call(args)));
    }
  };

  Model.Ajax = {
    extended: function() {
      this.fetch(this.ajaxFetch);
      this.change(this.ajaxChange);
      this.extend(Extend);
      return this.include(Include);
    },
    ajaxFetch: function() {
      var _ref;

      return (_ref = this.ajax()).fetch.apply(_ref, arguments);
    },
    ajaxChange: function(record, type, options) {
      if (options == null) {
        options = {};
      }
      if (options.ajax === false) {
        return;
      }
      return record.ajax()[type](options.ajax, options);
    }
  };

  Model.Ajax.Methods = {
    extended: function() {
      this.extend(Extend);
      return this.include(Include);
    }
  };

  Ajax.defaults = Base.prototype.defaults;

  Spine.Ajax = Ajax;

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Ajax;
  }

}).call(this);

/*
//@ sourceMappingURL=ajax.map
*/
}});

window.require.define({"spine/lib/list": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var $, Spine,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  Spine = this.Spine || require('spine');

  $ = Spine.$;

  Spine.List = (function(_super) {
    __extends(List, _super);

    List.prototype.events = {
      'click .item': 'click'
    };

    List.prototype.selectFirst = false;

    function List() {
      this.change = __bind(this.change, this);      List.__super__.constructor.apply(this, arguments);
      this.bind('change', this.change);
    }

    List.prototype.template = function() {
      throw 'Override template';
    };

    List.prototype.change = function(item) {
      this.current = item;
      if (!this.current) {
        this.children().removeClass('active');
        return;
      }
      this.children().removeClass('active');
      return $(this.children().get(this.items.indexOf(this.current))).addClass('active');
    };

    List.prototype.render = function(items) {
      if (items) {
        this.items = items;
      }
      this.html(this.template(this.items));
      this.change(this.current);
      if (this.selectFirst) {
        if (!this.children('.active').length) {
          return this.children(':first').click();
        }
      }
    };

    List.prototype.children = function(sel) {
      return this.el.children(sel);
    };

    List.prototype.click = function(e) {
      var item;

      item = this.items[$(e.currentTarget).index()];
      this.trigger('change', item);
      return true;
    };

    return List;

  })(Spine.Controller);

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Spine.List;
  }

}).call(this);

/*
//@ sourceMappingURL=list.map
*/
}});

window.require.define({"spine/lib/local": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var Spine;

  Spine = this.Spine || require('spine');

  Spine.Model.Local = {
    extended: function() {
      this.change(this.saveLocal);
      return this.fetch(this.loadLocal);
    },
    saveLocal: function() {
      var result;

      result = JSON.stringify(this);
      return localStorage[this.className] = result;
    },
    loadLocal: function() {
      var result;

      result = localStorage[this.className];
      return this.refresh(result || [], {
        clear: true
      });
    }
  };

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Spine.Model.Local;
  }

}).call(this);

/*
//@ sourceMappingURL=local.map
*/
}});

window.require.define({"spine/lib/manager": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var $, Spine,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __slice = [].slice;

  Spine = this.Spine || require('spine');

  $ = Spine.$;

  Spine.Manager = (function(_super) {
    __extends(Manager, _super);

    Manager.include(Spine.Events);

    function Manager() {
      this.controllers = [];
      this.bind('change', this.change);
      this.add.apply(this, arguments);
    }

    Manager.prototype.add = function() {
      var cont, controllers, _i, _len, _results;

      controllers = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      _results = [];
      for (_i = 0, _len = controllers.length; _i < _len; _i++) {
        cont = controllers[_i];
        _results.push(this.addOne(cont));
      }
      return _results;
    };

    Manager.prototype.addOne = function(controller) {
      var _this = this;

      controller.bind('active', function() {
        var args;

        args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
        return _this.trigger.apply(_this, ['change', controller].concat(__slice.call(args)));
      });
      controller.bind('release', function() {
        return _this.controllers.splice(_this.controllers.indexOf(controller), 1);
      });
      return this.controllers.push(controller);
    };

    Manager.prototype.deactivate = function() {
      return this.trigger.apply(this, ['change', false].concat(__slice.call(arguments)));
    };

    Manager.prototype.change = function() {
      var args, cont, current, _i, _len, _ref, _results;

      current = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      _ref = this.controllers;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        cont = _ref[_i];
        if (cont === current) {
          _results.push(cont.activate.apply(cont, args));
        } else {
          _results.push(cont.deactivate.apply(cont, args));
        }
      }
      return _results;
    };

    return Manager;

  })(Spine.Module);

  Spine.Controller.include({
    active: function() {
      var args;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      if (typeof args[0] === 'function') {
        this.bind('active', args[0]);
      } else {
        args.unshift('active');
        this.trigger.apply(this, args);
      }
      return this;
    },
    isActive: function() {
      return this.el.hasClass('active');
    },
    activate: function() {
      this.el.addClass('active');
      return this;
    },
    deactivate: function() {
      this.el.removeClass('active');
      return this;
    }
  });

  Spine.Stack = (function(_super) {
    __extends(Stack, _super);

    Stack.prototype.controllers = {};

    Stack.prototype.routes = {};

    Stack.prototype.className = 'spine stack';

    function Stack() {
      var key, value, _fn, _ref, _ref1,
        _this = this;

      Stack.__super__.constructor.apply(this, arguments);
      this.manager = new Spine.Manager;
      _ref = this.controllers;
      for (key in _ref) {
        value = _ref[key];
        if (this[key] != null) {
          throw Error("'@" + key + "' already assigned - choose a different name");
        }
        this[key] = new value({
          stack: this
        });
        this.add(this[key]);
      }
      _ref1 = this.routes;
      _fn = function(key, value) {
        var callback;

        if (typeof value === 'function') {
          callback = value;
        }
        callback || (callback = function() {
          var _ref2;

          return (_ref2 = _this[value]).active.apply(_ref2, arguments);
        });
        return _this.route(key, callback);
      };
      for (key in _ref1) {
        value = _ref1[key];
        _fn(key, value);
      }
      if (this["default"]) {
        this[this["default"]].active();
      }
    }

    Stack.prototype.add = function(controller) {
      this.manager.add(controller);
      return this.append(controller);
    };

    return Stack;

  })(Spine.Controller);

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Spine.Manager;
  }

  if (typeof module !== "undefined" && module !== null) {
    module.exports.Stack = Spine.Stack;
  }

}).call(this);

/*
//@ sourceMappingURL=manager.map
*/
}});

window.require.define({"spine/lib/relation": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var Collection, Instance, Singleton, Spine, association, isArray, require, singularize, underscore,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  Spine = this.Spine || require('spine');

  isArray = Spine.isArray;

  require = this.require || (function(value) {
    return eval(value);
  });

  Collection = (function(_super) {
    __extends(Collection, _super);

    function Collection(options) {
      var key, value;

      if (options == null) {
        options = {};
      }
      for (key in options) {
        value = options[key];
        this[key] = value;
      }
    }

    Collection.prototype.all = function() {
      var _this = this;

      return this.model.select(function(rec) {
        return _this.associated(rec);
      });
    };

    Collection.prototype.first = function() {
      return this.all()[0];
    };

    Collection.prototype.last = function() {
      var values;

      values = this.all();
      return values[values.length - 1];
    };

    Collection.prototype.count = function() {
      return this.all().length;
    };

    Collection.prototype.find = function(id) {
      var records,
        _this = this;

      records = this.select(function(rec) {
        return ("" + rec.id) === ("" + id);
      });
      if (!records[0]) {
        throw new Error("\"" + this.model.className + "\" model could not find a record for the ID \"" + id + "\"");
      }
      return records[0];
    };

    Collection.prototype.findAllByAttribute = function(name, value) {
      var _this = this;

      return this.model.select(function(rec) {
        return _this.associated(rec) && rec[name] === value;
      });
    };

    Collection.prototype.findByAttribute = function(name, value) {
      return this.findAllByAttribute(name, value)[0];
    };

    Collection.prototype.select = function(cb) {
      var _this = this;

      return this.model.select(function(rec) {
        return _this.associated(rec) && cb(rec);
      });
    };

    Collection.prototype.refresh = function(values) {
      var i, match, record, _i, _j, _k, _len, _len1, _len2, _ref, _ref1;

      if (values == null) {
        return this;
      }
      _ref = this.all();
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        record = _ref[_i];
        delete this.model.irecords[record.id];
        _ref1 = this.model.records;
        for (i = _j = 0, _len1 = _ref1.length; _j < _len1; i = ++_j) {
          match = _ref1[i];
          if (!(match.id === record.id)) {
            continue;
          }
          this.model.records.splice(i, 1);
          break;
        }
      }
      if (!isArray(values)) {
        values = [values];
      }
      for (_k = 0, _len2 = values.length; _k < _len2; _k++) {
        record = values[_k];
        record.newRecord = false;
        record[this.fkey] = this.record.id;
      }
      this.model.refresh(values);
      return this;
    };

    Collection.prototype.create = function(record, options) {
      record[this.fkey] = this.record.id;
      return this.model.create(record, options);
    };

    Collection.prototype.add = function(record, options) {
      return record.updateAttribute(this.fkey, this.record.id, options);
    };

    Collection.prototype.remove = function(record, options) {
      return record.updateAttribute(this.fkey, null, options);
    };

    Collection.prototype.associated = function(record) {
      return record[this.fkey] === this.record.id;
    };

    return Collection;

  })(Spine.Module);

  Instance = (function(_super) {
    __extends(Instance, _super);

    function Instance(options) {
      var key, value;

      if (options == null) {
        options = {};
      }
      for (key in options) {
        value = options[key];
        this[key] = value;
      }
    }

    Instance.prototype.exists = function() {
      if (this.record[this.fkey]) {
        return this.model.exists(this.record[this.fkey]);
      } else {
        return false;
      }
    };

    Instance.prototype.update = function(value) {
      if (value == null) {
        return this;
      }
      if (!(value instanceof this.model)) {
        value = new this.model(value);
      }
      if (value.isNew()) {
        value.save();
      }
      this.record[this.fkey] = value && value.id;
      return this;
    };

    return Instance;

  })(Spine.Module);

  Singleton = (function(_super) {
    __extends(Singleton, _super);

    function Singleton(options) {
      var key, value;

      if (options == null) {
        options = {};
      }
      for (key in options) {
        value = options[key];
        this[key] = value;
      }
    }

    Singleton.prototype.find = function() {
      return this.record.id && this.model.findByAttribute(this.fkey, this.record.id);
    };

    Singleton.prototype.update = function(value) {
      if (value == null) {
        return this;
      }
      if (!(value instanceof this.model)) {
        value = this.model.fromJSON(value);
      }
      value[this.fkey] = this.record.id;
      value.save();
      return this;
    };

    return Singleton;

  })(Spine.Module);

  singularize = function(str) {
    return str.replace(/s$/, '');
  };

  underscore = function(str) {
    return str.replace(/::/g, '/').replace(/([A-Z]+)([A-Z][a-z])/g, '$1_$2').replace(/([a-z\d])([A-Z])/g, '$1_$2').replace(/-/g, '_').toLowerCase();
  };

  association = function(name, model, record, fkey, Ctor) {
    if (typeof model === 'string') {
      model = require(model);
    }
    return new Ctor({
      name: name,
      model: model,
      record: record,
      fkey: fkey
    });
  };

  Spine.Model.extend({
    hasMany: function(name, model, fkey) {
      if (fkey == null) {
        fkey = "" + (underscore(this.className)) + "_id";
      }
      return this.prototype[name] = function(value) {
        return association(name, model, this, fkey, Collection).refresh(value);
      };
    },
    belongsTo: function(name, model, fkey) {
      if (fkey == null) {
        fkey = "" + (underscore(singularize(name))) + "_id";
      }
      this.prototype[name] = function(value) {
        return association(name, model, this, fkey, Instance).update(value).exists();
      };
      return this.attributes.push(fkey);
    },
    hasOne: function(name, model, fkey) {
      if (fkey == null) {
        fkey = "" + (underscore(this.className)) + "_id";
      }
      return this.prototype[name] = function(value) {
        return association(name, model, this, fkey, Singleton).update(value).find();
      };
    }
  });

  Spine.Collection = Collection;

  Spine.Singleton = Singleton;

  Spine.Instance = Instance;

}).call(this);

/*
//@ sourceMappingURL=relation.map
*/
}});

window.require.define({"spine/lib/route": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var $, Spine, escapeRegExp, hashStrip, namedParam, splatParam,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __slice = [].slice;

  Spine = this.Spine || require('spine');

  $ = Spine.$;

  hashStrip = /^#*/;

  namedParam = /:([\w\d]+)/g;

  splatParam = /\*([\w\d]+)/g;

  escapeRegExp = /[-[\]{}()+?.,\\^$|#\s]/g;

  Spine.Route = (function(_super) {
    var _ref;

    __extends(Route, _super);

    Route.extend(Spine.Events);

    Route.historySupport = ((_ref = window.history) != null ? _ref.pushState : void 0) != null;

    Route.routes = [];

    Route.options = {
      trigger: true,
      history: false,
      shim: false,
      replace: false
    };

    Route.add = function(path, callback) {
      var key, value, _results;

      if (typeof path === 'object' && !(path instanceof RegExp)) {
        _results = [];
        for (key in path) {
          value = path[key];
          _results.push(this.add(key, value));
        }
        return _results;
      } else {
        return this.routes.push(new this(path, callback));
      }
    };

    Route.setup = function(options) {
      if (options == null) {
        options = {};
      }
      this.options = $.extend({}, this.options, options);
      if (this.options.history) {
        this.history = this.historySupport && this.options.history;
      }
      if (this.options.shim) {
        return;
      }
      if (this.history) {
        $(window).bind('popstate', this.change);
      } else {
        $(window).bind('hashchange', this.change);
      }
      return this.change();
    };

    Route.unbind = function() {
      if (this.options.shim) {
        return;
      }
      if (this.history) {
        return $(window).unbind('popstate', this.change);
      } else {
        return $(window).unbind('hashchange', this.change);
      }
    };

    Route.navigate = function() {
      var args, lastArg, options, path;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      options = {};
      lastArg = args[args.length - 1];
      if (typeof lastArg === 'object') {
        options = args.pop();
      } else if (typeof lastArg === 'boolean') {
        options.trigger = args.pop();
      }
      options = $.extend({}, this.options, options);
      path = args.join('/');
      if (this.path === path) {
        return;
      }
      this.path = path;
      this.trigger('navigate', this.path);
      if (options.trigger) {
        this.matchRoute(this.path, options);
      }
      if (options.shim) {
        return;
      }
      if (this.history && options.replace) {
        return history.replaceState({}, document.title, this.path);
      } else if (this.history) {
        return history.pushState({}, document.title, this.path);
      } else {
        return window.location.hash = this.path;
      }
    };

    Route.getPath = function() {
      var path;

      if (this.history) {
        path = window.location.pathname;
        if (path.substr(0, 1) !== '/') {
          path = '/' + path;
        }
      } else {
        path = window.location.hash;
        path = path.replace(hashStrip, '');
      }
      return path;
    };

    Route.getHost = function() {
      return "" + window.location.protocol + "//" + window.location.host;
    };

    Route.change = function() {
      var path;

      path = this.getPath();
      if (path === this.path) {
        return;
      }
      this.path = path;
      return this.matchRoute(this.path);
    };

    Route.matchRoute = function(path, options) {
      var route, _i, _len, _ref1;

      _ref1 = this.routes;
      for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
        route = _ref1[_i];
        if (!(route.match(path, options))) {
          continue;
        }
        this.trigger('change', route, path);
        return route;
      }
    };

    function Route(path, callback) {
      var match;

      this.path = path;
      this.callback = callback;
      this.names = [];
      if (typeof path === 'string') {
        namedParam.lastIndex = 0;
        while ((match = namedParam.exec(path)) !== null) {
          this.names.push(match[1]);
        }
        splatParam.lastIndex = 0;
        while ((match = splatParam.exec(path)) !== null) {
          this.names.push(match[1]);
        }
        path = path.replace(escapeRegExp, '\\$&').replace(namedParam, '([^\/]*)').replace(splatParam, '(.*?)');
        this.route = new RegExp("^" + path + "$");
      } else {
        this.route = path;
      }
    }

    Route.prototype.match = function(path, options) {
      var i, match, param, params, _i, _len;

      if (options == null) {
        options = {};
      }
      match = this.route.exec(path);
      if (!match) {
        return false;
      }
      options.match = match;
      params = match.slice(1);
      if (this.names.length) {
        for (i = _i = 0, _len = params.length; _i < _len; i = ++_i) {
          param = params[i];
          options[this.names[i]] = param;
        }
      }
      return this.callback.call(null, options) !== false;
    };

    return Route;

  })(Spine.Module);

  Spine.Route.change = Spine.Route.proxy(Spine.Route.change);

  Spine.Controller.include({
    route: function(path, callback) {
      return Spine.Route.add(path, this.proxy(callback));
    },
    routes: function(routes) {
      var key, value, _results;

      _results = [];
      for (key in routes) {
        value = routes[key];
        _results.push(this.route(key, value));
      }
      return _results;
    },
    navigate: function() {
      return Spine.Route.navigate.apply(Spine.Route, arguments);
    }
  });

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Spine.Route;
  }

}).call(this);

/*
//@ sourceMappingURL=route.map
*/
}});

window.require.define({"spine/lib/spine": function(exports, require, module) {// Generated by CoffeeScript 1.6.2
(function() {
  var $, Controller, Events, Log, Model, Module, Spine, createObject, isArray, isBlank, makeArray, moduleKeywords,
    __slice = [].slice,
    __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; },
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  Events = {
    bind: function(ev, callback) {
      var calls, evs, name, _i, _len;

      evs = ev.split(' ');
      calls = this.hasOwnProperty('_callbacks') && this._callbacks || (this._callbacks = {});
      for (_i = 0, _len = evs.length; _i < _len; _i++) {
        name = evs[_i];
        calls[name] || (calls[name] = []);
        calls[name].push(callback);
      }
      return this;
    },
    one: function(ev, callback) {
      var handler;

      return this.bind(ev, handler = function() {
        this.unbind(ev, handler);
        return callback.apply(this, arguments);
      });
    },
    trigger: function() {
      var args, callback, ev, list, _i, _len, _ref;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      ev = args.shift();
      list = this.hasOwnProperty('_callbacks') && ((_ref = this._callbacks) != null ? _ref[ev] : void 0);
      if (!list) {
        return;
      }
      for (_i = 0, _len = list.length; _i < _len; _i++) {
        callback = list[_i];
        if (callback.apply(this, args) === false) {
          break;
        }
      }
      return true;
    },
    listenTo: function(obj, ev, callback) {
      obj.bind(ev, callback);
      this.listeningTo || (this.listeningTo = []);
      this.listeningTo.push(obj);
      return this;
    },
    listenToOnce: function(obj, ev, callback) {
      var listeningToOnce;

      listeningToOnce = this.listeningToOnce || (this.listeningToOnce = []);
      listeningToOnce.push(obj);
      obj.one(ev, function() {
        var idx;

        idx = listeningToOnce.indexOf(obj);
        if (idx !== -1) {
          listeningToOnce.splice(idx, 1);
        }
        return callback.apply(this, arguments);
      });
      return this;
    },
    stopListening: function(obj, ev, callback) {
      var idx, listeningTo, retain, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _results;

      if (arguments.length === 0) {
        retain = [];
        _ref = [this.listeningTo, this.listeningToOnce];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          listeningTo = _ref[_i];
          if (!listeningTo) {
            continue;
          }
          for (_j = 0, _len1 = listeningTo.length; _j < _len1; _j++) {
            obj = listeningTo[_j];
            if (!(!(__indexOf.call(retain, obj) >= 0))) {
              continue;
            }
            obj.unbind();
            retain.push(obj);
          }
        }
        this.listeningTo = void 0;
        return this.listeningToOnce = void 0;
      } else if (obj) {
        if (ev) {
          obj.unbind(ev, callback);
        }
        if (!ev) {
          obj.unbind();
        }
        _ref1 = [this.listeningTo, this.listeningToOnce];
        _results = [];
        for (_k = 0, _len2 = _ref1.length; _k < _len2; _k++) {
          listeningTo = _ref1[_k];
          if (!listeningTo) {
            continue;
          }
          idx = listeningTo.indexOf(obj);
          if (idx !== -1) {
            _results.push(listeningTo.splice(idx, 1));
          } else {
            _results.push(void 0);
          }
        }
        return _results;
      }
    },
    unbind: function(ev, callback) {
      var cb, evs, i, list, name, _i, _j, _len, _len1, _ref;

      if (arguments.length === 0) {
        this._callbacks = {};
        return this;
      }
      if (!ev) {
        return this;
      }
      evs = ev.split(' ');
      for (_i = 0, _len = evs.length; _i < _len; _i++) {
        name = evs[_i];
        list = (_ref = this._callbacks) != null ? _ref[name] : void 0;
        if (!list) {
          continue;
        }
        if (!callback) {
          delete this._callbacks[name];
          continue;
        }
        for (i = _j = 0, _len1 = list.length; _j < _len1; i = ++_j) {
          cb = list[i];
          if (!(cb === callback)) {
            continue;
          }
          list = list.slice();
          list.splice(i, 1);
          this._callbacks[name] = list;
          break;
        }
      }
      return this;
    }
  };

  Events.on = Events.bind;

  Events.off = Events.unbind;

  Log = {
    trace: true,
    logPrefix: '(App)',
    log: function() {
      var args;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      if (!this.trace) {
        return;
      }
      if (this.logPrefix) {
        args.unshift(this.logPrefix);
      }
      if (typeof console !== "undefined" && console !== null) {
        if (typeof console.log === "function") {
          console.log.apply(console, args);
        }
      }
      return this;
    }
  };

  moduleKeywords = ['included', 'extended'];

  Module = (function() {
    Module.include = function(obj) {
      var key, value, _ref;

      if (!obj) {
        throw new Error('include(obj) requires obj');
      }
      for (key in obj) {
        value = obj[key];
        if (__indexOf.call(moduleKeywords, key) < 0) {
          this.prototype[key] = value;
        }
      }
      if ((_ref = obj.included) != null) {
        _ref.apply(this);
      }
      return this;
    };

    Module.extend = function(obj) {
      var key, value, _ref;

      if (!obj) {
        throw new Error('extend(obj) requires obj');
      }
      for (key in obj) {
        value = obj[key];
        if (__indexOf.call(moduleKeywords, key) < 0) {
          this[key] = value;
        }
      }
      if ((_ref = obj.extended) != null) {
        _ref.apply(this);
      }
      return this;
    };

    Module.proxy = function(func) {
      var _this = this;

      return function() {
        return func.apply(_this, arguments);
      };
    };

    Module.prototype.proxy = function(func) {
      var _this = this;

      return function() {
        return func.apply(_this, arguments);
      };
    };

    function Module() {
      if (typeof this.init === "function") {
        this.init.apply(this, arguments);
      }
    }

    return Module;

  })();

  Model = (function(_super) {
    __extends(Model, _super);

    Model.extend(Events);

    Model.records = [];

    Model.irecords = {};

    Model.crecords = {};

    Model.attributes = [];

    Model.configure = function() {
      var attributes, name;

      name = arguments[0], attributes = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      this.className = name;
      this.deleteAll();
      if (attributes.length) {
        this.attributes = attributes;
      }
      this.attributes && (this.attributes = makeArray(this.attributes));
      this.attributes || (this.attributes = []);
      this.unbind();
      return this;
    };

    Model.toString = function() {
      return "" + this.className + "(" + (this.attributes.join(", ")) + ")";
    };

    Model.find = function(id) {
      var record;

      record = this.exists(id);
      if (!record) {
        throw new Error("\"" + this.className + "\" model could not find a record for the ID \"" + id + "\"");
      }
      return record;
    };

    Model.exists = function(id) {
      var _ref, _ref1;

      return (_ref = (_ref1 = this.irecords[id]) != null ? _ref1 : this.crecords[id]) != null ? _ref.clone() : void 0;
    };

    Model.refresh = function(values, options) {
      var record, records, result, _i, _len;

      if (options == null) {
        options = {};
      }
      if (options.clear) {
        this.deleteAll();
      }
      records = this.fromJSON(values);
      if (!isArray(records)) {
        records = [records];
      }
      for (_i = 0, _len = records.length; _i < _len; _i++) {
        record = records[_i];
        if (record.id && this.irecords[record.id]) {
          this.records[this.records.indexOf(this.irecords[record.id])] = record;
        } else {
          record.id || (record.id = record.cid);
          this.records.push(record);
        }
        this.irecords[record.id] = record;
        this.crecords[record.cid] = record;
      }
      this.sort();
      result = this.cloneArray(records);
      this.trigger('refresh', this.cloneArray(records));
      return result;
    };

    Model.select = function(callback) {
      var record, _i, _len, _ref, _results;

      _ref = this.records;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        record = _ref[_i];
        if (callback(record)) {
          _results.push(record.clone());
        }
      }
      return _results;
    };

    Model.findByAttribute = function(name, value) {
      var record, _i, _len, _ref;

      _ref = this.records;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        record = _ref[_i];
        if (record[name] === value) {
          return record.clone();
        }
      }
      return null;
    };

    Model.findAllByAttribute = function(name, value) {
      return this.select(function(item) {
        return item[name] === value;
      });
    };

    Model.each = function(callback) {
      var record, _i, _len, _ref, _results;

      _ref = this.records;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        record = _ref[_i];
        _results.push(callback(record.clone()));
      }
      return _results;
    };

    Model.all = function() {
      return this.cloneArray(this.records);
    };

    Model.first = function() {
      var _ref;

      return (_ref = this.records[0]) != null ? _ref.clone() : void 0;
    };

    Model.last = function() {
      var _ref;

      return (_ref = this.records[this.records.length - 1]) != null ? _ref.clone() : void 0;
    };

    Model.count = function() {
      return this.records.length;
    };

    Model.deleteAll = function() {
      this.records = [];
      this.irecords = {};
      return this.crecords = {};
    };

    Model.destroyAll = function(options) {
      var record, _i, _len, _ref, _results;

      _ref = this.records;
      _results = [];
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        record = _ref[_i];
        _results.push(record.destroy(options));
      }
      return _results;
    };

    Model.update = function(id, atts, options) {
      return this.find(id).updateAttributes(atts, options);
    };

    Model.create = function(atts, options) {
      var record;

      record = new this(atts);
      return record.save(options);
    };

    Model.destroy = function(id, options) {
      return this.find(id).destroy(options);
    };

    Model.change = function(callbackOrParams) {
      if (typeof callbackOrParams === 'function') {
        return this.bind('change', callbackOrParams);
      } else {
        return this.trigger.apply(this, ['change'].concat(__slice.call(arguments)));
      }
    };

    Model.fetch = function(callbackOrParams) {
      if (typeof callbackOrParams === 'function') {
        return this.bind('fetch', callbackOrParams);
      } else {
        return this.trigger.apply(this, ['fetch'].concat(__slice.call(arguments)));
      }
    };

    Model.toJSON = function() {
      return this.records;
    };

    Model.fromJSON = function(objects) {
      var value, _i, _len, _results;

      if (!objects) {
        return;
      }
      if (typeof objects === 'string') {
        objects = JSON.parse(objects);
      }
      if (isArray(objects)) {
        _results = [];
        for (_i = 0, _len = objects.length; _i < _len; _i++) {
          value = objects[_i];
          _results.push(new this(value));
        }
        return _results;
      } else {
        return new this(objects);
      }
    };

    Model.fromForm = function() {
      var _ref;

      return (_ref = new this).fromForm.apply(_ref, arguments);
    };

    Model.sort = function() {
      if (this.comparator) {
        this.records.sort(this.comparator);
      }
      return this.records;
    };

    Model.cloneArray = function(array) {
      var value, _i, _len, _results;

      _results = [];
      for (_i = 0, _len = array.length; _i < _len; _i++) {
        value = array[_i];
        _results.push(value.clone());
      }
      return _results;
    };

    Model.idCounter = 0;

    Model.uid = function(prefix) {
      var uid;

      if (prefix == null) {
        prefix = '';
      }
      uid = prefix + this.idCounter++;
      if (this.exists(uid)) {
        uid = this.uid(prefix);
      }
      return uid;
    };

    function Model(atts) {
      Model.__super__.constructor.apply(this, arguments);
      if (atts) {
        this.load(atts);
      }
      this.cid = this.constructor.uid('c-');
    }

    Model.prototype.isNew = function() {
      return !this.exists();
    };

    Model.prototype.isValid = function() {
      return !this.validate();
    };

    Model.prototype.validate = function() {};

    Model.prototype.load = function(atts) {
      var key, value;

      if (atts.id) {
        this.id = atts.id;
      }
      for (key in atts) {
        value = atts[key];
        if (atts.hasOwnProperty(key) && typeof this[key] === 'function') {
          this[key](value);
        } else {
          this[key] = value;
        }
      }
      return this;
    };

    Model.prototype.attributes = function() {
      var key, result, _i, _len, _ref;

      result = {};
      _ref = this.constructor.attributes;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        key = _ref[_i];
        if (key in this) {
          if (typeof this[key] === 'function') {
            result[key] = this[key]();
          } else {
            result[key] = this[key];
          }
        }
      }
      if (this.id) {
        result.id = this.id;
      }
      return result;
    };

    Model.prototype.eql = function(rec) {
      return !!(rec && rec.constructor === this.constructor && (rec.cid === this.cid) || (rec.id && rec.id === this.id));
    };

    Model.prototype.save = function(options) {
      var error, record;

      if (options == null) {
        options = {};
      }
      if (options.validate !== false) {
        error = this.validate();
        if (error) {
          this.trigger('error', error);
          return false;
        }
      }
      this.trigger('beforeSave', options);
      record = this.isNew() ? this.create(options) : this.update(options);
      this.stripCloneAttrs();
      this.trigger('save', options);
      return record;
    };

    Model.prototype.stripCloneAttrs = function() {
      var key, value;

      if (this.hasOwnProperty('cid')) {
        return;
      }
      for (key in this) {
        if (!__hasProp.call(this, key)) continue;
        value = this[key];
        if (this.constructor.attributes.indexOf(key) > -1) {
          delete this[key];
        }
      }
      return this;
    };

    Model.prototype.updateAttribute = function(name, value, options) {
      var atts;

      atts = {};
      atts[name] = value;
      return this.updateAttributes(atts, options);
    };

    Model.prototype.updateAttributes = function(atts, options) {
      this.load(atts);
      return this.save(options);
    };

    Model.prototype.changeID = function(id) {
      var records;

      records = this.constructor.irecords;
      records[id] = records[this.id];
      delete records[this.id];
      this.id = id;
      return this.save();
    };

    Model.prototype.destroy = function(options) {
      var i, record, records, _i, _len;

      if (options == null) {
        options = {};
      }
      this.trigger('beforeDestroy', options);
      records = this.constructor.records.slice(0);
      for (i = _i = 0, _len = records.length; _i < _len; i = ++_i) {
        record = records[i];
        if (!(this.eql(record))) {
          continue;
        }
        records.splice(i, 1);
        break;
      }
      this.constructor.records = records;
      delete this.constructor.irecords[this.id];
      delete this.constructor.crecords[this.cid];
      this.destroyed = true;
      this.trigger('destroy', options);
      this.trigger('change', 'destroy', options);
      if (this.listeningTo) {
        this.stopListening();
      }
      this.unbind();
      return this;
    };

    Model.prototype.dup = function(newRecord) {
      var result;

      result = new this.constructor(this.attributes());
      if (newRecord === false) {
        result.cid = this.cid;
      } else {
        delete result.id;
      }
      return result;
    };

    Model.prototype.clone = function() {
      return createObject(this);
    };

    Model.prototype.reload = function() {
      var original;

      if (this.isNew()) {
        return this;
      }
      original = this.constructor.find(this.id);
      this.load(original.attributes());
      return original;
    };

    Model.prototype.toJSON = function() {
      return this.attributes();
    };

    Model.prototype.toString = function() {
      return "<" + this.constructor.className + " (" + (JSON.stringify(this)) + ")>";
    };

    Model.prototype.fromForm = function(form) {
      var key, result, _i, _len, _ref;

      result = {};
      _ref = $(form).serializeArray();
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        key = _ref[_i];
        result[key.name] = key.value;
      }
      return this.load(result);
    };

    Model.prototype.exists = function() {
      return this.constructor.exists(this.id);
    };

    Model.prototype.update = function(options) {
      var clone, records;

      this.trigger('beforeUpdate', options);
      records = this.constructor.irecords;
      records[this.id].load(this.attributes());
      this.constructor.sort();
      clone = records[this.id].clone();
      clone.trigger('update', options);
      clone.trigger('change', 'update', options);
      return clone;
    };

    Model.prototype.create = function(options) {
      var clone, record;

      this.trigger('beforeCreate', options);
      if (!this.id) {
        this.id = this.cid;
      }
      record = this.dup(false);
      this.constructor.records.push(record);
      this.constructor.irecords[this.id] = record;
      this.constructor.crecords[this.cid] = record;
      this.constructor.sort();
      clone = record.clone();
      clone.trigger('create', options);
      clone.trigger('change', 'create', options);
      return clone;
    };

    Model.prototype.bind = function(events, callback) {
      var binder, singleEvent, _fn, _i, _len, _ref,
        _this = this;

      this.constructor.bind(events, binder = function(record) {
        if (record && _this.eql(record)) {
          return callback.apply(_this, arguments);
        }
      });
      _ref = events.split(' ');
      _fn = function(singleEvent) {
        var unbinder;

        return _this.constructor.bind("unbind", unbinder = function(record, event, cb) {
          if (record && _this.eql(record)) {
            if (event && event !== singleEvent) {
              return;
            }
            if (cb && cb !== callback) {
              return;
            }
            _this.constructor.unbind(singleEvent, binder);
            return _this.constructor.unbind("unbind", unbinder);
          }
        });
      };
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        singleEvent = _ref[_i];
        _fn(singleEvent);
      }
      return this;
    };

    Model.prototype.one = function(events, callback) {
      var handler,
        _this = this;

      return this.bind(events, handler = function() {
        _this.unbind(events, handler);
        return callback.apply(_this, arguments);
      });
    };

    Model.prototype.trigger = function() {
      var args, _ref;

      args = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      args.splice(1, 0, this);
      return (_ref = this.constructor).trigger.apply(_ref, args);
    };

    Model.prototype.listenTo = function(obj, events, callback) {
      obj.bind(events, callback);
      this.listeningTo || (this.listeningTo = []);
      return this.listeningTo.push(obj);
    };

    Model.prototype.listenToOnce = function(obj, events, callback) {
      var handler, listeningToOnce,
        _this = this;

      listeningToOnce = this.listeningToOnce || (this.listeningToOnce = []);
      listeningToOnce.push(obj);
      return obj.bind(events, handler = function() {
        var idx;

        idx = listeningToOnce.indexOf(obj);
        if (idx !== -1) {
          listeningToOnce.splice(idx, 1);
        }
        obj.unbind(events, handler);
        return callback.apply(obj, arguments);
      });
    };

    Model.prototype.stopListening = function(obj, events, callback) {
      var idx, listeningTo, retain, _i, _j, _k, _len, _len1, _len2, _ref, _ref1, _ref2, _results;

      if (arguments.length === 0) {
        retain = [];
        _ref = [this.listeningTo, this.listeningToOnce];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          listeningTo = _ref[_i];
          if (!listeningTo) {
            continue;
          }
          _ref1 = this.listeningTo;
          for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
            obj = _ref1[_j];
            if (!(!(__indexOf.call(retain, obj) >= 0))) {
              continue;
            }
            obj.unbind();
            retain.push(obj);
          }
        }
        this.listeningTo = void 0;
        this.listeningToOnce = void 0;
        return;
      }
      if (obj) {
        if (!events) {
          obj.unbind();
        }
        if (events) {
          obj.unbind(events, callback);
        }
        _ref2 = [this.listeningTo, this.listeningToOnce];
        _results = [];
        for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
          listeningTo = _ref2[_k];
          if (!listeningTo) {
            continue;
          }
          idx = listeningTo.indexOf(obj);
          if (idx !== -1) {
            _results.push(listeningTo.splice(idx, 1));
          } else {
            _results.push(void 0);
          }
        }
        return _results;
      }
    };

    Model.prototype.unbind = function(events, callback) {
      var event, _i, _len, _ref, _results;

      if (arguments.length === 0) {
        return this.trigger('unbind');
      } else if (events) {
        _ref = events.split(' ');
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          event = _ref[_i];
          _results.push(this.trigger('unbind', event, callback));
        }
        return _results;
      }
    };

    return Model;

  })(Module);

  Model.prototype.on = Model.prototype.bind;

  Model.prototype.off = Model.prototype.unbind;

  Controller = (function(_super) {
    __extends(Controller, _super);

    Controller.include(Events);

    Controller.include(Log);

    Controller.prototype.eventSplitter = /^(\S+)\s*(.*)$/;

    Controller.prototype.tag = 'div';

    function Controller(options) {
      this.release = __bind(this.release, this);
      var context, key, parent_prototype, value, _ref;

      this.options = options;
      _ref = this.options;
      for (key in _ref) {
        value = _ref[key];
        this[key] = value;
      }
      if (!this.el) {
        this.el = document.createElement(this.tag);
      }
      this.el = $(this.el);
      this.$el = this.el;
      if (this.className) {
        this.el.addClass(this.className);
      }
      if (this.attributes) {
        this.el.attr(this.attributes);
      }
      if (!this.events) {
        this.events = this.constructor.events;
      }
      if (!this.elements) {
        this.elements = this.constructor.elements;
      }
      context = this;
      while (parent_prototype = context.constructor.__super__) {
        if (parent_prototype.events) {
          this.events = $.extend({}, parent_prototype.events, this.events);
        }
        if (parent_prototype.elements) {
          this.elements = $.extend({}, parent_prototype.elements, this.elements);
        }
        context = parent_prototype;
      }
      if (this.events) {
        this.delegateEvents(this.events);
      }
      if (this.elements) {
        this.refreshElements();
      }
      Controller.__super__.constructor.apply(this, arguments);
    }

    Controller.prototype.release = function() {
      this.trigger('release', this);
      this.el.remove();
      this.unbind();
      return this.stopListening();
    };

    Controller.prototype.$ = function(selector) {
      return $(selector, this.el);
    };

    Controller.prototype.delegateEvents = function(events) {
      var eventName, key, match, method, selector, _results,
        _this = this;

      _results = [];
      for (key in events) {
        method = events[key];
        if (typeof method === 'function') {
          method = (function(method) {
            return function() {
              method.apply(_this, arguments);
              return true;
            };
          })(method);
        } else {
          if (!this[method]) {
            throw new Error("" + method + " doesn't exist");
          }
          method = (function(method) {
            return function() {
              _this[method].apply(_this, arguments);
              return true;
            };
          })(method);
        }
        match = key.match(this.eventSplitter);
        eventName = match[1];
        selector = match[2];
        if (selector === '') {
          _results.push(this.el.bind(eventName, method));
        } else {
          _results.push(this.el.delegate(selector, eventName, method));
        }
      }
      return _results;
    };

    Controller.prototype.refreshElements = function() {
      var key, value, _ref, _results;

      _ref = this.elements;
      _results = [];
      for (key in _ref) {
        value = _ref[key];
        _results.push(this[value] = this.$(key));
      }
      return _results;
    };

    Controller.prototype.delay = function(func, timeout) {
      return setTimeout(this.proxy(func), timeout || 0);
    };

    Controller.prototype.html = function(element) {
      this.el.html(element.el || element);
      this.refreshElements();
      return this.el;
    };

    Controller.prototype.append = function() {
      var e, elements, _ref;

      elements = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      elements = (function() {
        var _i, _len, _results;

        _results = [];
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          e = elements[_i];
          _results.push(e.el || e);
        }
        return _results;
      })();
      (_ref = this.el).append.apply(_ref, elements);
      this.refreshElements();
      return this.el;
    };

    Controller.prototype.appendTo = function(element) {
      this.el.appendTo(element.el || element);
      this.refreshElements();
      return this.el;
    };

    Controller.prototype.prepend = function() {
      var e, elements, _ref;

      elements = 1 <= arguments.length ? __slice.call(arguments, 0) : [];
      elements = (function() {
        var _i, _len, _results;

        _results = [];
        for (_i = 0, _len = elements.length; _i < _len; _i++) {
          e = elements[_i];
          _results.push(e.el || e);
        }
        return _results;
      })();
      (_ref = this.el).prepend.apply(_ref, elements);
      this.refreshElements();
      return this.el;
    };

    Controller.prototype.replace = function(element) {
      var previous, _ref;

      _ref = [this.el, $(element.el || element)], previous = _ref[0], this.el = _ref[1];
      previous.replaceWith(this.el);
      this.delegateEvents(this.events);
      this.refreshElements();
      return this.el;
    };

    return Controller;

  })(Module);

  $ = (typeof window !== "undefined" && window !== null ? window.jQuery : void 0) || (typeof window !== "undefined" && window !== null ? window.Zepto : void 0) || function(element) {
    return element;
  };

  createObject = Object.create || function(o) {
    var Func;

    Func = function() {};
    Func.prototype = o;
    return new Func();
  };

  isArray = function(value) {
    return Object.prototype.toString.call(value) === '[object Array]';
  };

  isBlank = function(value) {
    var key;

    if (!value) {
      return true;
    }
    for (key in value) {
      return false;
    }
    return true;
  };

  makeArray = function(args) {
    return Array.prototype.slice.call(args, 0);
  };

  Spine = this.Spine = {};

  if (typeof module !== "undefined" && module !== null) {
    module.exports = Spine;
  }

  Spine.version = '1.1.0';

  Spine.isArray = isArray;

  Spine.isBlank = isBlank;

  Spine.$ = $;

  Spine.Events = Events;

  Spine.Log = Log;

  Spine.Module = Module;

  Spine.Controller = Controller;

  Spine.Model = Model;

  Module.extend.call(Spine, Events);

  Module.create = Module.sub = Controller.create = Controller.sub = Model.sub = function(instances, statics) {
    var Result, _ref;

    Result = (function(_super) {
      __extends(Result, _super);

      function Result() {
        _ref = Result.__super__.constructor.apply(this, arguments);
        return _ref;
      }

      return Result;

    })(this);
    if (instances) {
      Result.include(instances);
    }
    if (statics) {
      Result.extend(statics);
    }
    if (typeof Result.unbind === "function") {
      Result.unbind();
    }
    return Result;
  };

  Model.setup = function(name, attributes) {
    var Instance, _ref;

    if (attributes == null) {
      attributes = [];
    }
    Instance = (function(_super) {
      __extends(Instance, _super);

      function Instance() {
        _ref = Instance.__super__.constructor.apply(this, arguments);
        return _ref;
      }

      return Instance;

    })(this);
    Instance.configure.apply(Instance, [name].concat(__slice.call(attributes)));
    return Instance;
  };

  Spine.Class = Module;

}).call(this);

/*
//@ sourceMappingURL=spine.map
*/
}});
