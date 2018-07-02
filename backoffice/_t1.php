<html lang="en-us" >
	<head>
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/smartadmin-skins.min.css">

		<!-- SmartAdmin RTL Support is under construction-->
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/smartadmin-rtl.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/your_style.css">

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/css/demo.min.css">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/favicon/favicon.ico" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/touch-icon-ipad-retina.png">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

	</head>
	<body >


			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget well" id="wid-id-1">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->


		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/pace/pace.min.js"></script>

		<!-- These scripts will be located in Header So we can add scripts inside body (used in class.datatables.php) -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local 
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script> -->

		<!-- IMPORTANT: APP CONFIG -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/app.config.js"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/bootstrap/bootstrap.min.js"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/notification/SmartNotification.min.js"></script>

		<!-- JARVIS WIDGETS -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/smartwidgets/jarvis.widget.min.js"></script>

		<!-- EASY PIE CHARTS -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>

		<!-- SPARKLINES -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/sparkline/jquery.sparkline.min.js"></script>

		<!-- JQUERY VALIDATE -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/select2/select2.min.js"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>

		<!-- browser msie issue fix -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>

		<!-- FastClick: For mobile devices -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/fastclick/fastclick.min.js"></script>

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- Demo purpose only -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/demo.min.js"></script>

		<!-- MAIN APP JS FILE -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/app.min.js"></script>		

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/speech/voicecommand.min.js"></script>	

		<!-- SmartChat UI : plugin -->
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/smart-chat-ui/smart.chat.manager.min.js"></script>

		<script type="text/javascript">
			// DO NOT REMOVE : GLOBAL FUNCTIONS!
			$(document).ready(function() {
				pageSetUp();
			})
		</script>
<!-- PAGE RELATED PLUGIN(S) -->
<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/summernote/summernote.min.js"></script>
<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/markdown/markdown.min.js"></script>
<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/markdown/to-markdown.min.js"></script>
<script src="http://localhost/_Template/SmartAdmin/DEVELOPER/PHP_HTML_Version/js/plugin/markdown/bootstrap-markdown.min.js"></script>


<script type="text/javascript">
	
	$(document).ready(function() {

		/*
		 * SUMMERNOTE EDITOR
		 */
		
		$('.summernote').summernote({
			height: 200,
			toolbar: [
		    ['style', ['style']],
		    ['font', ['bold', 'italic', 'underline', 'clear']],
		    ['fontname', ['fontname']],
		    ['color', ['color']],
		    ['para', ['ul', 'ol', 'paragraph']],
		    ['height', ['height']],
		    ['table', ['table']],
		    ['insert', ['link', 'picture', 'hr']],
		    ['view', ['fullscreen', 'codeview', 'help']]

		  ]
		});
	
		/*
		 * MARKDOWN EDITOR
		 */

		$("#mymarkdown").markdown({
			autofocus:false,
			savable:true
		})
					
	
	})

</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</body>

</html>