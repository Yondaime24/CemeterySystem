<?php  
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'cemetery_system');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// Admin

  define('DBINFO', 'mysql:host=localhost;dbname=cemetery_system');
    define('DBUSER','root');
    define('DBPASS','');

    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    function performQuery($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
// End admin

// call the register() function if register_btn is clicked
if (isset($_POST['registerBtn'])) {
	register();
}

// call the register() function if register_btn is clicked
if (isset($_POST['registerBtn2'])) {
	register2();
}


// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$fname = e($_POST['fname']);
	$mname = e($_POST['mname']);
	$lname = e($_POST['lname']);
	$age = e($_POST['age']);
	$birthday = e($_POST['birthday']);
	$gender = e($_POST['gender']);
	$residential_address = e($_POST['residential_address']);
	$email_address = e($_POST['email_address']);
	$contact_number = e($_POST['contact_number']);
	$password = e($_POST['password']);
	$username = e($_POST['username']);
	$confirm_password = e($_POST['confirm_password']);
	// $photo = e($_POST['photo']);

	move_uploaded_file($_FILES["photo"]["tmp_name"],"assets/images/" . $_FILES["photo"]["name"]);
    $photo=$_FILES["photo"]["name"];

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email_address)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $confirm_password) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (fname, mname, lname, age, birthday, gender, residential_address, email_address, contact_number, username, password, date_registered, photo, status, user_type)
				VALUES('$fname', '$mname', '$lname', '$age', '$birthday', '$gender', '$residential_address', '$email_address', '$contact_number', '$username', '$password', CURRENT_TIMESTAMP, '$photo', 'active', '$user_type')";
			mysqli_query($db, $query);

			// $_SESSION['success']  = "New user successfully created!!";
			// header('location: home.php');
			echo "<script>alert('Account Successfully Created')</script>";
        	echo "<script>window.open('index.php','_self')</script>";

		}else{
			$query = "INSERT INTO users (fname, mname, lname, age, birthday, gender, residential_address, email_address, contact_number, username, password, date_registered, photo, status, user_type)
				VALUES('$fname', '$mname', '$lname', '$age', '$birthday', '$gender', '$residential_address', '$email_address', '$contact_number', '$username', '$password', CURRENT_TIMESTAMP, '$photo', 'active', 'user')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Welcome";
			echo "<script>alert('Account Successfully Created')</script>";
        	echo "<script>window.open('index.php','_self')</script>";
			// header('location: index.php');				
		}
	}
}

// REGISTER USER
function register2(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$fname2 = e($_POST['fname2']);
	$mname2 = e($_POST['mname2']);
	$lname2 = e($_POST['lname2']);
	$age2 = e($_POST['age2']);
	$birthday2 = e($_POST['birthday2']);
	$gender2 = e($_POST['gender2']);
	$residential_address2 = e($_POST['residential_address2']);
	$email_address2 = e($_POST['email_address2']);
	$contact_number2 = e($_POST['contact_number2']);
	$password2 = e($_POST['password2']);
	$username2 = e($_POST['username2']);
	$confirm_password2 = e($_POST['confirm_password2']);
	// $photo = e($_POST['photo']);

	move_uploaded_file($_FILES["photo2"]["tmp_name"],"assets/images/" . $_FILES["photo2"]["name"]);
    $photo2=$_FILES["photo2"]["name"];

	// form validation: ensure that the form is correctly filled
	if (empty($username2)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email_address2)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password2)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password2 != $confirm_password2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password2 = md5($password2);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type2 = e($_POST['user_type']);
			$query = "INSERT INTO users (fname, mname, lname, age, birthday, gender, residential_address, email_address, contact_number, username, password, date_registered, photo, status, user_type)
				VALUES('$fname2', '$mname2', '$lname2', '$age2', '$birthday2', '$gender2', '$residential_address2', '$email_address2', '$contact_number2', '$username2', '$password2', CURRENT_TIMESTAMP, '$photo2', 'active', '$user_type2')";
			mysqli_query($db, $query);

			// $_SESSION['success']  = "New user successfully created!!";
			// header('location: home.php');
			echo "<script>alert('Account Successfully Created')</script>";
        	echo "<script>window.open('index.php','_self')</script>";

		}else{
			$query = "INSERT INTO users (fname, mname, lname, age, birthday, gender, residential_address, email_address, contact_number, username, password, date_registered, photo, status, user_type)
				VALUES('$fname2', '$mname2', '$lname2', '$age2', '$birthday2', '$gender2', '$residential_address2', '$email_address2', '$contact_number2', '$username2', '$password2', CURRENT_TIMESTAMP, '$photo2', 'active', 'user')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Welcome";
			echo "<script>alert('Account Successfully Created')</script>";
        	echo "<script>window.open('index.php','_self')</script>";
			// header('location: index.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE user_id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['loginBtn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/adminPanel.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Welcome";

				header('location: user/userHome.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function isUser()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'user' ) {
		return true;
	}else{
		return false;
	}
}

if (isset($_POST['addReservation'])) {
	reservation();
}

function reservation(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $loc_id = $_POST['loc_id'];
    $reserved_by = $_POST['reserved_by'];
    $residential_address = $_POST['residential_address'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $block = $_POST['block'];
    $number = $_POST['number'];
    $price = $_POST['price'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = $_POST['date_of_death'];
    $date_of_burial = $_POST['date_of_burial'];

		$query = "INSERT INTO reservations (`user_id`, `loc_id`, `reserved_by`, `residential_address`, `contact_number`, `email_address`, `block`, `number`, `price`, `fullname`, `age`, `gender`, `date_of_birth`, `date_of_death`, `date_of_burial`, `date_reserved`, `status`)VALUES('$user_id', '$loc_id', '$reserved_by', '$residential_address', '$contact_number', '$email_address', '$block', '$number', '$price', '$fullname', '$age', '$gender', '$date_of_birth', '$date_of_death', '$date_of_burial', CURRENT_TIMESTAMP, 'pending')";
		$query_run = mysqli_query($db, $query);

		if($query_run==1){
			 $block = $_POST['block'];
    		 $number = $_POST['number'];
    		 $loc_id = $_POST['loc_id'];

			$query="UPDATE `location` SET `block`='$block',`number`='$number',`status`='pending' WHERE loc_id='$loc_id'";
    		$query_run = mysqli_query($db, $query);

		}else{
			echo "Failed";
		}

		echo "<script>alert('Reservation has been added succesfully!')</script>";
        echo "<script>window.open('addReservation.php','_self')</script>";
		
}

if (isset($_POST['updateReservation'])) {
	reserveUpdate();
}

function reserveUpdate(){

	global $db, $errors, $username, $email;

	$reserve_id = $_POST['reserve_id'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = $_POST['date_of_death'];
    $date_of_burial = $_POST['date_of_burial'];

	$query="UPDATE `reservations` SET `fullname`='$fullname', `age`='$age', `gender`='$gender', `date_of_birth`='$date_of_birth', `date_of_death`='$date_of_death', `date_of_burial`='$date_of_burial' WHERE reserve_id='$reserve_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>window.open('myReservations.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('myReservations.php','_self')</script>";

     }
		
}

if (isset($_POST['sendMessage'])) {
	message();
}

function message(){

	global $db, $errors, $username, $email;

	$reserve_id = $_POST['reserve_id'];
    $user_id = $_POST['user_id'];
    $message_from = $_POST['message_from'];
    $date_of_burial = $_POST['date_of_burial'];
    $block = $_POST['block'];
    $number = $_POST['number'];
    $res_status = $_POST['res_status'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $message = $_POST['message'];

		$query = "INSERT INTO user_msg (`reserve_id`, `user_id`, `message_from`, `date_of_burial`, `block`, `number`, `res_status`, `contact_number`, `email_address`, `type`, `message`, `date_sent`, `status`)VALUES('$reserve_id', '$user_id', '$message_from', '$date_of_burial', '$block', '$number', '$res_status', '$contact_number', '$email_address', 'reservation_msg', '$message', CURRENT_TIMESTAMP, 'unread')";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('sendMessage.php?reserve_id=$reserve_id&&user_id=$user_id','_self')</script>";
		
}

if (isset($_POST['userMessage'])) {
	usermessage();
}

function usermessage(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $message = $_POST['message'];

		$query = "INSERT INTO user_msg (`reserve_id`, `user_id`, `message_from`, `date_of_burial`, `block`, `number`, `res_status`, `contact_number`, `email_address`, `type`, `message`, `date_sent`, `status`)VALUES('', '$user_id', '$name', '', '', '', '', '$contact_number', '$email_address', 'msg', '$message', CURRENT_TIMESTAMP, 'unread')";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('userMessage.php','_self')</script>";
		
}

if (isset($_POST['editProfile'])) {
	profileEdit();
}

function profileEdit(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
	$fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $residential_address = $_POST['residential_address'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];

	$query="UPDATE `users` SET `fname`='$fname', `mname`='$mname', `lname`='$lname', `age`='$age', `birthday`='$birthday', `gender`='$gender', `residential_address`='$residential_address', `email_address`='$email_address', `contact_number`='$contact_number' WHERE user_id='$user_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      session_destroy();
      session_unset();
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>alert('In order for this changes to take effect you need to login again')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('myProfile.php','_self')</script>";

     }
		
}

if (isset($_POST['updatePhoto'])) {
	photoEdit();
}

function photoEdit(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
	$photo = $_FILES["photo"]['name'];

	$query="UPDATE `users` SET `photo`='$photo' WHERE user_id='$user_id'";
    $query_run = mysqli_query($db, $query);


     if ($query_run) {
      session_destroy();
      session_unset();
      move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/images/".$_FILES["photo"]["name"]);  
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>alert('In order for this changes to take effect you need to login again')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('myProfile.php','_self')</script>";

     }
		
}

if (isset($_POST['updateUserPass'])) {
	userpassEdit();
}

function userpassEdit(){

	global $db, $errors, $username, $email;

	
	$user_id = $_POST['user_id'];
	$username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);

	$query="UPDATE `users` SET  `username`='$username', `password`='$password' WHERE user_id='$user_id'";
    $query_run = mysqli_query($db, $query);

     if ($query_run) {
      session_destroy();
      session_unset();  
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>alert('In order for this changes to take effect you need to login again')</script>";
      echo "<script>window.open('../index.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('userHome.php','_self')</script>";

     }
		
}

if (isset($_POST['adminReservationReply'])) {
	reservationReply();
}

function reservationReply(){

	global $db, $errors, $username, $email;

	$msg_id = $_POST['msg_id'];
	$user_id = $_POST['user_id'];
    $reserve_id = $_POST['reserve_id'];
    $admin_name = $_POST['admin_name'];
    $admin_cnum = $_POST['admin_cnum'];
    $admin_email = $_POST['admin_email'];
    $res_status = $_POST['res_status'];
    $message = $_POST['message'];

		$query = "INSERT INTO admin_message (`user_id`, `reserve_id`, `admin_name`, `admin_cnum`, `admin_email`, `res_status`, `message`, `type`, `status`, `date_sent`)VALUES('$user_id', '$reserve_id', '$admin_name', '$admin_cnum', '$admin_email', '$res_status', '$message', 'reservation_msg', 'unread', CURRENT_TIMESTAMP)";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('reservationMsg.php?msg_id=$msg_id','_self')</script>";
		
}

if (isset($_POST['adminMsgReply'])) {
	msgReply();
}

function msgReply(){

	global $db, $errors, $username, $email;

	$msg_id = $_POST['msg_id'];
	$user_id = $_POST['user_id'];
    $admin_name = $_POST['admin_name'];
    $admin_cnum = $_POST['admin_cnum'];
    $admin_email = $_POST['admin_email'];
    $message = $_POST['message'];

		$query = "INSERT INTO admin_message (`user_id`, `reserve_id`, `admin_name`, `admin_cnum`, `admin_email`, `res_status`, `message`, `type`, `status`, `date_sent`)VALUES('$user_id', '', '$admin_name', '$admin_cnum', '$admin_email', '', '$message', 'msg', 'unread', CURRENT_TIMESTAMP)";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('userMsg.php?msg_id=$msg_id','_self')</script>";
		
}

if (isset($_POST['replyreservationMessage'])) {
	replyReservation();
}

function replyReservation(){

	global $db, $errors, $username, $email;

	$adminmsg_id = $_POST['adminmsg_id'];
	$reserve_id = $_POST['reserve_id'];
    $user_id = $_POST['user_id'];
    $message_from = $_POST['message_from'];
    $date_of_burial = $_POST['date_of_burial'];
    $block = $_POST['block'];
    $number = $_POST['number'];
    $res_status = $_POST['res_status'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $message = $_POST['message'];

		$query = "INSERT INTO user_msg (`reserve_id`, `user_id`, `message_from`, `date_of_burial`, `block`, `number`, `res_status`, `contact_number`, `email_address`, `type`, `message`, `date_sent`, `status`)VALUES('$reserve_id', '$user_id', '$message_from', '$date_of_burial', '$block', '$number', '$res_status', '$contact_number', '$email_address', 'reservation_msg', '$message', CURRENT_TIMESTAMP, 'unread')";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('reservationMsg.php?adminmsg_id=$adminmsg_id&&reserve_id=$reserve_id','_self')</script>";
		
}

if (isset($_POST['userMsgReply'])) {
	userReply();
}

function userReply(){

	global $db, $errors, $username, $email;

	$adminmsg_id = $_POST['adminmsg_id'];
	$user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $message = $_POST['message'];

		$query = "INSERT INTO user_msg (`reserve_id`, `user_id`, `message_from`, `date_of_burial`, `block`, `number`, `res_status`, `contact_number`, `email_address`, `type`, `message`, `date_sent`, `status`)VALUES('', '$user_id', '$name', '', '', '', '', '$contact_number', '$email_address', 'msg', '$message', CURRENT_TIMESTAMP, 'unread')";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('adminMsg.php?adminmsg_id=$adminmsg_id','_self')</script>";
		
}

if (isset($_POST['sendUserMsg'])) {
	admintouser();
}

function admintouser(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $admin_name = $_POST['admin_name'];
    $admin_cnum = $_POST['admin_cnum'];
    $admin_email = $_POST['admin_email'];
    $message = $_POST['message'];

		$query = "INSERT INTO admin_message (`user_id`, `reserve_id`, `admin_name`, `admin_cnum`, `admin_email`, `res_status`, `message`, `type`, `status`, `date_sent`)VALUES('$user_id', '', '$admin_name', '$admin_cnum', '$admin_email', '', '$message', 'msg', 'unread', CURRENT_TIMESTAMP)";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('sendUserMessage.php?user_id=$user_id','_self')</script>";
		
}

if (isset($_POST['sendadminMsg'])) {
	admintoadmin();
}

function admintoadmin(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $message_from = $_POST['message_from'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $message = $_POST['message'];

		$query = "INSERT INTO user_msg (`reserve_id`, `user_id`, `message_from`, `date_of_burial`, `block`, `number`, `res_status`, `contact_number`, `email_address`, `type`, `message`, `date_sent`, `status`)VALUES('', '$user_id', '$message_from', '', '', '', '', '$contact_number', '$email_address', 'msg', '$message', CURRENT_TIMESTAMP, 'unread')";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        echo "<script>window.open('sendUserMessage.php?user_id=$user_id','_self')</script>";
		
}

if (isset($_POST['sendadminMsg2'])) {
	admintoadmin2();
}

function admintoadmin2(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
	$loc_id = $_POST['loc_id'];
    $admin_name = $_POST['admin_name'];
    $admin_cnum = $_POST['admin_cnum'];
    $admin_email = $_POST['admin_email'];
    $message = $_POST['message'];

		$query = "INSERT INTO admin_message (`user_id`, `reserve_id`, `admin_name`, `admin_cnum`, `admin_email`, `res_status`, `message`, `type`, `status`, `date_sent`)VALUES('$user_id', '', '$admin_name', '$admin_cnum', '$admin_email', '', '$message', 'msg', 'unread', CURRENT_TIMESTAMP)";
		$query_run = mysqli_query($db, $query);

		echo "<script>alert('Message has been sent succesfully!')</script>";
        // echo "<script>window.open('sendUserMessage2.php?user_id=$user_id&&loc_id=$loc_id','_self')</script>";
         echo "<script>window.open('adminPanel.php','_self')</script>";
		
}

if (isset($_POST['addUserReservation'])) {
	reservation2();
}

function reservation2(){

	global $db, $errors, $username, $email;

	$user_id = $_POST['user_id'];
    $loc_id = $_POST['loc_id'];
    $reserved_by = $_POST['reserved_by'];
    $residential_address = $_POST['residential_address'];
    $contact_number = $_POST['contact_number'];
    $email_address = $_POST['email_address'];
    $block = $_POST['block'];
    $number = $_POST['number'];
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = $_POST['date_of_death'];
    $date_of_burial = $_POST['date_of_burial'];

		$query = "INSERT INTO reservations (`user_id`, `loc_id`, `reserved_by`, `residential_address`, `contact_number`, `email_address`, `block`, `number`, `fullname`, `age`, `gender`, `date_of_birth`, `date_of_death`, `date_of_burial`, `date_reserved`, `status`)VALUES('$user_id', '$loc_id', '$reserved_by', '$residential_address', '$contact_number', '$email_address', '$block', '$number', '$fullname', '$age', '$gender', '$date_of_birth', '$date_of_death', '$date_of_burial', CURRENT_TIMESTAMP, 'pending')";
		$query_run = mysqli_query($db, $query);

		if($query_run==1){
			 $block = $_POST['block'];
    		 $number = $_POST['number'];
    		 $loc_id = $_POST['loc_id'];

			$query="UPDATE `location` SET `block`='$block',`number`='$number',`status`='pending' WHERE loc_id='$loc_id'";
    		$query_run = mysqli_query($db, $query);

		}else{
			echo "Failed";
		}

		echo "<script>alert('Reservation has been added succesfully!')</script>";
        echo "<script>window.open('viewUser.php','_self')</script>";
		
}

if (isset($_POST['addLocation'])) {
	locationAdd();
}

function locationAdd(){

	global $db, $errors, $username, $email;

	$block = $_POST['block'];
	$number = $_POST['number'];
	$price = $_POST['price'];

		$check = mysqli_query($db, "SELECT * FROM `location` WHERE `block`='$block' AND `number`='$number'");
		$checkrows=mysqli_num_rows($check);

		if ($checkrows>0) {
			echo "<script>alert('Cant insert new location. This location is already added!')</script>";
		}else{

			  $query = "INSERT INTO location (`block`, `number`, `price`, `status`)VALUES('$block', '$number', '$price', 'available')";
			  $query_run = mysqli_query($db, $query);

		      echo "<script>alert('New location has been added succesfully!')</script>";

		}
       
        // $sqlCheckNumber = "SELECT * FROM `location` WHERE `number` LIKE '$number' ";
        // $numberQuery = mysqli_query($db,$sqlCheckNumber);

        // $sqlCheckBlock = "SELECT * FROM `location` WHERE `block` LIKE '$block' ";
        // $blockQuery = mysqli_query($db,$sqlCheckBlock);

        // if(mysqli_num_rows($numberQuery)>0){

        // 	echo "<script>alert('Cant insert new location. This location is already added!')</script>";

        // }
        // else{

	  //       $query = "INSERT INTO location (`block`, `number`, `status`)VALUES('$block', '$number', 'available')";
			// $query_run = mysqli_query($db, $query);

   //      	echo "<script>alert('New location has been added succesfully!')</script>";

        // }
		
}

if (isset($_POST['occupiedButton'])) {
	occupyBtn();
}

function occupyBtn(){

	global $db, $errors, $username, $email;

	$reserve_id = $_GET['reserve_id'];
    $loc_id = $_GET['loc_id'];

	$user_id = $_POST['user_id'];
	$loc_id = $_POST['loc_id'];
	$reserve_id = $_POST['reserve_id'];
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_death = $_POST['date_of_death'];
    $block = $_POST['block'];
    $number = $_POST['number'];

		$query = "INSERT INTO deceased_details (`user_id`, `reserve_id`, `loc_id`, `full_name`, `age`, `gender`, `date_of_birth`, `date_of_death`, `date_buried`, `block`, `number`)VALUES('$user_id', '$reserve_id', '$loc_id', '$full_name', '$age', '$gender', '$date_of_birth', '$date_of_death', CURRENT_TIMESTAMP, '$block', '$number')";
		$query_run = mysqli_query($db, $query);


    $todayDate2 = new DateTime();
    $due_date = $todayDate2->format('Y-m-d H:i:s');

     $query1 ="UPDATE `location` SET `status` = 'occupied' WHERE `loc_id` = $loc_id;";
     performQuery($query1);

     $query2 ="UPDATE `reservations` SET `status` = 'occupied' WHERE `reserve_id` = $reserve_id;";
     performQuery($query2);

     $query3 ="UPDATE `reservations` SET `date_occupied` = '$due_date' WHERE `reserve_id` = $reserve_id;";
     performQuery($query3);

		echo "<script>alert('Location is now occupied!')</script>";
        echo "<script>window.open('viewLocDetails.php?loc_id=$loc_id','_self')</script>";
		
}

if (isset($_POST['updateDeceased'])) {
	deceasedUpdate();
}

function deceasedUpdate(){

	global $db, $errors, $username, $email;

	
	$deceased_id = $_POST['deceased_id'];
	$full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
	$date_of_birth = $_POST['date_of_birth'];
    $date_of_death = $_POST['date_of_death'];
    $date_buried = $_POST['date_buried'];

	$query="UPDATE `deceased_details` SET  `full_name`='$full_name', `age`='$age', `gender`='$gender', `date_of_birth`='$date_of_birth', `date_of_death`='$date_of_death', `date_buried`='$date_buried' WHERE deceased_id='$deceased_id'";
    $query_run = mysqli_query($db, $query);

     if ($query_run) {
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>window.open('deceasedGlosarry.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('deceasedGlosarry.php','_self')</script>";

     }
		
}


if (isset($_POST['updateLoc'])) {
	locupdate();
}

function locupdate(){

	global $db, $errors, $username, $email;

	$loc_id = $_POST['loc_id'];
	$block = $_POST['block'];
	$number = $_POST['number'];
    $price = $_POST['price'];

	$query="UPDATE `location` SET  `block`='$block', `number`='$number', `price`='$price' WHERE loc_id='$loc_id'";
    $query_run = mysqli_query($db, $query);

     if ($query_run) {
      echo "<script>alert('Update Success!!!')</script>";
      echo "<script>window.open('location.php','_self')</script>";
     }else{

      echo "<script>alert('Update Failed!')</script>";
      echo "<script>window.open('location.php','_self')</script>";

     }
		
}

?>