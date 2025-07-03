(function ($) {
  "use strict";

  // CustomEvent polyfill
  try {
    new CustomEvent("IE has CustomEvent, but doesn't support constructor");
  } catch (e) {
    window.CustomEvent = function (event, params) {
      let evt;
      params = params || {
        bubbles: false,
        cancelable: false,
        detail: undefined,
      };
      evt = document.createEvent("CustomEvent");
      evt.initCustomEvent(
        event,
        params.bubbles,
        params.cancelable,
        params.detail
      );
      return evt;
    };

    CustomEvent.prototype = Object.create(window.Event.prototype);
  }

  /**
   * @param {HTMLInputElement} input
   * @param {HTMLElement} sub
   * @param {HTMLElement} add
   */
  function CustomNumber(input, sub, add) {
    const self = this;

    this.input = input;
    this.sub = sub;
    this.add = add;

    this._subHandler = function () {
      self._change(-1);
      self._changeByTimer(-1);
    };
    this._addHandler = function () {
      self._change(1);
      self._changeByTimer(1);
    };

    this.sub.addEventListener("mousedown", this._subHandler, false);
    this.add.addEventListener("mousedown", this._addHandler, false);
  }

  CustomNumber.prototype = {
    destroy: function () {
      this.sub.removeEventListener("mousedown", this._subHandler, false);
      this.add.removeEventListener("mousedown", this._addHandler, false);
    },

    /**
     * @param {number} direction - one of [-1, 1]
     * @private
     */
    _change: function (direction) {
      const step = this._step();
      const min = this._min();
      const max = this._max();

      let value = this._value() + step * direction;

      if (max != null) {
        value = Math.min(max, value);
      }
      if (min != null) {
        value = Math.max(min, value);
      }

      const triggerChange = this.input.value !== value.toString();

      this.input.value = value;

      if (triggerChange) {
        this.input.dispatchEvent(new CustomEvent("change", { bubbles: true }));
      }
    },

    /**
     * @param {number} direction - one of [-1, 1]
     * @private
     */
    _changeByTimer: function (direction) {
      const self = this;

      let interval;
      const timer = setTimeout(function () {
        interval = setInterval(function () {
          self._change(direction);
        }, 50);
      }, 300);

      const documentMouseUp = function () {
        clearTimeout(timer);
        clearInterval(interval);

        document.removeEventListener("mouseup", documentMouseUp, false);
      };

      document.addEventListener("mouseup", documentMouseUp, false);
    },

    /**
     * @return {number}
     * @private
     */
    _step: function () {
      let step = 1;

      if (this.input.hasAttribute("step")) {
        step = parseFloat(this.input.getAttribute("step"));
        step = isNaN(step) ? 1 : step;
      }

      return step;
    },

    /**
     * @return {?number}
     * @private
     */
    _min: function () {
      let min = null;
      if (this.input.hasAttribute("min")) {
        min = parseFloat(this.input.getAttribute("min"));
        min = isNaN(min) ? null : min;
      }

      return min;
    },

    /**
     * @return {?number}
     * @private
     */
    _max: function () {
      let max = null;
      if (this.input.hasAttribute("max")) {
        max = parseFloat(this.input.getAttribute("max"));
        max = isNaN(max) ? null : max;
      }

      return max;
    },

    /**
     * @return {number}
     * @private
     */
    _value: function () {
      let value = parseFloat(this.input.value);

      return isNaN(value) ? 0 : value;
    },
  };

  /** @this {HTMLElement} */
  $.fn.customNumber = function (options) {
    options = $.extend({ destroy: false }, options);

    return this.each(function () {
      if (!$(this).is(".form-control-number")) {
        return;
      }

      /** @type {(undefined|CustomNumber)} */
      let instance = $(this).data("customNumber");

      if (instance && options.destroy) {
        // destroy
        instance.destroy();
        $(this).removeData("customNumber");
      } else if (!instance && !options.destroy) {
        // init
        instance = new CustomNumber(
          this.querySelector(".form-control-number__input"),
          this.querySelector(".form-control-number__sub"),
          this.querySelector(".form-control-number__add")
        );
        $(this).data("customNumber", instance);
      }
    });
  };

  $(function () {
    $(".form-control-number").customNumber();
  });

  let DIRECTION = null;

  function direction() {
    if (DIRECTION === null) {
      DIRECTION = getComputedStyle(document.body).direction;
    }

    return DIRECTION;
  }

  function isRTL() {
    return direction() === "rtl";
  }

  /**
   * Search
   */
  $(function () {
    $(".search-trigger").on("click", function () {
      const search = $(".search");

      if (search.is(".search--open")) {
        search.removeClass("search--open");
      } else {
        search.addClass("search--open");
        $(".search__input")[0].focus();
      }
    });
    $(document).on("click", function (event) {
      if (!$(event.target).closest(".search, .search-trigger").length) {
        $(".search").removeClass("search--open");
      }
    });
  });

  /**
   * Tabs
   */
  $(function () {
    $(".tabs").each(function (i, element) {
      $(".tabs__list", element).on("click", ".tabs__tab", function (event) {
        event.preventDefault();

        const tab = $(this);
        const content = $(".tabs__tab-content" + $(this).attr("href"), element);

        if (content.length) {
          $(".tabs__tab").removeClass("tabs__tab--active");
          tab.addClass("tabs__tab--active");

          $(".tabs__tab-content").removeClass("tabs__tab-content--active");
          content.addClass("tabs__tab-content--active");
        }
      });

      const currentTab = $(".tabs__tab--active", element);
      const firstTab = $(".tabs__tab:first", element);

      if (currentTab.length) {
        currentTab.trigger("click");
      } else {
        firstTab.trigger("click");
      }
    });
  });

  /**
   * Home Page Slider
   */
  $(function () {
    $(".block-slider--featured .owl-carousel").owlCarousel({
      items: 1,
      nav: false,
      dots: true,
      rtl: isRTL(),
    });
  });

  /**
   * Products Carousel
   */
  $(function () {
    $(".block-products-carousel .owl-carousel").owlCarousel({
      items: 4,
      nav: true,
      dots: false,
      margin: 14,
      stagePadding: 7,
      navText: [
        '<svg width="8px" height="13px"><use xlink:href="images/sprite.svg#arrow-left-8x13"></use></svg>',
        '<svg width="8px" height="13px"><use xlink:href="images/sprite.svg#arrow-right-8x13"></use></svg>',
      ],
      responsive: {
        992: { items: 4 },
        768: { items: 3 },
        420: { items: 2 },
        0: { items: 1 },
      },
      rtl: isRTL(),
    });
  });

  /**
   * Posts Carousel
   */
  $(function () {
    $(".block-posts-carousel .owl-carousel").owlCarousel({
      items: 3,
      nav: true,
      dots: false,
      margin: 14,
      stagePadding: 7,
      navText: [
        '<svg width="8px" height="13px"><use xlink:href="images/sprite.svg#arrow-left-8x13"></use></svg>',
        '<svg width="8px" height="13px"><use xlink:href="images/sprite.svg#arrow-right-8x13"></use></svg>',
      ],
      responsive: {
        992: { items: 3 },
        768: { items: 2 },
        520: { items: 2 },
        0: { items: 1 },
      },
      rtl: isRTL(),
    });
  });

  /**
   * Product Gallery
   */
  $(function () {
    $(".product-gallery").each(function (i, element) {
      const gallery = $(element);

      const image = gallery.find(".product-gallery__featured .owl-carousel");
      const carousel = gallery.find(".product-gallery__carousel .owl-carousel");

      image
        .owlCarousel({ items: 1, dots: false, rtl: isRTL() })
        .on("changed.owl.carousel", syncPosition);
      carousel
        .on("initialized.owl.carousel", function () {
          carousel
            .find(".product-gallery__carousel-item")
            .eq(0)
            .addClass("product-gallery__carousel-item--active");
        })
        .owlCarousel({
          items: 5,
          dots: false,
          margin: 12,
          responsive: {
            1200: { items: 5 },
            992: { items: 4 },
            768: { items: 4 },
            576: { items: 4 },
            420: { items: 4 },
            0: { items: 3 },
          },
          rtl: isRTL(),
        });

      carousel.on("click", ".owl-item", function (e) {
        e.preventDefault();

        image.data("owl.carousel").to($(this).index(), 300, true);
      });

      image.on("click", ".owl-item a", function (event) {
        event.preventDefault();

        openPhotoSwipe($(this).closest(".owl-item").index());
      });

      function getIndexDependOnDir(index) {
        // we need to invert index id direction === 'rtl' because photoswipe do not support rtl
        if (isRTL()) {
          return image.find(".owl-item img").length - 1 - index;
        }

        return index;
      }

      function openPhotoSwipe(index) {
        const photoSwipeImages = image
          .find(".owl-item a")
          .toArray()
          .map(function (element) {
            const img = $(element).find("img")[0];
            const width = $(element).data("width") || img.naturalWidth;
            const height = $(element).data("height") || img.naturalHeight;

            return {
              src: element.href,
              msrc: element.href,
              w: width,
              h: height,
            };
          });

        if (isRTL()) {
          photoSwipeImages.reverse();
        }

        const photoSwipeOptions = {
          getThumbBoundsFn: function (index) {
            const imageElements = image.find(".owl-item img").toArray();
            const dirDependentIndex = getIndexDependOnDir(index);

            if (!imageElements[dirDependentIndex]) {
              return null;
            }

            const imageElement = imageElements[dirDependentIndex];
            const pageYScroll =
              window.pageYOffset || document.documentElement.scrollTop;
            const rect = imageElement.getBoundingClientRect();

            return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
          },
          index: getIndexDependOnDir(index),
          bgOpacity: 0.9,
          history: false,
        };

        const photoSwipeGallery = new PhotoSwipe(
          $(".pswp")[0],
          PhotoSwipeUI_Default,
          photoSwipeImages,
          photoSwipeOptions
        );

        photoSwipeGallery.listen("beforeChange", function () {
          image
            .data("owl.carousel")
            .to(
              getIndexDependOnDir(photoSwipeGallery.getCurrentIndex()),
              0,
              true
            );
        });

        photoSwipeGallery.init();
      }

      function syncPosition(el) {
        let current = el.item.index;

        carousel
          .find(".product-gallery__carousel-item")
          .removeClass("product-gallery__carousel-item--active")
          .eq(current)
          .addClass("product-gallery__carousel-item--active");
        const onscreen = carousel.find(".owl-item.active").length - 1;
        const start = carousel.find(".owl-item.active").first().index();
        const end = carousel.find(".owl-item.active").last().index();

        if (current > end) {
          carousel.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
          carousel.data("owl.carousel").to(current - onscreen, 100, true);
        }
      }
    });
  });

  /**
   * Checkout payment methods
   */
  $(function () {
    $('[name="checkout_payment_method"]').on("change", function () {
      const currentItem = $(this).closest(".payment-methods__item");

      $(this)
        .closest(".payment-methods__list")
        .find(".payment-methods__item")
        .each(function (i, element) {
          const links = $(element);
          const linksContent = links.find(".payment-methods__item-container");

          if (element !== currentItem[0]) {
            const startHeight = linksContent.height();

            linksContent.css("height", startHeight + "px");
            links.removeClass("payment-methods__item--active");

            linksContent.height(); // force reflow
            linksContent.css("height", "");
          } else {
            const startHeight = linksContent.height();

            links.addClass("payment-methods__item--active");

            const endHeight = linksContent.height();

            linksContent.css("height", startHeight + "px");
            linksContent.height(); // force reflow
            linksContent.css("height", endHeight + "px");
          }
        });
    });

    $(".payment-methods__item-container").on("transitionend", function (event) {
      if (event.originalEvent.propertyName === "height") {
        $(this).css("height", "");
      }
    });
  });

  /**
   * Testimonials Carousel
   */
  $(function () {
    $(".block-testimonials .owl-carousel").owlCarousel({
      items: 1,
      nav: false,
      dots: true,
      rtl: isRTL(),
    });
  });

  /**
   * Mobile Menu
   */
  $(function () {
    $(".header__mobilemenu").on("click", function () {
      $(".mobilemenu").addClass("mobilemenu--open");
    });
    $(".mobilemenu__backdrop, .mobilemenu__close").on("click", function () {
      $(".mobilemenu").removeClass("mobilemenu--open");
    });
  });

  /**
   * Cart
   */
  $(function () {
    $(
      '.header__indicator[data-dropdown-trigger="click"] .header__indicator-button'
    ).on("click", function (event) {
      event.preventDefault();

      const indicator = $(this).closest(".header__indicator");

      if (indicator.is(".header__indicator--open")) {
        indicator.removeClass("header__indicator--open");
      } else {
        indicator.addClass("header__indicator--open");
      }
    });
    $(document).on("click", function (event) {
      $(".header__indicator")
        .not($(event.target).closest(".header__indicator"))
        .removeClass("header__indicator--open");
    });
  });

  /**
   * Collapse
   */
  $(function () {
    $("[data-collapse]").each(function (i, element) {
      const collapse = element;

      $("[data-collapse-trigger]", collapse).on("click", function () {
        const openClass = $(this)
          .closest("[data-collapse-open-class]")
          .data("collapse-open-class");
        const item = $(this).closest("[data-collapse-item]");
        const content = item.children("[data-collapse-content]");
        const itemParents = item.parents();

        itemParents
          .slice(0, itemParents.index(collapse) + 1)
          .filter("[data-collapse-item]")
          .css("height", "");

        if (item.is("." + openClass)) {
          const startHeight = content.height();

          content.css("height", startHeight + "px");
          item.removeClass(openClass);

          content.height(); // force reflow
          content.css("height", "");
        } else {
          const startHeight = content.height();

          item.addClass(openClass);

          const endHeight = content.height();

          content.css("height", startHeight + "px");
          content.height(); // force reflow
          content.css("height", endHeight + "px");
        }
      });

      $("[data-collapse-content]", collapse).on(
        "transitionend",
        function (event) {
          if (event.originalEvent.propertyName === "height") {
            $(this).css("height", "");
          }
        }
      );
    });
  });

  /**
   * Price Filter
   */
  $(function () {
    $(".filter-price").each(function (i, element) {
      const min = $(element).data("min");
      const max = $(element).data("max");
      const from = $(element).data("from");
      const to = $(element).data("to");
      const slider = element.querySelector(".filter-price__slider");

      noUiSlider.create(slider, {
        start: [from, to],
        connect: true,
        direction: isRTL() ? "rtl" : "ltr",
        range: {
          min: min,
          max: max,
        },
      });

      const titleValues = [
        $(element).find(".filter-price__min-value")[0],
        $(element).find(".filter-price__max-value")[0],
      ];

      slider.noUiSlider.on("update", function (values, handle) {
        titleValues[handle].innerHTML = values[handle];
      });
    });
  });

  /**
   * Alerts
   */
  $(function () {
    $(".alert-dismissible .alert__close-button").on("click", function () {
      $(this).closest(".alert").remove();
    });
  });
})(jQuery);
