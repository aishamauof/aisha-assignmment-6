<!--   aisha mauof-->
<!--217010003 -->
<!--صفحة تسجيل دخول  -->
<style>
	body{

background: linear-gradient(#c0c0aa, #1cefff);

}
	h2 {
    color: white;
    font-size: 50px;
	text-align:center;
  }

 .box{
	background: #007bff;
  width:300px;
  border-radius:6px;
  margin: 0 auto 0 auto;
  padding:0px 0px 70px 0px;
  border: #007bff 4px solid; 
}	
  input[type="text"], input[type="password"], input[type="submit"] {
    padding: 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 10px;
  }
  input[type="submit"] {
    background-color: #1CD8D2;
    color: white;
    cursor: pointer;
  }
</style>

<?php
include('header.php');
if(isset($_POST['login'])){
	$username=get_safe_value($_POST['username']);
	$password=get_safe_value($_POST['password']);
	
	$res=mysqli_query($con,"select * from users where username='$username'");
	
	if(mysqli_num_rows($res)>0){
		$row=mysqli_fetch_assoc($res);
		
		$verify=password_verify($password,$row['password']);
		
		if($verify==1){
			$_SESSION['UID']=$row['id'];
			$_SESSION['UNAME']=$row['username'];
			$_SESSION['UROLE']=$row['role'];
			if($_SESSION['UROLE']=='User'){
				redirect('dashboard.php');
			}else{
				redirect('category.php');
			}
		}else{
			echo "Please enter valid password";
		}
	}else{
		echo "Please enter valid username";
	}
		
}
?>
<form method="post"><div class="box">
<h2>Login</h2>

	
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" required></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="login" value="Login"></td>
		</tr>

	</table>
</div>
</form>


<?php
include('footer.php');
?>