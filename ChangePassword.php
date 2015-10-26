<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "Beam1994", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>

Change Pass form
<hr>

<?PHP
	if(isset($_POST['submit'])){
		//$username = $_SESSION['USERNAME'];
		$oldpass = trim($_POST['oldpass']);
		$newpass = trim($_POST['newpass']);
		$confpass = trim($_POST['confpass']);
		
		if($newpass == $confpass && $newpass != Null && $oldpass == $_SESSION['PASSWORD']){
			$query = "UPDATE AA_LOGIN SET PASSWORD = '$newpass' WHERE username = '".$_SESSION['USERNAME']."' and password = '$oldpass'";
			$_SESSION['PASSWORD'] = $newpass;
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
			echo "Success";
		}else{
			echo "Password error";
		}
	};
	oci_close($conn);
?>

<form action='ChangePassword.php' method='post'>
	Old password <br>
	<input name='oldpass' type='password'><br>
	New Password<br>
	<input name='newpass' type='password'><br><br>
	Confirm Password<br>
	<input name='confpass' type='password'><br><br>
	
	<input name='submit' type='submit' value='confirm'>
	
</form>