<?php
//check the signup info

require_once("connect.php");
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];

if(($email=="")||($password=="")||($username=="")||($confirm=="")) //任意为空
{
	echo "Please fill in all required blanks.";
}
else
{
	if($password!=$confirm) //验证两次密码
	{
		echo "The passwords you typed do not match. Please enter again.";
		echo "<a href='signup.php'>Back</a>";
	}
	else //注册成功录入数据库
	{
		$sql="insert into 'user' values('', '$email', '$username', '$password')";
		$result=mysqli_query($sql);
		if($result)
		{
			echo "Successfully register!";
		}
		else
		{
			echo "Fail to register. Please try again.";
			echo "<a href='signup.php'>Back</a>";
		}
	}
}
?>