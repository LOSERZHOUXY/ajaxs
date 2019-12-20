'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function () {
	window.$ = window.jQuery = function (selector) {
		return new Zxy(selector);
	};

	var Zxy = function () {
		function Zxy(selector) {
			_classCallCheck(this, Zxy);

			if (selector.nodeType == 1) {
				this.length = 0;
				this[0] = selector;
			} else {
				var els = document.querySelectorAll(selector);
				for (var i = 0; i < els.length; i++) {
					this[i] = els[i];
				}
				this.length = els.length;
			}
		}
		//添加CSS


		_createClass(Zxy, [{
			key: 'css',
			value: function css(obj) {
				for (var i = 0; i < this.length; i++) {
					for (var attr in obj) {
						this[i].style[attr] = obj[attr];
					}
				}
				return this;
			}
			//获取一堆元素中的某个元素对象

		}, {
			key: 'eq',
			value: function eq(num) {
				var el = this[num];
				for (var i = 0; i < this.length; i++) {
					delete this[i];
				}
				this.length = 1;
				this[0] = el;
				return this;
			}
			//添加class

		}, {
			key: 'addClass',
			value: function addClass(cname) {
				for (var i = 0; i < this.length; i++) {
					if (this[i].className.trim()) {
						var carr = this[i].className.split(' ');
						if (carr.indexOf(cname) == -1) {
							carr.push(cname);
							this[i].className = carr.join();
						}
					} else {
						this[i].className = cname;
					}
				}
				return this;
			}
			//获取原生对象

		}, {
			key: 'get',
			value: function get(num) {
				return this[num];
			}
			//移出class

		}, {
			key: 'removeClass',
			value: function removeClass(cname) {
				for (var i = 0; i < this.length; i++) {
					if (this[i].className.trim()) {
						var carr = this[i].className.split(' ');
						if (carr.indexOf(cname) != -1) {
							carr.splice(carr.indexOf(cname), 1);
							this[i].className = carr.join();
						}
					}
				}
				return this;
			}
		}]);

		return Zxy;
	}();
})();

$('li').css({
	color: 'green'
}).addClass('active').eq(1).removeClass('active');
