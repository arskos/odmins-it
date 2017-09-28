function smi(u,t,g)
{
	var $bs = jQuery.noConflict();
	document.write('<div id="smi"></div>');
	//var myDiv = $bs('#main_content_section');
	//myDiv.append('<div id="smi"></div>');
	var s = $bs('#smi');
	
	if (lang == 'ru' || lang == 'uk') {
		s.append(
	'<div class="centertext" style="padding-top: 6px">' +
		'<a class="' + img + '-bs icon-twitter" href="http://twitter.com/home?status=' + t + ' - ' + u + '" title="' + hint[0] + '"></a>' +
		'<a class="' + img + '-bs icon-google-buzz" href="http://www.google.com/reader/link?url=' + u + '&amp;title=' + t + '&amp;srcURL=' + g + '" title="' + hint[1] + '"></a>' +
		'<a class="' + img + '-bs icon-friendfeed" href="http://www.friendfeed.com/share?title=' + t + ' - ' + u + '" title="' + hint[2] + '"></a>' +
		'<a class="' + img + '-bs icon-facebook" href="http://www.facebook.com/sharer.php?u=' + u + '" title="' + hint[3] + '"></a>' +
		'<a class="' + img + '-bs icon-yandex" href="http://zakladki.yandex.ru/newlink.xml?url=' + u + '&amp;name=' + t + '" title="' + hint[4] + '"></a>' +
		'<a class="' + img + '-bs icon-vkontakte" href="http://vkontakte.ru/share.php?url=' + u + '" title="' + hint[5] + '"></a>' +
		'<a class="' + img + '-bs icon-moy-mir" href="http://connect.mail.ru/share?share_url=' + u + '" title="' + hint[6] + '"></a>' +
		'<a class="' + img + '-bs icon-livejournal" href="http://www.livejournal.com/update.bml?event=' + u + '&amp;subject=' + t + '" title="' + hint[7] + '"></a>' +
		'<a class="' + img + '-bs icon-delicious" href="http://delicious.com/save?url=' + u + '&amp;title=' + t + '" title="' + hint[8] + '"></a>' +
		'<a class="' + img + '-bs icon-odnoklassninki" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl=' + u + '" title="' + hint[9] + '"></a>' +
		'<a class="' + img + '-bs icon-google" href="http://www.google.com/bookmarks/mark?op=edit&amp;output=popup&amp;bkmk=' + u + '&amp;title=' + t + '" title="' + hint[10] + '"></a>' +
		'<a class="' + img + '-bs icon-bobrdobr" href="http://bobrdobr.ru/add.html?url=' + u + '&amp;title=' + t + '" title="' + hint[11] + '"></a>' +
		'<a class="' + img + '-bs icon-memori" href="http://memori.ru/link/?sm=1&amp;u_data[url]=' + u + '&amp;u_data[name]=' + t + '" title="' + hint[12] + '"></a>' +
		'<a class="' + img + '-bs icon-mister-wong" href="http://www.mister-wong.ru/index.php?action=addurl&amp;bm_url=' + u + '&amp;bm_description=' + t + '" title="' + hint[13] + '"></a>' +
	'</div>');
	}
	else {
		s.append(
	'<div class="centertext" style="padding-top: 6px">' +
		'<a class="' + img + '-bs icon-twitter" href="http://twitter.com/home?status=' + t + ' - ' + u + '" title="' + hint[0] + '"></a>' +
		'<a class="' + img + '-bs icon-google-buzz" href="http://www.google.com/reader/link?url=' + u + '&amp;title=' + t + '&amp;srcURL=' + g + '" title="' + hint[1] + '"></a>' +
		'<a class="' + img + '-bs icon-friendfeed" href="http://www.friendfeed.com/share?title=' + t + ' - ' + u + '" title="' + hint[2] + '"></a>' +
		'<a class="' + img + '-bs icon-facebook" href="http://www.facebook.com/sharer.php?u=' + u + '" title="' + hint[3] + '"></a>' +
		'<a class="' + img + '-bs icon-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=' + u + '&amp;title=' + t + '&amp;source=' + g + '" title="' + hint[4] + '"></a>' +
		'<a class="' + img + '-bs icon-myspace" href="http://www.myspace.com/Modules/PostTo/Pages/?u=' + u + '&amp;t=' + t + '" title="' + hint[5] + '"></a>' +
		'<a class="' + img + '-bs icon-livejournal" href="http://www.livejournal.com/update.bml?event=' + u + '&amp;subject=' + t + '" title="' + hint[6] + '"></a>' +
		'<a class="' + img + '-bs icon-delicious" href="http://delicious.com/save?url=' + u + '&amp;title=' + t + '" title="' + hint[7] + '"></a>' +
		'<a class="' + img + '-bs icon-google" href="http://www.google.com/bookmarks/mark?op=edit&amp;output=popup&amp;bkmk=' + u + '&amp;title=' + t + '" title="' + hint[8] + '"></a>' +
		'<a class="' + img + '-bs icon-digg" href="http://digg.com/submit?phase=2&amp;url=' + u + '&amp;title=' + t + '" title="' + hint[9] + '"></a>' +
		'<a class="' + img + '-bs icon-blogger" href="http://www.blogger.com/blog_this.pyra?t&amp;u=' + u + '&amp;n=' + t + '" title="' + hint[10] + '"></a>' +
		'<a class="' + img + '-bs icon-technorati" href="http://www.technorati.com/faves?add=' + u + '" title="' + hint[11] + '"></a>' +
		'<a class="' + img + '-bs icon-mister-wong" href="http://www.mister-wong.com/index.php?action=addurl&amp;bm_url=' + u + '&amp;bm_description=' + t + '" title="' + hint[12] + '"></a>' +
	'</div>');
	}

	s.find('a').attr({target: '_blank'}).css({opacity: 0.5}).hover(
		function() { $bs(this).css({opacity: 1}); },
		function() { $bs(this).css({opacity: 0.7}); }
	);
	s.hover(
		function() { $bs(this).find('a').css({opacity: 0.7}); },
		function() { $bs(this).find('a').css({opacity: 0.5}); }
	);

}