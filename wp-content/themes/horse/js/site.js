// SITE js
var SITE = {
	isMobile : function(){	
		//var uagent = navigator.userAgent.toLowerCase();
		//if (uagent.search("iphone") > -1 || uagent.search("ipod") > -1){
		if( /Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent) ) {
			return true;
		}else{
			return false;
		}
	},
	//Tablet Condition
	isTablet : function(){	
		var uagent = navigator.userAgent.toLowerCase();
		//if (uagent.search("iphone") > -1 || uagent.search("ipod") > -1){
		if( /Android|iPad/i.test(navigator.userAgent) ) {
			return true;
		}else{
			return false;
		}
	},
	toTop:function(){
			jQuery('html, body').animate( { scrollTop: 0 }, 'slow' );
	},
	
	initMobileMenu: function(){
		//	The menu on the left
		jQuery('#mobile_menu').mmenu({
			selectedClass  : "current_page_item"
		});
	},	
	//Show Form Error
	showErrorBox: function(error){
		var errorbox = '<div id="error-messages" class="error-popup mfp-hide"> <h2>Oops!</h2><ul id="error-list"></ul></div>';
		if(jQuery("#error-messages").size() == 0){
			jQuery(errorbox).appendTo("body");
		}
		jQuery("#error-list").empty().append(error);
		jQuery.magnificPopup.open({
		  items: {src: '#error-messages'},
		  type: 'inline'
		}, 0);
		return false;
	},
	toTitleCase: function(str) {
		 return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	},	
	equalHeight: function(el){
		if(jQuery(el).size() > 0){
			var byRow = true;
			jQuery(el).matchHeight(byRow);
		}
	},
    
    eqChild2 : function(){
        if(jQuery('.eq-parent2').size() > 0){
        var HChild = jQuery(".eq-parent2").height();
        var HSubChild = HChild/2;
        jQuery(".eq-child2").css("height",HSubChild); 
        }
        
    },
	//Accordian
	initAccordion: function(){
		var oAccordion = jQuery('.accordion_container');
		if(oAccordion.size() > 0){
			var menu_ul = jQuery('.accordion_container > li > div.accordion_content'), menu_a  = jQuery('.accordion_container > li > a'), default_open_slide =		jQuery('.accordion_container > li > div.default_open_slide');		
			menu_ul.hide();	
			default_open_slide.show();	
			menu_a.click(function(e) {
				e.preventDefault();
				if(!jQuery(this).hasClass('active')) {
					menu_a.removeClass('active');
					menu_ul.filter(':visible').slideUp('normal');
					jQuery(this).addClass('active').next().stop(true,true).slideDown('normal');
				} else {
					jQuery(this).removeClass('active');
					jQuery(this).next().stop(true,true).slideUp('normal');
				}
			});
		}
	},
	
	socialShare: function(o){
		var $a = jQuery(o);
		var social = $a.data('social');
		var params = $a.data("share-params");
		if(social == "facebook"){
			url = "https://www.facebook.com/sharer/sharer.php?"+params;
		}else if(social == "twitter"){
			url = "https://twitter.com/intent/tweet?"+params;
		}else if(social == "pinterest"){
			url = "https://pinterest.com/pin/create/button/?"+params;
		}else if(social == "gplus"){
			url = "https://plus.google.com/share?"+params;
		}
		
		window.open(url, 'social-share-dialog', 'width=626,height=436'); 
		return false;
	}, 
	initTabs: function(){
		jQuery(".tabs").on("click","a",function(event) {
            event.preventDefault();
            jQuery(this).parent().addClass("active");
            jQuery(this).parent().siblings().removeClass("active");
            var tab = jQuery(this).attr("href");
            jQuery(".tab-content").hide();
            jQuery(tab).show();
        });
	},
	initSlider: function(slider,numSlides){
		var slideOptions = {}
		if(numSlides == 1){
			slideOptions = {
				controls  :  false,
				responsive:  true,
				auto: true,
				mode: 'fade',
				pause: 20000
			}
		}else if(numSlides == 3){
			slideOptions = {
				controls  :  false,
				responsive:  true,
				infiniteLoop: false,
				slideWidth: 380,
				minSlides: 1,
				maxSlides: 3,
				moveSlides: 1,
				slideMargin: 0,
				auto: true,
				mode: 'fade',
				pause: 15000
			}
		}else if(numSlides == 4){
			var slide_width = 300;
			if(SITE.isMobile()){
				slide_width = 340;
			}
			slideOptions = {
				pager  :  false,
				responsive:  true,
				infiniteLoop: false,
				nextSelector: '#team_next',
				prevSelector: '#team_prev',
				slideWidth: slide_width,
				minSlides: 1,
				maxSlides: 4,
				moveSlides: 1,
				slideMargin: 0,
				auto: true,
				mode: 'fade',
			}
		}			
		jQuery(slider).bxSlider(slideOptions);	
	},
	
	scrollToSection:function(){
			var selector = '#primary-menu a';
    		//Removes click event of each li
    		jQuery(selector ).unbind('click');
    		//Add click event
    		jQuery(selector ).bind('click', function(){
				var contentMenuHT = jQuery('.header').height();
				jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top-contentMenuHT+1}, 'slow');	
				jQuery(selector).removeClass('active');
				jQuery(this).addClass('active');
			});
	},
	stickyHeader: function(){
		if(jQuery(window).width() > 768){
			if(jQuery('body').scrollTop() >= 200){
				//sticky Header
				var iCurScrollPos = jQuery('body').scrollTop();
			    if (iCurScrollPos >= iScrollPos) {
			        //Scrolling Down
			        jQuery('.header').addClass('sticky-header');
			    } else {
			       //Scrolling Up
			       jQuery('.header').addClass('sticky-header');
			    }
			    iScrollPos = iCurScrollPos;
			} else{
				jQuery('.header').removeClass('sticky-header');
			}
		} else{
			jQuery('.header').removeClass('sticky-header');
		}
	},
	
	testmonialsSlider: function(){
		jQuery('.testmonialsSlider').bxSlider({
		  adaptiveHeight: false,
		  captions: true,
		  pager: false,
		  controls : false,
		  auto:true,
		  mode: 'fade',
pause: 8000
		});
	},
	
	simpleTab: function(){
		if(jQuery('.simple-tab-wrapper').size() > 0){
			var currentIndex = 0;
			jQuery('.simple-tab-wrapper .simple-tab-content:first-child').show().addClass('active');
			jQuery('.simple-tab-links li:first-child a').addClass('selected');	
				 
			jQuery('.simple-tab-links a').click(function(){
				jQuery(this).parents('.simple-tab-links').find('a').removeClass('selected');
				jQuery(this).addClass('selected');
				var currentTab = jQuery(this).attr('href');
				jQuery(this).parents('.caregoryPopup').find('.simple-tab-content').hide();
				jQuery(currentTab).show().addClass('active');
				jQuery('.eq-child').removeAttr('style');
				SITE.equalHeight(".eq-parent .eq-child");
					return false;			
			});			
		}
	},
	
	/*initCarousel : function(){	
		if(jQuery(".initCarousel").size() > 0){	
			    var owl = jQuery(".initCarousel");
                owl.owlCarousel({
                    items : 2,
                    slideBy : 1,
                    itemsDesktop : [1000,2],
                    itemsDesktopSmall : [900,2],
                    itemsTablet: [600,1],
                    itemsMobile : [500,1],
                    autoplay: true,
                    navigation: true,
                    dots : false,
                    loop : true,
                    autoplayHoverPause : true,
                    margin: 0
                });
		    } 
	},
    
    initCarousel2 : function(){	
        if(jQuery("#Carousel").size() > 0){	
            var carousel = jQuery('#Carousel').glide({
				type: 'carousel',
				paddings: '25%',
				startAt: 2,
			});
        }
    },*/

    /*initCarousel3: function() {
    	if (jQuery(".owlInit").size() > 0) {
    		var carousel = jQuery(".owlInit");

    		carousel.owlCarousel({
    			loop: true,
    			center: true,
    			nav: true
    		})
    	}
    },*/
	
	alignCentered: function(customTop){
		
		if(jQuery('.align-centered').size() > 0){
			jQuery('.align-centered').each(function() {	
				var CBox = jQuery(this);
				var parentCBoxHeight = CBox.parent().height() - (parseInt(CBox.parent().css("padding-top")) + parseInt(CBox.parent().css("padding-bottom")));			
				var CBoxHeight = CBox.height();				
				var pTop =  Math.round((parentCBoxHeight - CBoxHeight) / 2);				
				CBox.css('paddingTop', pTop);
				
				//if process page on tablet
				if(SITE.isTablet()){
					if(jQuery("#process-steps-link").size() > 0){	
						CBox.css('paddingTop', pTop+20 );
					}
				}
				jQuery('.large-website-banner-content').css('visibility','visible');
				jQuery('.noScrollLandingBannerFormMain').css('visibility','visible');
									
			});		
		}
	},
	
	showErrorBox: function(error){
		var errorbox = '<div id="error-messages" class="error-popup mfp-hide"> <h2>Oops!</h2><ul id="error-list"></ul></div>';
		if(jQuery("#error-messages").size() == 0){
			jQuery(errorbox).appendTo("body");
		}
		jQuery("#error-list").empty().append(error);
		jQuery.magnificPopup.open({
		  items: {src: '#error-messages'},
		  type: 'inline',
		  fixedContentPos: true
		}, 0);
		return false;
	},
    
    fitVideo: function(){
        if(jQuery('.fitVideo').size() > 0){
            jQuery(".fitVideo").fitVids();
        }        
    },
};
var SITEForms = {
	onlyInteger: function(){
        jQuery('.only-integer').keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 37 && charCode != 39 && charCode != 46) {
                return false;
            }
            return true;
        });
    },
	onlyFloat: function(){
        jQuery('.only-float').keypress(function (event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 59) && charCode != 37 && charCode != 39 && charCode != 46) {
                return false;
            } // prevent if not number/dot
            if (charCode == 46 && jQuery(this).val().indexOf('.') != -1) {
                return false;
            } // prevent if already dot
            return true;
        });
    },
	isValidEmail: function(v){
		var filter_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (filter_email.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	
	isValidZip: function(v){
		var filter_zipcode =  /^(\d{5}-\d{4}|\d{5}|\d{9})$|^([a-zA-Z]\d[a-zA-Z]( )?\d[a-zA-Z]\d)$/;
		if (filter_zipcode.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	isValidPhone: function(v){
		var filter_phone = /^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$/;
		if (filter_phone.test(v)==false){
			return false;
		}else{
			return true;
		}
	},
	getValue: function(fieldID){
		var value = jQuery.trim(jQuery("#"+fieldID).val());
		jQuery("#"+fieldID).val(value);
		return value;
	},
	
	isInt: function (n){
    	return Number(n) === n && n % 1 === 0;
	},
	isFloat: function(n){
    	return Number(n) === n && n % 1 !== 0;
	},
	
	submitAjax : function(formID){
		var frm = jQuery('#'+formID);
		var formId = formID;
		jQuery.ajax({
			type: "post",
			url: '/wp-content/themes/arabian/ajax-submission.php',
			data: frm.serialize(),			
			success: function(data){
				
				if(data=="0"){
					
				}else{
					console.log(frm)
					//jQuery('#'+formID).find('.dummySubmit').trigger('click');					
					if(formID == "MemberbookForm"){
						document.location.href = jQuery("#redirect_to_member").val();
					} else {
						document.getElementById(formId).submit();
					}
					
				}
			},
			
		});
		return false;
	},
	
	
	bookForm:function(formID){
		
		var isOK = true, msg = "", d = jQuery('#'+formID);
		var fname = d.find("input[name='fname']").val();
		var lname = d.find("input[name='lname']").val();
		var email = d.find("input[name='email']").val();
		var phone = d.find("input[name='phone']").val();
		var course;
		var code;
		
		if (fname == ""){
			msg += "Please enter first name\n";
			isOK = false;
		}
		if (lname == ""){
			msg += "Please enter last name\n";
			isOK = false;
		}
		
		if(email == ""){
			msg += "Please enter email\n";
			isOK = false;
		}else{
			if (SITEForms.isValidEmail(email)==false){
				msg += "Please enter valid email\n";
				isOK = false;
			}
		}
		if (phone == ""){
			msg += "Please enter phone\n";
			isOK = false;
		}
		//For memeber area
		if(formID == "MemberbookForm"){
			var course = jQuery("#course_type option:selected").val();			
			var code = d.find("input[name='code']").val();
			if (course == ""){
				msg += "Please select course\n";
				isOK = false;
			}
			if (code == ""){
				msg += "Please enter Code\n";
				isOK = false;
			}
		}
		//End
		if(code!='' && formID == "MemberbookForm"){
			var data = {
				'action': 'my_action',
				'codes': code
			};
			var ajaxurl = {
				'url' : '/wp-admin/admin-ajax.php',
			}
						
			jQuery.post(
				ajaxurl, 
				data, 
				function(response) {
					if(response=="0"){
					msg += 'Please enter valid code.\n';
					isOK = false;
					
					if(isOK == false){
						alert(msg);
						return false;
					}
					
					}else{
						if(isOK == false){
							alert(msg);
							return false;
						}
					
						if(isOK == true){
							SITEForms.submitAjax(formID);
							return false;
						}
					}
				}
			)
			
		}else{
			
			if(isOK == false){
				alert(msg);
				return false;
			}

			if(isOK == true){
				SITEForms.submitAjax(formID);
				return false;
			}

		}
		return false;
	},
}      

function checkScript() {
	console.log("Good to Go");
}

checkScript();



jQuery(document).ready(function(){
	

	// Collection Page - Menu functionality
	// When a menu element (horse type) is clicked...
	jQuery('ul.horse-type li').click(function(){

		// Pull the horse type
		var tab_id = jQuery(this).attr('data-tab');

		// Show clicked horse type, hide the rest.
		jQuery('ul.horse-type li').removeClass('current');
		jQuery('.tab-content').removeClass('current');

		jQuery(this).addClass('current');
		jQuery("#"+tab_id).addClass('current');
	})


	// Header menu mobile toggle functionality
	jQuery('#toggleNav').click(function() {
		jQuery('#mobileNav').slideToggle(300, function() {
			jQuery('#openNav').toggleClass('hide');
			jQuery('#closeNav').toggleClass('hide');
		})
	})

})
