<?php
if((!empty($_POST["fname"]))&(!empty($_POST["username"]))&(!empty($_POST["email"]))&(!empty($_POST["phone_num"]))&(!empty($_POST["confirm_password"]))&(!empty($_POST["bank_name"]))&(!empty($_POST["account_name"]))&(!empty($_POST["account_no"]))){
	//collecting credentials from the form collected
    $fname=htmlspecialchars(trim($_POST["fname"]));
    $username=htmlspecialchars(trim($_POST["username"]));
    $password=htmlspecialchars(trim($_POST["password"]));
    $phone_num=htmlspecialchars(trim($_POST["phone_num"]));
    $email=htmlspecialchars(trim($_POST["email"]));
    $account_name =htmlspecialchars(trim($_POST["account_name"]));
    $account_no =htmlspecialchars(trim($_POST["account_no"]));
    $bank_name=htmlspecialchars(trim($_POST["bank_name"]));
    $result=createUser($fname,$username,$email,$phone_num,$password,$bank_name,$account_name,$account_no);
    if($result){
         $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Dashboard/dashboard.html';
        header('Location: ' . $home_url);
        // echo "Successfully";
    }else{
         $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/Landing/login.html';
        header('Location: ' . $home_url);
        // echo "Unsuccessfull";
    }
}else{

// General instance for connecting to the database
function connectToDatabase(){
	$host = "localhost";
	$dbname = "megamony";
	$username = "root";
	$password = " ";
	$db= mysqli_connect($host,$username,$password,$dbname) or die("Couldn't connect to the database");
	returb $db; 	//return the database instance 
}


//General function to add users to the database
function createUser($fname,$username,$email,$phone_num,$confirm_password,$bank_name,$account_name,$account_no){
	$status = false // returns the status of the connection process
	$db_connection = connectToDatabase(); // connects to the database and returns the database connection instance to the variable

	//try to create a user by submitting the credentials from the form to the database already created
	$query = "INSERT INTO users_tbl (fname,email,phone_num,username,password,bank_name,bank_acct,bank_acct_name,user_type,status)
		 VALUES ('$fname','$username','$email','$phone_num','$confirm_password','$bank_name','$account_name','$account_no','')";
		 mysql_select_db('megamony');  					//selects megamony as the database to use
		 $result = mysql_query($query,$db_connection);  //connects to the database
	 if(!($result)){
	 	die("couldn't enter the user credentials Successfully <br/>").mysql_error();
	 }
	 echo 'User Created Successfully!!!';
	 $status = true;  
	 return $status;
}

?>