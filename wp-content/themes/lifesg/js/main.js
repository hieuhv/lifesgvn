"use strict";
/* -------------------------------------
		CUSTOM FUNCTION WRITE HERE
-------------------------------------- */
$(document).ready(function() {
	jQuery('#tag_cloud').tagEditor();
	var file_frame; // variable for the wp.media file_frame
	$('.filter-menu ul li label').click(function(){
		var input = $(this).parent().find('input');
		if(input.prop('checked') == true){
			input.removeAttr('checked').trigger('change');
		} else {
			input.attr("checked", "checked").trigger('change');
		}
	});

    $('.share_this').on("click", function(e) {
      $(this).customerPopup(e);
    });
	
	$('.filters').on('change',function(){
		var classify = new Array();
			$('input[name="classify[]"]:checked').each(function(){
			   classify.push($(this).val());
			});
		var skin_type = new Array();
			$('input[name="skin_type[]"]:checked').each(function(){
			   skin_type.push($(this).val());
			});
		var purpose = new Array();
			$('input[name="purpose[]"]:checked').each(function(){
			   purpose.push($(this).val());
			});
		var paramsArray = []
		var classifyParams = createParamList(classify,'pl');
		var skinTypeParams = createParamList(skin_type,'ld');
		var purposeParams = createParamList(purpose,'md');
		if (classifyParams)
		{
			paramsArray.push(classifyParams);
		}
		if (skinTypeParams)
		{
			 paramsArray.push(skinTypeParams);
		}
		if (purposeParams)
		{
			 paramsArray.push(purposeParams);
		}
		var cr = $('#cr_term').val();
		if($.isEmptyObject(paramsArray)==true) {
			var end = cr;
		} else {
			var end = cr+'?'+paramsArray.join('&');
		}
		window.location.href = end;
	});         

	function createParamList(arrayObj, prefix)
	{
		if(arrayObj.length != 0){
			return prefix+'='+arrayObj.join(',');
		}
		return false;
	}
	
	//Back to top
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("btnTop").style.display = "block";
		} else {
			document.getElementById("btnTop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0; // For Chrome, Safari and Opera 
		document.documentElement.scrollTop = 0; // For IE and Firefox
	}
	// attach a click event (or whatever you want) to some element on your page
	$( '#fimg-button' ).on( 'click', function( event ) {
		event.preventDefault();

        // if the file_frame has already been created, just reuse it
		if ( file_frame ) {
			file_frame.open();
			return;
		} 

		file_frame = wp.media({
			title: 'LifeSG Media Library',
			button: {
				text: 'Chọn ảnh',
			}
		});

		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get('selection').first().toJSON();
			console.log(attachment);
			// do something with the file here
			$( '#image-url' ).addClass('fixwidth');
			$( '#image-url' ).attr('src', attachment.url);
			$( '#post_thumb' ).val(attachment.url);
		});

		file_frame.open();
	});
	
	var file_frame2;
	// attach a click event (or whatever you want) to some element on your page
	$( '#imageCover' ).on( 'click', function( event ) {
		event.preventDefault();

        // if the file_frame has already been created, just reuse it
		if ( file_frame2 ) {
			file_frame2.open();
			return;
		} 

		file_frame2 = wp.media({
			title: 'LifeSG Media Library',
			button: {
				text: 'Chọn ảnh',
			}
		});

		file_frame2.on( 'select', function() {
			var attachment = file_frame2.state().get('selection').first().toJSON();
			console.log(attachment);
			// do something with the file here
			$( '.file-input-name' ).html(attachment.url.split('/').last());
			$( '#coverURL' ).html(attachment.url);
			//$( '#post_thumb' ).val(attachment.url);
		});

		file_frame2.open();
	});
	
	/*$("#saveCover").click(function(){
		var request = {
			'action': 'update_cover',
			'gg_id': profile.getId(),
		};
		$.post(ajaxurl, request, function(response){
			if(response){
				//$('#tg-fullpost-slider').html(response);
				window.location = homeurl+'/thanh-vien/tai-khoan/';
			}
		});
	});*/
	/* -------------------------------------
	 PRELOADER
	 -------------------------------------- */
	jQuery("#status").delay(2000).fadeOut();
	jQuery("#preloader").delay(2000).fadeOut("slow");
	/* -------------------------------------
			SEARCH TOGGLE
	-------------------------------------- */
	$(".tg-search-open").on("click", function(){
		$(".tg-searchbox").slideToggle();
	});
	$(".tg-search-close").on("click", function(){
		$(".tg-searchbox").slideToggle();
	});
	
	/* -------------------------------------
			FOOTER INSTRGRAM
	-------------------------------------- */
	function syncInstaSlider(){
		var sync1 = $("#tg-instapost-slider");
		var sync2 = $("#tg-instathumb-slider");
		sync1.owlCarousel({
			singleItem : true,
			slideSpeed : 1000,
			navigation: false,
			pagination:false,
			afterAction : syncPosition,
			responsiveRefreshRate : 200,
			navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
		});
		sync2.owlCarousel({
			items						:5,
			itemsDesktop				:[1199,4],
			itemsDesktopSmall   		:[991,3],
			itemsTablet 				:[767,4],
			itemsMobile 				:[479,3],
			pagination  				:false,
			responsiveRefreshRate   	:100,
			afterInit : function(el){
				el.find(".owl-item").eq(0).addClass("active");
			}
		});
		function syncPosition(el){
			var current = this.currentItem;
			$("#tg-instathumb-slider")
				.find(".owl-item")
				.removeClass("active")
				.eq(current)
				.addClass("active")
			if($("#tg-instathumb-slider").data("owlCarousel") !== undefined){
				center(current)
			}
		}
		$("#tg-instathumb-slider").on("click", ".owl-item", function(e){
			e.preventDefault();
			var number = $(this).data("owlItem");
			sync1.trigger("owl.goTo",number);
		});
		function center(number){
			var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
			var num = number;
			var found = false;
			for(var i in sync2visible){
				if(num === sync2visible[i]){
					var found = true;
				}
			}
			if(found===false){
				if(num>sync2visible[sync2visible.length-1]){
					sync2.trigger("owl.goTo", num - sync2visible.length+2)
				}else{
					if(num - 1 === -1){
						num = 0;
					}
					sync2.trigger("owl.goTo", num);
				}
			} else if(num === sync2visible[sync2visible.length-1]){
				sync2.trigger("owl.goTo", sync2visible[1])
			} else if(num === sync2visible[0]){
				sync2.trigger("owl.goTo", num-1)
			}
		}
	}
	syncInstaSlider();
	/* -------------------------------------
			POPULAR VIDEOS
	-------------------------------------- */
	function imgHover(){
		$(".tg-postlistitem > div").hover(function(){
			$(".tg-postlistitem > div").removeClass("tg-active");
			$(this).addClass("tg-active");
			$(this).parent().addClass("tg-hover");
		});
		$(".tg-postlistitem > div").mouseleave(function(){
			$(".tg-postlistitem > div").removeClass("tg-active");
			$(".tg-postlistitem > div").parent().removeClass("tg-hover");
		});
	}
	imgHover();
	/* -------------------------------------
			POST SLIDER
	-------------------------------------- */
	var check = $('#tg-postslider .cycle-slideshow').on('cycle-next cycle-prev', function (e, opts) {
		$('#tg-alsocheck .cycle-slideshow').cycle('goto', opts.currSlide);
	});
	$('#tg-alsocheck-thumb .cycle-slide').on('click', function () {
		var index = $('#tg-alsocheck-thumb .cycle-slideshow').data('cycle.API').getSlideIndex(this);
		var todos = $('.cycle-slideshow').data('cycle.opts').slideCount;
		check.cycle('goto', index - todos);
	});
	/* ---------------------------------------
			PORTFOLIO FILTERABLE
	 -------------------------------------- */
	var $container = $('#tg-filtermasonry');
	var $optionSets = $('.option-set');
	var $optionLinks = $optionSets.find('a');
	function doIsotopeFilter() {
		if ($().isotope) {
			var isotopeFilter = '';
			$optionLinks.each(function () {
				var selector = $(this).attr('data-filter');
				var link = window.location.href;
				var firstIndex = link.indexOf('filter=');
				if (firstIndex > 0) {
					var id = link.substring(firstIndex + 7, link.length);
					if ('.' + id == selector) {
						isotopeFilter = '.' + id;
					}
				}
			});
			$container.isotope({
				itemSelector: '.tg-griditem',
				filter: isotopeFilter
			});
			$optionLinks.each(function () {
				var $this = $(this);
				var selector = $this.attr('data-filter');
				if (selector == isotopeFilter) {
					if (!$this.hasClass('active')) {
						var $optionSet = $this.parents('.option-set');
						$optionSet.find('.active').removeClass('active');
						$this.addClass('active');
					}
				}
			});
			$optionLinks.on('click', function () {
				var $this = $(this);
				var selector = $this.attr('data-filter');
				$container.isotope({itemSelector: '.tg-griditem', filter: selector});
				if (!$this.hasClass('active')) {
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.active').removeClass('active');
					$this.addClass('active');
				}
				return false;
			});
		}
	}
	var isotopeTimer = window.setTimeout(function () {
		window.clearTimeout(isotopeTimer);
		doIsotopeFilter();
	}, 1000);
	
	/* -------------------------------------
			GALLERY SLIDER
	-------------------------------------- */
	$("#tg-gallery-slider").owlCarousel({
		Play: 3000,
		items : 3,
		navigation:true,
		pagination:false,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [991,2],
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			FOOTER SLIDER
	-------------------------------------- */
	$("#tg-footerbrand-slider").owlCarousel({
		Play: 3000,
		items : 6,
		navigation:false,
		pagination:false,
		itemsDesktop : [1199,4],
		itemsDesktopSmall : [991,4],
		itemsTablet :[767,4],
		itemsMobile :[479,2],
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			WIDGET SLIDER
	-------------------------------------- */
	$("#tg-widget-slider").owlCarousel({
		Play: 3000,
		items : 1,
		navigation:true,
		pagination:false,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [979,1],
		itemsTablet :[767,1],
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			BLOG DETAIL SLIDER
	-------------------------------------- */
	$("#tg-blogdetail-slider").owlCarousel({
		Play: 3000,
		items : 1,
		navigation:true,
		pagination:false,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [979,1],
		itemsTablet :[767,1],
		itemsMobile :[479,1],
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			MORE BLOG SLIDER
	-------------------------------------- */
	$("#tg-moreblog-slider").owlCarousel({
		Play: 3000,
		items : 1,
		navigation:true,
		pagination:false,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [979,1],
		itemsTablet :[767,1],
		itemsMobile :[479,1],
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			COMMENTS SLIDER
	-------------------------------------- */
	$("#tg-comment-slider").owlCarousel({
		Play: 3000,
		items : 1,
		navigation:true,
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [979,1],
		itemsTablet :[767,1],
		itemsMobile :[479,1],
		pagination  :false,
		responsiveRefreshRate :100,
		navigationText: ["<i class='fa fa-angle-left tg-prev'></i>","<i class='fa fa-angle-right tg-next'></i>"]
	});
	/* -------------------------------------
			PRETTY PHOTO GALLERY
	-------------------------------------- */
	/*$("a[data-rel]").each(function () {
		$(this).attr("rel", $(this).data("rel"));
	});
	$("a[data-rel^='prettyPhoto']").prettyPhoto({
		animation_speed: 'normal',
		theme: 'dark_square',
		slideshow: 3000,
		autoplay_slideshow: false,
		social_tools: false
	});*/
	/* -------------------------------------
			HOME SLIDER TWO
	-------------------------------------- */
	$('#tg-home-slidertwo').flexslider({
		animation: "slide",
		slideshowSpeed : 3000,
		controlNav: false,
		pauseOnHover: true,
		touch : true,
		directionNav : true,
		prevText :"<i class='fa fa-angle-left'></i>",
		nextText : "<i class='fa fa-angle-right'></i>",
	});
	/* -------------------------------------
			HOME SLIDER THREE
	-------------------------------------- */
	
	
	
	/* --------------------------------------
			HOME SLIDER PROGRESSBAR
	-------------------------------------- */
	var time = 7;
	var $progressBar, $bar, $elem, isPause, tick, percentTime;
	$("#tg-fullpostfour-slider").owlCarousel({
		slideSpeed : 500,
		paginationSpeed : 500,
		pagination : false,
		singleItem : true,
		navigation : false,
		navigationText: [
			"<i class='fa fa-angle-left'></i>",
			"<i class='fa fa-angle-right'></i>"
		],
		afterInit : progressBar,
		afterMove : moved,
		startDragging : pauseOnDragging
	});
	function progressBar(elem){
		$elem = elem;
		buildProgressBar();
		start();
	}
	function buildProgressBar(){
		$progressBar = $("<div>",{
			id:"progressBar"
		});
		$bar = $("<div>",{
			id:"bar"
		});
		$progressBar.append($bar).prependTo($elem);
	}
	function start() {
		percentTime = 0;
		isPause = false;
		tick = setInterval(interval, 10);
	}
	function interval() {
		if(isPause === false){
			percentTime += 1 / time;
			$bar.css({
				width: percentTime+"%"
			});
			if(percentTime >= 100){
				$elem.trigger('owl.next');
			}
		}
	}
	function pauseOnDragging(){
		isPause = true;
	}
	function moved(){
		clearTimeout(tick);
		start();
	}
	/* --------------------------------------
			COMMING SOON SLIDER
	-------------------------------------- */
	/*var swiper = new Swiper('#tg-commingsoon-slider', {
		pagination: '.swiper-pagination',
		paginationClickable: false,
		autoplay: 3500,
		effect: 'fade'
	});*/
	var swiper = new Swiper('#tg-commingsoon-slider', {
		grabCursor: true,
		autoplay: 4000,
		slidesPerView: 1,
		effect: 'fade',
		loop: true,
	});
	/* --------------------------------------
			FULL VIEW SLIDER
	-------------------------------------- */
	var swiper = new Swiper(
		'#tg-fullview-slider',
		{
			loop: true,
			autoplay: 0,
			//prevButton: '.tg-prev',
			//nextButton: '.tg-next',
		}
	);
	/* --------------------------------------
			MULTI SLIDERS
	-------------------------------------- */
	$(".live-tile, .flip-list").not(".exclude").liveTile();

	function getRandomOptions(){
		var doIt = Math.floor(Math.random() * 1001) % 2 == 0;
		return {
				index: "next",
				delay: 3000,
				animationDirection: doIt ? 'forward' : 'backward',
				direction: doIt ? 'vertical' : 'horizontal'
			};
	}
	$("#tile1").liveTile({
		animationComplete: function(tileData){
			$(this).liveTile("goto", getRandomOptions());
		}
	}).liveTile("goto", getRandomOptions());

	function getRandomOptionsTwo(){
		var doIt = Math.floor(Math.random() * 1001) % 2 == 0;
		return {
				index: "next",
				delay: 3000,
				animationDirection: doIt ? 'forward' : 'backward',
				direction: doIt ? 'vertical' : 'horizontal'
			};
	}
	$("#tile2").liveTile({
		animationComplete: function(tileData){
			$(this).liveTile("goto", getRandomOptionsTwo());
		}
	}).liveTile("goto", getRandomOptionsTwo());

	function getRandomOptionsThree(){
		var doIt = Math.floor(Math.random() * 1001) % 2 == 0;
		return {
				index: "next",
				delay: 3000,
				animationDirection: doIt ? 'forward' : 'backward',
				direction: doIt ? 'vertical' : 'horizontal'
			};
	}
	$("#tile3").liveTile({
		animationComplete: function(tileData){
			$(this).liveTile("goto", getRandomOptionsThree());
		}
	}).liveTile("goto", getRandomOptionsThree());
	
	//Menu Filter Cosmetic
	 $('.sidebar-menu').mouseenter(function(){
      $(this).children('.expand').addClass('turn');
    });
  
    $('.sidebar-menu').mouseleave(function(){
      if ($(this).hasClass('open')) {
      } else {
        $(this).children('.expand').removeClass('turn');
      }
    });
    
    $('.sidebar-menu').click(function () {
      var $this = $(this);
      if ($this.hasClass('open')) {
        $('.sidebar-menu').removeClass('open');
        $('.sub-menu').stop(true).slideUp("fast");
        $('.expand').removeClass('turn');        
        $this.removeClass('open');
        $this.children('.expand').removeClass('turn');
        $this.next().stop(true).slideUp("fast");
      }    
      else {
        $('.sidebar-menu').removeClass('open');
        $('.sub-menu').stop(true).slideUp("fast");
        $('.expand').removeClass('turn');
        
        $this.addClass('open');
        $this.children('.expand').addClass('turn');
        $this.next().stop(true).slideDown("fast");
        }
    });
	
	//Sidebar Detail
	function sidebar_scroll(div) {
		var length = $('#tg-content-upper').height() - $('#'+div).height() + $('#tg-content-upper').offset().top - $("#tg-footer").height();
		console.log(length);
		$(window).scroll(function () {
			var scroll = $(this).scrollTop();
			var height = $('#'+div).height() + 'px';

			if (scroll < $('#tg-content-upper').offset().top) {

				$('#'+div).css({
					'position': 'absolute',
					'top': '0'
				});

			} else if (scroll > length) {

				$('#'+div).css({
					'position': 'absolute',
					'bottom': '0',
					'top': 'auto'
				});

			} else {

				$('#'+div).css({
					'position': 'fixed',
					'top': '10px',
					'height': height
				});
			}
		});
	}
});

//Create Popup Social Share URL 
$.fn.customerPopup = function (e, intWidth, intHeight, blnResize) {

	// Prevent default anchor event
	e.preventDefault();
	
	// Set values for window
	intWidth = intWidth || '500';
	intHeight = intHeight || '400';

	// Set title and open popup with focus on it
	var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
		strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=no',            
		objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
}
function loginfb(){
	$.fblogin({
		fbId: '1857571601164988',
		permissions: 'email',
		fields: 'first_name,last_name,locale,email,birthday',
	})
	.fail(function (error) {
	  console.log('error callback', error);
	})
	.progress(function (data) {
		console.log('progress', data);
	})
	.done(function (data) {
		//console.log('done everything', data);
		var request = {
				'action': 'sb_fb_login',
				'user': JSON.stringify(data)
			};
		console.log(request);
		$.post(ajaxurl, request, function(response){
			if(response){
				window.location = homeurl+'/thanh-vien/tai-khoan/';
			}
		});
	});
}


function signIn() { 
	//var profile = googleUser.getBasicProfile();
	//console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
	//console.log('Name: ' + profile.getName());
	//console.log('Image URL: ' + profile.getImageUrl());
	//console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
	var auth2 = gapi.auth2.getAuthInstance();         
	  // Sign the user in, and then retrieve their ID.
	  auth2.signIn().then(function() {
		//console.log(auth2.currentUser.get().getId());
		var profile = auth2.currentUser.get().getBasicProfile();
		console.log(profile);
		var request = {
			'action': 'sb_gg_login',
			'gg_id': profile.getId(),
			'display_name' : profile.getName(),
			'avatar' : profile.getImageUrl(),
			'email' : profile.getEmail()
		};
		$.post(ajaxurl, request, function(response){
			if(response){
				//$('#tg-fullpost-slider').html(response);
				window.location = homeurl+'/thanh-vien/tai-khoan/';
			}
		});
	  });   
}

function onLoadCallback() {
  console.log('onLoadCallback');
  gapi.load('auth2', function() {
	gapi.auth2.init({
		client_id: '743900024231-12s7ruu6liv82n7v0cn2u6aml921sdvk.apps.googleusercontent.com',
		//This two lines are important not to get profile info from your users
		fetch_basic_profile: false,
		scope: 'email'
	});        
  });     
}