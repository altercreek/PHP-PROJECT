<?php
session_start();
// ============
//include("../../php_crud/my_class.php");
//$obj=new my_class();
//$br_id = $_SESSION['LOGIN_BRANCH'];
// ============

?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>
	My Demo Work	</title>

	<link rel="icon" href="assets/img/favicon.ico" type="image/png" />

		
		<link href="asset/theme/css/bootstrap.min.css" rel="stylesheet" />

		<!-- <link href="asset/theme/css/my_custom.css" rel="stylesheet" />-->
		<link href="asset/theme/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="asset/theme/css/font-awesome.min.css" />

		
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="asset/theme/css/ace.min.css" />
		
		<link rel="stylesheet" href="asset/theme/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="asset/theme/css/ace-skins.min.css" />
		


		<link rel="stylesheet" href="asset/theme/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="asset/theme/css/chosen.css" />
		<link rel="stylesheet" href="asset/theme/css/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="asset/theme/css/datepicker.css" />
		<link rel="stylesheet" href="asset/theme/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="asset/theme/css/daterangepicker.css" />
		<link rel="stylesheet" href="asset/theme/css/colorpicker.css" />
        <link href="asset/theme/css/my_custom.css" rel="stylesheet" />
        <link href="asset/theme/css/combogrid.css" rel="stylesheet" />
		<script src="asset/theme/js/jquery-2.1.3.js"></script>	
		<script src="asset/theme/js/jquery.dataTables.min.js"></script>
		<script src="asset/theme/js/jquery.dataTables.bootstrap.js"></script>			
        <script src="asset/theme/js/bootstrap-multiselect.js"></script>
		
		
		<script src="asset/theme/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--ace scripts-->

		<script src="asset/theme/js/ace-elements.min.js"></script>
		<script src="asset/theme/js/ace.min.js"></script>
		<script src="asset/theme/js/common.js"></script>
		
		<script src="asset/theme/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="asset/theme/js/jquery.ui.touch-punch.min.js"></script>
		<script src="asset/theme/js/chosen.jquery.min.js"></script>
		<script src="asset/theme/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="asset/theme/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="asset/theme/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="asset/theme/js/date-time/moment.min.js"></script>
		<script src="asset/theme/js/date-time/daterangepicker.min.js"></script>
		<script src="asset/theme/js/bootstrap-colorpicker.min.js"></script>
		<script src="asset/theme/js/jquery.knob.min.js"></script>
		<script src="asset/theme/js/jquery.autosize-min.js"></script>
		<script src="asset/theme/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="asset/theme/js/jquery.maskedinput.min.js"></script>
		<script src="asset/theme/js/bootstrap-tag.min.js"></script>
		<script src="asset/theme/js/jquery.easyui.min.js"></script>
<script type="text/javascript">
	
$(document).ready(function(){

	
	var folder= 'webportal';	
	var a= "module/"+folder+"/module_deshboard.php";
	//alert(a);
	$("#main_content_div").load(a);	
	
	
	$('.acls').click(function(){
		$('li').removeClass('active');
		$(this).parent().addClass('active');
		$(this).parent().parent().parent().addClass('active');
		var id=$(this).attr('id');
		$("#menu_id1").val(id);		
		var url =$(this).attr('name');
		var mod_id =$(this).attr('mod_id');
		var a= "module/" + url;
		menustr = "menu_id="+id;
		$.ajax({
				type:"post",
				url:"include/set_menu_to_session.php",data:menustr ,success:function(st){
					 //alert(st);
					
				}
			});

		//alert(a);
		datastr = "mod_id="+mod_id;
		   $("#main_content_div").load(a,datastr,function(){}).hide().fadeIn(700);
		 //   $("#main_content_div").load(a,datastr,function(){}).hide().fadeIn(900);
		/*    $("#main_content_div").load(a,datastr, function(){
				$('#main_content_div').fadeIn(5000);
			}); */
		   
		   var person = {content:id}; 
		   $("#header_links").load("include/header_links.php",person);
		
	});
	
}); 
</script>

    <script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable( {
				"sPaginationType": "full_numbers"
			} );
		} );
	</script>
		

<style>
		ul.submenu{z-index:9}
		/*.nav-list > li.active::after {
			border-right: 2px solid #A5A4A4;
		}
		.nav-list li.active > a::after {
			border-color: transparent #A5A4A4 transparent transparent;
			}*/

		a{
			text-decoration: none!important;
		}

		#back{
			height: 40px;
			float: right;
		}
</style>
   
</head>
<style type="text/css">
i{
	cursor:pointer;
}
</style>
<!--<script src="web_content_management.js" type="text/javascript"></script>-->
<div class="row-fluid" style="background-color:#f5f5f0;-webkit-box-shadow: 0 8px 6px -6px black; -moz-box-shadow: 0 8px 6px -6px black; box-shadow: 0 8px 6px -6px black; ">

<div class="row-fluid" id="first_part">
	<form class="form-vertical" id="asd">
	<input type="hidden" id="web_notice_board_content" name="webNoticeBoardContent" value="<?php echo $institute_id;?>"/>
		<legend>
			<div class="widget-header header-color-purple">
				<h4 class="lighter smaller" style="font-weight:bold;">Stock Market</h4>
			</div>
		</legend>
		<!--PAGE CONTENT BEGINS-->
		<div class="row-fluid" id="input_field">
			<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Date <font color="#FF0000">*</font></label>
					<input style=" height:30px;" type="date"   name="date_nm" id="date_id">
				</div>
			</div>
			
			<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Trade Code <font color="#FF0000">*</font></label>
					<input type="text" name="trade_code_name" id="trade_code_id">
				</div>
			</div>
			<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;High <font color="#FF0000">*</font></label>
					<input type="text" name="high_nm" id="high_id">
				</div>
			</div>
			
			<div class="span3">
				<div class="control-group">
					<label class="control-label" for="form-field-1">&nbsp;&nbsp;Low <font color="#FF0000">*</font></label>
					<input type="text" name="low_nm" id="low_id">
				</div>
			</div>
			
		</div>
		<div class="row-fluid" id="input_field">
				<div class="span3">
					<div class="control-group">
						<label class="control-label" for="form-field-1">&nbsp;&nbsp;Open <font color="#FF0000">*</font></label>
						<input type="text" name="open_nm" id="open_id">
					</div>
				</div>
				<div class="span3">
					<div class="control-group">
						<label class="control-label" for="form-field-1">&nbsp;&nbsp;Close <font color="#FF0000">*</font></label>
						<input type="text" name="close_nm" id="close_id">
					</div>
				</div>
				<div class="span3">
					<div class="control-group">
						<label class="control-label" for="form-field-1">&nbsp;&nbsp;Volume <font color="#FF0000">*</font></label>
						<input type="text" name="vol_nm" id="vol_id">
					</div>
				</div>
				<div class="span3">
					<div class="control-group">
						<label class="control-label" for="form-field-1">&nbsp;</label>
						<div class="controls">
							<button class="btn btn-small btn-success" type="button" id="add_file">
								<i class="icon-ok bigger-100"></i>
								 Add
							</button>
						</div>
					</div>
				</div>
		
		</div>
	</form>
	</div>

</div>

</br>
<div class="row-fluid" style="margin-bottom: 10px;">
	<button type='button' class="btn btn-mini btn-warning prbtn" style="float:right;" class='btn btn-primary btn-mini'
		onclick='show_line_chart()'> Line Chart<i class="icon-signal  bigger-125 icon-on-right"></i></button>
   

</div>
<div class="row-fluid" id="stock_mrk_info_list">
</div>

<div id="modal-web-class-routine" class="modal hide fade  " style="overflow-x:show" tabindex="-1">
										<div class="modal-header no-padding">
											<div class="table-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												Edit Stock market info
											</div>
										</div>
										<div class="modal-body" id="edit_stk_info">

										</div>
										
										<div class="modal-footer">
											<button class="btn btn-small btn-success pull-left" type="button" id="update_stck_info" data-dismiss="modal" onclick="perform_update_stk()">
												<i class="icon-ok bigger-100"></i>
												Update
											</button>
											<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
												<i class="icon-remove"></i>
												Cancel
											</button>
										</div>
									
</div>

<script>

$(document).ready(function(){
	
	load_stk_info();
		
});
function show_line_chart(){
	
	window.open("line_chart.php");
}
$('#add_file').click(function(){
	
	//alert('hello from add file');
	var operation = 'insert_stk_info';
	var date = $('#date_id').val();
	var trade_code_id = $('#trade_code_id').val();
    var high_id = $('#high_id').val();
	var low_id = $("#low_id").val();
	var open_id = $("#open_id").val();
	var close_id = $("#close_id").val();
	var vol_id = $("#vol_id").val();
	//alert(file_path);
	

	var dataStr = "date="+date+"&trade_code_id="+trade_code_id+
					"&high_id="+high_id+"&low_id="+low_id+"&open_id="+open_id+"&close_id="+close_id+
					"&vol_id="+vol_id+"&operation="+operation;
		
	//alert (dataStr);
	if (date== "") {
        alert("Select a date");
        $('#date_id').focus();
        return false;
    }
    else if (trade_code_id == "") {
        alert("trade code cannot be empty");
        $('#trade_code_id').focus();
        return false;
    }
    else if (high_id  == "") {
        alert("High field cannot be empty");
        $('#high_id').focus();
        return false;
    }
    else if (low_id == "") {
        alert("low field cannot be empty");
        $('#low_id').focus();
        return false;
    }
	 else if (open_id == "") {
        alert("Open field cannot be empty");
        $('#open_id').focus();
        return false;
    }
	else if (vol_id == "") {
        alert("Volume field cannot be empty");
        $('#vol_id').focus();
        return false;
    }
	else{

	$.ajax({
					url: 'stk_market_ajax.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						 load_stk_info();
						
					}

		});
	}
	clearInput();

});
function load_stk_info(){
	
	$("#stock_mrk_info_list").load("web_class_routine_datatable.php");
}
function delete_stk_info(id){
	
	var operation = 'delete_stk_info';
	var datastr="_id="+id+"&operation="+operation;
	 if (confirm("Are you sure want to delete class routine?"))
	  {
		 $.ajax({
				type:"post",
				url:"stk_market_ajax.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_stk_info();
				
				}
				
			}); 		
	  }	
}
function edit_stk_info(id){
	var datastr="_id="+id;
	
	$("#edit_stk_info").load("edit_stk_info.php",datastr);
}
function perform_update_stk(){
	var operation='edit_stk_info';
	var edit_date_id = $("#edit_date_id").val();
	var edit_trade_code_id = $("#edit_trade_code_id").val();
	var edit_high_id = $("#edit_high_id").val();
	var edit_low_id = $("#edit_low_id").val();
	var edit_op_id = $("#edit_op_id").val();
	var edit_cl_id = $("#edit_cl_id").val();
	var edit_vl_id = $("#edit_vl_id").val();
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	
	
	if (edit_date_id == "") {
        alert("Date field cannot be empty");
        $('#edit_date_id').focus();
        return false;
    }
    else if (edit_trade_code_id == "") {
        alert("Trade code code cannot be empty");
        $('#edit_trade_code_id').focus();
        return false;
		
    }else if (edit_high_id == "") {
        alert("High field cannot be empty");
        $('#edit_high_id').focus();
        return false;
    }else if (edit_low_id == "") {
        alert("Low field cannot be empty");
        $('#edit_low_id').focus();
        return false;
		
    }else if (edit_op_id == "") {
        alert("Open field cannot be empty");
        $('#edit_op_id').focus();
        return false;
		
    }else if (edit_cl_id == "") {
        alert("Close field cannot be empty");
        $('#edit_cl_id').focus();
        return false;
		
    }else if (edit_vl_id == "") {
        alert("Volume field cannot be empty");
        $('#edit_vl_id').focus();
        return false;

    }
		else{
			var dataStr="edit_vl_id="+edit_vl_id+"&selected_id_to_edit="+selected_id_to_edit+"&edit_cl_id="+edit_cl_id+"&edit_op_id="+edit_op_id+"&edit_low_id="+edit_low_id+"&edit_high_id="+edit_high_id+"&edit_trade_code_id="+edit_trade_code_id+"&operation="+operation+"&edit_date_id="+edit_date_id;

			//alert(dataStr);

			$.ajax({
				type:"post",
				url:"stk_market_ajax.php",
				data:dataStr ,
				success:function(st){
						alert(st);
						load_stk_info();
						//edit_web_banner_to_show();
				}
			}); 
		}
	
	//alert('hello');
}
</script>