
(function( $ ) {
	
		//slippry slider 
		$('.slippry-slider-container').slippry({ 
			hideOnEnd: false,
			adaptiveHeight: true, 
		}); 
		//$('#out-of-the-box-demo').slippry();
		
		$('#news-demo').slippry({
			// general elements & wrapper
			slippryWrapper: '<div class="sy-box news-slider" />', // wrapper to wrap everything, including pager
			elements: 'article', // elments cointaining slide content

			// options
			adaptiveHeight: false, // height of the sliders adapts to current 
			captions: false,

			// pager
			pagerClass: 'news-pager',

			// transitions
			transition: 'horizontal', // fade, horizontal, kenburns, false
			speed: 1200,
			pause: 8000,

			// slideshow
			autoDirection: 'prev'
		});
		
		var thumbs = $('#thumbnails').slippry({
			// general elements & wrapper
			slippryWrapper: '<div class="slippry_box thumbnails" />',
			// options
			transition: 'horizontal',
			pager: false,
			auto: false,
			onSlideBefore: function (el, index_old, index_new) {
				jQuery('.thumbs a img').removeClass('active');
				jQuery('img', jQuery('.thumbs a')[index_new]).addClass('active');
			}
		});

		jQuery('.thumbs a').click(function () {
			thumbs.goToSlide($(this).data('slide'));
			return false;
		});
		
		//$('.logo-slider .slick-slide img').matchHeight();
		//$('.logo-slider .slick-slide .slick-p').matchHeight();
		
	
})( jQuery );