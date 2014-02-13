		$(document).ready(function(){

			// pagination ==========================================
			function paginate(data){

				var html = "";
				var allProducts = data['allProducts'];

				$('.productsTable tbody').html(""); //clear table and get ready to put in new html

				$.each(allProducts, function(key, oneProduct){
					
					html = "<tr id='id"+oneProduct['id']+"'>";
				 	$.each(oneProduct, function(attributeKey, attribute){
				 		if(attributeKey !== 'id')
						{
							 html += "<td>"+attribute+"</td>";
						}
				 	});
				 	html += "<td><img src='images/edit.png' class='btnEdit hidden'/></td>";
					html += "<td><img src='images/delete.png' class='btnDelete hidden'/></td>";
				 	html += "</tr>";
				 	$('.productsTable tbody').append(html);
				});
				$(".btnEdit").bind("click", Edit);
				$(".btnDelete").bind("click", Delete);
			};

			$("#paginationForm").on('submit', function(){

				var form = $(this);
				$.post(
					form.attr('action'),
					form.serialize(),
					function(data){
						paginate(data);

					},
					'json'
				);
				return false;
			});

			$(".pagination li:first-child").addClass('liSelected');

			$(".pagination li").on('click', function(){
				var pageNum = $(this).text();
				$("input[name=page-number]").val(pageNum); // set the input value to the number that was selected/clicked
				$(".pagination li").removeClass('liSelected');
				$(this).addClass('liSelected'); // change the color of the selected number
				$("#paginationForm").submit(); //submit the form to cause pagination
				
			});


		});


		setTimeout(function(){changeToRed();},14000);

		setInterval(function(){changeColors();}, 28000);

		function changeColors(){
			$('body').removeClass('red');
			$('body').addClass('colorChange');
			setTimeout(function(){changeToRed();},14000);
		}
		function changeToRed(){
			$('body').removeClass('colorChange');
			$('body').addClass('red');
		}

		

		// the following are functions for editing,saing, deleting rows
		// ============================================================

		$(function(){
			$(".btnEdit").bind("click", Edit);
		    $(".btnDelete").bind("click", Delete);
		    $("#btnAdd").bind("click", Add);
		});

		function Add(){
			
		    $('.productsTable tbody').prepend(
		        "<tr class='showing'>"+
		        "<td><input type='text'/></td>"+
		        "<td><textarea></textarea></td>"+
		        "<td><input type='text'/></td>"+
		        "<td><input type='text'/></td>"+
		        "<td><input type='text'/></td>"+
		        "<td><input type='text'/></td>"+
		        "<td><input type='text'/></td>"+
		        "<td><img src='images/save.png' class='btnSave'><td>"+
		        "<td><img src='images/delete.png' class='btnDelete'/></td>"+
		        "</tr>");


	     
	        $(".btnSave").bind("click", Save);     
	        $(".btnDelete").bind("click", Delete);
	        $("#table").tablesorter(); 


		};

		function Save(){
			var parent = $(this).parent().parent(); // to produce a tr
			var name = parent.children("td:nth-child(1)");
			var description = parent.children("td:nth-child(2)");
			var width = parent.children("td:nth-child(3)");
			var length= parent.children("td:nth-child(4)");
			var height= parent.children("td:nth-child(5)");
			var weight= parent.children("td:nth-child(6)");
			var value= parent.children("td:nth-child(7)");
			var edit= parent.children("td:nth-child(8)");
			var del= parent.children("td:nth-child(9)");

			var rowID = ($(this).parent().parent().attr('id'));
			if(rowID){
				var rowID = rowID.slice(2);
				console.log(rowID);
				$('#productId').attr('value',rowID);
				$('#name').attr('value', name.children("input[type=text]").val());
				$('#description').attr('value',description.children("textarea").html());
				$('#width').attr('value',width.children("input[type=text]").val());
				$('#length').attr('value',length.children("input[type=text]").val());
				$('#weight').attr('value',weight.children("input[type=text]").val());
				$('#height').attr('value',height.children("input[type=text]").val());
				$('#value').attr('value',value.children("input[type=text]").val());
				

				// $('#updateForm').submit();

				// almost finished here, running out of time
			}

			name.html(name.children("input[type=text]").val());
			description.html(description.children("textarea").html());
			width.html(width.children("input[type=text]").val());
			length.html(length.children("input[type=text]").val());
			height.html(height.children("input[type=text]").val());
			weight.html(weight.children("input[type=text]").val());
			value.html(value.children("input[type=text]").val());
			edit.html("<img src='images/edit.png' class='btnEdit hidden'/>");
			del.html("<img src='images/delete.png' class='btnDelete'>");
			
			$(".btnEdit").bind("click", Edit);
			$(".btnDelete").bind("click", Delete);
			// $('th:not(th:first-child)').toggle();

		};

		function Edit(){
			var parent = $(this).parent().parent(); // to produce a tr
			var name = parent.children("td:nth-child(1)");
			var description = parent.children("td:nth-child(2)");
			var width = parent.children("td:nth-child(3)");
			var length= parent.children("td:nth-child(4)");
			var height= parent.children("td:nth-child(5)");
			var weight= parent.children("td:nth-child(6)");
			var value= parent.children("td:nth-child(7)");
			var save= parent.children("td:nth-child(8)");


			

			name.html("<input type='text' value='"+name.html()+"'/>");
			description.html("<textarea>"+description.html()+"</textarea>");
			width.html("<input type='text' value='"+width.html()+"'/>");
			length.html("<input type='text' value='"+length.html()+"'/>");
			height.html("<input type='text' value='"+height.html()+"'/>");
			weight.html("<input type='text' value='"+weight.html()+"'/>");
			value.html("<input type='text' value='"+value.html()+"'/>");
			save.html("<img src='images/save.png' class='btnSave hidden'/>");

			$(".btnSave").bind("click", Save);

			



		};

		function Delete(){
			var rowID = ($(this).parent().parent().attr('id'));
			if(rowID){
				var rowID = rowID.slice(2);
				$('#deleteRow').attr('value',rowID);
				$('#deleteForm').submit();
			}
			
			$(this).parent().parent().remove();

			//submit form to delete items from database

		};

		$("#deleteForm").on('submit', function(){

				var form = $(this);
				$.post(
					form.attr('action'),
					form.serialize(),
					function(data){
						console.log('deleted');

					},
					'json'
				);
				return false;
		});





		var button = $('.btnEdit, .btnDelete').parent()
		// $('.btnEdit, .btnDelete').addClass('hidden');

		$('th:not(th:first-child)').hide();

		$(document).on('mouseenter','table', function(){
			$('.btnEdit, .btnDelete').parent().on('mouseenter',function(){
				$(this).children().removeClass('hidden');

			});
			$('.btnEdit, .btnDelete').parent().on('mouseleave',function(){
				$(this).children().addClass('hidden');
			});

			$('td:first-child').on('click',function(){
				$(this).siblings('td:not(td:last-child)').toggle();	
				$('th:not(th:first-child)').show();	
				
			});
			
			
			
		}); 
		
		$(document).ready(function() 
		    { 
		        $("#table").tablesorter(); 
		    } 
		); 
		