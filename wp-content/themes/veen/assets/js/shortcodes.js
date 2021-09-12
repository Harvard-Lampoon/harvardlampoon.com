(function($){
	/* All Images Loaded */
	$(window).load(function(){
	
	});
	
	/* Dom Loaded */
	$(document).ready(function($){
	

		/* Toggles */
		
		$('.epcl-toggle-elem .toggle-title').on('click', function(){
			$(this).next().stop().slideToggle();
			$(this).parent().toggleClass('active');
		});
		
		/* Accordions */
		
		$('.epcl-accordions').each(function(){
			var wrapper = $(this);
			wrapper.find('.accordion-elem .toggle-title').on('click', function(){
                var elem = $(this);
                var parent = $(this).parent();
				if( parent.hasClass('active') ) return false;
				wrapper.find('.accordion-elem .toggle-content').slideUp().parent().removeClass('active');
				parent.addClass('active').find('.toggle-content').slideDown();
			});
			wrapper.find('.accordion-elem:first .toggle-title').click();
		});
		
		/* Tabs */
		
		$('.epcl-tabs .tab-links li a').on('click', function(){
			var id = $(this).attr('data-id');
			var parent = $(this).parents('.epcl-tabs');
			parent.find('div.tab-container div.tab-item').stop().hide().removeClass('active');
			parent.find('ul.tab-links li.active').removeClass('active');
			$(this).parent().addClass('active');
			parent.find('div#'+id).stop().fadeIn().addClass('active');
			return false;
		});
		$('.epcl-tabs ul.tab-links').each(function(){
			$(this).find('li:first a').click();
		});
	
	});

})(jQuery);