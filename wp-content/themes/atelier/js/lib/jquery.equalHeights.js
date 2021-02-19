/////////////////////////////////////////////
// EQUALHEIGHTS PLUGIN
/////////////////////////////////////////////

(function($) {

	// USE STRICT
	"use strict";

	$.fn.equalHeights = function(px) {
		$(this).each(function(){
			var currentTallest = 0;
			$(this).children().each(function(){
				if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
			});
			if (!px && Number.prototype.pxToEm) {
				currentTallest = currentTallest.pxToEm(); //use ems unless px is specified
			}
			$(this).children().css({'min-height': currentTallest});
		});
		return this;
	};
})(jQuery);