$( document ).ready(function() {
   
   //Index
	$(".create").click(function(){
		var url = "/projects/create";
		$(location).attr('href',url);
	});

	$(".edit").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		var url = "projects/" + id + "/edit";
		$(location).attr('href',url);
	});

	$(".delete").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		var r = confirm("Are you sure you want to delete this project permanently?");
		if (r) {
			$(this).closest('tr').fadeOut();
			$.post('/projects/' + id, { _method : "DELETE" }, function(response){
				if(response.success)
					$(this).closest('tr').remove();
				else{
					alert("I'm sorry we couldn't delete your project. Please try again. If the problem persists contact us.");
					$(this).closest('tr').fadeIn();
				}
			}).fail(function(){
				alert("I'm sorry we couldn't delete your project. Please try again. If the problem persists contact us.");
				$(this).closest('tr').fadeIn();
			});   
		}
	});

	// For categories
	$(".draggable").draggable();
    $("#droppable").droppable({
        over: function(event, ui) {
            $(ui.draggable).removeClass('btn btn-danger');
            $(ui.draggable).addClass('btn btn-success');
        },
        out: function(event, ui) {
            $(ui.draggable).removeClass('btn btn-success');
            $(ui.draggable).addClass('btn btn-danger');
        }
    });

    $('#store').click(function(){
        // Getting the categories
		var categories = $(".draggable.btn-success").map(function(){
            return this.id;
    	}).get().join(',');
		var categories = categories.split(',');

		var form = document.forms.namedItem("form-data");
		var formData = new FormData(form);
		formData.append('categories', categories);

		$.ajax({
			url:'/projects',
			data:formData,
			dataType:'json',
			async:true,
			type:'post',
			processData: false,
			contentType: false,
			success:function(response){
				if (response.success)
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>Project created!</div>")
				else
				{
					$.each(response.errors, function(key, value){
						$('.messages').prepend("<div class='alert alert-danger'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + response.errors[key] + "</div>");
					});
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("I'm sorry we couldn't create your project. Please try again. If the problem persists contact us.");
    		},
		});
	});   

});

function updateRangeInput(range) {
	document.getElementById('rangeInput').value = range;
}  
