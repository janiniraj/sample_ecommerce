$(function(){
    $('.youtube-video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });

    // If you want to keep full screen on window resize
    $(window).resize(function(){
        $('.youtube-video').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
    });

    $("#headerRegister").submit(function(e){
    	e.preventDefault();
    	var url = $(this).attr('action');
    	$.ajax({
           type: "POST",
           url: url,
           data: $("#headerRegister").serialize(),
           success: function(data)
           {
           		if(data.success == true)
           		{
           			swal({
	                  title:'Thank you!',
	                  text:data.message,
	                  type:'success'
	                }).then(function() {
	                    $('#register-modal').modal('hide');
	                    window.location.replace(data.redirectPath);
	                });
           		}
           		else
           		{

       				swal({
                      title:'Errors',
                      html:data.error,
                      type:'error'
                    });
           		}           		
           }
         });
    });
});