<!--صفحة الاضافة او تحرير تفاصيل مصاريف المستخدم -->
<style>
		body{

background: linear-gradient(#c0c0aa, #1cefff);

}
h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

form {
  width: 80%;
  margin: 0 auto;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

table td {
  padding: 10px;
  border: 1px solid #ddd;
  
}

table td:first-child {
  width: 150px;
}

a {
  color: #007bff; 
  text-decoration: none; 
}

a:hover {
  color: #0056b3; 
}


input[type="text"],
input[type="date"] {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ddd;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #3e8e41;
}
</style>
<?php
include('header.php');
checkUser();
userArea();
$msg="";
$category_id="";
$item="";
$price="";
$details="";
$expense_date=date('Y-m-d');
$label="Add";
if(isset($_GET['id']) && $_GET['id']>0){
	$label="Edit";
	$id=get_safe_value($_GET['id']);
	$res=mysqli_query($con,"select * from expense where id=$id");
	if(mysqli_num_rows($res)==0){
		redirect('expense.php');
		die();
	}
	$row=mysqli_fetch_assoc($res);
	$category_id=$row['category_id'];
	$item=$row['item'];
	$price=$row['price'];
	$details=$row['details'];
	$expense_date=$row['expense_date'];
	if($row['added_by']!=$_SESSION['UID']){
		redirect('expense.php');
	}
	
}

if(isset($_POST['submit'])){
	$category_id=get_safe_value($_POST['category_id']);
	$item=get_safe_value($_POST['item']);
	$price=get_safe_value($_POST['price']);
	$details=get_safe_value($_POST['details']);
	$expense_date=get_safe_value($_POST['expense_date']);
	$added_on=date('Y-m-d h:i:s');
	
	$type="add";
	$sub_sql="";
	if(isset($_GET['id']) && $_GET['id']>0){
		$type="edit";
		$sub_sql="and id!=$id";
	}
	
	$added_by=$_SESSION['UID'];
	$sql="insert into expense(category_id,item,price,details,added_on,expense_date,added_by) values('$category_id','$item','$price','$details','$added_on','$expense_date','$added_by')";

	if(isset($_GET['id']) && $_GET['id']>0){
		$sql="update expense set category_id='$category_id',item='$item',price='$price',details='$details',expense_date='$expense_date' where id=$id";
	}
	mysqli_query($con,$sql);
	redirect('expense.php');
}

include('user_header.php');
?>
<h2><?php echo $label?> Expense</h2>
<a href="expense.php">Back</a>
<br/><br/>

<form method="post">
	<table>
		<tr>
			<td>Category</td>
			<td>
			<?php echo getCategory($category_id);
			?>
			</td>
		</tr>
		<tr>
			<td>Item</td>
			<td><input type="text" name="item" required value="<?php echo $item?>"></td>
		</tr>
		<tr>
			<td>Price</td>
			<td><input type="text" name="price" required value="<?php echo $price?>"></td>
		</tr>
		<tr>
			<td>Details</td>
			<td><input type="text" name="details" required value="<?php echo $details?>"></td>
		</tr>
		<tr>
			<td>Expense Date</td>
			<td><input type="date" name="expense_date" required value="<?php echo $expense_date?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"></td>
		</tr>
	</table>
</form>

<?php echo $msg;?>

<?php
include('footer.php');
?>