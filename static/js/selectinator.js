/*
 * library dependencies:
 *      jquery
 */

// plugin 1.0


$(document).ready(function () {
  "use strict";
  var pluginName = "selectionator";
  var defaults = {
    propertyName: "selectionator",
    src: null,
    orgElement: null,
    checkedItems: [],
    // custom callback events
    onError: function(error) {}
  };
  function Plugin(element, options) {
    this.element = element;
    this.selector = null;
    this.options = $.extend({}, defaults, options);
    this._defaults = defaults;
    this._name = pluginName;
    this.init();
  }
  Plugin.prototype = {
    init: function () {
      var that = this;
      var self = $(that.element);
      that.options.src = that.element.getAttribute('data-src');
      that.selector = that.createFromJson(that.options.data);
      that.options.orgElement = that.element.parentNode.replaceChild(that.selector, that.element);
      $(that.selector).addClass(that._name);
    },
    createFromJson: function(options) {
      var that = this;
      var select = document.createElement('select');
      var popup = document.createElement('div');
      var header = document.createElement('div');
      var search = document.createElement('span');
      var overlay = document.createElement('span');
      overlay.className = 'overlay';
      var shadow = document.createElement('span');
      shadow.className = 'shadow';
      var placeholder = document.createTextNode('Theme');
      search.className = 'search';
      search.appendChild(shadow);     
      search.appendChild(overlay);   
      search.appendChild(placeholder);   
      popup.appendChild(search);
      var menu = document.createElement('ul');
      select.style.display = 'none';
	  
      menu.className = 'list';
      var box = document.createElement('div');
      box.className = 'menu';
      box.appendChild(menu);
      popup.appendChild(box);
      options.optgroups.forEach(function(optgroup, index) {


        var menuItem = document.createElement('li');
        //menuItem.className('header');
        var header = document.createElement('span');
        header.className = 'header';
        var caption = document.createTextNode(optgroup.label);
        header.appendChild(caption);
        menuItem.appendChild(header);
        var menuItems = document.createElement('ul');
        menuItems.className = 'optgroup';
        menuItem.appendChild(menuItems);
        menu.appendChild(menuItem);

        optgroup.options.forEach(function(option, index) {
          var opt = new Option(option.text, option.value, option.defaultSelected, option.selected);
          select.options.add(opt);
          var item = document.createElement('li');
          var label = document.createElement('label');
          label.setAttribute("for", option.value);
          var checkbox = document.createElement('input');
          if(index === 2) checkbox.setAttribute('checked', true)
          $(checkbox).data(option);
          checkbox.setAttribute('type', 'checkbox');

          checkbox.addEventListener('change', function(event){
            var checkbox = event.target;
            var $el = $(event.srcElement);
			if (checkbox.id == '0'){
			  if(!checkbox.checked) {
			    checkbox.checked = true
			  } else {
			    for(let i = 99; i--;){let d = document.getElementById(""+i); if (d && ""+i !== checkbox.id) d.checked = false}
			    window.location.href = 'https://beige.fowlerautocenter.com'
		      }
			}
			if (checkbox.id == '1'){
			  if(!checkbox.checked) {
			    checkbox.checked = true
			  } else {
			    for(let i = 99; i--;){let d = document.getElementById(""+i); if (d && ""+i !== checkbox.id) d.checked = false}
			    window.location.href = 'https://red.fowlerautocenter.com'
			  }
			}
                        if (checkbox.id == '2'){
                          if(!checkbox.checked) {
                            checkbox.checked = true
                          } else {
                            for(let i = 99; i--;){let d = document.getElementById(""+i); if (d && ""+i !== checkbox.id) d.checked = false}
                            window.location.href = 'https://winter.fowlerautocenter.com'
                          }
                        }
                        if (checkbox.id == '3'){
                          if(!checkbox.checked) {
                            checkbox.checked = true
                          } else {
                            for(let i = 99; i--;){let d = document.getElementById(""+i); if (d && ""+i !== checkbox.id) d.checked = false}
                            window.location.href = 'https://darkblue.fowlerautocenter.com/#'
                          }
                        }
            if (checkbox.checked) {
              that.options.checkedItems.push(event.srcElement);
              //placeholder.nodeValue = "Selected: " + that.options.checkedItems.length + " out of " + $(that.selector).find('input[type="checkbox"]').length;
			  placeholder.nodeValue = 'Theme'

            } else {
              that.options.checkedItems.pop();
              that.options.checkedItems = that.options.checkedItems.filter(function(items, index){
                return items.value != $el.data().value;
              });
              //placeholder.nodeValue = "Selected: " + that.options.checkedItems.length + " out of " + $(that.selector).find('input[type="checkbox"]').length;
			  placeholder.nodeValue = 'Theme'
            }
          });
          checkbox.id = option.value;
          var caption = document.createTextNode(option.text);
          label.appendChild(caption);
          item.appendChild(checkbox);
          item.appendChild(label);
          menuItems.appendChild(item);
        });
      });
      return popup;
    },
    onAddFriend: function(data) {
      var that = this;
      return that.options.onAddFriend(that, data);
    },
    onRemoveFriend: function(data){
      var that = this;
      var self = $(that.element);
      return that.options.onRemoveFriend(data);
    },
    destroy: function() {
      var that = this;
      $(that.element).unbind("destroyed", that.teardown);
      that.teardown();
    },
    teardown: function() {
      var that = this;
      $(that.element).removeClass(that._name);
      $(that.selector).replaceWith(that.options.orgElement);
      $(that.element).removeData(that._name);
      that.unbind();
      that.element = null;
    },
    bind: function() { },
    unbind: function() { }
  };
  $.fn[pluginName] = function (options) {
    return this.each(function () {
      if (!$.data(this, pluginName)) {
        $.data(this, pluginName, new Plugin(this, options));
      }
    });
  };
});
//Attach plugin to all matching element
$(document).ready(function () {
  $('#select').selectionator({
    data: {
      optgroups: [{
        label: 'Choose --',
        options: [{
          value: 0,
          text: 'Cream',
          defaultSelected: false,
          selected: false
        }, {
          value: 1,
          text: 'Red',
          defaultSelected: false,
          selected: false
        }, {
          value: 2,
          text: 'Winter',
          defaultSelected: false,
          selected: false
        }, {
          value: 3,
          text: 'Dark Blue',
          defaultSelected: false,
          selected: false
        }]
      }]
    }
  });
  setTimeout(function(){
    $(".selectionator").addClass('opened');
  }, 500);
  setTimeout(function(){
    $(".selectionator").removeClass('opened');
  }, 1250);
});

