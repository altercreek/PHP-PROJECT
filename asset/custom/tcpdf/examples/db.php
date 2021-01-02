<?php
   /***************************************************     
	****	Database Configuration file
	****	Decent Pharmacutical Ltd.
    ***************************************************/    	
	
	/**/
	$server = "localhost";
	$user = "root";
	$pass = "";
	/**/
	
	/*
	$server = "202.51.191.67";
	$user    = "himel";
	$pass   = "himel123";
	*/
	//$db       = "school_mod";
	$db       = "school_v5";
	
	$con = mysql_connect($server,$user,$pass);
	mysql_select_db($db,$con);
	function check_permission($group_id,$menu_id,$permission_type){
		$qry1=mysql_query("SELECT * FROM user_menu_permission WHERE menu_id='$menu_id' AND group_id='$group_id' AND $permission_type='Y' AND active_flag='1'");
		if(mysql_num_rows($qry1)>0){
			$v=1;
		}
		else{
			$v=0;
		}
		return $v;
		
		
	}
	//if($con) echo  "database connected"; else echo "database not connected";
?>