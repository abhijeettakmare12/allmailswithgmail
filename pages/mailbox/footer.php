
<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script> 
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- Page Script -->
<script>
/*function load_email_list(id,e_type){
	 $.ajax({
		  type: "POST",
		  url: "email_list_return.php",
		  data: {account_id:id,mail_type:e_type},
		  success: function(response){
			 	$("#mail_list").html(response); 
				 
		  },
		  beforeSend: function() {
 			  $("#mail_list").html( "<img src='../../dist/img/ajax-loader-new.gif' width='32' height='32' class='loading-img' />" );   
   		  }
		  
		});
	
} */
  $(function () {
	  
	  //Custom Script
	  $("#add_more_accounts").click(function(e){
		  
		 alert("You Can add More Accounts Here"); 
		  
	  });
	  // loading menu list
	  $.ajax({
		  type: "POST",
		  url: "load_menu.php",
		  data: '',
		  success: function(response){
			 	$("#menu_list").html(response); 
				
		  },
		  beforeSend: function() {
			  
 			 // $("#mail_list").html( "<img src='../../dist/img/ajax-loader-new.gif' width='32' height='32' class='loading-img' />" );   
   		 }
		  
		});
	  
	  
	  //load mail 
	 	
	 // load_email_list(<?php //echo $_SESSION['account_id'];?>,<?php //echo $_SESSION['mail_type_id'];?>);
	 
	  // End of Custom Script
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });
    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
	
  });

</script>
 
</body>
</html>