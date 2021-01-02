<?php
//session_start();
// ============
include("my_class.php");
$obj=new my_class();
//$br_id = $_SESSION['LOGIN_BRANCH'];

$operation=addslashes(trim($_POST['operation']));


if ($operation == 'delete_stk_info') {
		$id=$_POST['_id'];
		$dataTable = 'stock_market_data';
		$where_cond = 'stock_market_data.id = "'.$id.'"';

		$sql = $obj->Delete_Data($dataTable,$where_cond);

		if($sql!=NULL){
			echo "Selected row deleted";
		}

}


	if ($operation == 'edit_stk_info') {
	$edit_vl_id=addslashes(trim($_POST['edit_vl_id']));
	$edit_cl_id=addslashes(trim($_POST['edit_cl_id']));
	$selected_id_to_edit = addslashes(trim($_POST['selected_id_to_edit']));
	
	$edit_low_id=addslashes(trim($_POST['edit_low_id']));
	$edit_high_id=addslashes(trim($_POST['edit_high_id']));
	$edit_trade_code_id=addslashes(trim($_POST['edit_trade_code_id']));
	$edit_op_id=addslashes(trim($_POST['edit_op_id']));
	$edit_date_id=addslashes(trim($_POST['edit_date_id']));
	

	$dataTable = "stock_market_data";
	
	$values = array('volume'=> $edit_vl_id,
			
				'close'=>$edit_cl_id,
				'low'=>$edit_low_id,
				'high'=>$edit_high_id,
				'trade_code'=>$edit_trade_code_id,
				'open'=>$edit_op_id,
				'date'=> $edit_date_id);
		
			$where_clause="id='".$selected_id_to_edit."'";
			$updateEntry=$obj->Update_Data($dataTable, $values, $where_clause);

	        
             if($updateEntry!=NULL){
				echo "Sucessfully updated";
			}
			else{
				echo "Error occured during updating information..!";
			}
}
	
	if ($operation == 'insert_stk_info') {
	$date=addslashes(trim($_POST['date']));
	$trade_code_id=addslashes(trim($_POST['trade_code_id']));
	$high_id=addslashes(trim($_POST['high_id']));
	$low_id=addslashes(trim($_POST['low_id']));
	$open_id=addslashes(trim($_POST['open_id']));
	$close_id=addslashes(trim($_POST['close_id']));
	$vol_id=addslashes(trim($_POST['vol_id']));
	
	//$date = date('Y-m-d-h-i-s');

	$dataTable = "stock_market_data";

	$values = array('date'=> $date,
			
					'trade_code'=> $trade_code_id,
					'high'=>$high_id,
					'low'=> $low_id,
					'open'=> $open_id,
					'close'=> $close_id,
					'volume'=> $vol_id);

	$sql = $obj-> Insert_Data($dataTable,$values);
				
			//echo $sql;

			if ($sql=='') {
				echo "Something went wrong, data doesn't inserted.";
			}
			else{
				echo "Data successfully inserted.";
			}
}
?>