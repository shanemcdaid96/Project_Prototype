<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>DentalApp</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
 <div class="login-page">
 <div class="icon-bar">
  <a href="home.php"><i class="fa fa-home"></i></a> 
  <a href="index.php"><i class="fa fa-refresh"></i></a> 
</div><br><br><br><br>
  <div class="form">

 <form class="form-signin" id="loginform" action="" method="POST">
   <center><h2 class="form-signin-heading"><img src="logo.png" width="150" height="150"></h2></center>
   <div id="message"></div>
      <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" required/>
      <span id="uname"></span>
      <input type="password" class="form-control" placeholder="Password" name="password" id="password"required/>
      <span id="upass" name="upass"></span><br>
      <input type="submit" class="btn btn-info btn-block"  name="submit" id="submt" value="Login">
      <a href="register.php">Not a Member? Register Here!</a><br>
      <a href="forgotPassword.php">Forget Password?</a> 
      
    </form>
  </div>
</div>
​<div class="footer">
  <a href="dentist/login.php">Dentist Login</a>
</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
<script type="text/javascript">
var attempts=0;
  $("#loginform").on("submit",function(e){
 
   
    $('#uname').html('');
    $('#upass').html('');
    $('#message').html('');
        
        var email=$("#email").val();
        var password=$("#password").val();
        if($("#email").val()==""){
               $("#uname").html("Please enter Email.");
               $("#uname").css("color", "red");
               $("#user_name").css("border", "1px solid grey");
               $("#user_name").focus();
             }
        
        else if($("#password").val()==""){
              $("#upass").html("Please enter password.");
               $("#upass").css("color", "red");
               $("#password").css("border", "1px solid grey");
              $("#password").focus();
        }
      else
      {
           $.ajax({
            type:"POST",
            url:"do_login.php",
            data:{"email":email,"password":password},
            success:function(result){
              //alert(result);
             if(result==1){
               //alert("invalid");
               attempts++;
                $("#message").html("Invalid Email/Password");
                 $("#message").css("color", "red");
                 if(attempts>2){
                  $("#message").html("3 attempts used - contact dentist for password reset");
                 $("#message").css("color", "red");
                 document.getElementById("submt").disabled = true;
                 $.ajax({
                  type:"POST",
                  url:"restrict_login.php",
                  data:{attempts:attempts, "email":email},
                  success:function(result){

                  }
                 });
                 } 
                }
                else if(result==2){
                  $("#message").html("Access Denied for 30 minutes");
                 $("#message").css("color", "red");
                 document.getElementById("submt").disabled = true;
                }
                else{
                window.location.href="home.php";
           }
          }
 
    });
 
}
 
e.preventDefault();
 
 
  });
</script>