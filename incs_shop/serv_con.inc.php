<?php
	//move to outside of the root folder
	//variables
	define("Host","us-cdbr-east-06.cleardb.net");	//  localhost
	define("User","bd4351311c725a");	//  root
	define("Password","f93bb13f"); //
	define("Db_Name","heroku_0074a896f4937ca");	//  myshoptwo
	define("Conn_error","could not connect to server at this time"); // all of the rest below may be defined later
	define("db_conn_error","<div id='oops'>
							<h1 id='oops_h1'>Oops!!!</h1>
							<h1>We are sorry</h1>
							<h3>Data could not be fetched at this time</h3>
							</div>
							");
	
	//connecting to server
	$connect=mysqli_connect(Host,User,Password,Db_Name);
	
	/* check connection */
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$data_select=mysqli_select_db($connect,Db_Name) or die(db_conn_error);		//maximum execution time exceeded on this line
	
	function escape_data($data){
	
	global $connect;
	
	// if (get_magic_quotes_gpc())$data = stripslashes($data);
	// return mysqli_real_escape_string (trim ($connect, $data));
	
	
	 }
	
	
	
	function get_password_hash($password) {
     global $connect;
      //return mysqli_real_escape_string ($connect,hash_hmac('sha256',  $password, 'c#haRl891', true));
	   return mysqli_real_escape_string ($connect,md5($password));
	 
	}
	
	
	?>