<!-- صفحة لوحة معلومات خاصة بالمستخدم-->
<style>
	body{

background: linear-gradient(#c0c0aa, #1cefff);

}
h2 {
  font-size: 28px;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  font-size: 18px;
}

td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}

/* تصميم العناصر الفرعية */
td:first-child {
  text-align: left;
  font-weight: bold;
  background-color: #f2f2f2;
}


a {
  color: #007bff; /* تغيير لون الروابط */
  text-decoration: none; /* إزالة تأثير الزخرفة الافتراضية للروابط */
}

a:hover {
  color: #0056b3; /* تغيير لون الروابط عند المرور بالمؤشر */
}



</style>
<?php
include('header.php');
checkUser();
userArea();
include('user_header.php');
?>
<h2>Dashboard</h2>

<table>
	<tr>
		<td>Today's Expense</td>
		<td>
		<?php echo getDashboardExpense('today')?>
		</td>
	</tr>
	<tr>
		<td>Yesterday's Expense</td>
		<td>
		<?php echo getDashboardExpense('yesterday')?>
		</td>
	</tr>
	<tr>
		<td>This Week Expense</td>
		<td>
		<?php echo getDashboardExpense('week')?>
		</td>
	</tr>
	<tr>
		<td>This Month Expense</td>
		<td>
		<?php echo getDashboardExpense('month')?>
		</td>
	</tr>
	<tr>
		<td>This Year Expense</td>
		<td>
		<?php echo getDashboardExpense('year')?>
		</td>
	</tr>
	<tr>
		<td>Total Expense</td>
		<td>
		<?php echo getDashboardExpense('total')?>
		</td>
	</tr>
</table>


<?php
include('footer.php');
?>