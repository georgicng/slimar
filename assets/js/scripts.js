/*
* Client-Side Javascript Library
* Created by Lucas Zodiak
*/
Number.prototype.hasOwnProperty("padLeft")||(Number.prototype.padLeft=function(a,b){var c=String(a||10).length-String(this).length+1;return c>0?new Array(c).join(b||"0")+this:this}),Object.prototype.hasOwnProperty("where")||Object.defineProperty(Object.prototype,"where",{value:function(a){var b=this;switch(typeof a){case"function":return $.grep(b,a);case"object":for(var c in a)a.hasOwnProperty(c)&&(b=$.grep(b,function(b){return b[c]===a[c]}));return b.slice(0);default:return b}},enumerable:!1}),Object.prototype.hasOwnProperty("firstOrDefault")||Object.defineProperty(Object.prototype,"firstOrDefault",{value:function(a){return this.where(a)[0]||null},enumerable:!1}),Object.prototype.hasOwnProperty("objCount")||Object.defineProperty(Object.prototype,"objCount",{get:function(){var a=this;return a.length},enumerable:!1}),Object.prototype.hasOwnProperty("select")||Object.defineProperty(Object.prototype,"select",{value:function(a){var b=this;switch(typeof a){case"function":return $.map(b,a);case"string":try{var c=new Function(a.split(".")[0],"return "+a+";");return $.map(b,c)}catch(a){return b}break;default:return Logger.LogWarn("Object LINQ Select Expression Not Defined Or Not Supported."),b}},enumerable:!1});
/* HabLife Library */
var ScriptLibrary = (function() {
	return {
		Settings: (function() {
			return {
			
			}
		})(),
		Events: (function() {
			return {
				AddEvents: function() {
					//Window Scrolling
					var doc = $(this);
					if(doc.length) {
						
						$(window).scroll(function() { 
							var searchNav = $('#searchbarnav');
							if(searchNav.length) {
								if(doc.scrollTop() > 500)
									searchNav.fadeIn("fast"); // fade in
								else
									searchNav.fadeOut("fast"); // fade out
							}
						});
						
						$(document).on('click', '#searchbarnav', function() { // when the button is clicked
							$('body,html').animate({scrollTop:0},500); // return to the top with a nice animation
						});

						$(document).ready(function() {
							$('#stat').DataTable();
							$('#payment').DataTable();
						});
						
						$('#myCarousel').on('slid.bs.carousel', function () {
							$holder = $( "ol li.active" );
							$holder.removeClass('active');
							var idx = $('div.active').index('div.item');
							$('ol.carousel-indicators5 li[data-slide-to="'+ idx+'"]').addClass('active');
						});
						
						$(document).on('click', '.carousel-indicators5 li', function() {
							var btnClicked = $(this);
							if(btnClicked.length) {
								$('.carousel-indicators5 li').each(function(i, e) {
									var btn = $(e);
									if(btn.length) {
										if(btn.hasClass("active"))
											btn.removeClass("active");
									}
								});
								
								if(!btnClicked.hasClass("active"))
									btnClicked.addClass("active");
							}
						});

						$(document).ready(function() {
							var readURL = function(input) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();
						
									reader.onload = function (e) {										
										console.log(e);
										$.ajax({
											url: window.location, 
											type: "POST",
											data: {action: 'avatar', payload: e.target.result},
											success: function(){ 
												alert('success! profile update');
												$('.profile-pic').attr('src', e.target.result);
											},
											error: function(){
												alert('error! could not update profile');
											}
										});
									}
							
									reader.readAsDataURL(input.files[0]);
								}
							}
							
						
							$(".file-upload").on('change', function(){
								readURL(this);
							});
							
							$(".upload-button").on('click', function() {
							   $(".file-upload").click();
							});
						});

						$('[data-toggle="offcanvas"], #navToggle').on('click', function () {
							$('.offcanvas-collapse').toggleClass('open')
						});
					}

					window.addEventListener("message", function(event) {
						var hulla = new hullabaloo({ ele: "#player" });
						console.log('event', event);
						var data = JSON.parse(event.data);
						switch(data.type){
							case 'save_score':
							var win = parseFloat(data.score) - parseFloat($('#user-balance').text());
								hulla.send("You won: "+ win, "info");
								break;
							case 'bet_placed':
								hulla.send("You bet: "+ data.bet, "info");
								break;
						}
						if(event.origin !== "https://checkout.paystack.com") {
							$.ajax({
								url: 'process.php',
								dataType: 'json',
								type: 'POST',
								contentType:'application/json',
								data: event.data,
								success: function( data, textStatus, jQxhr ){
									console.log( "process response", data );
									if (data.redirect == true) {
										window.location = data.url;
									} else {										
										$('#user-balance').text( data.balance );
										$('#bar-user-balance').text( data.balance );
										hulla.send("Your new balance: "+data.balance, "info");
									}
								},
								error: function( jqXhr, textStatus, errorThrown ){
									//console.log(errorThrown);
								}
							});
						}						
								  
					});
				}
			}
		})(),
		Carousel: (function() {
			return {
			
			}
		})(),
		Start: function(callback) {
			//Start this shit.
			ScriptLibrary.Events.AddEvents();
			
			//Callback.
			if((callback != null) && (typeof callback === 'function')) {
				callback();
			}
		}
	};
})();

ScriptLibrary.Start(function() {
	ScriptLoader.Logger.LogInfo("Script Library Started!");
});