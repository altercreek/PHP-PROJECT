<?php
	$dir = $_POST['path'];
	//echo $dir;
	//echo "file execute";
	$ret_msg = "";
	$filename = $_FILES['file']['name'];
	//echo $filename;
	$file_new_name="";
	if($filename!=''){
		$fl = $dir . $filename;
		$fl = str_replace(' ', '', $fl);
		$filename = str_replace(' ', '', $filename);
		//echo $fl;
		if(file_exists($fl)) {
			//$ret_msg = "inside file exists if";
			$file_extension=explode('.',$filename);
			$index=count($file_extension)-1;
			$random_id = mt_rand(1,99);
			$file = explode(".",$filename);
			$file_name = $file[0].$random_id;
			//echo $file_name;
			//echo "W";
			$changed_file_name = $file_name;
			//echo $changed_file_name;
			$file_new_name=$changed_file_name.".".$file_extension[$index];
			$new_file_with_dir=$dir.$file_new_name;
			//echo $file_new_name;
			//rename($fl, $new_file_with_dir);
			move_uploaded_file($_FILES["file"]["tmp_name"], $new_file_with_dir);
			$ret_msg = $file_new_name;
		} else {
			
			move_uploaded_file($_FILES["file"]["tmp_name"], $fl);
			$ret_msg = "".$filename;
		}
	}
	echo $ret_msg;
	
?>