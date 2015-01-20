$(function() {
  $('.error').hide();
  $('input.text-input').css({backgroundColor:"#FFFFFF"});
  $('input.text-input').focus(function(){
    $(this).css({backgroundColor:"#FFDDAA"});
  });
  $('input.text-input').blur(function(){
    $(this).css({backgroundColor:"#FFFFFF"});
  });

  $(".button").click(function() {
		// validate and process form
		// first hide any error messages
    $('.error').hide();
		
	  var teacher_name = $("input#teacher").val();
		if (teacher_name == "") {
      $("label#teacher_name_error").show();
      $("input#teacher").focus();
      return false;
    }
		var teacher_book = $("input#teacher_book").val();
		if (teacher_book == "") {
      $("label#teacher_book_error").show();
      $("input#teacher_book").focus();
      return false;
    }
		
		var dataString = 'teacher_name='+ teacher_name + '&teacher_book=' + teacher_book;
		//alert (dataString);return false;
		
		$.ajax({
		type: "POST",
		url: "sendbookBACKUP.php",
		data: dataString,
		success: function() {
			get(document.getElementById('contact'));
			$('#contact_form').html("<div id='message'></div>");
			$('#message').html("<h2>Contact Form Submitted!</h2>")
			.append("<p>We will be in touch soon.</p>")
			.hide()
			.fadeIn(1500, function() {
				$('#message').append("<p>Keep the yolo going</p>");
				});
			}
		});
	return false;
	});
});
runOnLoad(function(){
  $("input#name").select().focus();
});
