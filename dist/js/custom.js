//----- OPEN
     $('#gmailbtn').on('click', function(e)  {
		 
		$('#userpopup').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('#userpopupclose').on('click', function(e)  {
        //var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('#userpopup').fadeOut(350);
 
        e.preventDefault();
    }); 