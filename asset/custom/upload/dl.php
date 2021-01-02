<?php  
	session_start();
	// ============
	include("../../asset/theme/css/myfunc.php");
	include("../../php_crud/my_class.php");
	$obj=new my_class();
	
	extract($_GET);
	$class_id  ;
	$subject_id;
	$section_id;
	$department_id;
	$exam_term_id;
	$exam_session; 
	 
	$class_name  ;
	$department ;
	$student_type;  
	$section_name  ;
	$sub_name;
	
	
	
	$filename = '../../asset/custom/upload/sample_mark_sheet_'.$class_id.'_'.$subject_id .'_'.$section_id.'_'.$exam_term_id.'_'.$exam_session .'.csv';
	 	
	$fp = fopen('php://output', 'w');
	$headers_01 = array(1=>"Class:". $class_name , 2=> "Student Type:". $student_type , 3=> "Section:". $section_name , 4=> "Department:".$department , 5=> "Subject:". $sub_name);
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $headers_01);

	fputcsv($fp, array(1=>"  "  , 2=> " " , 3=> "   "  , 4=> "    "));
	
	$headers_02 = array(1=>"Serial" , 2=>"ID" , 3=>"Name" , 4=> "Roll" , 5=>"Subjective" , 6=>"Objective" , 7=>"Class Test" , 8=> "Practical" , 9=>"Spot Test" , 10=>"Total Mark" , 11=>"GPA" , 12=>"Grade");
	fputcsv($fp, $headers_02);
	
    $i = 1;
	foreach($obj->std_mark_entry_list("m_sh._term_id='$exam_term_id' AND m_sh._session='$exam_session' AND 
			m_sh._section_id='$section_id' AND std._status='A' AND m_sh._subject_id='$subject_id' ORDER BY _section_roll") as $value)
	{
		extract($value);
		$i++; 

		$slno = $i; 
		$uniq_id =  $value['_uniq_id']; 
		$fullname = $value['_full_name']; 
		if(!empty($value['_nick_name'])){
			$fullname .= ' ('.$value['_nick_name'].')'; 
		} 		 
		$section_roll =  $value['_section_roll'];  	

		 
		fputcsv($fp, array(1=> $slno , 2=> $uniq_id , 3=> $fullname , 4=> $section_roll , 5=>"" , 6=>"" , 7=>"" , 8=> "" , 9=>"" , 10=>"" , 11=>"" , 12=>""));	
		$i++;
	} 
	fclose($fp);
	exit;
	
 
/* 
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;*/
?>