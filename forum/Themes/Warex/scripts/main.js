window.addEvent('domready', function() {
	if($('fancymenu'))
		FancyExample = new SlideList($E('ul', 'fancymenu'), {transition: Fx.Transitions.backOut, duration: 700});
});