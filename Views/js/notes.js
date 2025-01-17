/* 

	tcNotes - Simple Notifications by Tyler Colwell Â© 2011
	
	http://tyler.tc/
	
*/

(function($){

	$.tcNotes = function(options){
	
			var defaults = {
				
				message: 		"This is a notification!",
				type:			"tip",
				slideSpeed:		500
				
			};
			
			var options = $.extend(defaults, options);
			
			$('#tcNote').remove();
						
			$('<div id="tcNote" class="notification '+defaults.type+'"><p>'+defaults.message+'</p></div>').hide().prependTo(document.body);
			
			$.scrollTo(0, 800, function(){
				
				$('#tcNote').slideDown(defaults.slideSpeed);
				
			});
			
			$('#tcNote').click(function(){
				
				$('#tcNote').slideUp(defaults.slideSpeed, 0, function(){
					
					$(this).remove();
					
				});
				
			});
			
	};

})(jQuery);