<!--  يقوم باضافة أو تعديل مستخدم في قاعدة البيانات-->
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
  a {
  color: #007bff; 
  text-decoration: none; 
}

a:hover {
  color: #0056b3; 
}
</style>
<?php
include('header.php');
checkUser();
adminArea();
$msg="";
$username="";
$password="";
$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
	$label="Edit";
	$id=get_safe_value($_GET['id']);
	$res=mysqli_query($con,"select * from users where id=$id");
	if(mysqli_num_rows($res)==0){
		redirect('users.php');
		die();
	}
	$row=mysqli_fetch_assoc($res);
	$username=$row['username'];
	$password=$row['password'];
}

if(isset($_POST['submit'])){
	$username=get_safe_value($_POST['username']);
	$password=get_safe_value($_POST['password']);
	$type="add";
	$sub_sql="";
	if(isset($_GET['id']) && $_GET['id']>0){
		$type="edit";
		$sub_sql="and id!=$id";
	}
	
	$res=mysqli_query($con,"select * from users where username='$username' $sub_sql");
	if(mysqli_num_rows($res)>0){
		$msg="Username already exists";
	}else{
		
		$password=password_hash($password,PASSWORD_DEFAULT);
		
		$sql="insert into users(username,password,role) values('$username','$password','User')";
		if(isset($_GET['id']) && $_GET['id']>0){
			$sql="update users set username='$username',password='$password' where id=$id";
		}
		mysqli_query($con,$sql);
		redirect('users.php');
	}
}

include('user_header.php');
?>
<h2><?php echo $label?> Users</h2>
<a href="users.php">Back</a>
<br/><br/>

<form method="post">
<div class="box">
	<table>
		<tr>
			<td>Username</td>
			<td><input type="text" name="username" required value="<?php echo $username?>"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="password" name="password" required value="<?php echo $password?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"></td>
		</tr>
	</table>
</div>
</form>

<?php echo $msg;?>

<?php
include('footer.php');
?>