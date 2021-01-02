<?php
include('my_class.php');

function get_personal_info($id){
	$obj=new my_class();
	$data_list_personal_info=$obj->Details_By_Cond('_pf_std_personal_info',"_id='".$id."'");
	$blood_group=$obj->View_column_details_By_Cond('_int_common_setup','_name','_id='.$data_list_personal_info['_blood_group_id'].' AND _type="BG"');
	$data_list_personal_info['_blood']=$blood_group['_name'];
	$section_id=$obj->View_column_details_By_Cond('_pf_std_basic_info',' * ','_pid='.$id);
	$all_details_institute=$obj->Details_By_Cond('_int_institute_setup_vw'," section_id='".$section_id['']."' LIMIT 1");
	$data_list_personal_info['_sh_name']=$all_details_institute['shift'];
	$data_list_personal_info['_me_name']=$all_details_institute['medium'];
	$data_list_personal_info['_cl_name']=$all_details_institute['class'];
	$data_list_personal_info['_dp_name']=$all_details_institute['department'];
	$data_list_personal_info['_st_name']=$all_details_institute['student_type'];
	$data_list_personal_info['_sc_name']=$all_details_institute['section'];
return $data_list_personal_info;
	
}

$a=get_personal_info(4);
print_r($a);


?>