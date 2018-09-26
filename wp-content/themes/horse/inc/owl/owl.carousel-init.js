jQuery(window).load(function(){
	
	jQuery('.owl-carousel').owlCarousel({
		items: 1,
		slideSpeed: 500,
		loop: true,
		center: true,
		stagePadding: 0,
		autoHeight: true,
		autoWidth: true,
		lazyLoad : true,
		nav: true,
		navText: ["<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-left.svg'>","<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-right.svg'>"],
		//autoplay: true,
		//autoplaySpeed: 2000,
		responsive: {
			960: {
				stagePadding: 100
			},
			1280: {
				stagePadding: 300
			},
			1600: {
				stagePadding: 600
			}
		},

		afterAction: function(el){
		   //remove class active
		   this
		   .$owlItems
		   .removeClass('active')

		   //add class active
		   this
		   .$owlItems //owl internal $ object containing items
		   .eq(this.currentItem)
		   .addClass('active')    
	    } 
	});

	jQuery('.owl-carousel.video').owlCarousel({
		items: 1,
		slideSpeed: 500,
		loop: true,
		center: true,
		stagePadding: 0,
		nav: true,
		navText: ["<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-left.svg'>","<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-right.svg'>"],
		autoplay: false,

		afterAction: function(el){
		   //remove class active
		   this
		   .$owlItems
		   .removeClass('active')

		   //add class active
		   this
		   .$owlItems //owl internal $ object containing items
		   .eq(this.currentItem)
		   .addClass('active')    
	    } 
	});

	jQuery('.owl-carousel-collection').owlCarousel({
		items: 3,
		slideSpeed: 500,
		margin: 20,
		slideBy: 3,
		loop: true,
		center: true,
		stagePadding: 0,
		nav: true,
		navText: ["<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-left.svg'>","<img src='http://saharascottsdale.com/wp-content/themes/horse/images/owl-arrow-square-right.svg'>"],
		mouseDrag: false,
		autoplay: false,
		responsive: {
			0: {
				items: 1,
				slideBy: 1,
				center: false
			},
			600: {
				items: 2,
				slideBy: 2,
				center: false
			},
			960: {
				items: 3
			},
			1200: {
				stagePadding: 100
			}
		},

		afterAction: function(el){
		   //remove class active
		   this
		   .$owlItems
		   .removeClass('active')

		   //add class active
		   this
		   .$owlItems //owl internal $ object containing items
		   .eq(this.currentItem)
		   .addClass('active')    
	    } 
	});

	/*$(".owl-carousel").each(function(index, el) {
		var containerHeight = $(el).height();
		$(el).find('.owl-item').each(function(index, div) {
			var w = $(div).find('img').prop('naturalWidth');
			var h = $(div).find('img').prop('naturalHeight');

			console.log(w,h);
			if (h > 616) {
				$(div).css({
					'width': Math.round(616 * w / h) + 'px',
					'height': 616 + 'px'
				});
			}
		}),
		$(el).owlCarousel({
			//autoWidth: true
		});
	});*/
});
