<style>
	body{

		background: linear-gradient(#c0c0aa, #1cefff);

	}
/* تنسيق الجدول */
table {
  border-collapse: collapse; /* إضافة خاصية لدمج حواف الخلايا */
  width: 100%; /* إضافة عرض كامل للجدول */
}

table td, table th {
  border: 1px solid #ddd; /* إضافة حواف للخلايا */
  padding: 8px; /* إضافة هامش داخلي للخلايا */
  text-align: center; /* محاذاة نص الخلايا بالوسط */
}

tr:first-child {
  
  background-color: #f2f2f2;
}
table th {
  background-color: #f2f2f2; /* إضافة لون خلفية لصف العناوين */
  font-weight: bold; /* إضافة سمك للخط لصف العنوان */
}

/* تنسيق الروابط */
a {
  color: #007bff; /* تغيير لون الروابط */
  text-decoration: none; /* إزالة تأثير الزخرفة الافتراضية للروابط */
}

a:hover {
  color: #0056b3; /* تغيير لون الروابط عند المرور بالمؤشر */
}

/* تنسيق العنوان */
h2 {
  font-size: 24px; /* تغيير حجم الخط */
  margin-bottom: 20px; /* إضافة هامش سفلي */
}

/* تنسيق الزر */
.button {
  background-color: #007bff; /* إضافة لون خلفية للزر */
  border: none; /* إزالة حواف الزر */
  color: white; /* تغيير لون نص الزر */
  padding: 10px 20px; /* إضافة هامش داخلي للزر */
  text-align: center; /* محاذاة نص الزر بالوسط */
  text-decoration: none; /* إزالة تأثير الزخرفة الافتراضية لنص الزر */
  display: inline-block; /* جعل الزر عنصرا متدفقا */
  font-size: 16px; /* تغيير حجم الخط */
  margin-top: 20px; /* إضافة هامش علوي */
}

.button:hover {
  background-color: #0056b3; /* تغيير لون خلفية الزر عند المرور بالمؤشر */
}

</style>
<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');

if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
	$id=get_safe_value($_GET['id']);
	mysqli_query($con,"delete from expense where id=$id");
	echo "<br/>Data deleted<br/>";
}

$res=mysqli_query($con,"select expense.*,category.name from expense,category  where expense.category_id=category.id and expense.added_by='".$_SESSION['UID']."'
order by expense.expense_date asc");
?>
<h2>Expense</h2>
<a href="manage_expense.php">Add Expense</a>
<br/><br/>
<?php
if(mysqli_num_rows($res)>0){
?>

<table border="1">
	<tr>
		<td>ID</td>
		<td>Category</td>
		<td>Item</td>
		<td>Price</td>
		<td>Details</td>
		<td>Expense Date</td>
		<td></td>
	</tr>
	<?php while($row=mysqli_fetch_assoc($res)){?>
	<tr>
		<td><?php echo $row['id'];?></td>
		<td><?php echo $row['name']?></td>
		<td><?php echo $row['item']?></td>
		<td><?php echo $row['price']?></td>
		<td><?php echo $row['details']?></td>
		<td><?php echo $row['expense_date']?></td>
		<td>
			<a href="manage_expense.php?id=<?php echo $row['id'];?>">Edit</a>&nbsp;
			<a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','expense.php')">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } 
	else{
		echo "No data found";
	}
?>


<?php
include('footer.php');
?>