</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/tether/dist/js/tether.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/modernizr/modernizr.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/classie/classie.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/pages/accordion/accordion.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/i18next/i18next.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/js/pcoded.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/js/demo-12.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>vendor/assets/js/jquery.mousewheel.min.js"></script>
<script>
	"use strict";
	$(document).ready(function() {
		var $window = $(window);
		var getBody = $("body");
		var bodyClass = getBody[0].className;
		$(".main-menu").attr('id', bodyClass);
		$('.theme-loader').fadeOut(1000);
		var emailbody = $(window).height();
		$('.user-body').css('min-height', emailbody);
		$(".card-header-right .icofont-close-circled").on('click', function() {
			var $this = $(this);
			$this.parents('.card').animate({
				'opacity': '0',
				'-webkit-transform': 'scale3d(.3, .3, .3)',
				'transform': 'scale3d(.3, .3, .3)'
			});
			setTimeout(function() {
				$this.parents('.card').remove();
			}, 800);
		});
		$("#styleSelector .style-cont").slimScroll({
			height: '100%',
			allowPageScroll: false,
			wheelStep: 5,
			color: '#999',
			animate: true
		});
		$(".card-header-right .icofont-rounded-down").on('click', function() {
			var $this = $(this);
			var port = $($this.parents('.card'));
			var card = $(port).children('.card-block').slideToggle();
			$(this).toggleClass("icon-up").fadeIn('slow');
		});
		$(".icofont-refresh").on('mouseenter mouseleave', function() {
			$(this).toggleClass("rotate-refresh").fadeIn('slow');
		});
		$("#more-details").on('click', function() {
			$(".more-details").slideToggle(500);
		});
		$(".mobile-options").on('click', function() {
			$(".navbar-container .nav-right").slideToggle('slow');
		});
		var a = $(window).height() - 50;
		$(".main-friend-list").slimScroll({
			height: a,
			allowPageScroll: false,
			wheelStep: 5,
			color: '#1b8bf9'
		});

	});

	function toggleFullScreen() {
		var a = $(window).height() - 10;
		if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement) {
			if (document.documentElement.requestFullscreen) {
				document.documentElement.requestFullscreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullscreen) {
				document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			}
		}
	}
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

	$(".color-1").click(function() {
		$("#color").attr("href", "assets/css/color/color-1.css");
		return false;
	});
	$(".color-2").click(function() {
		$("#color").attr("href", "assets/css/color/color-2.css");
		return false;
	});
	$(".color-3").click(function() {
		$("#color").attr("href", "assets/css/color/color-3.css");
		return false;
	});
	$(".color-4").click(function() {
		$("#color").attr("href", "assets/css/color/color-4.css");
		return false;
	});
	$(".color-5").click(function() {
		$("#color").attr("href", "assets/css/color/color-5.css");
		return false;
	});
	$(".color-6").click(function() {
		$("#color").attr("href", "assets/css/color/color-6.css");
		return false;
	});
	$('.color-picker').animate({
		right: '-239px'
	});
	$('.color-picker a.handle').click(function(e) {
		e.preventDefault();
		var div = $('.color-picker');
		if (div.css('right') === '-239px') {
			$('.color-picker').animate({
				right: '0px'
			});
		} else {
			$('.color-picker').animate({
				right: '-239px'
			});
		}
	});
</script>
