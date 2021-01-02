$(document).ready(function(){
	//alert('hello');
	load_notice_board_to_show();
	load_image_gallery_to_show();
	load_latest_news_to_show();
	load_web_event_to_show();
	load_class_routine_to_show();
		
});
function load_events(){
	load_web_event_to_show();
	document.getElementById("banner_list").style.display = "none";
	document.getElementById("event_list").style.display = "block";
}

function load_banners(){
	load_web_banner_to_show();
	document.getElementById("event_list").style.display = "none";
	document.getElementById("banner_list").style.display = "block";
}
$("#file_pdf").change(function(){

		var file_data = $('#file_pdf').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var file_path = "../../asset/custom/upload/web/file/";
		fd.append('path', file_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					file_path = file_path + php_script_response;
					$("#file_pdf").val(file_path);
					//alert(php_script_response);
			 
				}

		}); 
});
$('#add_notice').click(function(){
	
	var operation = 'insert_notice';
	var notice_title = $('#notice_title').val();
	var notice_content = $('#notice_content').val();
	var notice_status = $('#notice_status').val();
	var publish_date = $('#publish_date').val();
	var expire_date = $('#expire_date').val();
	var file_notice = $("#file_pdf").val();
	//alert(file_path);
 		var file_path_arr = file_notice.split("\\");
		var file_namer = file_path_arr[2];

		if (notice_title== "") {
        alert("Enter Title");
        $('#notice_title').focus();
        return false;
    }
    
    else if (notice_status  == "") {
        alert("Select Status");
        $('#notice_status').focus();
        return false;
    }
	else if (publish_date  == "") {
        alert("Enter Publish date");
        $('#publish_date').focus();
        return false;
    }
  else if (expire_date  == "") {
        alert("Enter expire date");
        $('#expire_date').focus();
        return false;
    }
	else{
	file_path =  "asset/custom/upload/web/file/" + file_namer;

	var dataStr = "notice_title="+notice_title+" &notice_content="+notice_content+" &notice_status="+notice_status+
	" &publish_date="+publish_date+"&file_path="+file_path+" &expire_date="+expire_date+" &operation="+operation;
	//alert (dataStr);

	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						load_notice_board_to_show();
						
					}

		});


	clearInput();
	}
});

function edit_file(){
	var file_data = $('#edit_notice_file').prop('files')[0];   
	var fd = new FormData();                  
	fd.append('file', file_data);
	var file_path = "../../asset/custom/upload/web/file/";
	fd.append('path', file_path);
	
	$.ajax({
		url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
		//dataType: 'text',  // what to expect back from the PHP script, if anything
		cache: false,
		contentType: false,
		processData: false,
		data: fd,                         
		type: 'POST',
		success: function(php_script_response){
					file_path = "asset/custom/upload/web/file/" + php_script_response;
					alert(php_script_response);
					//alert(file_path);
					//$("#edit_web_img_speech").val(file_path);
					$("#file_edited").val(file_path);
				}
	});
}

$('#add_latest_news').click(function(){

	var operation = 2;
	var latest_news = $('#latest_news').val();
	var news_status = $('#news_status').val();

	var dataStr = "latest_news="+latest_news+" &news_status="+news_status+" &operation="+operation;
	//alert (dataStr);

	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						load_latest_news_to_show();
						
					}

		});

	clearInput();

});

$("#web_image").change(function(){

		

		var file_data = $('#web_image').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var pic_path = "../../asset/custom/upload/web/image/";
		fd.append('path', pic_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					pic_path = pic_path + php_script_response;
					//$(“input type=[file]”).val(pic_path);
					//alert(php_script_response);
			 
				}


		});

		//alert(signature_name);
		//console.log(file_data);  
});
$("#web_file").change(function(){

		

		var file_data = $('#web_file').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var file_path = "../../asset/custom/upload/web/file/";
		fd.append('path', file_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					file_path = file_path + php_script_response;
					$("#web_file").val(file_path);
					//alert(php_script_response);
			 
				}


		});

		//alert(signature_name);
		//console.log(file_data);  
});


$('#add_web_image').click(function(){

	var operation = 'insert_web_image';
	var image_caption = $('#image_caption').val();
	var image_status = $('#image_status').val();

	var img = $("#web_image").val();
		var pic_path_arr = img.split("\\");
		var pic_namer = pic_path_arr[2];

		pic_path =  "asset/custom/upload/web/image/" + pic_namer;

	var dataStr = "file_caption="+image_caption+"&file_status="+image_status+"&file_path="+pic_path+"&file_namer="+pic_namer+"&operation="+operation;
	//alert (dataStr);
	
	if (image_caption == "") {
        alert("Enter Caption");
        $('#image_caption').focus();
        return false;
    }
	if (img == "") {
        alert("Select Picture");
        $('#web_image').focus();
        return false;
    }
    else if (image_status == "") {
        alert("Select Status");
        $('#image_status').focus();
        return false;
    }
    else{
	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						load_image_gallery_to_show();
						
					}

		});

	clearInput();
}

});

$('#add_web_class_routine_pdf').click(function(){  

	alert('hello from add file');
	var operation = 'insert_class_routine';
	var file_caption = $('#file_caption').val();
	var file_status = $('#file_status').val();
    var file_title = $('#file_title').val();
	var file_pdf = $("#web_file").val();
	//alert(file_path);
	
		var file_path_arr = file_pdf.split("\\");
		var file_namer = file_path_arr[2];

	file_path =  "asset/custom/upload/web/file/" + file_namer;

	var dataStr = "file_caption="+file_caption+"&file_status="+file_status+
					"&file_path="+file_path+"&file_title="+file_title+"&operation="+operation;
	alert (dataStr);
	if (file_caption== "") {
        alert("Enter Caption");
        $('#file_caption').focus();
        return false;
    }
    else if (file_title == "") {
        alert("Select Title");
        $('#file_title').focus();
        return false;
    }
    else if (file_status  == "") {
        alert("Select Status");
        $('#file_status').focus();
        return false;
    }
    else if (file_pdf == "") {
        alert("Select Image");
        $('#web_file').focus();
        return false;
    }
	else{

	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						 load_class_routine_to_show();
						
					}

		});

	clearInput();
	}
});
function delete_class_routine(id){
	
	var operation = 'delete_class_routine';
	var datastr="_id="+id+"&operation="+operation;
	 if (confirm("Are you sure want to delete class routine?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_class_routine_to_show();
				
				}
				
			}); 		
	  }

	
}



function delete_notice_data(id){
	
	//alert(id);
	var operation = 4;
	var datastr="_id="+id+"&operation="+operation;
	//alert(datastr);
	//$('#form_data').css('display','none');
	  if (confirm("Are you sure want to delete The Notice?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_notice_board_to_show();
				
				}
				
			}); 		
	  }
}

function delete_web_image(id){
	
	//alert(id);
	var operation = 'Delete_Web_Image';
	var datastr="_id="+id+"&operation="+operation;
	//alert(datastr);
	//$('#form_data').css('display','none');
	  if (confirm("Are you sure want to delete The Image?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_image_gallery_to_show();
				
				}
				
			}); 		
	  }
}

function delete_latest_news(id){
	
	//alert(id);
	var operation = 6;
	var datastr="_id="+id+"&operation="+operation;
	//alert(datastr);
	//$('#form_data').css('display','none');
	  if (confirm("Are you sure want to delete The News?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_latest_news_to_show();
				
				}
				
			}); 		
	  }
}

function show_notice_edit(id){
	var datastr="_id="+id;
	$("#add_notice_table_value").load("module/webportal/edit_web_notice.php",datastr);
}

function perform_update_notice(){
	//alert("Hi there");
	var operation = 'edit_notice';
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_notice_title = $('#edit_notice_title').val();
	var edit_notice_content = $('#edit_notice_content').val();
	var edit_notice_status = $('#edit_notice_status').val();
	var edit_publish_date = $('#edit_publish_date').val();
	var edit_expire_date = $('#edit_expire_date').val();
	var edit_notice_file = $('#file_edited').val();
	
	
var dataStr="edit_notice_title="+edit_notice_title+"&edit_notice_content="+edit_notice_content+
"&edit_notice_status="+edit_notice_status+"&edit_publish_date="+edit_publish_date+"&edit_expire_date="+edit_expire_date+
"&selected_id_to_edit="+selected_id_to_edit+"&edit_notice_file="+edit_notice_file+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_notice_board_to_show();
		}
	}); 
}

function show_latest_news_edit(id){
	var datastr="_id="+id;
	$("#add_latest_news_table_value").load("module/webportal/edit_latest_news.php",datastr);
}

function perform_update_latest_news(){
	//alert("Hi there");
	var operation = 8;
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_latest_news = $('#edit_latest_news').val();
	var edit_news_status = $('#edit_news_status').val();

	var dataStr="edit_latest_news="+edit_latest_news+"&edit_news_status="+edit_news_status+"&selected_id_to_edit="+selected_id_to_edit+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_latest_news_to_show();
		}
	}); 
}

function show_web_image_edit(id){
	var datastr="_id="+id;
	$("#add_image_gallery_table_value").load("module/webportal/edit_image_gallery.php",datastr);
}
function edit_img(){
	var file_data = $('#edit_web_image').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var file_path = "../../asset/custom/upload/web/image/";
		fd.append('path', file_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					file_path = file_path + php_script_response;
					//alert(php_script_response);
					//alert(file_path);
					$("#web_img_id_edited").val(file_path);
				}


		});
}
function perform_update_image_gallery(){
	//alert("Hi there");
	var operation = 'edit_image_galary';
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_image = $("#edit_web_image").val();
	var edit_image_caption = $('#edit_image_caption').val();
	var edit_image_status = $('#edit_image_status').val();

	var image_previous_value=$("#web_img_id_edited").val();
	if (edit_image!="")
	{
	    var edit_img_path_arr = edit_image.split("\\");
		var edit_img_namer = edit_img_path_arr[2];
		edit_img_path =  "asset/custom/upload/web/image/" + edit_img_namer;
	}
	else
	{
		edit_img_path=image_previous_value;
	}
	
	if(edit_image_caption == ""){
		  alert("Enter Caption");
        $('#edit_image_caption').focus();
        return false;	
	}
	else if(edit_image == ""){
		alert("Upload Image");
		$('#edit_web_image').focus();
        return false;
	}
else{

	var dataStr="edit_image_caption="+edit_image_caption+"&edit_image_status="+edit_image_status+
	"&edit_img_path="+edit_img_path+"&selected_id_to_edit="+selected_id_to_edit+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_image_gallery_to_show();
		}
	}); 
}
}

$("#web_event_img").change(function(){

		

		var file_data = $('#web_event_img').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var pic_path = "../../asset/custom/upload/web/image/";
		fd.append('path', pic_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					pic_path = pic_path + php_script_response;
					//$(“input type=[file]”).val(pic_path);
					//alert(php_script_response);
			 
				}


		});;  
});


$('#add_web_event').click(function(){

	var operation = 10;
	var event_status = $('#event_status').val();

	var pic_path = $("#web_event_img").val();
		var pic_path_arr = pic_path.split("\\");
		var pic_namer = pic_path_arr[2];

		pic_path =  "asset/custom/upload/web/image/" + pic_namer;

	var dataStr = "event_status="+event_status+" &pic_path="+pic_path+" &pic_namer="+pic_namer+" &operation="+operation;
	//alert (dataStr);

	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						load_web_event_to_show();
						
					}

		});

	clearInput();

});

function delete_web_event(id){
	
	//alert(id);
	var operation = 11;
	var datastr="_id="+id+"&operation="+operation;
	//alert(datastr);
	//$('#form_data').css('display','none');
	  if (confirm("Are you sure want to delete This Event?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_web_event_to_show();
				
				}
				
			}); 		
	  }
}

function show_web_event_edit(id){
	var datastr="_id="+id;
	$("#add_event_table_value").load("module/webportal/edit_web_event.php",datastr);
}

function perform_update_web_event(){
	//alert("Hi there");
	var operation = 12;
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_event_status = $('#edit_event_status').val();


	var dataStr="edit_event_status="+edit_event_status+"&selected_id_to_edit="+selected_id_to_edit+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_web_event_to_show();
		}
	}); 
}

$("#web_banner_img").change(function(){

		

		var file_data = $('#web_banner_img').prop('files')[0];   
		var fd = new FormData();                  
		fd.append('file', file_data);
		var pic_path = "../../asset/custom/upload/web/image/";
		fd.append('path', pic_path);
		$.ajax({
			url: 'module/webportal/web_upload_file.php', // point to server-side PHP script 
			//dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: fd,                         
			type: 'POST',
			success: function(php_script_response){

					pic_path = pic_path + php_script_response;
					//$(“input type=[file]”).val(pic_path);
					//alert(php_script_response);
			 
				}


		});;  
});


$('#add_web_banner').click(function(){

	var operation = 13;
	var banner_status = $('#banner_status').val();

	var pic_path = $("#web_banner_img").val();
		var pic_path_arr = pic_path.split("\\");
		var pic_namer = pic_path_arr[2];

		pic_path =  "asset/custom/upload/web/image/" + pic_namer;

	var dataStr = "banner_status="+banner_status+" &pic_path="+pic_path+" &pic_namer="+pic_namer+" &operation="+operation;
	//alert (dataStr);

	$.ajax({
					url: 'module/webportal/web_content_management_AJAX.php',
					dataType: 'text',
					data: dataStr,                         
					type: 'POST',
					success: function(php_script_response){

						alert(php_script_response);
						load_web_banner_to_show();
						
					}

		});

	clearInput();

});

function delete_web_banner(id){
	
	//alert(id);
	var operation = 14;
	var datastr="_id="+id+"&operation="+operation;
	//alert(datastr);
	//$('#form_data').css('display','none');
	  if (confirm("Are you sure want to delete This Banner?"))
	  {
		 $.ajax({
				type:"post",
				url:"module/webportal/web_content_management_AJAX.php",
				data:datastr ,
				success:function(st){
					 alert(st);
					 load_web_banner_to_show();
				
				}
				
			}); 		
	  }
}

function show_web_banner_edit(id){
	var datastr="_id="+id;
	$("#add_banner_table_value").load("module/webportal/edit_web_banner.php",datastr);
}
function show_file_edit(id){
	var datastr="_id="+id;
	//alert(datastr);
	$("#edit_class_routine").load("module/webportal/edit_web_class_routine.php",datastr);
}
function perform_update_file(){
	var operation='edit_class_routine';
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_file_caption = $("#edit_file_caption").val();
	var edit_file_title = $("#edit_file_title").val();
	var file_status = $('#edit_file_status').val();
	
	if (edit_file_caption == "") {
        alert("Enter File Caption");
        $('#edit_file_caption').focus();
        return false;
    }
    else if (edit_file_title == "") {
        alert("Enter Title");
        $('#edit_file_title').focus();
        return false;
		alert("xyz");
    }
else{
	var dataStr="edit_file_status="+file_status+"&selected_id_to_edit="+selected_id_to_edit+"&edit_file_caption="+edit_file_caption+"&edit_file_title="+edit_file_title+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_class_routine_to_show();
				//edit_web_banner_to_show();
		}
	}); 
}
	
	//alert('hello');
}
function perform_update_web_banner(){
	//alert("Hi there");
	var operation = 15;
	var selected_id_to_edit = $("#selected_id_to_edit").val();
	var edit_banner_status = $('#edit_banner_status').val();


	var dataStr="edit_banner_status="+edit_banner_status+"&selected_id_to_edit="+selected_id_to_edit+"&operation="+operation;

	//alert(dataStr);

	$.ajax({
		type:"post",
		url:"module/webportal/web_content_management_AJAX.php",
		data:dataStr ,
		success:function(st){
				alert(st);
				load_web_banner_to_show();
		}
	}); 
}


function clearInput(){
	$("#input_field :input").each(function(){
		$(this).val('');
	});
}

function load_notice_board_to_show()
{
	//alert('inside load function');
	$("#notice_list").load("module/webportal/notice_board_datatable.php");
	
}

function load_image_gallery_to_show(){
	$("#image_list").load("module/webportal/image_gallery_datatable.php");
	
}

function load_class_routine_to_show(){
	$("#class_routine_list").load("module/webportal/web_class_routine_datatable.php");
	
}
function edit_class_routine_to_show(){
	$("#class_routine_list").load("module/webportal/web_class_routine_datatable.php");
	
}
function load_latest_news_to_show(){
	$("#latest_news_list").load("module/webportal/latest_news_datatable.php");
	
}

function load_web_event_to_show(){
	$("#event_list").load("module/webportal/web_events_datatable.php");
	
}

function load_web_banner_to_show(){
	$("#banner_list").load("module/webportal/web_banner_datatable.php");
	
}