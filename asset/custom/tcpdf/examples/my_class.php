<?php
date_default_timezone_set("Asia/Dacca");
class my_class{
//================ Start DB Connection 1 ==================== 
// =======Local Data=======

    private $host_add1="localhost";
    private $db_name1="school_v5";
    private $user_name1="root";    
    private $password1="";
    // =====


// =======Online Data=======

    // private $host_add1="202.51.191.67";
    // private $db_name1="school_mod";
    // private $user_name1="himel";    
    // private $password1="himel123";
//========


// ==========================
public function __construct(){
    $this->con1 = new PDO("mysql:host=".$this->host_add1.";dbname=".$this->db_name1,$this->user_name1,$this->password1);  
}   
//================== End DB Connection 1 ======================
// ======================
// ===================
// ===============
// ============
// =========
// ======
// ===


// Start Login User Check Function
public function Login_Check($table_name,$where_cond) {
    $sql_login = "SELECT * FROM ".$table_name." WHERE $where_cond";
    $login = $this->con1->prepare($sql_login);
    $login->execute() or die(print_r($q->errorInfo()));
    $total = $login->rowCount();

    if($total==1){

    $data = $login->fetch(PDO::FETCH_ASSOC);
    return isset($data)? $data :NULL;

    }
    else{
        return $total;
        }
    
}
// ==============End Login User Check Function==================



// Data Insert Function
public function Insert_Data($table_name, $form_data) {
$fields = array_keys($form_data);

$sql = "INSERT INTO ".$table_name."
(`".implode('`,`', $fields)."`)
VALUES('".implode("','", $form_data)."')";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

return $this->con1->lastInsertId();
}
// ========================


// Insert By Check Duplicate Data Function
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
    $q = $this->con1->prepare($sql);
 
 return $q->execute() or die(print_r($q->errorInfo()));

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
    $q->execute() or die(print_r($q->errorInfo()));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    return isset($data)? $data :NULL;    
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
    $sql_login = "SELECT * FROM $table_name";
    $count = $this->con->prepare($sql_login);
    $count->execute() or die(print_r($q->errorInfo()));
    $total = $count->rowCount();
    return $total;
}
// ========================



//Row Count By Condition Function
public function Total_Count_By_Cond($table_name,$where_cond) {
    $sql_login = "SELECT * FROM ".$table_name." WHERE $where_cond";
    $count = $this->con->prepare($sql_login);
    $count->execute() or die(print_r($q->errorInfo()));
    $total = $count->rowCount();
    return $total;
}
// ========================



// Mail Send with Attach file
public function Mail_Attachment($filename, $path, $to, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($to, $subject, "", $header)) {
        echo "Mail Send Successfull"; // or use booleans here
    } else {
        echo "Mail Send Failed";
    }
}
// ========================



// Mail send without attach file
public function Mail_Send($to,$subject,$message,$from) {
    
    if (mail($to,$subject,$message,"From: $from\n")) {
        echo "Mail Send Successfull"; // or use booleans here
    } else {
        echo "Mail Send Failed";
    }
}
// ====================================



//Start Randome Code Generate Function
public function Random_Code($chars,$length) {

    srand((double)microtime()*1000000); 
    $i = 0; 
    $code = ''; 

    while ($i <= ($length-1)) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $code = $code . $tmp; 
        $i++; 
    } 
    return $code;
} 
// ========================


// ================ Statrt SMS Function =====================
public function Sms_Send($institute_id,$module_id,$sms_type,$mobile_no,$sms_body,$priority,$entry_by,$date_time) {

    $sql_select = "SELECT * FROM _int_sms_switch WHERE `_institute_id`='$institute_id' AND `_module_id`='$module_id' AND `_sms_status`='1'";
    $ch_data = $this->con1->prepare($sql_select);
    $ch_data->execute(array());
    $total = $ch_data->rowCount();

    if($total=='1'){
        $sms_send ="INSERT INTO `_int_sms_inbox` (`_institute_id`, `_module_id`, `_sms_type`, `_number`, `_sms_body`, `_priority`, `_entry_by`, `_entry_date`) VALUES ('$institute_id', '$module_id', '$sms_type', '$mobile_no', '$sms_body', '$priority', '$entry_by', '$date_time')";
        $sms = $this->con1->prepare($sms_send);
        $sms->execute() or die(print_r($sms->errorInfo()));

        return $this->con1->lastInsertId();
    }
    else{
        return $total;
    }
}
// example: $smstest = $obj->Sms_Send("94","1","AT","01911094989","Test","N","1","2015-04-06 12:08:42"); 

// ================ End SMS Function =====================



// ================ Start Custom Query ================
// ============================
function student_id_generator($session,$section_id){
		$sql="SELECT MAX(a._uniq_id) AS max_id  FROM `_pf_std_personal_info` AS a,`_pf_std_basic_info` AS b WHERE a._id=b._pid AND b._session='".$session."' AND b._section_id='".$section_id."'";
		$q = $this->con1->prepare($sql);
		$q->execute() or die(print_r($q->errorInfo()));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		return isset($data)? $data :NULL;
		
	}

// ============================


public function View_class_period($where_cond) {
    $data = array();
    $sql = "SELECT p._id,
       p._period_name,
       p._start_time,
       p._end_time,
       p._break,
       p._status,
       me._id AS me_id,
       me._name AS me_name,
       sh._id AS sh_id,
       sh._name AS sh_name,
       br._id AS br_id,
       br._name AS br_name,
       i._id AS i_id,
       i._name AS i_name
  FROM (((_int_institute_setup br
          INNER JOIN _int_institute_setup i ON (br._pid = i._id))
         INNER JOIN _int_institute_setup sh ON (sh._pid = br._id))
        INNER JOIN _int_institute_setup me ON (me._pid = sh._id))
       right JOIN _r_class_period p ON (p._medium_id = me._id)
 WHERE $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}






// ============================

public function View_Employee_List($br_id,$status) {
    $data = array();
    $sql = "SELECT emp._id,
       i._id AS _ins_id,
       i._name AS _ins_name,
       br._id AS _br_id,
       br._name AS _br_name,
       emp._status,
       emp._uniq_id,
       emp._full_name,
       emp._nick_name,
       emp._code_name,
       bg._name AS _blood_group,
       emp._contact_mobile_no,
       dp._name AS _department,
       dg._name AS _designation
  FROM ((((_pf_emp_personal_info emp
           left JOIN _int_common_setup dp
              ON (emp._department_id = dp._id))
          left JOIN _int_institute_setup br
             ON (emp._branch_id = br._id))
         left JOIN _int_institute_setup i ON (br._pid = i._id))
        left JOIN _int_common_setup bg
           ON (emp._blood_group_id = bg._id))
       left JOIN _int_common_setup dg
          ON (emp._designation_id = dg._id)
 WHERE br._id='$br_id' AND emp._status !='$status'";


    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================


public function View_Student_List($where_cond) {
    $data = array();
    $sql = "SELECT pf_std._id,
       bsf._session,
       sc._id AS _section_id,
       sc._name AS _section,
       st._id AS _std_type_id,
       st._name AS _std_type,
       dp._id AS _depart_id,
       dp._name AS _department,
       cl._id AS _class_id,
       cl._name AS _class,
       me._id AS _medium_id,
       me._name AS _medium,
       sh._id AS _shift_id,
       sh._name AS _shift,
       br._id AS _branch_id,
       br._name AS _branch,
       i._id AS _institute_id,
       i._name AS _institute,
       pf_std._status,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       bg._id AS _blood_id,
       bg._name AS _blood,
       pf_std._gender,
       rg._id AS _religion_id,
       rg._name AS _religion,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
       pf_std._current_guardian,
       pf_std._image_location
  FROM ((((((((((school_v5._int_institute_setup br
                 left JOIN school_v5._int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN school_v5._int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN school_v5._int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN school_v5._int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN school_v5._int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN school_v5._int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN school_v5._int_institute_setup sc ON (sc._pid = st._id))
          left JOIN school_v5._pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN school_v5._pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN school_v5._int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN school_v5._int_common_setup rg
          ON (pf_std._religion = rg._id)          
  where $where_cond";
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================


public function View_Section($medium_id) {
    $data = array();
    $sql = "SELECT sc._id AS _sec_id,
       sc._name AS _sec_name,
       st._id AS _st_id,
       dp._id AS _dep_id,
       me._id AS _me_id
  FROM ((_int_institute_setup dp
         LEFT JOIN _int_institute_setup me ON (dp._pid = me._id))
        LEFT JOIN _int_institute_setup st ON (st._pid = dp._id))
       LEFT JOIN _int_institute_setup sc ON (sc._pid = st._id)
       
WHERE me._id='$medium_id' AND sc._id!='' ORDER BY sc._id ASC";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


//employee
public function View_profile_employee($employee) {
	
    $sql = "SELECT emp._id AS emp_id,
       i._id AS _ins_id,
       i._name AS _ins_name,
       br._id AS _br_id,
       br._name AS _br_name,
       emp._status,
       emp._uniq_id,
       emp._full_name,
       emp._nick_name,
       emp._code_name,
       emp._date_of_birth,
       emp._emp_code,
       emp._gender,
       emp._nationality,
       emp._marital_status,
       emp._national_id_no,
       emp._joining_date,
       emp._last_promotion_date,
       emp._contact_email,
       emp._home_phone,
       emp._office_phone,
       emp._hoby,
       bg._name AS _blood_group,
       rg._name AS _religion,
       emp._contact_mobile_no,
       pf._name AS _proffesion,       
       dp._name AS _department,
       dg._name AS _designation,
       sc._name AS _section ,
       qt._name AS _quata ,                    
       emp._comments AS _comments                     
  FROM ((((_pf_emp_personal_info emp
           LEFT JOIN _int_common_setup pf
              ON (emp._profession_id = pf._id)
           LEFT JOIN _int_common_setup dp
              ON (emp._department_id = dp._id)
               LEFT JOIN _int_common_setup sc
              ON (emp._section_id = sc._id)
              LEFT JOIN _int_common_setup qt
              ON (emp._quota_id = qt._id))
          LEFT JOIN _int_institute_setup br
             ON (emp._branch_id = br._id))
         LEFT JOIN _int_institute_setup i ON (br._pid = i._id))
        LEFT JOIN _int_common_setup bg
           ON (emp._blood_group_id = bg._id)
        LEFT JOIN _int_common_setup rg
           ON (emp._religion_id = rg._id))
       LEFT JOIN _int_common_setup dg
          ON (emp._designation_id = dg._id)
          
          where emp._id = $employee ORDER BY emp._id ASC";
		$q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;  



}


//address
public function View_address($emp_id,$type,$info_type) {
	
    $sql = "SELECT 
       ai._id AS _add_id,
       ai._pid AS _add_pid,       
       ai._type AS _add_type,
       ai._info_type AS _add_info_type,
       ai._address AS _address,
       ct._name AS _dname,
       tn._name AS _tname
       
                            
  FROM (_pf_address_info ai
              
           
          LEFT JOIN _int_country ct
             ON (ai._district_id = ct._id))
             LEFT JOIN _int_country tn
             ON (ai._thana_id = tn._id)
             
    WHERE ai._pid='$emp_id' AND ai._type='$type' AND  ai._info_type='$info_type' ";
	$q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;    



}
//----spouse and parents
public function View_spouse_parents($emp_id,$type,$info_type) {
	
    $sql = "SELECT 
       gs._id ,
        gs._pid AS _guardian_pid ,
       gs._type AS _gs_type,
       gs._info_type AS _gs_info_type,
       gs._full_name AS _gs_full_name,
       
       gs._nationality AS _gs_nationality,
       gs._national_id AS _gs_national_id,
       gs._yearly_income AS _gs_yearly_income,
       gs._mobile_no AS _gs_mobile_no,
       gs._email AS _gs_email,
       gs._home_phone AS _gs_home_phone,
       gs._office_phone AS _gs_office_phone,
       gs._office_address AS _gs_office_address,
      
       cs._name AS _oname ,
       bg._name AS _bname,
       rl._name AS _rname    
      
       
                            
  FROM (_pf_guardian_spouse_info gs
              
           
          LEFT JOIN _int_common_setup cs
             ON (gs._occupation_id = cs._id)
             LEFT JOIN _int_common_setup bg
             ON (gs._blood_group_id = bg._id)
             LEFT JOIN _int_common_setup rl
             ON (gs._blood_group_id = rl._id))
             
            
WHERE gs._pid='$emp_id' AND gs._type='$type' AND gs._info_type='$info_type'";
	$q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;  



}

///jhcj
 public function View_academic($emp_id,$type) {
	$data = array();
    $sql = "SELECT 
       aca._id ,
        aca._pid AS _academic_pid ,
       aca._type AS _aca_type,
       
       aca._institute AS _istitute,
       aca._pass_year AS _pass_year,
       aca._gpa_marks AS _gpa_marks,
      
       ex._name AS _ex_name ,
       bd._name AS _bd_name,
       gd._name AS _gdname 
	   
      
       
                            
  FROM (_pf_academic_bg aca
              
           
          LEFT JOIN _int_common_setup ex
             ON (aca._exam_name_id = ex._id)
             LEFT JOIN _int_common_setup bd
             ON (aca._board_id = bd._id)
             LEFT JOIN _int_common_setup gd
             ON (aca._grade_id = gd._id)
             )
             
            
WHERE aca._pid='$emp_id' AND aca._type='$type'";
	$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
 



} 

//identify
public function View_identyfier($emp_id,$type,$info_type) {
	
    $sql = "SELECT 
       ide._id ,
        ide._pid AS _identify_pid ,
       ide._type AS _ide_type,
       ide._info_type AS ide_info_type,
       ide._name AS _name,
       
      
       des._name AS _des_name 
       
      
       
                            
  FROM (_pf_form_identifier ide
              
           
          LEFT JOIN _int_common_setup des
             ON (ide._designation_id = des._id)
             
             )
             
            
WHERE ide._pid='$emp_id' AND ide._type='$type' AND ide._info_type='$info_type'";
	$q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;  
 



}

//

public function View_std_prof($where_cond) {
	$data = array();
    $sql = "SELECT pf_std._id,
       pf_std._status,
       bsf._id AS _basic_id,
       sc._id AS _sc_id,
       sc._name AS _sc_name,
       st._id AS _st_id,
       st._name AS _st_name,
       dp._id AS _dp_id,
       dp._name AS _dp_name,
       cl._id AS _cl_id,
       cl._name AS _cl_name,
       me._id AS _me_id,
       me._name AS _me_name,
       sh._id AS _sh_id,
       sh._name AS _sh_name,
       br._id AS _br_id,
       br._name AS _br_name,
       i._id AS _ins_id,
       i._name AS _ins_name,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._nick_name,
       pf_std._birth_reg_no,
       pf_std._full_name AS _full_name ,
       pf_std._date_of_birth,
       bg._id AS _blood_id,
       bg._name AS _blood,
       pf_std._gender,
       rg._id AS _religion_id,
       rg._name AS _religion,
       pf_std._nationality,
       qt._id AS _quata_id,
       qt._name AS _quata,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
       pf_std._current_guardian,
       pf_std._image_location,
       pf_std._comments
  FROM (((((((((((_pf_std_basic_info bsf
                  left JOIN _int_institute_setup sc
                     ON (bsf._section_id = sc._id))
                 left JOIN _int_institute_setup st
                    ON (sc._pid = st._id))
                left JOIN _int_institute_setup dp
                   ON (st._pid = dp._id))
               left JOIN _int_institute_setup cl
                  ON (dp._pid = cl._id))
              left JOIN _int_institute_setup me
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup sh
                ON (me._pid = sh._id))
            left JOIN _int_institute_setup br
               ON (sh._pid = br._id))
           left JOIN _int_institute_setup i ON (br._pid = i._id))
          left JOIN _pf_std_personal_info pf_std
             ON (pf_std._id = bsf._pid))
         left JOIN _int_common_setup bg
            ON (pf_std._blood_group_id = bg._id))
        left JOIN _int_common_setup rg
           ON (pf_std._religion = rg._id))
       left JOIN _int_common_setup qt
          ON (pf_std._quota_id = qt._id)
		  where $where_cond";
	$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL; 



}



////






// ============================

// ========================================================================
}

?>