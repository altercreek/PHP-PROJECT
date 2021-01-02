<?php
//session_start();
// ============ this file shows data in form for user to update
//include("../../asset/theme/css/myfunc.php");
include("my_class.php");
$obj=new my_class();
//$branch_id=$_SESSION['LOGIN_BRANCH'];
$selected_id_to_edit=addslashes(trim($_GET['_id']));
//echo $selected_id_to_edit;

$table_name="stock_market_data";
$where_cond="id=".$selected_id_to_edit;
$selected_row_to_edit = $obj->Details_By_Cond($table_name,$where_cond);
extract($selected_row_to_edit);
?>
<div class="row-fluid"  style="background-color:#f5f5f5;-webkit-box-shadow: 0 8px 6px -6px black; -moz-box-shadow: 0 8px 6px -6px black; box-shadow: 0 8px 6px -6px black;">
<form class="form-horizontal" >
	<input type="hidden" id="branchid" name="branchid" value="<?php echo $_SESSION['LOGIN_BRANCH'];?>"/>
	<input type="hidden" id="selected_id_to_edit" name="selectedidtoedit" value="<?php echo $selected_id_to_edit;?>"/>							
	<!--PAGE CONTENT BEGINS-->					
	<!--<div class="row-fluid">-->
	<div class="row-fluid">
		<div class="span3">
			<div class="control-group">
				<label class="control-label" for="form-field-1">Date<font color="#FF0000">*</font></label>
				<div class="controls">
					<input style=" height:30px;" type="date" name="edit_date_nm" id="edit_date_id" value="<?php echo $selected_row_to_edit['date']; ?>">
				</div>
			</div>
											
		</div>

	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">Trade Code<font color="#FF0000">*</font></label>
					<div class="controls">
					  <input type="text" name="edit_trade_code_name" id="edit_trade_code_id" value="<?php echo $selected_row_to_edit['trade_code'];?>">
					</div>
				</div>
												
		</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;High <font color="#FF0000">*</font></label>
						<div class="controls">	
							<input type="text" name="edit_high_nm" id="edit_high_id" value="<?php echo $selected_row_to_edit['high'];?>">
						</div>
				</div>
			</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Low <font color="#FF0000">*</font></label>
					<div class="controls">	
						<input type="text" name="edit_low_nm" id="edit_low_id" value="<?php echo $selected_row_to_edit['low'];?>">
					</div>
				</div>
			</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Open<font color="#FF0000">*</font></label>
					<div class="controls">	
						<input type="text" name="edit_op_nm" id="edit_op_id" value="<?php echo $selected_row_to_edit['open'];?>">
					</div>
				</div>
			</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Close <font color="#FF0000">*</font></label>
					<div class="controls">	
						<input type="text" name="edit_cl_nm" id="edit_cl_id" value="<?php echo $selected_row_to_edit['close'];?>">
					</div>
				</div>
			</div>
	</div>
	<div class="row-fluid">
		<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Volume<font color="#FF0000">*</font></label>
					<div class="controls">	
						<input type="text" name="edit_vl_nm" id="edit_vl_id" value="<?php echo $selected_row_to_edit['volume'];?>">
					</div>
				</div>
		</div>
	</div>
	
</form>
</div>
