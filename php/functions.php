<!--يحتوي على مجموعة من الدوال   -->
<?php
/*  تستخم الدالة هده لطباعة قيم متغير و تصحيح الاخطاء */
function prx($data){
	echo '<pre>';
	print_r($data);
	die();
}
/*  دالة تستخم الارجاع قيم مدخلة من مستخدم بشكل امن*/
function get_safe_value($data){
	global $con;
	if($data){
		return mysqli_real_escape_string($con,$data);
	}
}
/*  دالة اعادة توجيه المستخدم الي صفحة اخرى*/
function redirect($link){
	?>
	<script>
	window.location.href="<?php echo $link?>";
	</script>
	<?php
}
/*  دالة تستخدم  تحقق من تسجيل دخول المستخدم*/
function checkUser(){
	if(isset($_SESSION['UID']) && $_SESSION['UID']!=''){
	
		
	}else{
		redirect('index.php');
	}
}

/*دالة تستخدم لجلب كافة الفئات  */
function getCategory($category_id='',$page=''){
	global $con;
	$res=mysqli_query($con,"select * from category order by name asc");
	$fun="required";
	if($page=='reports'){
		//$fun="onchange=change_cat()";
		$fun="";
	}
	$html='<select $fun name="category_id" id="category_id">';
		$html.='<option value="">Select Category</option>';
		
		while($row=mysqli_fetch_assoc($res)){
			if($category_id>0 && $category_id==$row['id']){
				$html.='<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
			}else{
				$html.='<option value="'.$row['id'].'">'.$row['name'].'</option>';	
			}
			
		}
		
	$html.='</select>';
	return $html;
	
}

/*دالة تستخدم لجلب اجمالي المصروفات في فترة معينة*/
function getDashboardExpense($type){
	global $con;
	$today=date('Y-m-d');
	if($type=='today'){
		$sub_sql=" and expense_date='$today'";
		$from=$today;
		$to=$today;
	}
	elseif($type=='yesterday'){
		$yesterday=date('Y-m-d',strtotime('yesterday'));
		$sub_sql=" and expense_date='$yesterday'";
		$from=$yesterday;
		$to=$yesterday;
	}elseif($type=='week' || $type=='month' || $type=='year'){
		$from=date('Y-m-d',strtotime("-1 $type"));
		$sub_sql=" and expense_date between '$from' and '$today'";
		$to=$today;
	}else{
		$sub_sql=" ";
		$from='';
		$to='';
	}
	
	$res=mysqli_query($con,"select sum(price) as price from expense where added_by='".$_SESSION['UID']."' $sub_sql");
	
	$row=mysqli_fetch_assoc($res);
	$p=0;
	$link="";
	if($row['price']>0){
		$p=$row['price'];
		$link="&nbsp;<a href='dashboard_report.php?from=".$from."&to=".$to."' target='_blank'>Details</a>";
	}
	
	return $p.$link;	
}

/* دالة تستخم للتحقق من ان مستخدم المتصل لديه صلاحيات الادارة */
function adminArea(){
	if($_SESSION['UROLE']!='Admin'){
		redirect('dashboard.php');
	}
}
/*  دالة تستخم للتحقق من ان مستخدم المتصل لديه صلاحيات مستخدم العادي*/
function userArea(){
	if($_SESSION['UROLE']!='User'){
		redirect('category.php');
	}
}
?>