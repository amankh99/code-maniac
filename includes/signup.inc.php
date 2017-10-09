<?php
	if(isset($_POST["b_signup"])){
		include_once "dbh.inc.php";

		$name = mysqli_real_escape_string($conn, $_POST["name"]);
		$handle = mysqli_real_escape_string($conn, $_POST["handle"]);
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		$password = password_hash($password,PASSWORD_DEFAULT);

		$sql = "SELECT * FROM LOGINTRY WHERE HANDLE='$handle'";
		$result = mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck>0){
			header("Location: ../signup.php?signup=usertaken");
			exit();
		}
		if(!preg_match("/^[a-zA-Z]*$/", $name)){
			header("Location: ../signup.php?signup=invalid");
			exit();
		}
		// else{
		// 	if(!filter_var($email,FILTER_VALID_EMAIL)){
		// 		header("Location: ../signup.php?signup=email");
		// 	exit();
		// 	}
		// }
		$sql = "INSERT INTO LOGINTRY VALUES('$handle','$password','$name')";
		mysqli_query($conn,$sql);
		header("Location: ../signup.php?signup=success");
		exit();
	}
	else{
		header("Location: ../signup.php");
		exit();
	}
?>