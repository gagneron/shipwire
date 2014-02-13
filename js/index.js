$(document).ready(function(){

			var popErrors = function(element){
					var target = element;
					
					if(isNaN(target.val()) && target.attr('id') != 'name' && target.attr('id') != 'description'){
						target.siblings('.errorBox').css('visibility','visible');
					}
					else
					{
						target.siblings('.errorBox').css('visibility','hidden');
					}
					
			};

			var validate = function(clicked){
				var empty = false;
		        $('form .errorBox').each(function() {
		            if (($(this).css('visibility') == 'visible') ||  ($(this).siblings('input').val() == '')) {
		                empty = true;
		    
		                $(this).siblings('input').css('outline-color','red');
		                if(clicked) $(this).siblings('input').css('border-color','red');
		            }
		            else{
		            	$(this).siblings('input').css('outline-color','green');
		            	$(this).siblings('input').css('border', '2px solid transparent');
		            }
		            
		    	});

		        if($('textarea').val() == ''){
		        	empty = true;
		        	$('textarea:focus').css('outline-color','red');
		        	if(clicked) $('textarea').css('border','2px solid red');
		        } 
		        else{
		        	$('textarea:focus').css('outline-color', 'green');
		        	$('textarea').css('border','2px solid transparent');
		        }

		        return !empty;
			};

			$('input,textarea').keyup(function(){
				popErrors($(this));
				var clicked = false;
				validate(clicked);
			});
			$('#submit').click(function(){
				var clicked = true;
				return validate(clicked);
			});
			$('#clear').click(function(){
				$('input').val("");
				$('textarea').html("");
				
				return false;
			});
		});