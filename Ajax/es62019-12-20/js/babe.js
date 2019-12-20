(function() {
				window.$ = window.jQuery = function(selector) {
					return new Zxy(selector);
				}
				class Zxy {
					constructor(selector) {
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
					css(obj) {
						for (let i = 0; i < this.length; i++) {
							for (let attr in obj) {
								this[i].style[attr] = obj[attr];
							}
						}
						return this;
					}
					//获取一堆元素中的某个元素对象
					eq(num){
						let el =this[num]
						for (var i = 0; i < this.length; i++) {
							delete this[i]
						}
						this.length=1;
						this[0]=el;
						return this;
					}
					//添加class
					addClass(cname){
						for (let i = 0; i < this.length; i++) {
							if(this[i].className.trim()){
								let carr = this[i].className.split(' ');
								if(carr.indexOf(cname)==-1){
									carr.push(cname);
									this[i].className=carr.join()
								}
								
							}else{
								this[i].className=cname;
							}
						}
						return this;
					}
					//获取原生对象
					get(num){
						return this[num];
					}
					//移出class
					removeClass(cname){
						for (let i = 0; i < this.length; i++) {
							if(this[i].className.trim()){
								let carr = this[i].className.split(' ');
								if(carr.indexOf(cname)!=-1){
									carr.splice(carr.indexOf(cname),1)
									this[i].className=carr.join();
								}
								
							}
						}
						return this;
					}
						
					
						
					}
				}
			})()
			
			$('li').css({
				color: 'green'
			}).addClass('active').eq(1).removeClass('active')