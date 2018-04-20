
 <?php
 echo "hello";
 require_once("functions.php");
 echo "hello";
 require_once("facebook_access.php");

echo "hello";
$access_token = $_POST["access_token"];
//$facebook->getAccessToken();
echo $access_token;
$facebook->setAccessToken($params['access_token']);
$updated_access_token=$facebook->getAccessToken();
$uid = $_POST["uid"];
$user_profile = $facebook->api('/me','GET');
$user_firstname=$user_profile['first_name'];
$user_lastname=$user_profile['last_name'];
echo $user_firstname;
if($uid==0)
	//header("location:https://www.facebook.com/connect/login.html");

	/*try{
$conn = new PDO ( "sqlsrv:server = tcp:k79oqcbnn6.database.windows.net,1433; Database = [big-friends_db]", "big_friends_public","RQaTbMAppcT6ASpU");
$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );}
catch ( PDOException $e ) {
   print( "Error connecting to SQL Server." );
   die(print_r($e));
   }
   Database=bigfriends;Data Source=us-cdbr-azure-east-b.cloudapp.net;User Id=b86e3ca291436b;Password=e4b1dc28
   $connectionInfo = array("UID" => "b86e3ca291436b", "pwd" => "e4b1dc28", "Database" => "bigfriends", "LoginTimeout" => 30, "Encrypt" => 1);
   $serverName = "tcp:k79oqcbnn6.database.windows.net,1433";
   $con = sqlsrv_connect($serverName, $connectionInfo);*/
//$con = mysqli_connect("mysql13.000webhost.com","a6961521_public","RQaTbMAppcT6ASpU","a6961521_bigfs");
$con = mysqli_connect("us-cdbr-azure-east-b.cloudapp.net","b86e3ca291436b","e4b1dc28","bigfriends");
if (!$con)
  {
  die('Could not connect: ' . mysqli_connect_error());
  echo mysqli_connect_error();
  }
$user_settings=$uid."_settings";
$user_friends=$uid."_friends";
$user_feedbackrequest=$uid."_feedback_requests";
$user_override=$uid."_override";
if(!table_exists($user_settings)) //check if user data is already present..If not create tables and write the user data
{
mysqli_query($con,"CREATE TABLE $user_settings
(firstname varchar(50),
lastname varchar(50),
trustfriends BOOLEAN DEFAULT '1',
required_approvals INT(3),
override_effective BOOLEAN DEFAULT '0',
latest_access_token BLOB
);");
mysqli_query($con,"CREATE TABLE $user_friends
(
fbid BIGINT,
PRIMARY KEY(fbid),
firstname varchar(50),
lastname varchar(50),
alreadypresent BOOLEAN,
trusted BOOLEAN DEFAULT '0'
);");
mysqli_query($con,"CREATE TABLE $user_feedbackrequest
(
sno INT(10) AUTO_INCREMENT,
PRIMARY KEY(sno),
friend_fbid BIGINT,
thread_no INT(10),
seen BOOLEAN DEFAULT '0',
given_feedback BOOLEAN DEFAULT '0');
");
mysqli_query($con,"CREATE TABLE $user_override
(
sno INT(10) NOT NULL AUTO_INCREMENT,
time INT UNSIGNED,
);");
//visibility setting -1: restricted to specified users, 0: unrestricted, 1:only to specified users


$exec=mysqli_stmt_init($con);
if(!mysqli_stmt_prepare($exec,"INSERT INTO $user_settings(firstname, lastname,latest_access_token) values (?, ?,?);"))
	{
		echo "prepare";
	}
mysqli_stmt_bind_param($exec,"ssb",$user_firstname,$user_lastname,$updated_access_token);
mysqli_stmt_execute($exec);
mysqli_stmt_close($exec);
echo mysqli_error($con);
}
mysqli_close($con);
?>
