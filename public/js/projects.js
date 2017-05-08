$( document ).ready(function() {
   
   //Index
	$(".create").click(function(){
		var url = "/projects/create";
		$(location).attr('href',url);
	});

	$(".edit").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		if (!id)
			id = $(this).closest('a').attr('data-id');
		var url = "/projects/" + id + "/edit";
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

	$(".join").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		if (!id)
			id = $(this).closest('a').attr('data-id');
		var r = confirm("Are you sure you want to join this project?");
		if (r) {
			$(this).closest('tr').fadeOut();
			$.post('/joinProject/' + id, { _method: "POST" }, function(response){
				if (response.success){
					var url = "/projects/" + id;
					$(location).attr('href',url);
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>Notification sent!</div>");
				}
				else {
					alert("I'm sorry we couldn't make you join this project. Please try again. If the problem persists contact us.");
				}
			}).fail(function(){
				alert("I'm sorry we couldn't make you join this project. Please try again. If the problem persists contact us.");
			});  
		}
	});

	$(".leave").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		if (!id)
			id = $(this).closest('a').attr('data-id');
		var r = confirm("Are you sure you want to leave this project?");
		if (r) {
			$(this).closest('tr').fadeOut();
			$.post('/leaveProject/' + id, { _method: "POST" }, function(response){
				if (response.success)
					$(this).closest('tr').remove();
				else {
					alert("I'm sorry we couldn't let you leave this project. Please try again. If the problem persists contact us.");
					$(this).closest('tr').fadeIn();
				}
			}).fail(function(){
				alert("I'm sorry we couldn't let you leave this project. Please try again. If the problem persists contact us.");
				$(this).closest('tr').fadeIn();
			});  
		}
	});

	$(".finish").click(function(){
		var id = $(this).closest('tr').attr('data-id');
		if (!id)
			id = $(this).closest('a').attr('data-id');
		var r = confirm("Are you sure you finish this project? This action is irreversible");
		if (r) {
			$.post('/finishProject/' + id, { _method: "POST" }, function(response){
				if (response.success)
				{
					var url = "/projects/" + id;
					$(location).attr('href',url);
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>Project finished!</div>");
				}
				else {
					alert("I'm sorry we couldn't finish this project for you. Please try again. If the problem persists contact us.");
				}
			}).fail(function(){
				alert("I'm sorry we couldn't finish this project for you. Please try again. If the problem persists contact us.");
			});  
		}
	});

	$(".accept").click(function(){
		var collaborator_id = $(this).closest('tr').attr('collaborator');
		var project_id = $(this).closest('tr').attr('project');
		var r = confirm("Are you sure you want this user to be part of your project?");
		if (r) {
			$(this).closest('tr').fadeOut();
			$.post('/addCollaborator/' + project_id, { _method: "POST", collaborator: collaborator_id }, function(response){
				if (response.success)
				{
					var url = "/projects/" + project_id;
					$(location).attr('href',url);
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>User now collaborating!</div>");
				}
				else {
					alert("I'm sorry we couldn't add this user to your project. Please try again. If the problem persists contact us.");
				}
			}).fail(function(){
				alert("I'm sorry we couldn't add this user to your project. Please try again. If the problem persists contact us.");
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
				{
					var url = "/projects";
					$(location).attr('href',url);
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>Project created!</div>")
				}
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

	$('#update').click(function(){
		project_id = document.getElementById("project_id").value;
		var categories = $(".draggable.btn-success").map(function(){
            return this.id;
    	}).get().join(',');
		var current_photos = $(".close.current_photo").map(function(){
            return this.id;
    	}).get().join(',');

		var current_photos = current_photos.split(',');
		var categories = categories.split(',');

		var form = document.forms.namedItem("form-data");
		var formData = new FormData(form);
		formData.append('categories', categories);
		formData.append('current_photos', current_photos);
		formData.append('_method', 'PUT');

		$.ajax({
			url:'/projects/' + project_id,
			data:formData,
			dataType:'json',
			async:true,
			type:'post',
			processData: false,
			contentType: false,
			success:function(response){
				if (response.success)
				{
					var url = "/projects/" + project_id;
					$(location).attr('href',url);
					$('.messages').prepend("<div class='alert alert-success'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>Project updated!</div>")
				}
				else
				{
					$.each(response.errors, function(key, value){
						$('.messages').prepend("<div class='alert alert-danger'><a class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + response.errors[key] + "</div>");
					});
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				alert("I'm sorry we couldn't update your project. Please try again. If the problem persists contact us.");
    		},
		});
	});

	$('.close').click(function(){
		var r = confirm("Estas seguro de borrar esta imagen?");
		if (r){
			var photo_id = this.id;
			$("#" + photo_id).remove();
			plusSlides(1);
		}
	});

});

function updateRangeInput(range) {
	document.getElementById('rangeInput').value = range;
}  

/**
 * Show slides for the images
 */
var slideIndex = 1;
var notShowing = [];
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  slides[slideIndex-1].style.display = "block"; 
}