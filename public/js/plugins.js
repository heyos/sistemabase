//pixelFileInput
(function() {
  var FileInput;

  FileInput = function($input, options) {
    if (options == null) {
      options = {};
    }
    this.options = $.extend({}, FileInput.DEFAULTS, options || {});
    this.$input = $input;
    this.$el = $('<div class="pixel-file-input"><span class="pfi-filename"></span><div class="pfi-actions"></div></div>').insertAfter($input).append($input);
    this.$filename = $('.pfi-filename', this.$el);
    this.$clear_btn = $(this.options.clear_btn_tmpl).addClass('pfi-clear').appendTo($('.pfi-actions', this.$el));
    this.$choose_btn = $(this.options.choose_btn_tmpl).addClass('pfi-choose').appendTo($('.pfi-actions', this.$el));
    this.onChange();
    $input.on('change', (function(_this) {
      return function() {
        return $.proxy(_this.onChange, _this)();
      };
    })(this)).on('click', function(e) {
      return e.stopPropagation();
    });
    this.$el.on('click', function() {
      return $input.click();
    });
    this.$choose_btn.on('click', function(e) {
      return e.preventDefault();
    });
    return this.$clear_btn.on('click', (function(_this) {
      return function(e) {
        $input.wrap('<form>').parent('form').trigger('reset');
        $input.unwrap();
        $.proxy(_this.onChange, _this)();
        e.stopPropagation();
        return e.preventDefault();
      };
    })(this));
  };

  FileInput.DEFAULTS = {
    choose_btn_tmpl: '<a href="#" class="btn btn-sm btn-success">Choose</a>',
    clear_btn_tmpl: '<a href="#" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Clear</a>',
    placeholder: null
  };

  FileInput.prototype.onChange = function() {
    var value;
    value = this.$input.val().replace(/\\/g, '/');
    if (value !== '') {
      this.$clear_btn.css('display', 'inline-block');
      this.$filename.removeClass('pfi-placeholder');
      return this.$filename.text(value.split('/').pop());
    } else {
      this.$clear_btn.css('display', 'none');
      if (this.options.placeholder) {
        this.$filename.addClass('pfi-placeholder');
        return this.$filename.text(this.options.placeholder);
      } else {
        return this.$filename.text('');
      }
    }
  };

  $.fn.pixelFileInput = function(options) {
    return this.each(function() {
      if (!$.data(this, 'pixelFileInput')) {
        return $.data(this, 'pixelFileInput', new FileInput($(this), options));
      }
    });
  };

  $.fn.pixelFileInput.Constructor = FileInput;

})(jQuery);

//Growl Notifications
(function() {
  "use strict";
  var $, Animation, Growl,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  $ = jQuery;

  Animation = (function() {
    function Animation() {}

    Animation.transitions = {
      "webkitTransition": "webkitTransitionEnd",
      "mozTransition": "mozTransitionEnd",
      "oTransition": "oTransitionEnd",
      "transition": "transitionend"
    };

    Animation.transition = function($el) {
      var el, result, type, _ref;
      el = $el[0];
      _ref = this.transitions;
      for (type in _ref) {
        result = _ref[type];
        if (el.style[type] != null) {
          return result;
        }
      }
    };

    return Animation;

  })();

  Growl = (function() {
    Growl.settings = {
      namespace: 'growl',
      duration: 3200,
      close: "&times;",
      location: "default",
      style: "default",
      size: "medium"
    };

    Growl.growl = function(settings) {
      if (settings == null) {
        settings = {};
      }
      this.initialize();
      return new Growl(settings);
    };

    Growl.initialize = function() {
      return $("body:not(:has(#growls))").append('<div id="growls" />');
    };

    function Growl(settings) {
      if (settings == null) {
        settings = {};
      }
      this.html = __bind(this.html, this);
      this.$growl = __bind(this.$growl, this);
      this.$growls = __bind(this.$growls, this);
      this.animate = __bind(this.animate, this);
      this.remove = __bind(this.remove, this);
      this.dismiss = __bind(this.dismiss, this);
      this.present = __bind(this.present, this);
      this.close = __bind(this.close, this);
      this.cycle = __bind(this.cycle, this);
      this.unbind = __bind(this.unbind, this);
      this.bind = __bind(this.bind, this);
      this.render = __bind(this.render, this);
      this.settings = $.extend({}, Growl.settings, settings);
      this.$growls().attr('class', this.settings.location);
      this.render();
    }

    Growl.prototype.render = function() {
      var $growl;
      $growl = this.$growl();
      this.$growls().append($growl);
      this.cycle($growl);
    };

    Growl.prototype.bind = function($growl) {
      if ($growl == null) {
        $growl = this.$growl();
      }
      return $growl.find("." + this.settings.namespace + "-close").on("click", this.close);
    };

    Growl.prototype.unbind = function($growl) {
      if ($growl == null) {
        $growl = this.$growl();
      }
      return $growl.find("." + (this.settings.namespace - close)).off("click", this.close);
    };

    Growl.prototype.cycle = function($growl) {
      if ($growl == null) {
        $growl = this.$growl();
      }
      return $growl.queue(this.present).delay(this.settings.duration).queue(this.dismiss).queue(this.remove);
    };

    Growl.prototype.close = function(event) {
      var $growl;
      event.preventDefault();
      event.stopPropagation();
      $growl = this.$growl();
      return $growl.stop().queue(this.dismiss).queue(this.remove);
    };

    Growl.prototype.present = function(callback) {
      var $growl;
      $growl = this.$growl();
      this.bind($growl);
      return this.animate($growl, "" + this.settings.namespace + "-incoming", 'out', callback);
    };

    Growl.prototype.dismiss = function(callback) {
      var $growl;
      $growl = this.$growl();
      this.unbind($growl);
      return this.animate($growl, "" + this.settings.namespace + "-outgoing", 'in', callback);
    };

    Growl.prototype.remove = function(callback) {
      this.$growl().remove();
      return callback();
    };

    Growl.prototype.animate = function($element, name, direction, callback) {
      var transition;
      if (direction == null) {
        direction = 'in';
      }
      transition = Animation.transition($element);
      $element[direction === 'in' ? 'removeClass' : 'addClass'](name);
      $element.offset().position;
      $element[direction === 'in' ? 'addClass' : 'removeClass'](name);
      if (callback == null) {
        return;
      }
      if (transition != null) {
        $element.one(transition, callback);
      } else {
        callback();
      }
    };

    Growl.prototype.$growls = function() {
      return this.$_growls != null ? this.$_growls : this.$_growls = $('#growls');
    };

    Growl.prototype.$growl = function() {
      return this.$_growl != null ? this.$_growl : this.$_growl = $(this.html());
    };

    Growl.prototype.html = function() {
      return "<div class='" + this.settings.namespace + " " + this.settings.namespace + "-" + this.settings.style + " " + this.settings.namespace + "-" + this.settings.size + "'>\n  <div class='" + this.settings.namespace + "-close'>" + this.settings.close + "</div>\n  <div class='" + this.settings.namespace + "-title'>" + this.settings.title + "</div>\n  <div class='" + this.settings.namespace + "-message'>" + this.settings.message + "</div>\n</div>";
    };

    return Growl;

  })();

  $.growl = function(options) {
    if (options == null) {
      options = {};
    }
    return Growl.growl(options);
  };

  $.growl.error = function(options) {
    var settings;
    if (options == null) {
      options = {};
    }
    settings = {
      title: "Error!",
      style: "error"
    };
    return $.growl($.extend(settings, options));
  };

  $.growl.notice = function(options) {
    var settings;
    if (options == null) {
      options = {};
    }
    settings = {
      title: "Notice!",
      style: "notice"
    };
    return $.growl($.extend(settings, options));
  };

  $.growl.warning = function(options) {
    var settings;
    if (options == null) {
      options = {};
    }
    settings = {
      title: "Warning!",
      style: "warning"
    };
    return $.growl($.extend(settings, options));
  };

})(jQuery);

//switcher
(function() {
  var Switcher;

  Switcher = function($el, options) {
    var box_class;
    if (options == null) {
      options = {};
    }
    this.options = $.extend({}, Switcher.DEFAULTS, options);
    this.$checkbox = null;
    this.$box = null;
    if ($el.is('input[type="checkbox"]')) {
      box_class = $el.attr('data-class');
      this.$checkbox = $el;
      this.$box = $('<div class="switcher"><div class="switcher-toggler"></div><div class="switcher-inner"><div class="switcher-state-on">' + this.options.on_state_content + '</div><div class="switcher-state-off">' + this.options.off_state_content + '</div></div></div>');
      if (this.options.theme) {
        this.$box.addClass('switcher-theme-' + this.options.theme);
      }
      if (box_class) {
        this.$box.addClass(box_class);
      }
      this.$box.insertAfter(this.$checkbox).prepend(this.$checkbox);
    } else {
      this.$box = $el;
      this.$checkbox = $('input[type="checkbox"]', this.$box);
    }
    if (this.$checkbox.prop('disabled')) {
      this.$box.addClass('disabled');
    }
    if (this.$checkbox.is(':checked')) {
      this.$box.addClass('checked');
    }
    this.$checkbox.on('click', function(e) {
      return e.stopPropagation();
    });
    this.$box.on('touchend click', (function(_this) {
      return function(e) {
        e.stopPropagation();
        e.preventDefault();
        return _this.toggle();
      };
    })(this));
    return this;
  };


  /*
   * Enable switcher.
   *
   */

  Switcher.prototype.enable = function() {
    this.$checkbox.prop('disabled', false);
    return this.$box.removeClass('disabled');
  };


  /*
   * Disable switcher.
   *
   */

  Switcher.prototype.disable = function() {
    this.$checkbox.prop('disabled', true);
    return this.$box.addClass('disabled');
  };


  /*
   * Set switcher to true.
   *
   */

  Switcher.prototype.on = function() {
    if (!this.$checkbox.is(':checked')) {
      this.$checkbox.click();
      return this.$box.addClass('checked');
    }
  };


  /*
   * Set switcher to false.
   *
   */

  Switcher.prototype.off = function() {
    if (this.$checkbox.is(':checked')) {
      this.$checkbox.click();
      return this.$box.removeClass('checked');
    }
  };


  /*
   * Toggle switcher.
   *
   */

  Switcher.prototype.toggle = function() {
    if (this.$checkbox.click().is(':checked')) {
      return this.$box.addClass('checked');
    } else {
      return this.$box.removeClass('checked');
    }
  };

  Switcher.DEFAULTS = {
    theme: null,
    on_state_content: 'ON',
    off_state_content: 'OFF'
  };

  $.fn.switcher = function(options, attrs) {
    return $(this).each(function() {
      var $this, sw;
      $this = $(this);
      sw = $.data(this, 'Switcher');
      if (!sw) {
        return $.data(this, 'Switcher', new Switcher($this, options));
      } else if (options === 'enable') {
        return sw.enable();
      } else if (options === 'disable') {
        return sw.disable();
      } else if (options === 'on') {
        return sw.on();
      } else if (options === 'off') {
        return sw.off();
      } else if (options === 'toggle') {
        return sw.toggle();
      }
    });
  };

  $.fn.switcher.Constructor = Switcher;

})(jQuery);