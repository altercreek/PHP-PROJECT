<?php
//session_start();
date_default_timezone_set("Asia/Dacca");



class my_class{

//================ Start DB Connection 1 ==================== 


	private $host_add1="localhost";
	private $db_name1="janata_wifi";
	private $user_name1="root";    
	private $password1="";
		
		


	//require_once "php_crud/test.php";
	// ==========================

	public function __construct(){
		//require_once "php_crud/test.php";


		
		$this->con1 = new PDO("mysql:host=".$this->host_add1.";dbname=".$this->db_name1,$this->user_name1,$this->password1);

		//$this->con2 = new PDO("mysql:host=".$this->host_add2.";dbname=".$this->db_name2,$this->user_name2,$this->password2);  
		
		//require_once "php_crud/test.php";
	} 
	  
	//================== End DB Connection 1 ======================




	public function Insert_Data($table_name, $form_data) {
	$fields = array_keys($form_data);

	$sql = "INSERT INTO ".$table_name."
	(`".implode('`,`', $fields)."`)
	VALUES('".implode("','", $form_data)."')";
	$q = $this->con1->prepare($sql);
	$q->execute() or die(print_r($q->errorInfo()));

	return $this->con1->lastInsertId();
	//return $sql;
	}
	// ========================


	public function Insert_Data_By_Cond($table_name, $form_data,$where_cond) {
		$fields = array_keys($form_data);

		$sql_select = "SELECT * FROM ".$table_name." WHERE $where_cond";
		$ch_data = $this->con1->prepare($sql_select);
		$ch_data->execute(array());
		$total = $ch_data->rowCount();

		if($total=='0'){
		$sql = "INSERT INTO ".$table_name."
		(`".implode('`,`', $fields)."`)
		VALUES('".implode("','", $form_data)."')";
		$q = $this->con1->prepare($sql);
		$q->execute() or die(print_r($q->errorInfo()));

		return $this->con1->lastInsertId();
		
		
		}
	}

	// ======================


	// View All Data Function
	public function View_All($table_name) {
		$data = array();
		$sql = "SELECT * FROM $table_name";
		$q = $this->con1->prepare($sql);
		$q->execute() or die(print_r($q->errorInfo()));
		
		while ($row = $q->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return isset($data)? $data :NULL;    
	}
	// ========================


	// View All Data Condition wise Function
	public function View_All_By_Cond($table_name,$where_cond) {
		$data = array();
		$sql = "SELECT * FROM $table_name WHERE $where_cond";
		$q = $this->con1->prepare($sql);
		$q->execute() or die(print_r($q->errorInfo()));
		//return $sql;
		while ($row = $q->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return isset($data)? $data :NULL;    
	}
	// ========================

	// View All Data Condition wise Function
	public function View_colmn_By_Cond($table_name,$columns,$where_cond) {
		$data = array();
		$sql = "SELECT $columns FROM $table_name WHERE $where_cond";
		$q = $this->con1->prepare($sql);
		$q->execute() or die(print_r($q->errorInfo()));
		
		while ($row = $q->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return isset($data)? $data :NULL;    
	}
	// ========================

	 // Details Data View Function
	public function Details_Data($table_name){

	 $sql="SELECT * FROM $table_name";
	 $q = $this->con1->prepare($sql);
	 $q->execute() or die(print_r($q->errorInfo()));
	 $data = $q->fetch(PDO::FETCH_ASSOC);
	 return isset($data)? $data :NULL;
	 }
	// ========================


	// Details Data View Condition Wise Function
	public function Details_By_Cond($table_name,$where_cond){

	 $sql="SELECT * FROM $table_name WHERE $where_cond";
	 $q = $this->con1->prepare($sql);
	 $q->execute() or die(print_r($q->errorInfo()));
	 $data = $q->fetch(PDO::FETCH_ASSOC);
	 return isset($data)? $data :NULL;
	 }
	// ========================

	// Details Data View Condition Wise Function
	public function View_column_details_By_Cond($table_name,$column,$where_cond){
	 $sql="SELECT $column FROM $table_name WHERE $where_cond";
	 $q = $this->con1->prepare($sql);
	 $q->execute() or die(print_r($q->errorInfo()));
	 $data = $q->fetch(PDO::FETCH_ASSOC);
	 return isset($data)? $data :NULL;
	 }
	// ========================

	//// View selected columns Condition wise Function (multiple data row)

	public function View_all_data_row_column_By_Cond($table_name,$column,$where_cond) {
		$data = array();
		$sql = "SELECT $column FROM $table_name WHERE $where_cond";
		$q = $this->con1->prepare($sql);
		   $q->execute() or die(print_r($q->errorInfo()));
		
		while ($row = $q->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return isset($data)? $data :NULL;    
			
	}
	// ========================

	// Data Update Function

	function Update_Data($table_name, $form_data, $where_clause='') {

		$whereSQL = '';
		if(!empty($where_clause))
		{
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				$whereSQL = " WHERE ".$where_clause;
			}
			else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}

		$sql = "UPDATE ".$table_name." SET ";
		$sets = array();
		foreach($form_data as $column => $value)
		{
			 $sets[] = "`".$column."` = '".$value."'";
		}
		$sql .= implode(', ', $sets);
		$sql .= $whereSQL;
	   //echo $sql;
		$q = $this->con1->prepare($sql);
	 
	 return $q->execute() or die(print_r($q->errorInfo()));
	// return $sql;

	}
	// =============================================



	// Data Update By Check Duplicate Function
	function Update_Data_By_Check_Duplicate($table_name, $form_data, $where_clause='',$check_cond_data) {

		$sql_select = "SELECT * FROM ".$table_name." WHERE $check_cond_data";
		$ch_data = $this->con1->prepare($sql_select);
		$ch_data->execute(array());
		$total = $ch_data->rowCount();

		if($total=='0'){

			$whereSQL = '';
			if(!empty($where_clause))
			{
				if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
				{
					$whereSQL = " WHERE ".$where_clause;
				}
				else
				{
					$whereSQL = " ".trim($where_clause);
				}
			}

			$sql = "UPDATE ".$table_name." SET ";
			$sets = array();
			foreach($form_data as $column => $value)
			{
				 $sets[] = "`".$column."` = '".$value."'";
			}
			$sql .= implode(', ', $sets);
			$sql .= $whereSQL;
			$q = $this->con1->prepare($sql);
		 
			return $q->execute() or die(print_r($q->errorInfo()));

		}

	}

	// ========================


	//for updating with existing column value
	function Update_Data2($table_name, $form_data, $where_clause='') {

		$whereSQL = '';
		if(!empty($where_clause))
		{
			if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
			{
				$whereSQL = " WHERE ".$where_clause;
			}
			else
			{
				$whereSQL = " ".trim($where_clause);
			}
		}

		$sql = "UPDATE ".$table_name." SET ".$form_data." ";
	   /*  $sets = array();
		foreach($form_data as $column => $value)
		{
			 $sets[] = "`".$column."` = '".$value."'";
		}
		$sql .= implode(', ', $sets); */
		$sql .= $whereSQL;
		$q = $this->con1->prepare($sql);
	 
	 return $q->execute() or die(print_r($q->errorInfo()));

	}
	// =========================

	// Delete Data Function
	function Delete_Data($table_name,$where_cond) {    
		$sql = "delete FROM $table_name WHERE $where_cond";
		$q = $this->con1->prepare($sql);
		$data = $q->execute() or die(print_r($q->errorInfo()));
	   
		return isset($data)? $data :NULL; 
		//return $sql;   
	}
	// ========================



	//Max Value Detect Function
	public function Max_Value($table_name,$column) {
		 $sql="SELECT MAX($column) AS max_value FROM $table_name";
		 $q = $this->con1->prepare($sql);
		 $q->execute() or die(print_r($q->errorInfo()));
		 $data = $q->fetch(PDO::FETCH_ASSOC);
		 return isset($data)? $data :NULL;
	}
	// ========================



	//Max Value Detect by condition Function
	public function Max_Value_By_Cond($table_name,$column,$where_cond) {
		 $sql="SELECT MAX($column) AS max_valu FROM $table_name WHERE $where_cond";
		 $q = $this->con1->prepare($sql);
		 $q->execute() or die(print_r($q->errorInfo()));
		 $data = $q->fetch(PDO::FETCH_ASSOC);
		 return isset($data)? $data :NULL;
	}
	// ========================



	//Row Count Function
	public function Total_Count($table_name) {
	  $sql="SELECT COUNT(*) AS total FROM $table_name";
	  $q = $this->con1->prepare($sql);
	  $q->execute() or die(print_r($q->errorInfo()));
	  $row = $q->fetch(PDO::FETCH_ASSOC);
	  $total = $row['total'];

	  return isset($total)? $total :NULL;
	}
	// ========================



	//Row Count By Condition Function
	public function Total_Count_By_Cond($table_name,$where_cond) {
		$sql="SELECT COUNT(*) AS total FROM $table_name WHERE $where_cond";
	  $q = $this->con1->prepare($sql);
	  $q->execute() or die(print_r($q->errorInfo()));
	  $row = $q->fetch(PDO::FETCH_ASSOC);
	  $total = $row['total'];

	  return isset($total)? $total :NULL;
	}
}