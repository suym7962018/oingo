<?php
//check the signup info
session_start();
require_once("functions.php");
$server="localhost";
$db_username="root";
$db_password="";
$db_name="proj1"; 
$con=mysqli_connect($server, $db_username, $db_password, $db_name);
if(!$con)
{
    die("can't connect".mysqli_error());
}

$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$gender=$_POST['gender'];
$birthdate=$_POST['birthdate'];
$region=$_POST['region'];


if(($email=="")||($password=="")||($username=="")||($confirm=="")||($gender=="")||($birthdate=="")||($region=="")) //任意为空
{
	//echo "Please fill in all the blanks.";
	echo"<script type='text/javascript'>alert('Please fill in all the blanks.');location='signup.html';</script>";
}
else
{
	check_username($username);
	if($password!=$confirm) //验证两次密码
	{
		echo"<script type='text/javascript'>alert('The passwords you typed do not match. Please enter again.');location='signup.html';</script>";
	}
	else //注册成功录入数据库
	{
		//add_user($email, $username, $password, $gender, $birthdate, $region);
		//$sql1="insert into user(email, userName, password, gender, birthDate, region) values ('$email', '$username', '$password', '$gender', '$birthdate', '$region')";
		$sql1 = $con->prepare('insert into user(email, userName, password, gender, birthDate, region) values (?, ?, ?, ?, ?, ?)');
		$sql1->bind_param('ssssss', $email, $username, $password, $gender, $birthdate, $region);
		$sql1->execute();
		$result1 = $sql1->get_result();
		//$result1=mysqli_query($con, $sql1);
		//add state
		$user=userdata($email);
		$_SESSION['userid']=$user['userID'];
		$_SESSION['email']=$user['email'];
		$sql2="insert into state(userID, state) values ('".$user['userID']."', 'default')";
		$result2=mysqli_query($con, $sql2);
		$sql3="insert into current (userID, cTime, cWeekday, cLongitude, cLatitude, cLocation) values ('".$user['userID']."', '2000-01-01 00:00:00', 6, 0, 0, 'default')";
		$result3=mysqli_query($con, $sql3);
		echo"<script type='text/javascript'>alert('Successfully register!');location='index.php';</script>";
	}
}
?>