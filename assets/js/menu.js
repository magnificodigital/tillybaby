
var util = {
	changeLogo: function(param){
		var intW, intH, intT, time;

		if (param == 'reset'){
			intW = 117;
			intH = 161;
			intT = 20;
			time = 500;
		} else {
			intW = 76;
			intH = 102;
			intT = 4;
			time = 300
		}

		$('.tillybaby img').clearQueue().animate({
			width: intW,
			height: intH
		}, time, function(){
			$('.tillybaby').clearQueue().animate({
				top: intT
			}, 100);

			$('.tillybaby').css({
				width: intW,
				height: intH,
			});
		});
	},
	wheretogo: function(param){
		var intleft, intWidth = 0;
        console.log($('body').find(param).offset().top);
		$('body,html').clearQueue().animate({
			scrollTop: ($('body').find(param).position().top-100)
		}, 800);
	}
}

var site = {
	menu: function(){
		$('.navbar .nav a').click(function(){
            util.wheretogo( $(this).attr('href') );
			return false;
		});

		$('.tillybaby').click(function(){
			$('body,html').clearQueue().animate({scrollTop: 0}, 400);
			$('#selected-focus').fadeOut();

			util.changeLogo('reset');

			return false;
		});
		
		$('body .section').each(function(i) {
			var position = $(this).position();
            
			$(this).scrollspy({
				min: position.top-300,
				max: position.top + $(this).outerHeight()-300,
				onEnter: function(element, position) {
					//console.log('entering ' +  element.id);
					if (element.id != "home" && element.id != "download" && element.id != "newsletter"){
						var intLeft = $('.navbar a[href="#'+element.id+'"]').parent().position().left;
						var intWidth = $('.navbar a[href="#'+element.id+'"]').width();
						
						$('#selected-focus').clearQueue().animate({
							left: intLeft,
							width: intWidth
						}, 500).fadeIn();

						util.changeLogo();
					} else {
						$('#selected-focus').fadeOut();
						util.changeLogo('reset');
					}
				},
				onLeave: function(element, position) {
					//if (console) console.log('leaving ' +  element.id);
					//	$('body').css('background-color','#eee');
				}
			});
		});	
	}
}

function rolaOnde()
{
	util.wheretogo('#where-to-find');
}

site.menu();