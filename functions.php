<?php
//read users'data from database
function userdata()
{
	require_once("connect.php");
	$sql="select * from user";
	$result=mysql_query($sql);
	$user=mysql_fetch_array($result);

	return $user;
}

//list the user's friends
function friendlist($userid)
{
	require_once("connect.php");
	$userid=$_POST['userid']; //获取当前用户的ID
	$sql="select friendship.userID2, user.fbsql_username
	      from friendship join user on friendship.userID2=user.userID
	      where friendship.userID2='$userid'";
	$result=mysqli_query($sql);
	$friend=mysqli_fetch_array($result);
	
	return $friend;
}

function add_note($userid, $notetext, $notetime, $radius, $nrestrict, $nsID, $ifcomment)
{
	require_once("connect.php");
	$sql="insert into 'note' values ('', '$userid', '$notetext', 'notetime', '$radius', '$nrestrict', '$nsID', '$ifcomment')";
	$result=mysql_query($sql);
}

function add_tag($noteid, $tag)
{
	require_once("connect.php");
	$sql="insert into 'tag' values ('$noteid', '$tag')";
	$result=mysql_query($sql);
}

?>