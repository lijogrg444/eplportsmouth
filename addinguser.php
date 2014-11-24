<?php 

//$root_location="/var/www/html/students.ee.port.ac.uk/up754668/";
include 'globals.php';

// $root_location is stored in the file globals.php 

include("$root_location"."controller/connection.php");
$repeat=10;


echo $_POST["activated"];
echo "<br>";
echo $_POST["username"];
echo "<br>";
echo $_POST["password"];
echo "<br>";
echo $_POST["fname"];
echo "<br>";
echo $_POST["lname"];
echo "<br>";
echo $_POST["email"];
echo "<br>";
echo $_POST["password"];echo "<br>";
echo $_POST["cpassword"];echo "<br>";
echo $_POST["phno"];echo "<br>";
echo $_POST["address"];echo "<br>";
echo $_POST["pc"];//postcodeecho "<br>"
echo $_POST["county"];echo "<br>";
echo $_POST["country"];echo "<br>";
echo $_POST["school"];echo "<br>";
echo "<br>";
echo $_POST["usertype"];
echo "<br>";
switch($_POST["usertype"])
    {
      case "Staff": 
					$usertype=2; 
					break;
      case "Student": 
					$usertype=1;
					break;
	  
      case "Other":
					$usertype=3;
					break;
	  
      default: 
	  
					exit(); 
					break;
    }

echo $usertype;
$username=$_POST["username"];

$query1="SELECT * FROM users WHERE username='$username'";
$handle = mysqli_query($con,$query1);
$count=mysqli_num_rows($handle);
$time=time(); //reg time in unix epoc time
date_default_timezone_set("Europe/London");//default time zone for date() 
$last_date=date('m',$time);
 
//make sure username is not alreaady taken
if($count==0)
{
$repeat=0;
}

echo "repeat=".$repeat;

if ($repeat==0)
{
$query2= "INSERT INTO users(username,user_password,user_type,fname,lname,email,phno,regdate,last_date,address,county,country,pc,school,activated) VALUES('$_POST[username]','$_POST[password]','$usertype','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[phno]','$time','$last_date','$_POST[address]','$_POST[county]','$_POST[country]','$_POST[pc]','$_POST[school]','$_POST[activated]')";
$handle = mysqli_query($con,$query2);
if ($_POST["activated"] ==1)
{
header("Location: https://$host$path/manageusers.php?success=1");				
}
else if($_POST["activated"] ==0)
{
header("Location: https://$host$path/pendingusers.php?success=1");
} 

}

else
{
  //Username already exists ,please select a new one ";
  header("Location: https://$host$path/adduser.php?error=1");
  
}





?>
