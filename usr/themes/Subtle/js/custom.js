/**
 * Main JS file for Subtle behaviours
 */

/*globals jQuery, document */
(function ($) {
	"use strict";

	$(document).ready(function(){

		// Responsive video embeds
		$('.post-content').fitVids();

		// Scroll to content
		$('.cover .arrow-down').on('click', function(e) {
			$('html, body').animate({'scrollTop': $('.cover').height()}, 800);
			e.preventDefault();
		});

		// Animated Back To Top link
		$('.site-footer .arrow-up').on('click', function(e) {
			$('html, body').animate({'scrollTop': 0});
			e.preventDefault();
		});

		// Sidebar
		$('.sidebar-toggle').on('click', function(e){
			$('body').toggleClass('sidebar-opened');
			e.preventDefault();
		});

		// Post reading time
		$('.post-template .post').readingTime();

	});

}(jQuery));
