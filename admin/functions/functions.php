<?php  


session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'cemetery_system');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['adminAddUser'])) {
	addUser();
}

// REGISTER USER
function addUser(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
    $user_type = e($_POST['user_type']);
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

	move_uploaded_file($_FILES["photo"]["tmp_name"],"../assets/images/" . $_FILES["photo"]["name"]);
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
        	echo "<script>window.open('adminPanel.php','_self')</script>";

		}else{
			$query = "INSERT INTO users (fname, mname, lname, age, birthday, gender, residential_address, email_address, contact_number, username, password, date_registered, photo, status, user_type)
				VALUES('$fname', '$mname', '$lname', '$age', '$birthday', '$gender', '$residential_address', '$email_address', '$contact_number', '$username', '$password', CURRENT_TIMESTAMP, '$photo', 'active', '$user_type')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Welcome";
			echo "<script>alert('Account Successfully Created')</script>";
        	echo "<script>window.open('adminPanel.php','_self')</script>";
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



?>