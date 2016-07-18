<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="dist/js/custom.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  $(document).ready(function(){
	  
	  $('#registerbtn').click(function(){
		   var loginbxpassword = $('input[name="loginbxpassword"]').val();   
		   var loginbxrepassword = $('input[name="loginbxrepassword"]').val(); 
 		   
		   if(loginbxpassword != loginbxrepassword){
			   alert('Entered password are not same');
			    
				$('.registerform').submit(function(e) {
					return false;  
				});
				
			}
	  });
  });
  

</script>
</body>
</html>