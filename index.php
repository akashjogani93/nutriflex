<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="asset/login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
			    <center>	<h3>Log In</h3> </center>
				<!-- <div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div> -->
			</div>
			<div class="card-body">
				<!-- <form> -->
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="username" id="user">
                    
                </div>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" id="myInput" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="checkbox" onclick="myFunction()"><b class="text-white"style="margin-left:7px;">Show Password</b>
                </div>
            
                <div class="form-group">
                    <center>
                    <input type="submit" value="Login" class="btn login_btn" onclick="logintocheck()">
                    </center>
                </div>
				<!-- </form> -->
			</div>
			
		</div>
	</div>
</div>
</body>
    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }


        function logintocheck()
        {
            username=$("#user").val();
            password=$("#myInput").val();

            var input=['#user','#myInput'];
            for(var i=0; i<input.length; i++)
            {
                if($(input[i]).val() == '')
                {
                    $(input[i]).css("border", "1px solid red");
                    return;
                }else
                {
                    $(input[i]).css("border","");
                }
            }
            let log=$.ajax({
                url:'ajax/submit_master.php',
                type:'post',
                dataType:'json',
                data:{
                    username:username,
                    password:password,
                },
                success: function(response)
                {
                    console.log(response);
                    if(response==0)
                    {
                        window.location="home.php"
                    }else if(response==1)
                    {
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something Went Wrong!',
                        })
                        return;
                    }
                }
            });
        }
    </script>
</html>