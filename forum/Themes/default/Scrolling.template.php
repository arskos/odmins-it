<?php

function template_scrolling_above()
{
	echo '
	<div id="sc_top"></div>';
}

function template_scrolling_below()
{
	global $txt;

	echo '
	<div id="gtb_pos">
		<div id="gtb_top" class="png">
			<a id="toTop" class="png" href="#sc_top" title="' . $txt['go_up'] . '"><span style="display: none;">' . $txt['go_up'] . '</span></a>
		</div>
		<div id="gtb_bottom" class="png">
			<a id="toBottom" class="png" href="#sc_bottom" title="' . $txt['go_down'] . '"><span style="display: none;">' . $txt['go_down'] . '</span></a>
		</div>
	</div>
	<div id="sc_bottom"></div>
	<script type="text/javascript">window.jQuery || document.write(unescape(\'%3Cscript src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"%3E%3C/script%3E\'))</script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			if ($.browser.opera && $("div#tooltip"))
				$("a#toTop, a#toBottom").removeAttr("title"); // temp. toggle for Opera
			var nav = $.browser.mozilla ? 1 : 0; // Fix for Gecko
			if ($("body").height() > $(window).height())
			{
				if ($(this).scrollTop() == 0)
					$("#toTop").hide();
				$(window).scroll(function(){
					if($(this).scrollTop() > 0) 
						$("#toTop").fadeIn().click(function(){
							$(this).addClass("toTop-click");
						});
					if ($(this).scrollTop() == 0) 
						$("#toTop").fadeOut().removeClass("toTop-click").click(function(){
							$(this).removeClass("toTop-click");
						});
					if (($(this).scrollTop() + $(this).height() + nav) < $(document).height())
						$("#toBottom").fadeIn().click(function(){
							$(this).addClass("toBottom-click");
						});
					if (($(this).scrollTop() + $(this).height() + nav) >= $(document).height())
						$("#toBottom").fadeOut().removeClass("toBottom-click").click(function(){
							$(this).removeClass("toBottom-click");
						});
				});
				var mode = (window.opera) ? ((document.compatMode == "CSS1Compat") ? $("html") : $("body")) : $("html,body");
				$("#toTop").click(function(){
					mode.animate({scrollTop:0},800);
					return false;
				});
				$("#toBottom").click(function(){
					mode.animate({scrollTop:$(document).height()},800);
					return false;
				});
			}
			else $("#gtb_pos").css("display", "none");
		});
	</script>';
}

?>