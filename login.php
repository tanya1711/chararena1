<?php include "layouts/header.php"; ?>
<!--
//login.php
!-->
<style>
  h2{
color:white;
  }
  label{
color:white;
  }
  .container {
    margin-top: 5%;
    width: 40%;
    background-color: #26262b9e;
    padding-top:5%;
    padding-bottom:5%;
    padding-right:10%;
    padding-left:10%;
  }
  .btn-primary {
    background-color: #673AB7;
}
  </style>

<?php
  include "config.php";
  if($_POST)
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM `login` where username = '".$username."' and password = '".$password."' ";
		$query =  mysqli_query($conn, $sql);
		if(mysqli_num_rows($query)>0)
		{
			$row = mysqli_fetch_assoc($query);
			session_start();
			$_SESSION['user_id'] = $row['user_id'];
       			 $_SESSION['username'] = $row['username'];
			header("Location:index.php");
		}
		else
		{
			echo "<script> alert('Invalid Email or Password.'); </script>";
		}
	}
?>

<html>  
    <head>  
        <title>CHAT ARENA</title>  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body background="img.jpg">  
        <div class="container">
   <br />
   
   <h2 align="center"><b><font color="white" face="Comic Sans MS">WELCOME TO CHAT ARENA!!</a></h2><br />
   <br />
 
     <div class="panel-heading"><h2>Chat Application Login</h2></div></font></b>
    <div class="panel-body">
     <form method="post">
      <p class="text-danger"></p>
      <div class="form-group">
       <label>Enter Username</label>
       <input type="text" name="username" class="form-control" required />
      </div>
      <div class="form-group">
       <label>Enter Password</label>
       <input type="password" name="password" class="form-control" required />
      </div>
      <div class="form-group">
       <input type="submit" name="login" class="btn btn-info" value="Login" />
      </div>
     </form></div>
    </div>

  </div>
    </body>  
</html>
