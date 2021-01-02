<?php
date_default_timezone_set("Asia/Dacca");
class my_class{
//================ Start DB Connection 1 ==================== 

    private $host_add1="localhost";
    private $db_name1="school_v5";
    private $user_name1="root";    
    private $password1="";

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


public function menu_permission($column,$cond) {
   $sql="SELECT $column FROM st_user_menu_permission WHERE $cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
    
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
    $data = $q->execute() or die(print_r($q->errorInfo()));
   
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
       bsf._id AS _base_id,
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
       pf_std._id_card AS id_card_num,
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
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
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


public function View_Student_List_rows($where_cond) {
    $data = array();
    $sql = "SELECT pf_std._id,
       bsf._session,
       sc._id AS _section_id,
       st._id AS _std_type_id,
       dp._id AS _depart_id,
       cl._id AS _class_id,
       me._id AS _medium_id,
       sh._id AS _shift_id,
       br._id AS _branch_id,
       i._id AS _institute_id,
       pf_std._status
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)          
  where $where_cond";
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    return $total_rows = $q->rowCount();   
}


// ============================



public function View_Section($medium_id) {
    $data = array();
    $sql = "SELECT sc._id AS _sec_id,
       sc._name AS _sec_name,
       sc._status AS _sec_status,
       me._id AS _me_id,
       me._name AS _me_name
  FROM (((_int_institute_setup dp
          left JOIN _int_institute_setup cl ON (dp._pid = cl._id))
         left JOIN _int_institute_setup st ON (st._pid = dp._id))
        left JOIN _int_institute_setup sc ON (sc._pid = st._id))
       left JOIN _int_institute_setup me ON (cl._pid = me._id)
       
  where me._id='$medium_id' AND sc._id!='' AND sc._status='A' ORDER BY sc._id ASC";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ============================


public function View_Section_for_routine($medium_id,$class_day) {
    $data = array();
    $sql = "SELECT _r_class_routine._id,
       _r_class_routine._class_day,
       _r_class_routine._medium_id,
       _r_class_routine._section_id,
       sc._name AS _sc_name,
       st._id AS _st_id,
       st._name AS _st_name,
       dp._id AS _dp_id,
       dp._name AS _dp_name,
       cl._id AS _cl_id,
       cl._name AS _cl_name
  FROM (((._int_institute_setup st
          left JOIN _int_institute_setup dp ON (st._pid = dp._id))
         left JOIN _int_institute_setup sc ON (sc._pid = st._id))
        left JOIN _r_class_routine _r_class_routine
           ON (_r_class_routine._section_id = sc._id))
       left JOIN _int_institute_setup cl ON (dp._pid = cl._id)
       
 where _medium_id='$medium_id' AND _r_class_routine._class_day='$class_day' group by sc._id
 
 order by cl._name,dp._name,st._name,sc._name ASC";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ============================


public function View_Teacher_For_Routine($where_cond) {
    $data = array();
    $sql = "SELECT tch._id,
       tch._branch_id,
       tch._status,
       tch._uniq_id,
       tch._full_name,
       tch._nick_name,
       tch._code_name,
       tch._profession_id AS _profession,
       dp._name AS _department,
       dg._name AS _designation,
       sc._name AS _section
  FROM ((_pf_emp_personal_info tch
         left JOIN _int_common_setup sc
            ON (tch._section_id = sc._id))
        left JOIN _int_common_setup dp
           ON (tch._department_id = dp._id))
       left JOIN _int_common_setup dg
          ON (tch._designation_id = dg._id)
          
          where $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================

// Details Data View Condition Wise Function
public function Details_By_Cond_for_routine($where_cond){
 $sql="SELECT r._id,
       sb._subject_full_name,
       sb._subject_short_name,
       sb._subject_code,
       sb._subject_type,
       m_tch._uniq_id AS _main_uniq_id,
       m_tch._full_name AS _main_full_name,
       m_tch._nick_name AS _main_nick_name,
       m_tch._code_name AS _main_code_name,
       r._teacher_type AS _main_tch_type,
       dp._name,
       dg._status,
       sc._name,
       r._break,
       r._status,
       p_tch._uniq_id AS _proxy_uniq_id,
       p_tch._full_name AS _proxy_full_name,
       p_tch._nick_name AS _proxy_nick_name,       
       p_tch._code_name AS _proxy_code_name,
       h_tch._uniq_id AS _help_uniq_id,
       h_tch._full_name AS _help_full_name,
       h_tch._nick_name AS _help_nick_name,
       h_tch._code_name AS _help_code_name
  FROM ((((((_pf_emp_personal_info m_tch
             left JOIN _int_common_setup sc
                ON (m_tch._section_id = sc._id))
            left JOIN _r_class_routine r
               ON (r._teacher_id = m_tch._id))
           left JOIN _int_subject sb ON (r._subject_id = sb._id))
          left JOIN _pf_emp_personal_info p_tch
             ON (r._proxy_teacher_id = p_tch._id))
         left JOIN _pf_emp_personal_info h_tch
            ON (r._helping_teacher_id = h_tch._id))
        left JOIN _int_common_setup dp
           ON (m_tch._department_id = dp._id))
       left JOIN _int_common_setup dg
          ON (m_tch._designation_id = dg._id)
          
  WHERE $where_cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
 }
// ========================



public function View_Section_atd($where_cond) {
    $data = array();
    $sql = "SELECT atd._id,
       atd._atd_status,
       atd._approve_satus,
       usr.user_full_name,
       usr.user_login_id,
       atd._atd_time,
       atd._comments,
       br._id AS _br_id,
       br._name AS _br_name,
       sh._id AS _sh_id,
       sh._name AS _sh_name,
       me._id AS _me_id,
       me._name AS _me_name,
       cl._id AS _cl_id,
       cl._name AS _cl_name,
       dp._id AS _dp_id,
       dp._name AS _dp_name,
       st._id AS _st_id,
       st._name AS _st_name,
       sc._id AS _sc_id,
       sc._name AS _sc_name,
       atd._entry_date
  FROM (((((((_int_institute_setup dp
             LEFT JOIN _int_institute_setup cl
                ON (dp._pid = cl._id))
            LEFT JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           LEFT JOIN _int_institute_setup sc ON (sc._pid = st._id))
          LEFT JOIN _atd_daily_status_class atd
             ON (atd._section_id = sc._id))
         LEFT JOIN st_user_info usr ON (atd._atd_by = usr.user_id))
        LEFT JOIN _int_institute_setup me ON (cl._pid = me._id))
       LEFT JOIN _int_institute_setup sh ON (me._pid = sh._id))
       LEFT JOIN _int_institute_setup br ON (sh._pid = br._id)
       
   where $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ============================

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

// =======================================

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

// ==============================================

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

// ============================================

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

// =============================================

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

// =================================

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
       emp._profession_id,
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

// ================================================


public function View_sub_atd_status($where_cond) {
    $data = array();
    $sql = "SELECT atd_sub_status._id,
       atd_sub_status._section_id,
       sb._id AS _subject_id,
       sb._subject_full_name,
       sb._subject_short_name,
       sb._subject_code,
       sb._subject_type,
       atd_sub_status._atd_status,
       atd_sub_status._approve_satus,
       st_user_info.user_full_name AS _atd_entry_by_name,
       st_user_info.user_login_id AS _atd_entry_by_login_id,
       atd_sub_status._atd_time,
       atd_sub_status._comments,
       st_user_info_1.user_full_name AS _in_log_name,
       st_user_info_1.user_login_id AS _in_log_id,
       atd_sub_status._entry_date,
       st_user_info_2.user_full_name AS _up_log_name,
       st_user_info_2.user_login_id AS _up_log_id,
       atd_sub_status._last_update
  FROM (((_atd_daily_status_subject atd_sub_status
          left JOIN st_user_info st_user_info_1
             ON (atd_sub_status._entry_by = st_user_info_1.user_id))
         left JOIN _int_subject sb
            ON (atd_sub_status._subject_id = sb._id))
        left JOIN st_user_info st_user_info
           ON (atd_sub_status._atd_by = st_user_info.user_id))
       left JOIN st_user_info st_user_info_2
          ON (atd_sub_status._update_by = st_user_info_2.user_id)
          
  where $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ===============================================

public function subject_select_student($where_cond) {
    $data = array();
    $sql = "SELECT sl._id,
       sl._section_id,
       sl._std_id,
       std._uniq_id,
       std._class_roll,
       std._full_name,
       std._section_roll,
       std._nick_name,
       std._contact_mobile,
       sl._main_sub_ids,
       sl._3rd_sub_id,
       sl._4th_sub_id,
       sl._status
  FROM _int_subject_select sl
       left JOIN _pf_std_personal_info std
          ON (sl._std_id = std._id)
          
  where $where_cond";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ==================================

public function subject_select_student_rows($where_cond) {
    $data = array();

    $sql = "SELECT sl._id,
       sl._section_id,
       sl._session,
       sl._std_id,
       std._uniq_id,
       std._class_roll,
       std._full_name,
       std._section_roll,
       std._nick_name,
       std._contact_mobile,
       sl._main_sub_ids,
       sl._3rd_sub_id,
       sl._4th_sub_id,
       sl._status
  FROM _int_subject_select sl
       left JOIN _pf_std_personal_info std
          ON (sl._std_id = std._id)
          
  where $where_cond";

$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    return $total_rows = $q->rowCount();   
}

// ===================Exam Part===================================

public function sub_wise_std($section_id,$session,$sub_id) {
    $data = array();
    $sql = "SELECT 
    _id,
    _section_id,
    _std_id,
    CONCAT(
        IF(_main_sub_ids = 0,'',_main_sub_ids),
        IF(_combined_sub_ids = 0,'',CONCAT(',',_combined_sub_ids)),
        IF(_3rd_sub_id = 0,'',CONCAT(',',_3rd_sub_id)),
        IF(_4th_sub_id = 0, '',CONCAT(',',_4th_sub_id))
    ) AS _sub_ids,
    _status

FROM _int_subject_select

WHERE 

_section_id=".$section_id." AND 
_session=".$session." AND
FIND_IN_SET(".$sub_id.", (CONCAT(
    IF(_main_sub_ids = 0,'',_main_sub_ids),
    IF(_combined_sub_ids = 0,'',CONCAT(',',_combined_sub_ids)),
    IF(_3rd_sub_id = 0,'',CONCAT(',',_3rd_sub_id)),
    IF(_4th_sub_id = 0, '',CONCAT(',',_4th_sub_id))
))) > 0";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ====================================

public function std_list_mark_entry($wher_cond) {
    $data = array();
    $sql = "SELECT m_sh._id,
       m_sh._term_id,
       m_sh._session,
       m_sh._section_id,
       m_sh._sub_select_id,
       m_sh._std_id,
       std._status AS _std_status,
       std._uniq_id,
       std._full_name,
       std._nick_name,
       std._class_roll,
       std._section_roll,
       std._contact_mobile,
       m_sh._subject_id,
       sub._full_asign_mark,
       sub._pass_mark_percent,
       sub._subjective_asign_mark,
       sub._subjective_pass_mark,
       sub._objective_asign_mark,
       sub._objective_pass_mark,
       sub._ct_asign_mark,
       sub._ct_pass_mark,
       sub._practical_asign_mark,
       sub._practical_pass_mark,
       sub._spot_asign_mark,
       sub._spot_pass_mark,
       m_sh._subj_marks,
       m_sh._obj_marks,
       m_sh._ct_marks,
       m_sh._pract_marks,
       m_sh._spot_marks,
       m_sh._total_marks,
       m_sh._gpa,
       m_sh._grade,
       m_sh._status,
       m_sh._comments
  FROM (_ex_mark_sheet m_sh
        left JOIN _pf_std_personal_info std
           ON (m_sh._std_id = std._id))
       left JOIN _int_subject sub ON (m_sh._subject_id = sub._id)

  WHERE $wher_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ==============================================

public function std_list_mark_entry_row($wher_cond) {
    $data = array();

    $sql = "SELECT m_sh._id,
       m_sh._term_id,
       m_sh._session,
       m_sh._section_id,
       m_sh._sub_select_id,
       m_sh._std_id,
       std._status AS _std_status,
       m_sh._subject_id,
       m_sh._status
  FROM (_ex_mark_sheet m_sh
        left JOIN _pf_std_personal_info std
           ON (m_sh._std_id = std._id))
       left JOIN _int_subject sub ON (m_sh._subject_id = sub._id)

  WHERE $wher_cond";

$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    return $total_rows = $q->rowCount();   
}

// ====================

public function View_Section_homework($where_cond) {
    $data = array();
    $sql = "SELECT hom._id,
       hom._homework_status,
       hom._approve_satus,
       usr.user_full_name,
       usr.user_login_id,
       hom._homework_time,
       hom._homework_comments,
       sh._id AS _sh_id,
       sh._name AS _sh_name,
       me._id AS _me_id,
       me._name AS _me_name,
       cl._id AS _cl_id,
       cl._name AS _cl_name,
       dp._id AS _dp_id,
       dp._name AS _dp_name,
       st._id AS _st_id,
       st._name AS _st_name,
       sc._id AS _sc_id,
       sc._name AS _sc_name,
       hom._entry_date
  FROM ((((((_int_institute_setup dp
             left JOIN _int_institute_setup cl
                ON (dp._pid = cl._id))
            left JOIN ._int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _homework_daily_status_class hom
             ON (hom._section_id = sc._id))
         left JOIN st_user_info usr ON (hom._homework_by = usr.user_id))
        left JOIN _int_institute_setup me ON (cl._pid = me._id))
       left JOIN _int_institute_setup sh ON (me._pid = sh._id)
       
   where $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================================


public function View_Student_List_with_topics($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
      cl._name AS _class_name,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
     pf_std._current_guardian,
     pf_std._gender,
     mot._mobile_no AS mother_phone,
     fath._mobile_no AS father_phone,
     gur._mobile_no AS guardian_phone,
       hmc._homework_message_status,
       hmc._homework_topics,
       hmc._homework_common_topics
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
      left JOIN  _homework_daily_by_class hmc
         ON (hmc._std_id = pf_std._id)  
   left JOIN  _pf_guardian_spouse_info mot
    ON (pf_std._id = mot._pid AND mot._type = "S" AND mot._info_type = "F" )
  left JOIN _pf_guardian_spouse_info fath
     ON (pf_std._id = fath._pid AND fath._type = "S" AND fath._info_type = "M") 
   left JOIN _pf_guardian_spouse_info gur
     ON (pf_std._id = gur._pid AND gur._type = "S" AND gur._info_type = "O" )
    
    where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ================================================



function Update_Data_with_cond_return_row_count($table_name, $column, $where_clause='') {

    $whereSQL = '';
    
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            $whereSQL = " WHERE ".$where_clause;
        }
        else
        {
            $whereSQL = " ".trim($where_clause);
        }

    $sql = "UPDATE ".$table_name." SET ";
    $sets = array();
    
    $sql .= $whereSQL;
    $q = $this->con1->prepare($sql);
    return $q->execute() or die(print_r($q->errorInfo()));
}


// ========================================================================

// Data Update By Check Duplicate Function
function Update_Or_Insert_Data_By_Check_Duplicate($table_name, $column, $where_clause) {
  
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
  
    $sql_select = "SELECT * FROM ".$table_name." WHERE $where_clause";
    $ch_data = $this->con1->prepare($sql_select);
    $ch_data->execute(array());
    $total = $ch_data->rowCount();
    
  
  
    if($total=='0'){
       
    $sql = "INSERT INTO ".$table_name." SET ".$column ;
  }else{
    $sql = "UPDATE ".$table_name." SET ".$column."  ".$whereSQL;
  
  }
  
     $q = $this->con1->prepare($sql);
   return $q->execute() or die(print_r($q->errorInfo()));
}


// =====================


public function View_Section_detention($where_cond) {
    $data = array();
    $sql = "SELECT hom._id,
       hom._detention_status,
       hom._approve_satus,
       usr.user_full_name,
       usr.user_login_id,
     hom._detention_time,
       hom._detention_comments,
       sh._id AS _sh_id,
       sh._name AS _sh_name,
       me._id AS _me_id,
       me._name AS _me_name,
       cl._id AS _cl_id,
       cl._name AS _cl_name,
       dp._id AS _dp_id,
       dp._name AS _dp_name,
       st._id AS _st_id,
       st._name AS _st_name,
       sc._id AS _sc_id,
       sc._name AS _sc_name,
       hom._entry_date
  FROM ((((((_int_institute_setup dp
             left JOIN _int_institute_setup cl
                ON (dp._pid = cl._id))
            left JOIN ._int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _detention_daily_status_class hom
             ON (hom._section_id = sc._id))
         left JOIN st_user_info usr ON (hom._detention_by = usr.user_id))
        left JOIN _int_institute_setup me ON (cl._pid = me._id))
       left JOIN _int_institute_setup sh ON (me._pid = sh._id)
       
   where $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// =========================================


public function View_Student_List_with_topics_detention($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
      cl._name AS _class_name,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
     pf_std._current_guardian,
     mot._mobile_no AS mother_phone,
     fath._mobile_no AS father_phone,
     gur._mobile_no AS guardian_phone,
       hmc._detention_message_status,
       hmc._detention_topics,
       hmc._detention_common_topics
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
      left JOIN  _detention_daily_by_class hmc
        ON (hmc._std_id = pf_std._id)
   left JOIN  _pf_guardian_spouse_info mot
    ON (pf_std._id = mot._pid AND mot._type = "S" AND mot._info_type = "F" )
  left JOIN _pf_guardian_spouse_info fath
     ON (pf_std._id = fath._pid AND fath._type = "S" AND fath._info_type = "M") 
  left JOIN _pf_guardian_spouse_info gur
     ON (pf_std._id = gur._pid AND gur._type = "S" AND gur._info_type = "O" )  
    
      where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}



// ============================================



public function View_std_custom_report($where) {
  $data = array();
  $sql = "SELECT sp._id AS _std_id,
       sp._status,
       bf._session,
       in._id AS _institute_id,
       in._name AS _institute_name,
       br._id AS _branch_id,
       br._name AS _branch_name,
       sh._id AS _shift_id,
       sh._name AS _shift_name,
       me._id AS _medium_id,
       me._name AS _medium_name,
       cl._id AS _class_id,
       cl._name AS _class_name,
       dp._id AS _dept_id,
       dp._name AS _dept_name,
       st._id AS _std_type_id,
       st._name AS _std_type_name,
       sc._id AS _section_id,
       sc._name AS _section_name,
       sp._full_name,
       sp._nick_name,
       sp._uniq_id,
       sp._class_roll,
       sp._section_roll,
       sp._birth_reg_no,
       sp._date_of_birth,
       sp._gender,
       bg._name AS _blood_group,
       rg._name AS _religion,
       sp._nationality,
       qt._name,
       sp._std_mobile,
       sp._contact_email,
       sp._contact_mobile,
       sp._image_location,
       sp._current_guardian,
       pr_add._type,
       pr_add._info_type,
       pr_add._address AS _present_address,
       pr_dist._name AS _present_district,
       pr_th._name AS _present_thana,
       par_add._type,
       par_add._info_type,
       par_add._address AS _parmanet_address,
       par_dist._name AS _parmanet_district,
       par_th._name AS _parmanet_thana,
       cg._type AS _cg_type,
       cg._info_type AS _cg_info_type,
       cg._full_name AS _cg_full_name,
       coc._name AS _cg_ocupation,
       cbg._name AS _cg_blood_group,
       cg._nationality AS _cg_nationality,
       cg._national_id AS _cg_national_id,
       cg._yearly_income AS _cg_income,
       cg._mobile_no AS _cg_mobile,
       cg._email AS _cg_email,
       cg._home_phone AS _cg_home_phone,
       cg._office_phone AS _cg_office_phone,
       cg._office_address AS _cg_office_address,
       rl._name AS _cg_relation,
       f._type,
       f._info_type,
       f._full_name AS _f_full_name,
       f_oc._name AS _f_ocupation,
       f_bg._name AS _f_blood_group,
       f._nationality AS _f_nationality,
       f._national_id AS _f_national_id,
       f._yearly_income AS _f_income,
       f._mobile_no AS _f_mobile,
       f._email AS _f_email,
       f._home_phone AS _f_home_phone,
       f._office_phone AS _f_office_phone,
       f._office_address AS _f_office_add,
       m._type,
       m._info_type,
       m._full_name AS _m_full_name,
       m_oc._name AS _m_ocupation,
       m_bg._name AS _m_blood_group,
       m._nationality AS _m_nationality,
       m._national_id AS _m_national_id,
       m._yearly_income AS _m_income,
       m._mobile_no AS _m_mobile,
       m._email AS _m_email,
       m._home_phone AS _m_home_phone,
       m._office_phone AS _m_office_phone,
       m._office_address AS _m_office_add
  FROM (((((((((((((((((((((((((((_int_institute_setup cl
                                  LEFT JOIN _int_institute_setup me
                                     ON (cl._pid = me._id))
                                 LEFT JOIN _int_institute_setup sh
                                    ON (me._pid = sh._id))
                                LEFT JOIN _int_institute_setup br
                                   ON (sh._pid = br._id))
                               LEFT JOIN _int_institute_setup `in`
                                  ON (br._pid = `in`._id))
                              LEFT JOIN _int_institute_setup dp
                                 ON (dp._pid = cl._id))
                             LEFT JOIN _int_institute_setup st
                                ON (st._pid = dp._id))
                            LEFT JOIN _int_institute_setup sc
                               ON (sc._pid = st._id))
                           LEFT JOIN _pf_std_basic_info bf
                              ON (bf._section_id = sc._id))
                          LEFT JOIN _pf_std_personal_info sp
                             ON (sp._id = bf._pid))
                         LEFT JOIN _int_common_setup bg
                            ON (sp._blood_group_id = bg._id))
                        LEFT JOIN _int_common_setup rg
                           ON (sp._religion = rg._id))
                       LEFT JOIN _int_common_setup qt
                          ON (sp._quota_id = qt._id))
                      LEFT JOIN _pf_address_info pr_add
                         ON (sp._id = pr_add._pid))
                     LEFT JOIN _int_country pr_dist
                        ON (pr_add._district_id = pr_dist._id))
                    LEFT JOIN _int_country pr_th
                       ON (pr_add._thana_id = pr_th._id))
                   LEFT JOIN _pf_address_info par_add
                      ON (sp._id = par_add._pid))
                  LEFT JOIN _int_country par_dist
                     ON (par_add._district_id = par_dist._id))
                 LEFT JOIN _int_country par_th
                    ON (par_add._thana_id = par_th._id))
                LEFT JOIN _pf_guardian_spouse_info f
                   ON (sp._id = f._pid AND f._info_type = 'f'))
               LEFT JOIN _int_common_setup f_oc
                  ON (f._occupation_id = f_oc._id))
              LEFT JOIN _int_common_setup f_bg
                 ON (f._blood_group_id = f_bg._id))
             LEFT JOIN _pf_guardian_spouse_info m
                ON (sp._id = m._pid AND  m._info_type = 'm'))
            LEFT JOIN _int_common_setup m_oc
               ON (m._occupation_id = m_oc._id))
           LEFT JOIN _int_common_setup m_bg
              ON (m._blood_group_id = m_bg._id))
          LEFT JOIN _pf_guardian_spouse_info cg
             ON (sp._id = cg._pid AND sp._current_guardian = cg._info_type))
         LEFT JOIN _int_common_setup coc
            ON (cg._occupation_id = coc._id))
        LEFT JOIN _int_common_setup cbg
           ON (cg._blood_group_id = cbg._id))
       LEFT JOIN _int_common_setup rl
          ON (cg._relation_id = rl._type)
 WHERE 
       ((pr_add._type = 'S')
      ANd (pr_add._info_type = 'present')
       AND (par_add._type = 'S')
       AND (par_add._info_type = 'parmanent'))
       
       
       AND $where
              
       
GROUP BY sp._id";

$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;

}



// ======================================



public function View_Student_List_atttd_with_comment($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._current_guardian,
     mot._mobile_no AS mother_phone,
     fath._mobile_no AS father_phone,
     gur._mobile_no AS guardian_phone,
       hmc._atd_status,
    hmc._late_time,
       hmc._comments
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
      left JOIN  _atd_daily_by_class hmc
        ON (hmc._std_id = pf_std._id AND hmc._atd_status != "P")
     left JOIN  _pf_guardian_spouse_info mot
    ON (pf_std._id = mot._pid AND mot._type = "S" AND mot._info_type = "F" )
   left JOIN  _pf_guardian_spouse_info fath
     ON (pf_std._id = fath._pid AND fath._type = "S" AND fath._info_type = "M") 
   left JOIN  _pf_guardian_spouse_info gur
     ON (pf_std._id = gur._pid AND gur._type = "S" AND gur._info_type = "O" )
       
      where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}



// ============================================



public function View_Student_List_atttd_with_comment_subject_wise($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
      cl._name AS _class_name,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
       hmc._atd_status,
    hmc._late_time,
       hmc._comments
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
   left JOIN  _atd_daily_by_subject hmc
      ON (hmc._std_id = pf_std._id AND hmc._atd_status != "P")  where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ==================================

public function View_std_trabulation($where_cond) {
    $data = array();
    $sql = "SELECT sub_s._id,
       sub_s._section_id,
       sub_s._session,
       std._id AS std_id,
       std._uniq_id,
       std._class_roll,
       std._section_roll,
       std._full_name,
       std._nick_name,
       std._std_mobile,
       std._contact_email,
       std._contact_mobile,
       std._current_guardian,
       sub_s._combined_sub_ids,
       sub_s._main_sub_ids,
       sub_s._3rd_sub_id,     
       sub_s._4th_sub_id,
       CONCAT(
        IF(sub_s._main_sub_ids = 0,'',sub_s._main_sub_ids),
        IF(sub_s._combined_sub_ids = 0,'',CONCAT(',',sub_s._combined_sub_ids))
        ) AS _main_cmb_sub_ids, 
        CONCAT(
        IF(sub_s._main_sub_ids = 0,'',sub_s._main_sub_ids),
        IF(sub_s._combined_sub_ids = 0,'',CONCAT(',',sub_s._combined_sub_ids)),
        IF(sub_s._3rd_sub_id = 0,'',CONCAT(',',sub_s._3rd_sub_id))
        ) AS _main_3rd_sub_ids, 
        CONCAT(
        IF(sub_s._main_sub_ids = 0,'',sub_s._main_sub_ids),
        IF(sub_s._3rd_sub_id = 0,'',CONCAT(',',sub_s._3rd_sub_id))
        ) AS _main_all_sub_ids,
        CONCAT(
        IF(sub_s._main_sub_ids = 0,'',sub_s._main_sub_ids),
        IF(sub_s._combined_sub_ids = 0,'',CONCAT(',',sub_s._combined_sub_ids)),
        IF(sub_s._3rd_sub_id = 0,'',CONCAT(',',sub_s._3rd_sub_id)),
        IF(sub_s._4th_sub_id = 0,'',CONCAT(',',sub_s._4th_sub_id))
        ) AS _all_sub_ids,          
        sub_s._status
        
        FROM 
        _int_subject_select sub_s
        LEFT JOIN 
        _pf_std_personal_info std ON (sub_s._std_id = std._id)

    WHERE $where_cond";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================

public function View_branch_details_By_Cond($_pid){
 $sql='SELECT 
      (i._name) as insName,
      (id._code_name) as insCodeName, 
      d.*, 
      dv._name as division_name, 
      dis._name as distrinc_name ,
      tn._name as thana_name 
      FROM 
        _int_institute_setup i
        LEFT JOIN  _int_institute_setup b on i._id = b._pid
         LEFT JOIN _int_inst_br_details d ON b._id = d._pid AND d._type = "B"  
         LEFT JOIN _int_inst_br_details id ON i._id = id._pid AND id._type = "I" 
        LEFT JOIN _int_country dv ON  d._division = dv._id AND dv._type = "DV" 
       LEFT JOIN  _int_country dis ON  d._district = dis._id  AND  dis._type = "DC"
      LEFT JOIN  _int_country tn ON d._thana = tn._id AND tn._type = "TH" 
    WHERE 
      b._id="' . $_pid .'" AND b._type = "B"   ';
  $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  $data = $q->fetch(PDO::FETCH_OBJ);
  return isset($data)? $data :NULL;
 }



//===========================================================================

public function View_Institute_details_By_ID($_pid){
 $sql='SELECT 
      (i._name) as insName, 
      d.*, 
      dv._name as division_name, 
      dis._name as distrinc_name ,
      tn._name as thana_name 
      FROM 
        _int_institute_setup i
         LEFT JOIN _int_inst_br_details d ON i._id = d._pid AND d._type = "I" 
        LEFT JOIN _int_country dv ON  d._division = dv._id AND dv._type = "DV" 
       LEFT JOIN  _int_country dis ON  d._district = dis._id  AND  dis._type = "DC"
      LEFT JOIN  _int_country tn ON d._thana = tn._id AND tn._type = "TH" 
    WHERE 
      i._id="' . $_pid .'" AND i._type = "I"   ';
   $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  $data = $q->fetch(PDO::FETCH_OBJ);
  return isset($data)? $data :NULL;
 }

// ============================================

/* emp report */


public function View_emp_custom_report($where) {
  $data = array();
  $sql = 'SELECT ep._id,
       ep._status,
       br._id AS _branch_id,
       br._name AS _branch_name,
       ins._id AS _institute_id,
       ins._name AS _institute_name,
       ep._uniq_id,
       ep._full_name,
       ep._nick_name,
       ep._code_name,
       ep._emp_code,
       ep._date_of_birth,
       ep._gender,
       ep._marital_status,
       bg._name AS _blood_group,
       rl._name AS _religion,
       ep._nationality,
       ep._national_id_no,
       qt._name AS _quata,
       ep._profession_id AS _profession,
       dpt._name AS _department,
       desig._name AS _designation,
       sc._name AS _section,
       ep._joining_date,
       ep._last_promotion_date,
       ep._contact_email,
       ep._contact_mobile_no,
       ep._home_phone,
       ep._office_phone,
       ep._hoby,
       ep._image_location,
       pre_ad._address AS _present_add,
       pre_dist._name AS _present_dist,
       pre_th._name AS _present_thana,
       par_ad._address AS _parmanent_add,
       par_dist._name AS _parmanent_dist,
       par_th._name AS _parmanent_thana,
       spous._full_name AS _spaous_name,
       ocp._name AS _spaous_ocupation,
       s_bg._name AS _spaous_blood,
       spous._nationality AS _spaous_nationality,
       spous._national_id AS _spaous_national_id,
       spous._yearly_income AS _spaous_income,
       spous._mobile_no AS _spaous_mobile,
       spous._email AS _spaous_email,
       spous._home_phone AS _spaous_home_phone,
       spous._office_phone AS _spaous_office_phone,
       spous._office_address AS _spaous_office_address
  FROM ((((((((((((((((_pf_address_info pre_ad
                        LEFT JOIN _int_country pre_dist
                           ON (pre_ad._district_id = pre_dist._id))
                       LEFT JOIN _pf_emp_personal_info ep
                          ON (ep._id = pre_ad._pid))
                      LEFT JOIN _int_institute_setup br
                         ON (ep._branch_id = br._id))
                     LEFT JOIN _int_institute_setup ins
                        ON (br._pid = ins._id))
                    LEFT JOIN _int_common_setup bg
                       ON (ep._blood_group_id = bg._id))
                   LEFT JOIN _int_common_setup rl
                      ON (ep._religion_id = rl._id))
                  LEFT JOIN _int_common_setup qt
                     ON (ep._quota_id = qt._id))
                LEFT JOIN _int_common_setup dpt
                   ON (ep._department_id = dpt._id))
               LEFT JOIN _int_common_setup desig
                  ON (ep._designation_id = desig._id))
              LEFT JOIN _int_common_setup sc
                 ON (ep._section_id = sc._id))
             LEFT JOIN _pf_address_info par_ad
                ON (ep._id = par_ad._pid))
            LEFT JOIN _int_country par_dist
               ON (par_ad._district_id = par_dist._id))
           LEFT JOIN _int_country par_th
              ON (par_ad._thana_id = par_th._id))
          LEFT JOIN _pf_guardian_spouse_info spous
             ON (ep._id = spous._pid))
         LEFT JOIN _int_common_setup ocp
            ON (spous._occupation_id = ocp._id))
        LEFT JOIN _int_common_setup s_bg
           ON (spous._blood_group_id = s_bg._id))
       LEFT JOIN _int_country pre_th
          ON (pre_ad._thana_id = pre_th._id)
 WHERE 
 
      ((pre_ad._type = "E")
       AND (pre_ad._info_type = "present")
       AND (par_ad._type = "E")
       AND (par_ad._info_type = "parmanent")
       AND (spous._type = "E")
       AND (spous._info_type = "S"))
       AND ep._id!=""
       
      
           
 
       '.$where.'
           
 GROUP BY ep._id ';

$q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;


}

// ===========================

public function num_of_rows($table,$where_cond=1){
 $sql='SELECT count(*) as num From '.$table.' WHERE '.$where_cond ;
   $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  $data = $q->fetch(PDO::FETCH_OBJ);
  return isset($data)? $data :NULL;
 }

// =============================

 // Grade Check Function
public function Grade_check($where_cond){
 $sql="SELECT _grade,MAX(_gpa) FROM _int_grading_system WHERE $where_cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $row = $q->fetch(PDO::FETCH_ASSOC);
 $grade = $row['_grade'];
 return isset($grade)? $grade :NULL;
 }
// ========================


  // Grade Check Function
public function Gpa_check($where_cond){
 $sql="SELECT _gpa,MAX(_gpa) FROM _int_grading_system WHERE $where_cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $row = $q->fetch(PDO::FETCH_ASSOC);
 $gpa = $row['_gpa'];
 return isset($gpa)? $gpa :NULL;
 }
// ========================




public function Combined_Mark($where_cond){

 $sql="SELECT m_sh._id,      
       trm._term_type,
       m_sh._session,
       m_sh._section_id,
       m_sh._sub_select_id,
       m_sh._std_id,
       m_sh._subject_id,
       m_sh._subject_type,
       m_sh._combined_sub_id,
       m_sh._subj_marks,
       ROUND(SUM((m_sh._subj_marks*trm._count_mark)/100)/2) AS _subj_marks_avg,
       m_sh._obj_marks,
       ROUND(SUM((m_sh._obj_marks*trm._count_mark)/100)/2) AS _obj_marks_avg,
       m_sh._ct_marks,
       ROUND(SUM((m_sh._ct_marks*trm._count_mark)/100)/2) AS _ct_marks_avg,
       m_sh._pract_marks,
       ROUND(SUM((m_sh._pract_marks*trm._count_mark)/100)/2) AS _pract_marks_avg,
       m_sh._spot_marks,
       ROUND(SUM((m_sh._spot_marks*trm._count_mark)/100)/2) AS _spot_marks_avg,
       trm._count_mark,
       m_sh._total_marks,
              
       (ROUND(SUM((m_sh._subj_marks*trm._count_mark)/100)/2)+
       ROUND(SUM((m_sh._obj_marks*trm._count_mark)/100)/2)+
       ROUND(SUM((m_sh._ct_marks*trm._count_mark)/100)/2)+
       ROUND(SUM((m_sh._pract_marks*trm._count_mark)/100)/2)+
       ROUND(SUM((m_sh._spot_marks*trm._count_mark)/100)/2)) AS _total_mark_avg,
       
       m_sh._status,
       m_sh._comments
       
      FROM 
      _ex_mark_sheet m_sh
      LEFT JOIN 
      _int_exam_term trm ON (m_sh._term_id = trm._id)
            
       
     WHERE $where_cond";

 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
 }
// ========================


 public function Others_sub_marks($where_cond){

 $sql="SELECT m_sh._id,      
       trm._term_type,
       m_sh._session,
       m_sh._section_id,
       m_sh._sub_select_id,
       m_sh._std_id,
       m_sh._subject_id,
       m_sh._subject_type,
       m_sh._combined_sub_id,
       m_sh._subj_marks,
       ROUND(SUM((m_sh._subj_marks*trm._count_mark)/100)) AS _subj_marks_avg,
       m_sh._obj_marks,
       ROUND(SUM((m_sh._obj_marks*trm._count_mark)/100)) AS _obj_marks_avg,
       m_sh._ct_marks,
       ROUND(SUM((m_sh._ct_marks*trm._count_mark)/100)) AS _ct_marks_avg,
       m_sh._pract_marks,
       ROUND(SUM((m_sh._pract_marks*trm._count_mark)/100)) AS _pract_marks_avg,
       m_sh._spot_marks,
       ROUND(SUM((m_sh._spot_marks*trm._count_mark)/100)) AS _spot_marks_avg,
       trm._count_mark,
       m_sh._total_marks,
              
       (ROUND(SUM((m_sh._subj_marks*trm._count_mark)/100))+
       ROUND(SUM((m_sh._obj_marks*trm._count_mark)/100))+
       ROUND(SUM((m_sh._ct_marks*trm._count_mark)/100))+
       ROUND(SUM((m_sh._pract_marks*trm._count_mark)/100))+
       ROUND(SUM((m_sh._spot_marks*trm._count_mark)/100))) AS _total_mark_avg,
       
       m_sh._status,
       m_sh._comments
       
      FROM 
      _ex_mark_sheet m_sh
      LEFT JOIN 
      _int_exam_term trm ON (m_sh._term_id = trm._id)
            
       
     WHERE $where_cond";

 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 $data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
 }
// ========================




// ========================
public function Combined_sub_total($where_cond) {
    $data = array();

 $sql="SELECT *
FROM
(
SELECT SUM(abc._total_mark_avg) AS _comb_total,SUM(abc.gpa) AS _comb_gpa
FROM

(
SELECT *, 
(
SELECT `_gpa` 
FROM 
_int_grading_system gs 

WHERE 
`_branch_id`=tbl_mark._branch_id AND 
(tbl_mark._total_mark_avg BETWEEN `_from_mark` AND `_to_mark`)
) AS gpa

FROM 
(SELECT 
m_sh._id,
trm._term_name,       
trm._term_type,
trm._branch_id,
m_sh._session,
m_sh._section_id,
m_sh._sub_select_id,
m_sh._std_id,
m_sh._subject_id,
m_sh._subject_type,
m_sh._combined_sub_id,      

(ROUND(SUM((m_sh._subj_marks*trm._count_mark)/100)/2)+
ROUND(SUM((m_sh._obj_marks*trm._count_mark)/100)/2)+
ROUND(SUM((m_sh._ct_marks*trm._count_mark)/100)/2)+
ROUND(SUM((m_sh._pract_marks*trm._count_mark)/100)/2)+
ROUND(SUM((m_sh._spot_marks*trm._count_mark)/100)/2)) AS _total_mark_avg,
m_sh._status,
m_sh._comments
     
FROM 
_ex_mark_sheet m_sh
LEFT JOIN 
_int_exam_term trm ON (m_sh._term_id = trm._id)

WHERE ".$where_cond."

GROUP BY m_sh._combined_sub_id

) AS tbl_mark
) AS abc
) AS tbl_comb";
 $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================


// ========================
public function Main_3rd_sub_total($where_cond) {
    $data = array();

 $sql="SELECT *
FROM
(
SELECT SUM(abc._total_mark_avg) AS _main_3rd_total,SUM(abc.gpa) AS _main_3rd_gpa
FROM

(
SELECT *, 
(
SELECT `_gpa` 
FROM 
_int_grading_system gs 

WHERE 
`_branch_id`=tbl_mark._branch_id AND 
(tbl_mark._total_mark_avg BETWEEN `_from_mark` AND `_to_mark`)
) AS gpa

FROM 
(SELECT 
m_sh._id,
trm._term_name,       
trm._term_type,
trm._branch_id,
m_sh._session,
m_sh._section_id,
m_sh._sub_select_id,
m_sh._std_id,
m_sh._subject_id,
m_sh._subject_type,
m_sh._combined_sub_id,      

(ROUND(SUM(m_sh._subj_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._obj_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._ct_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._pract_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._spot_marks*trm._count_mark)/100)) AS _total_mark_avg,
m_sh._status,
m_sh._comments
     
FROM 
_ex_mark_sheet m_sh
LEFT JOIN 
_int_exam_term trm ON (m_sh._term_id = trm._id)

WHERE ".$where_cond."

GROUP BY m_sh._subject_id

) AS tbl_mark
) AS abc
) AS tbl_main_3rd";
 $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================


// ========================
public function Ssub_total_4th($where_cond) {
    $data = array();

 $sql="SELECT *
FROM
(
SELECT abc._subject_id,SUM(abc._total_mark_avg) AS _4th_total,SUM(abc.gpa) AS _4th_gpa
FROM

(
SELECT *, 
(
SELECT `_gpa` 
FROM 
_int_grading_system gs 

WHERE 
`_branch_id`=tbl_mark._branch_id AND 
(tbl_mark._total_mark_avg BETWEEN `_from_mark` AND `_to_mark`)
) AS gpa

FROM 
(SELECT 
m_sh._id,
trm._term_name,       
trm._term_type,
trm._branch_id,
m_sh._session,
m_sh._section_id,
m_sh._sub_select_id,
m_sh._std_id,
m_sh._subject_id,
m_sh._subject_type,
m_sh._combined_sub_id,      

(ROUND(SUM(m_sh._subj_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._obj_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._ct_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._pract_marks*trm._count_mark)/100)+
ROUND(SUM(m_sh._spot_marks*trm._count_mark)/100)) AS _total_mark_avg,
m_sh._status,
m_sh._comments
     
FROM 
_ex_mark_sheet m_sh
LEFT JOIN 
_int_exam_term trm ON (m_sh._term_id = trm._id)

WHERE ".$where_cond."

) AS tbl_mark
) AS abc
) AS tbl_4th";
 $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================




// View All Data Condition wise Function
public function View_fee_assign_Cond($where_cond) {
    $data = array();
    $sql = "SELECT fd._id,
       fd._branch_id,
       br._name AS _br_name,
       sh._id AS _sh_id,
       sh._name AS _sh_name,
       me._id AS _me_id,
       me._name AS _me_name,
       cl._id AS _class_id,
       cl._name AS _cl_name,
       fd._dept_id,
       dp._name AS _dp_name,
       fd._fee_head_id,
       fh._fee_head,
       fd._fee_amount,
       fd._status,
       fd._entry_by,
       fd._entry_date,
       fd._update_by,
       fd._last_update
  FROM (((((_int_institute_setup me
           INNER JOIN _int_institute_setup sh ON (me._pid = sh._id))
          INNER JOIN _int_institute_setup cl ON (cl._pid = me._id))
          INNER JOIN _int_institute_setup dp ON (dp._pid = cl._id))
         INNER JOIN _int_class_fee_declare fd
            ON (fd._dept_id = dp._id AND fd._id!= ''))
        LEFT JOIN _int_institute_setup br
           ON (fd._branch_id = br._id))
       LEFT JOIN _int_fee_head fh ON (fd._fee_head_id = fh._id)

       WHERE $where_cond";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================


public function View_Student_List_scholarship($where_cond) {
    $data = array();
    $sql = "SELECT pf_std._id,
       bsf._id AS _base_id,
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
       pf_std._image_location,
       schlor._id AS schlor_id,
       schlor._scholar_amount,
       schlor._purpose,
       schlor._months,
       schlor._session AS schlor_session
  FROM (((((((((((._int_institute_setup br
                 LEFT JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                LEFT JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               LEFT JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              LEFT JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             LEFT JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            LEFT JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           LEFT JOIN _int_institute_setup sc ON (sc._pid = st._id))
          LEFT JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         LEFT JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
  LEFT JOIN _int_scholarship_declare schlor
           ON (pf_std._id = schlor._std_id))
           
            
        LEFT JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       LEFT JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)          
  WHERE $where_cond";
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ====================================


public function mark_sheet($where_cond) {
  
  $data = array();

 $sql="SELECT 
sp._id,
sp._uniq_id,
sp._class_roll,
sp._section_roll,
sp._nick_name,
sp._full_name,
ex._id,
ex._term_id,
ex._session,
 ex._section_id,
 ex._sub_select_id,
 ex._std_id,
 ex._subject_id,
 ex._subject_type,
 ex._combined_sub_id,
 ex._subj_marks,
 ex._obj_marks,
 ex._ct_marks,
 ex._pract_marks,
 ex._spot_marks,
 ex._total_marks,
ex._gpa,
ex._grade,
ex._status,
ex._comments
        
FROM (`_ex_mark_sheet` ex
LEFT JOIN _pf_std_personal_info sp
ON (sp._id = ex._std_id))
WHERE ".$where_cond."";
  
  
  $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;
  
}

// ===========================


public function View_class_fee($cond) {
    $data = array();
    $sql = "SELECT fdc._id,
       fdc._branch_id,
       fdc._dept_id,
       fdc._fee_head_id,
       fh._fee_head,
       fh._fee_type,
       fdc._fee_amount,
       fdc._status
    FROM 
    _int_class_fee_declare fdc
    LEFT JOIN _int_fee_head fh
    ON (fdc._fee_head_id = fh._id)

    WHERE $cond";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================



// Attendance Fine Calculation
public function atd_fine_calculation($where_cond) {
    $data = array();
    $sql = "SELECT atd._id,
       ins.branch_id,
       ins.class_id,
       atd._section_id,
       atd._std_id,
       COUNT(atd._atd_status) AS _atd_statust_days,
       (FLOOR(COUNT(atd._atd_status)/atf._absent_days)*atf._absent_fee) AS _atd_absent_amount,
       (FLOOR(COUNT(atd._atd_status)/atf._late_days)*atf._late_fee) AS _atd_late_amount,
       atd._entry_by,
       atd._entry_date,
       atd._update_by,
       atd._last_update,
       atf._absent_days,
       atf._absent_fee,
       atf._late_days,
       atf._late_fee,
       atf._status
  FROM (_int_institute_setup_vw ins
        INNER JOIN _fee_atd_fine_dec atf
           ON (ins.branch_id = atf._br_id))
       INNER JOIN _atd_daily_by_class atd
          ON (atd._section_id = ins.section_id)
          
    WHERE $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}



// =======================================


public function View_Student_List_atttd_status_classwise($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
     cl._name AS _class_name,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
     pf_std._gender,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._current_guardian,
     mot._mobile_no AS mother_phone,
     fath._mobile_no AS father_phone,
     gur._mobile_no AS guardian_phone,
       hmc._atd_status,
    hmc._late_time,
       hmc._comments
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
      left JOIN  _atd_daily_by_class hmc
        ON (hmc._std_id = pf_std._id )
     left JOIN  _pf_guardian_spouse_info mot
    ON (pf_std._id = mot._pid AND mot._type = "S" AND mot._info_type = "F" )
   left JOIN  _pf_guardian_spouse_info fath
     ON (pf_std._id = fath._pid AND fath._type = "S" AND fath._info_type = "M") 
   left JOIN  _pf_guardian_spouse_info gur
     ON (pf_std._id = gur._pid AND gur._type = "S" AND gur._info_type = "O" )
       
      where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// =======================================


public function View_Student_List_atttd_subject_wise_with_present($where_cond) {
    $data = array();
    $sql = 'SELECT pf_std._id,
       sc._id AS _section_id,
       sc._name AS _section,
       cl._id AS _class_id,
       pf_std._uniq_id,
       pf_std._class_roll,
       pf_std._section_roll,
       pf_std._full_name,
       pf_std._nick_name,
       pf_std._std_mobile,
       pf_std._contact_email,
       pf_std._contact_mobile,
       hmc._atd_status,
       hmc._late_time,
       hmc._comments,
     pf_std._current_guardian,
     mot._mobile_no AS mother_phone,
     fath._mobile_no AS father_phone,
     gur._mobile_no AS guardian_phone
  FROM ((((((((((._int_institute_setup br
                 left JOIN _int_institute_setup i
                    ON (br._pid = i._id))
                left JOIN _int_institute_setup sh
                   ON (sh._pid = br._id))
               left JOIN _int_institute_setup me
                  ON (me._pid = sh._id))
              left JOIN _int_institute_setup cl
                 ON (cl._pid = me._id))
             left JOIN _int_institute_setup dp
                ON (dp._pid = cl._id))
            left JOIN _int_institute_setup st
               ON (st._pid = dp._id))
           left JOIN _int_institute_setup sc ON (sc._pid = st._id))
          left JOIN _pf_std_basic_info bsf
             ON (bsf._section_id = sc._id))
             
         left JOIN _pf_std_personal_info pf_std
            ON (pf_std._id = bsf._pid))
        left JOIN _int_common_setup bg
           ON (pf_std._blood_group_id = bg._id))
       left JOIN _int_common_setup rg
          ON (pf_std._religion = rg._id)
      left JOIN  _atd_daily_by_subject hmc
        ON (hmc._std_id = pf_std._id ) 
   left JOIN  _pf_guardian_spouse_info mot
    ON (pf_std._id = mot._pid AND mot._type = "S" AND mot._info_type = "F" )
    left JOIN _pf_guardian_spouse_info fath
     ON (pf_std._id = fath._pid AND fath._type = "S" AND fath._info_type = "M") 
   left JOIN  _pf_guardian_spouse_info gur
     ON (pf_std._id = gur._pid AND gur._type = "S" AND gur._info_type = "O" )  
    
     where '.$where_cond;
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    

    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// =======================================

// Invoice Check Report Function
public function invoice_check_report($br_id,$std_id) {
    $data = array();

    $sql = "SELECT
c_inv._id,
c_inv._br_id,
c_inv._invoice_no,
c_inv._month,
c_inv._year,
c_inv._class_id,
cl._name AS _class_name,
c_inv._section_id,
sc._name AS _section_name,
c_inv._std_id,
stdn._uniq_id,
stdn._full_name,
stdn._nick_name,
stdn._section_roll,
stdn._contact_mobile,
stdn._contact_email,
c_inv._cr_amount,
d_inv._dr_amount,
(CASE WHEN d_inv._dr_amount IS NULL THEN c_inv._cr_amount ELSE (c_inv._cr_amount-d_inv._dr_amount) END) AS _payable_amount,
c_inv._purpuse

FROM 

(SELECT *, SUM(`_amount`) AS _cr_amount
FROM `_fee_details_invoice`
WHERE `_invoice_no` IS NULL AND `_br_id`='$br_id' AND `_std_id`='$std_id' AND `_type`='C') AS c_inv
LEFT JOIN
(SELECT _br_id, SUM(`_amount`) AS _dr_amount
FROM `_fee_details_invoice`
WHERE `_invoice_no` IS NULL AND `_br_id`='$br_id' AND `_std_id`='$std_id' AND `_type`='D') AS d_inv
ON (c_inv._br_id = d_inv._br_id)
LEFT JOIN
_int_institute_setup AS cl
ON (c_inv._class_id=cl._id)
LEFT JOIN
_int_institute_setup AS sc
ON (c_inv._section_id=sc._id)
LEFT JOIN
`_pf_std_personal_info` AS stdn
ON (c_inv._std_id=stdn._id)";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============== Store Report On Product In=========================

public function product_in_report($where_cond,$group_by) {
    $data = array();
    $sql = "SELECT inv_in.id,
       inv_in.product_id,
       pd.name AS product_name,
       pd.`desc` AS product_desc,
       inv_in.cat_id,
       ct.name AS cat_name,
       ct.`desc` AS cat_desc,
       inv_in.type_id,
       pt.name AS type_name,
       pt.`desc` AS type_desc,
       usr.user_full_name as userName,
       sum(inv_in.product_quantity) as product_qt,
       inv_in.product_quantity as pq,
       inv_in.invoice,
       inv_in.serial,
       inv_in.cost,
       sum(inv_in.cost) as totalcost,
       inv_in.comment,
       inv_in.entry_by as entryBy,
       inv_in.br_id,
       inv_in.entry_date as entryDate,
       inv_in.update_by,
       inv_in.update_date,
       inv_in.status as status
  FROM ((str_product_inventory_in inv_in
         left JOIN str_product_type pt ON (inv_in.type_id = pt.id))
        left JOIN str_product pd ON (inv_in.product_id = pd.id))
       left JOIN str_product_category ct
          ON (inv_in.cat_id = ct.id)
       left JOIN st_user_info usr ON(inv_in.entry_by=usr.user_id)
            
          
          
   WHERE $where_cond
  group by $group_by ";
          
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============== Store Report On Product out=========================

public function product_out_report($where_cond,$group_by) {
    $data = array();
    $sql = "SELECT inv_out.id,
       inv_out.product_id,
       pd.name AS product_name,
       pd.`desc` AS product_desc,
       inv_out.cat_id,
       ct.name AS cat_name,
       ct.`desc` AS cat_desc,
       inv_out.type_id,
       pt.name AS type_name,
       pt.`desc` AS type_desc,
       usr.user_full_name as userName,
       sum(inv_out.product_quantity) as product_qt,
       inv_out.product_quantity as pq,
       inv_out.wit_by,
       inv_out.purpose,
       inv_out.comment,
       inv_out.entry_by as entryBy,
       inv_out.tag,
       inv_out.serial,
       inv_out.br_id,
       inv_out.entry_date as entryDate,
       inv_out.update_by,
       inv_out.update_date,
       inv_out.status
  FROM ((str_product_inventory_out inv_out
         left JOIN str_product_type pt ON (inv_out.type_id = pt.id))
        left JOIN str_product pd ON (inv_out.product_id = pd.id))
       left JOIN str_product_category ct
          ON (inv_out.cat_id = ct.id)
           left JOIN st_user_info usr ON(inv_out.entry_by=usr.user_id)
          
          
   WHERE $where_cond
  group by $group_by ";
          
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ============================


public function View_students_personal_details_by_uniq_id($uniq_id) {
    $data = array();
    $sql = "SELECT 
    b._section_id,
    s._id AS _st_id,
    s._uniq_id,
    s._full_name,
    s._section_roll as _roll,
        vw.medium_id  AS _medium_id,
    vw.section as section_name,
    t._in_time  AS _shif_in_time
    t._out_time  AS _shif_out_time
    FROM 
      _pf_std_personal_info s 
      INNER JOIN _pf_std_basic_info b ON s._id = b._pid
       INNER JOIN _int_institute_setup_vw vw ON b._section_id = vw.section_id
       INNER JOIN _int_shift_time t ON vw.shift_id = t._pid
       where s._uniq_id=:id AND s._status = 'A' limit 1";
    $q = $this->con1->prepare($sql);
  $q->bindValue(':id', $uniq_id, PDO::PARAM_STR);  
    $q->execute() or die(print_r($q->errorInfo()));
    $data = $q->fetchObject();;
    return isset($data)? $data :NULL;
}

// ========================
public function sudents_id_by_section($section) {
  $data = array();
    $sql = "SELECT 
    s._id 
    FROM 
      _pf_std_personal_info s 
      INNER JOIN _pf_std_basic_info b ON s._id = b._pid
       where b._section_id=:section AND s._status = 'A' ";
    $q = $this->con1->prepare($sql);
  $q->bindValue(':section', $section, PDO::PARAM_STR);   
    $q->execute() or die(print_r($q->errorInfo()));
    $data = $q->fetchAll(PDO::FETCH_OBJ);
    return isset($data)? $data :NULL;

}

// Students Details By section

// ========================
public function sudents_details_by_section($section) {
  $data = array();
    $sql = "SELECT 
    s._id,
    s._uniq_id,
    s._section_roll,
    s._full_name
    FROM 
      _pf_std_personal_info s 
      INNER JOIN _pf_std_basic_info b ON s._id = b._pid
       where b._section_id=:section AND s._status = 'A' ";
    $q = $this->con1->prepare($sql);
  $q->bindValue(':section', $section, PDO::PARAM_STR);   
    $q->execute() or die(print_r($q->errorInfo()));
    $data = $q->fetchAll(PDO::FETCH_OBJ);
    return isset($data)? $data :NULL;

}

//===================================================

public function stock_report($brunch_id) {
    $data = array();
    $sql = "SELECT 
in_sum.i_br_id,
in_sum.i_p_id,
in_sum.i_p_name,
in_sum.i_c_id,
in_sum.i_c_name,
in_sum.i_t_id,
in_sum.i_t_name,
in_sum.in_total,
out_sum.out_total,
stk.quantity AS stk_qt
from

((
SELECT `in`.id AS in_id,
       `in`.br_id AS i_br_id,
       `in`.product_id AS i_p_id,
       i_pd.name AS i_p_name,
       `in`.cat_id AS i_c_id,
       i_cat.name AS i_c_name,
       `in`.type_id AS i_t_id,
       i_type.name AS i_t_name,
       SUM(`in`.product_quantity) AS in_total,
       `in`.status AS i_st
  FROM ((str_product_inventory_in `in`
         left JOIN str_product_type i_type
            ON (`in`.type_id = i_type.id))
        left JOIN str_product i_pd ON (`in`.product_id = i_pd.id))
       left JOIN str_product_category i_cat
          ON (`in`.cat_id = i_cat.id)
 WHERE ($brunch_id ) AND (`in`.status = 'A')
GROUP BY `in`.product_id
) in_sum

left join

(SELECT `out`.id AS o_id,
       `out`.br_id AS o_br_id,
       `out`.product_id AS o_p_id,
       `out`.cat_id AS o_c_id,
       `out`.type_id AS o_t_id,
       SUM(`out`.product_quantity) AS out_total,
       `out`.status AS o_st
  FROM ((str_product_inventory_out `out`
         left JOIN str_product_type o_tp
            ON (`out`.type_id = o_tp.id))
        left JOIN str_product o_pd ON (`out`.product_id = o_pd.id))
       left JOIN str_product_category o_ct
          ON (`out`.cat_id = o_ct.id)
 WHERE ($brunch_id) AND (`out`.status = 'A')
GROUP BY `out`.product_id
) out_sum

ON (in_sum.i_p_id=out_sum.o_p_id))

Left JOIN
str_stock AS stk
ON (in_sum.i_p_id=stk.product_id) ";
          
  
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ======================================================

// View All Data Condition wise Function
public function invoice_std_list($br_id,$sec_id,$month,$year) {
    $data = array();
    $sql = "SELECT fm_inv._id,
       fm_inv._br_id,
       ins.shift_id,
       ins.shift,
       ins.medium_id,
       ins.medium,
       ins.class_id,
       ins.class,
       ins.department_id,
       ins.department,
       ins.student_type_id,
       ins.student_type,
       ins.section_id,
       ins.section,
       fm_inv._std_id,
       std._uniq_id,
       std._class_roll,
       std._section_roll,
       std._full_name,
       std._nick_name,
       std._contact_mobile,
       std._contact_email,
       fm_inv._month,
       fm_inv._year,
       fm_inv._invoice_no,
       fm_inv._amount,
       fm_inv._total_due_amount,
       fm_inv._last_paid_amount,
       fm_inv._status
  FROM (_fee_master_invoice fm_inv
        left JOIN _pf_std_personal_info std
           ON (fm_inv._std_id = std._id))
       left JOIN _int_institute_setup_vw ins
          ON (fm_inv._section_id = ins.section_id)
          
  WHERE fm_inv._br_id='$br_id' AND ins.section_id='$sec_id' AND fm_inv._month='$month' AND fm_inv._year='$year'";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}
// ========================


// ===========*************Barcode Create**************============


public function print_barcode($string, $height, $width)
  {
    $string = strtoupper($string);
   
    $string = "*".$string."*";


    $bit_string = '';
  //echo $string;
    for($i=0; $i<strlen($string); $i++)
    {
      $sql="SELECT bit FROM st_bitstring WHERE letter='$string[$i]'";
      $q = $this->con1->prepare($sql);
      $q->execute() or die(print_r($q->errorInfo()));
      $bit = $q->fetch(PDO::FETCH_ASSOC);

      $bit_string = $bit_string.$bit['bit']."0";
    }
  
    //echo "</br>".$bit_string;
    //echo strlen($bit_string);
    echo "<div style='text-align: center;'>";
    for($i=0; $i<strlen($bit_string); $i++)
    {
      if($bit_string[$i]==1){
        echo "<img src='php_crud/img/black1by1.gif' style='height:".$height."px; width:".$width."px;' />";
      }
      else{
        echo "<img src='php_crud/img/white1by1.gif' style='height:".$height."px; width:".$width."px;' />";
      }
    }
    echo "<br/>".$string."</div>";
    //echo getcwd() . "\n";
  }
// ===========*************Barcode Create End**************============

// ===============================================================

public function sect_invoice($where) {
    $data = array();
    $sql = "SELECT fm._id,
       ins.branch,
       ins.branch_id,
       ins.shift,
       ins.shift_id,
       ins.medium,
       ins.medium_id,
       ins.class,
       ins.class_id,
       ins.department,
       ins.department_id,
       ins.student_type,
       ins.student_type_id,
       ins.section,
       ins.section_id,
       fm._month,
       fm._year,
       fm._std_id,
       pf._uniq_id,
       pf._class_roll,
       pf._section_roll,
       pf._full_name,
       pf._nick_name,
       pf._contact_mobile,
       pf._contact_email,       
       fm._invoice_no,
       fm._amount,
       fm._status
       
  FROM 
  (_fee_master_invoice fm
LEFT JOIN _pf_std_personal_info pf
   ON (fm._std_id = pf._id))
LEFT JOIN _int_institute_setup_vw ins
  ON (fm._section_id = ins.section_id)
  
WHERE 
$where

";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ======================================================

public function total_cr_db($branch,$section_id,$month,$year,$std_id) {
 $data = array();
$sql = "SELECT 
cr_tbl._cr_amount,
dr_tbl._dr_amount
FROM
(
SELECT 
_std_id AS cr_std,
SUM(`_amount`) AS _cr_amount
FROM `_fee_details_invoice`
WHERE
`_br_id`='$branch' AND 
`_section_id`='$section_id'AND 
`_month`='$month' AND 
`_year`='$year' AND 
`_std_id`='$std_id' AND
`_type`='C'
GROUP BY `_type`
) AS cr_tbl

LEFT JOIN

(
SELECT 
_std_id AS dr_std,
SUM(`_amount`) AS _dr_amount
FROM `_fee_details_invoice`
WHERE

`_br_id`='$branch' AND 
`_section_id`='$section_id'AND 
`_month`='$month' AND 
`_year`='$year' AND 
`_std_id`='$std_id' AND
`_type`='D'
GROUP BY `_type`
) AS dr_tbl

ON(cr_tbl.cr_std = dr_tbl.dr_std)
";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ======================================================


public function T_Leave($where_cond) {
  $sql="SELECT
    COUNT(lv_in._id) AS _total
    FROM 
    hr_emp_leave_entry lv_in
    RIGHT JOIN hr_emp_leave_dates lv_d
    ON (lv_in._id = lv_d._pid)
    WHERE $where_cond";
  $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  $row = $q->fetch(PDO::FETCH_ASSOC);
  $total = $row['_total'];

  return isset($total)? $total :NULL;
}


// ========================


// ======================================================

public function get_transport_allocation($route_id='',$stoppage_id='') {
$data = array();
$sql = "SELECT
tr_route_setting._id as _route_id,
tr_route_setting._route_name,
tr_stoppage_setting._id as _stoppage_id,
tr_stoppage_setting._stoppage_name,
_pf_std_personal_info._id as _std_id,
_pf_std_personal_info._uniq_id,
_pf_std_personal_info._full_name,
tr_transport_allocation._id as _transport_id,
tr_transport_allocation._transport_way,
tr_transport_allocation._cost,
tr_transport_allocation._comments,
tr_transport_allocation._status
FROM
tr_transport_allocation
LEFT JOIN _pf_std_personal_info ON tr_transport_allocation._std_id = _pf_std_personal_info._id
LEFT JOIN tr_stoppage_setting ON tr_stoppage_setting._id = tr_transport_allocation._stoppage_id
LEFT JOIN tr_route_setting ON tr_route_setting._id = tr_stoppage_setting._route_id";

$sql_stoppage='';
$sql_route='';

if($route_id!=''){
$sql_route="tr_route_setting._id='$route_id' AND";
}

if($stoppage_id!=''){
$sql_stoppage="tr_stoppage_setting._id='$stoppage_id' AND";
}

if($sql_route!='' OR $sql_stoppage!=''){
  $sql=$sql." WHERE ".$sql_route." ".$sql_stoppage." tr_transport_allocation._status!='D'";
}

$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    

  //echo $sql;
}

// ======================================================


public function edit_transport_allocation($trans_id) {
$data = array();
$sql = "SELECT spf._id as _std_id, spf._full_name, spf._uniq_id, rou._id as _route_id,
rou._route_name, stp._id as _stoppage_id, stp._stoppage_name, trns._id as _trans_id,
trns._transport_way, trns._comments, trns._cost, trns._status
FROM
tr_transport_allocation as trns 
LEFT JOIN tr_stoppage_setting as stp ON trns._stoppage_id = stp._id
LEFT JOIN tr_route_setting rou ON stp._route_id = rou._id 
LEFT JOIN _pf_std_personal_info as spf ON trns._std_id = spf._id
WHERE
trns._id = '$trans_id' AND trns._status != 'D'";

$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
$data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
}
//==============================================================


public function Emp_Payroll($where_cond){
 $sql="SELECT pr._id,
       pr._br_id,
       pr._emp_id,
       pr._status,
       pf._status AS _emp_status,
       pf._joining_date,
       pr._promotion_date,
       pr._active_date,
       pf._uniq_id,
       pf._full_name,
       pf._nick_name,
       pf._date_of_birth,
       dg._name AS _designation,
       pr._emp_type,
       pr._salary_type,
       pr._amount,
       pr._bnck_ac_name,
       pr._bnck_ac_no,
       pr._bank_name
  FROM (_pf_emp_personal_info pf
        left JOIN _int_common_setup dg
           ON (pf._designation_id = dg._id))
       right JOIN _pay_roll_emp_setup pr ON (pr._emp_id = pf._id)
  WHERE $where_cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));
 while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL; 
 }
// ============================================================


public function Head_amount($where_cond,$single=''){
 $sql="SELECT pd._id,
       pd._br_id,
       pd._emp_id,
       pd._year,
       pd._month,
       pd._head_id,
       ph._name AS _head_name,
       pd._amount,
       pd._trxn_id,
       pd._type,
       pd._txrn_type,
       pd._status
  FROM _pay_roll_details pd LEFT JOIN _pay_roll_head ph ON (pd._head_id = ph._id)
  WHERE $where_cond";
 $q = $this->con1->prepare($sql);
 $q->execute() or die(print_r($q->errorInfo()));

if($single==''){
 while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL; 
}
else{
    $data = $q->fetch(PDO::FETCH_ASSOC);
    return isset($data)? $data :NULL; 
}




}

// ============================================================

public function Head_Sum($where_cond) {
$sql = "SELECT SUM(pd._amount) AS total       
  FROM _pay_roll_details pd LEFT JOIN _pay_roll_head ph ON (pd._head_id = ph._id)

WHERE $where_cond";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
$data = $q->fetch(PDO::FETCH_ASSOC);
$total = $data['total'];
 return isset($total)? $total :NULL;
}

// ============================================================

public function Head_Count($where_cond) {
$sql = "SELECT *        
  FROM _pay_roll_details pd LEFT JOIN _pay_roll_head ph ON (pd._head_id = ph._id)

WHERE $where_cond";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
$data = $q->fetch(PDO::FETCH_ASSOC);
// $total = $data['total'];
$total = $q->rowCount();
 return isset($total)? $total :NULL;
}

// ============================================================

public function Atd_Calculate($where_cond) {
$data = array();
$sql = "SELECT 
*,
(_paid_leave+_unpaid_leave) AS _total_leave,
(TRUNCATE((_late/_late_fine),0)+_unpaid_leave+_absent) AS _sd_day

FROM
(
SELECT ma.br_id,ma.emp_id,ma.month,ma.year,ma._present,ma._absent,ma._late,

(SELECT COUNT(le._emp_id)
FROM hr_emp_leave_entry le RIGHT JOIN hr_emp_leave_dates ld ON (le._id = ld._pid)       
WHERE le._status='A' AND ld._status='A' AND YEAR(ld._date)=ma.year AND MONTH(ld._date)=ma.month AND le._emp_id=ma.emp_id AND le._pay_type='1') AS _paid_leave,
  
(SELECT COUNT(le._emp_id)
FROM hr_emp_leave_entry le RIGHT JOIN hr_emp_leave_dates ld ON (le._id = ld._pid)       
WHERE le._status='A' AND ld._status='A' AND YEAR(ld._date)=ma.year AND MONTH(ld._date)=ma.month AND le._emp_id=ma.emp_id AND le._pay_type='0') AS _unpaid_leave,
  
(SELECT lt_day FROM `hr_attendance_rule` WHERE br_id=ma.br_id AND `lt_status`='1') AS _late_fine

FROM `hr_emp_monthly_attandce` ma

WHERE $where_cond) AS atd_tb";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
$data = $q->fetch(PDO::FETCH_ASSOC);
 return isset($data)? $data :NULL;
}



// ===================Student ID Card Generate============================




public function student_id($where_cond) {
  $sql="SELECT sp._id,
       b._session,
       sp._status,
       sp._uniq_id,
       sp._class_roll,
       sp._section_roll,
       sp._full_name,
       sp._nick_name,
       sp._date_of_birth,
       sp._birth_reg_no,
       bg._name as blood_grp,
       sp._gender,
       sp._religion,
       sp._nationality,
       sp._std_mobile,
       sp._contact_mobile,
       sp._contact_email,
       sp._image_location,
       cg._full_name AS _cg_name,
       cg._mobile_no AS _cg_mobile,
       cg._email AS _cg_email,
       f._full_name AS _f_name,
       f._mobile_no AS _f_mobile,
       f._email AS _f_email,
       m._full_name AS _m_name,
       m._mobile_no AS _m_mobie,
       m._email AS _m_email,
       v.institute AS _inst,
       v.institute_id AS _inst_id,
       v.branch AS _br,
       v.branch_id AS _br_id,
       v.shift AS _shift,
       v.shift_id AS _id,
       v.medium AS _medium,
       v.medium_id AS _medium_id,
       v.class AS _cl,
       v.class_id AS _cl_id,
       v.department AS _dept,
       v.department_id AS _dept_id,
       v.student_type AS _std_type,
       v.student_type_id AS _std_type_id,
       v.section AS _sec,
       v.section_id AS _sec_id
FROM (((((_pf_std_personal_info sp
            LEFT JOIN _pf_guardian_spouse_info cg
               ON ((sp._id = cg._pid) AND (cg._type = 'S') AND (cg._info_type = sp._current_guardian)))
           LEFT JOIN _pf_std_basic_info b ON (sp._id = b._pid))
          LEFT JOIN _int_institute_setup_vw v
             ON (b._section_id = v.section_id))
         LEFT JOIN _int_common_setup bg
            ON (sp._blood_group_id = bg._id))
        LEFT JOIN _pf_guardian_spouse_info f ON ((sp._id = f._pid) AND (f._type = 'S') AND (f._info_type = 'F')))
       LEFT JOIN _pf_guardian_spouse_info m ON ((sp._id = m._pid) AND (m._type = 'S') AND (m._info_type = 'M'))
    WHERE $where_cond";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ===================================


public function emp_pay_setup($where) {
  $data = array();
    $sql = "SELECT 
pem._id,
psh._id,
pem._uniq_id,
pem._full_name,
psh._emp_id,
psh._emp_type,
psh._salary_type,
psh._amount,
psh._bnck_ac_name,
psh._bnck_ac_no,
psh._active_date,
psh._promotion_date,
psh._status AS p_status



 FROM (_pf_emp_personal_info pem
           left JOIN _pay_roll_emp_setup psh ON (pem._id = psh._emp_id))
           
           
           WHERE $where";
           
           
           //WHERE psh._br_id='$branchid' AND psh._status!='D'";
  $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    

}

//=====================
public function emp_payroll_head($where) {
  $data = array();
    $sql = "SELECT
*
FROM
(
SELECT
_id AS _head_id,
_name AS _head_name,
_value AS _head_value,
_cal_type AS _head_cal_type
FROM
_pay_roll_head
WHERE
_pay_type='I'
AND _status='A'
) AS t1

LEFT JOIN

(SELECT
ems._payroll_id,
ems._br_id,
ems._emp_id,
ems._setup_status,
psh._selected_id,
psh._selected_head_id,
psh._selected_amount,
psh._selected_status
FROM 

(
(SELECT
_id AS _payroll_id,
_br_id,
_emp_id,
_status AS _setup_status
FROM 
_pay_roll_emp_setup
WHERE 
_status='A') AS ems 

RIGHT JOIN 

(
SELECT
_id AS _selected_id,
_pay_roll_id AS _selected_pay_roll_id,
_pay_head_id AS _selected_head_id,
_amount AS _selected_amount,
_status AS _selected_status
FROM 
_pay_roll_selected_head
WHERE _status!='D'
) psh 

ON (ems._payroll_id=psh._selected_pay_roll_id))
) AS t2

ON (t1._head_id=t2._selected_head_id)

WHERE

t2._emp_id= '$where' OR t2._emp_id IS NULL

GROUP BY t1._head_id"  ;
        

  $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    

}


// =====================================================

public function Month($month){
  $month_name='';
  if($month==1){ $month_name='January'; }
  elseif($month==2){ $month_name='February'; }
  elseif($month==3){ $month_name='March'; }
  elseif($month==4){ $month_name='April'; }
  elseif($month==5){ $month_name='May'; }
  elseif($month==6){ $month_name='June'; }
  elseif($month==7){ $month_name='July'; }
  elseif($month==8){ $month_name='August'; }
  elseif($month==9){ $month_name='September'; }
  elseif($month==10){ $month_name='October'; }
  elseif($month==11){ $month_name='November'; }
  elseif($month==12){ $month_name='December'; }
  else { $month_name=null; }

  return $month_name;
}


// ================================================

public function View_GL_HEAD($where) {
    $data = array();
    $sql = "SELECT acc_gl_head_._id,
       acc_gl_head_.gl_head_code,
       acc_gl_head_.gl_head_name,
       acc_gl_head_.gl_head_has_child,
       acc_gl_head_.gl_head_parent_id,
       acc_gl_head_._status,
       acc_gl_head_._transaction_type,
       acc_account_type_.account_type_name,
       acc_account_type_._id as acc_id,
       acc_account_type_._br_id
  FROM acc_gl_head_
       LEFT JOIN acc_account_type_ 
          ON (acc_gl_head_.account_type_id = acc_account_type_._id)
          
where $where";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


//======================for fee collection============
public function fee_collect_report($where) {
  $data = array();
    $sql = "SELECT
*
FROM
(
SELECT inv._id,
       inv._section_id,
       ins.institute_id,
       ins.institute,
       ins.branch_id,
       ins.branch,
       ins.shift_id,
       ins.shift,
       ins.medium_id,
       ins.medium,
       ins.class_id,
       ins.class,
       ins.department_id,
       ins.department,
       ins.student_type_id,
       ins.student_type,
       ins.section_id,
       ins.section,
       inv._month,
       inv._year,       
  (SELECT SUM(_amount) AS _paid FROM _fee_master_invoice
  WHERE _section_id=ins.section_id AND _month=inv._month AND _year=inv._year AND _status='P') AS _paid,

  (SELECT SUM(_amount) AS _unpaid FROM _fee_master_invoice
  WHERE _section_id=ins.section_id AND _month=inv._month AND _year=inv._year AND _status='U') AS _due,
  
  (SELECT SUM(_amount) AS _total FROM _fee_master_invoice
  WHERE _section_id=ins.section_id AND _month=inv._month AND _year=inv._year AND (_status='P' OR _status='U')) AS _total  
           
FROM _fee_master_invoice inv
LEFT JOIN _int_institute_setup_vw ins ON (inv._section_id = ins.section_id)
WHERE
$where
ORDER BY ins.shift,ins.medium,ins.class,ins.department,ins.student_type,ins.section
) AS t1
"  ;
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
$data[] = $row;
}
return isset($data)? $data :NULL;    

}


// ============================month duriton report=========================

public function sec_fee_std_detail($section_id,$f_month,$t_month,$f_year,$t_year) {
$data = array();
$sql = "SELECT
pspi._uniq_id,
pspi._full_name ,
pspi._section_roll,
pspi._contact_mobile, 
pmi._section_id,
pmi._std_id,

(SELECT SUM(_amount) AS st_total FROM _fee_master_invoice
WHERE _section_id=pmi._section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year AND _std_id=pmi._std_id AND (_status='P' OR _status='U')) AS st_total,

(SELECT SUM(_amount) AS up_total FROM _fee_master_invoice
WHERE _section_id=pmi._section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year AND _std_id=pmi._std_id AND  _status='U' ) AS up_total,

(SELECT SUM(_amount) AS p_total FROM _fee_master_invoice
WHERE _section_id=pmi._section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year AND _std_id=pmi._std_id AND  _status='P' ) AS p_total




FROM (_fee_master_invoice pmi
        LEFT JOIN _pf_std_personal_info pspi ON (pmi._std_id = pspi._id))
        
  WHERE  _section_id=$section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year AND pmi._status!='AD'
        
      GROUP BY _std_id  
";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row;
}
return isset($data)? $data :NULL;    

}


// ============================month duriton total report=========================
public function month_du_std_tdetail($section_id,$f_month,$t_month,$f_year,$t_year) {
$data = array();
$sql = "SELECT * FROM
(SELECT SUM(_amount) AS _paid FROM _fee_master_invoice
  WHERE _section_id=$section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year  AND _status='P') AS _paid,

(SELECT SUM(_amount) AS _unpaid FROM _fee_master_invoice
  WHERE _section_id=$section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year  AND _status='U') AS _unpaid,
  
(SELECT SUM(_amount) AS _total FROM _fee_master_invoice
WHERE _section_id=$section_id AND _month BETWEEN $f_month AND $t_month AND _year BETWEEN $f_year AND $t_year  AND (_status='P' OR _status='U')) AS _total"
;
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row;
}
return isset($data)? $data :NULL;    

}



// =========================section wise fee details============================

public function section_fee_collect_report($where) {
$data = array();
$sql = "SELECT
pspi._uniq_id, 
pspi._full_name,
pspi._section_roll,
pspi._contact_mobile,
pmi._std_id,
pmi._amount,
pmi._month,
pmi._year,
pmi._status,
(SELECT SUM(_amount) AS st_total FROM _fee_master_invoice
WHERE _section_id=pmi._section_id AND _month=pmi._month AND _year=pmi._year AND _std_id=pmi._std_id AND (_status='P' OR _status='U')) AS st_total,

(SELECT _amount AS _paid FROM _fee_master_invoice
  WHERE _section_id=pmi._section_id AND _month=pmi._month AND _year=pmi._year AND _std_id=pmi._std_id AND _status='P') AS _paid,

(SELECT _amount AS _unpaid FROM _fee_master_invoice
  WHERE _section_id=pmi._section_id AND _month=pmi._month AND _year=pmi._year AND _std_id=pmi._std_id AND _status='U') AS _due
FROM (_fee_master_invoice pmi
        LEFT JOIN _pf_std_personal_info pspi ON (pmi._std_id = pspi._id))
        WHERE $where 
";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row;
}
return isset($data)? $data :NULL;    

}

// =========================section wise Total fee details============================

public function section_total_fee_report($where) {
$data = array();
$sql = "SELECT * FROM
(SELECT SUM(_amount) AS _paid FROM _fee_master_invoice
  WHERE $where AND _status='P') AS _paid,

(SELECT SUM(_amount) AS _unpaid FROM _fee_master_invoice
  WHERE $where AND _status='U') AS _unpaid,
  
(SELECT SUM(_amount) AS _total FROM _fee_master_invoice
WHERE $where AND (_status='P' OR _status='U')) AS _total";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row;
}
return isset($data)? $data :NULL;    

}


// =======================total fee collection==============================

public function total_fee($where_c) {
$data = array();
$sql = "SELECT * FROM
(SELECT SUM(minv._amount) AS _unp_total
FROM _fee_master_invoice minv LEFT JOIN _int_institute_setup_vw ins ON (minv._section_id = ins.section_id)
WHERE $where_c AND minv._status='U') AS _unp_total,

(SELECT SUM(minv._amount) AS _p_total
FROM _fee_master_invoice minv LEFT JOIN _int_institute_setup_vw ins ON (minv._section_id = ins.section_id)
WHERE $where_c AND minv._status='P') AS _p_total,

(SELECT SUM(minv._amount) AS _total
FROM _fee_master_invoice minv LEFT JOIN _int_institute_setup_vw ins ON (minv._section_id = ins.section_id)
WHERE $where_c AND (minv._status='P' OR minv._status='U')) AS _total";
$q = $this->con1->prepare($sql);
$q->execute() or die(print_r($q->errorInfo()));

while ($row = $q->fetch(PDO::FETCH_ASSOC)){
  $data[] = $row;
}
return isset($data)? $data :NULL;    

}

// =====================================================


public function View_sub_GL_HEAD($where) {
    $data = array();
    $sql = "SELECT acc_sub_gl_head_._id,       
       acc_sub_gl_head_._sub_gl_head_name,
       acc_sub_gl_head_._sub_gl_head_code,
       acc_sub_gl_head_._transaction_type,
       acc_sub_gl_head_._status,
       acc_gl_head_._id as p_id,
       acc_gl_head_._br_id,
       acc_gl_head_.gl_head_name
  FROM acc_sub_gl_head_
       LEFT JOIN acc_gl_head_ 
          ON (acc_sub_gl_head_._parent_gl_id = acc_gl_head_._id)
          
where $where";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ==============================

public function Total_Count_std($where_cond) {
$sql="SELECT COUNT(_full_name) AS total 
FROM (SELECT br.section_id,
br.student_type_id,
br.department_id,
br.class_id,
br.medium_id,
br.shift_id,
br.branch_id,
i._pid,
st._full_name

FROM (_int_institute_setup_vw br
LEFT JOIN _pf_std_basic_info i
  ON (br.section_id = i._section_id))
  LEFT JOIN `_pf_std_personal_info` st
  ON( i._pid = st._id)
WHERE st._status='A' AND $where_cond
 ) AS t1";

 $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  $row = $q->fetch(PDO::FETCH_ASSOC);
  $total = $row['total'];

  return isset($total)? $total :NULL;
}

// ============================================

// ==============================
public function Student_profile_detail($id){
  
$column=" st._id,
         in.institute,
         in.branch,
         in.shift,
         in.medium,
         in.class,
         in.department,
         in.student_type,
         in.section,
         st._status,
         st._tc_status,
         st._uniq_id,
         st._class_roll,
         st._section_roll,
         st._full_name,
         st._nick_name,
         st._birth_reg_no,
         st._date_of_birth,
         st._gender,
         st._contact_mobile,
         st._image_location,
         f._full_name AS father_name,
         m._full_name AS mother_name";
$table_name="(((_pf_std_personal_info st
            LEFT JOIN _pf_guardian_spouse_info f
            ON (st._id = f._pid AND f._type = 'S' AND f._info_type = 'F'))
            LEFT JOIN _pf_std_basic_info b ON (st._id = b._pid))
            LEFT JOIN _int_institute_setup_vw `in`
            ON (b._section_id = `in`.section_id))
            LEFT JOIN _pf_guardian_spouse_info m ON (st._id = m._pid AND m._type = 'S' AND m._info_type = 'M')";

$where_cond="st._id='$id'";

return $this->View_column_details_By_Cond($table_name,$column,$where_cond);

}
// ==============================



public function View_quiz_student($where_cond) {
    $data = array();
    $sql = "SELECT qm._id,
       iv.institute_id,
       iv.institute,
       iv.branch_id,
       iv.branch,
       iv.shift_id,
       iv.shift,
       iv.medium_id,
       iv.medium,
       iv.class_id,
       iv.class,
       iv.department_id,
       iv.department,
       iv.student_type_id,
       iv.student_type,
       iv.section_id,
       iv.section,
       qm._qz_type_id,
       qt._quize_type,
       qt._assign_mark,
       qt._pass_mark,
       qm._subject_id,
       qs._sub_full_name,
       qs._sub_short_name,
       qs._sub_code,
       qm._date,
       qm._std_id,
       sp._status AS _std_status,
       sp._uniq_id,
       sp._id_card,
       sp._section_roll,
       sp._full_name,
       sp._nick_name,
       sp._contact_mobile,
       sp._contact_email,
       qm._mark,
       qm._status,
       qm._comments,
       qm._atd_status
FROM (((_qz_mark_sheet qm
LEFT JOIN _qz_quize_subject qs
  ON (qm._subject_id = qs._id))
LEFT JOIN _int_institute_setup_vw iv
  ON (qm._section_id = iv.section_id))
LEFT JOIN _qz_quize_type qt 
  ON (qm._qz_type_id = qt._id))
LEFT JOIN _pf_std_personal_info sp ON (qm._std_id = sp._id)
       
WHERE $where_cond";
    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}


// ============================================

public function Column_Count($table_name,$where_cond) {
    $sql_login = "SELECT * FROM ".$table_name." WHERE $where_cond";
    $login = $this->con1->prepare($sql_login);
    $login->execute() or die(print_r($q->errorInfo()));
    $total = $login->columnCount();

    return isset($total)? $total :NULL;  

}

// ===========================================

public function account_balance($branchid){

  $sql="SELECT
  IFNULL(t1.cash_credit,0) AS cash_credit,
  IFNULL(t2.cash_debit,0) AS cash_debit,
  (IFNULL(t1.cash_credit,0)-IFNULL(t2.cash_debit,0)) AS cash_balance,
  IFNULL(t3.bank_credit,0)AS bank_credit,
  IFNULL(t4.bank_debit,0)AS bank_debit,
  (IFNULL(t3.bank_credit,0)-IFNULL(t4.bank_debit,0))AS bank_balance,
  ((IFNULL(t1.cash_credit,0)-IFNULL(t2.cash_debit,0))+(IFNULL(t3.bank_credit,0)-IFNULL(t4.bank_debit,0))) AS total_balance

  FROM 
  (SELECT SUM(`_amount`) AS cash_credit FROM `acc_voucher` WHERE `_br_id`='$branchid' AND `_trxn_type`='C' AND `_voutcher_type`='C') AS t1,
  (SELECT SUM(`_amount`) AS cash_debit FROM `acc_voucher` WHERE `_br_id`='$branchid' AND `_trxn_type`='D' AND `_voutcher_type`='C') AS t2,
  (SELECT SUM(`_amount`) AS bank_credit FROM `acc_voucher` WHERE `_br_id`='$branchid' AND `_trxn_type`='C' AND `_voutcher_type`='B') AS t3,
  (SELECT SUM(`_amount`) AS bank_debit FROM `acc_voucher` WHERE `_br_id`='$branchid' AND `_trxn_type`='D' AND `_voutcher_type`='B') AS t4";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
}

// ===========================================

public function default_bank_balance($branchid){

  $sql="SELECT
  IFNULL(t1.bank_credit,0) AS bank_credit,
  IFNULL(t2.bank_debit,0) AS bank_debit,
  (IFNULL(t1.bank_credit,0)-IFNULL(t2.bank_debit,0)) AS bank_balance_default
  FROM 
  (SELECT SUM(`_amount`) AS bank_credit FROM `acc_voucher_gl` WHERE `_br_id`='$branchid' AND `_trxn_type`='C' AND `_gl_id`=(SELECT acc_gl_head_._id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='2' AND acc_gl_head_._br_id='$branchid' )) AS t1,
  (SELECT SUM(`_amount`) AS bank_debit FROM `acc_voucher_gl` WHERE `_br_id`='$branchid' AND `_trxn_type`='D' AND `_gl_id`=(SELECT acc_gl_head_._id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='2' AND acc_gl_head_._br_id='$branchid')) AS t2";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
}

// ===========================================

public function cash_in_hand_balance($branchid){

  $sql="SELECT
  IFNULL(t1.cash_credit,0) AS cash_credit,
  IFNULL(t2.cash_debit,0) AS cash_debit,
  (IFNULL(t1.cash_credit,0)-IFNULL(t2.cash_debit,0)) AS cash_balance_default
  FROM 
  (SELECT SUM(`_amount`) AS cash_credit FROM `acc_voucher_gl` WHERE `_br_id`='$branchid' AND `_trxn_type`='C' AND `_gl_id`=(SELECT acc_gl_head_._id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='3' AND acc_gl_head_._br_id='$branchid' )) AS t1,
  (SELECT SUM(`_amount`) AS cash_debit FROM `acc_voucher_gl` WHERE `_br_id`='$branchid' AND `_trxn_type`='D' AND `_gl_id`=(SELECT acc_gl_head_._id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='3' AND acc_gl_head_._br_id='$branchid')) AS t2";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
}

// ===========================================

public function get_default_cash_gl($branchid){

  $sql="SELECT acc_gl_head_._id AS gl_head_id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='3' AND acc_gl_head_._br_id='$branchid'";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
 }

// ===========================================

public function get_default_bank_gl($branchid){

  $sql="SELECT acc_gl_head_._id AS gl_head_id
    FROM acc_gl_head_ acc_gl_head_
         LEFT JOIN acc_voucher_gl acc_voucher_gl
            ON (acc_gl_head_._id = acc_voucher_gl._id)
            WHERE acc_gl_head_._transaction_type='2' AND acc_gl_head_._br_id='$branchid'";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
}

// ===========================================

public function voucher_gl_info($where) {
    $data = array();
    $sql = "SELECT acc_voucher_gl._gl_id,
       acc_gl_head_.gl_head_code,
       acc_gl_head_.gl_head_name,
       acc_voucher_gl._id,
       acc_voucher_gl._voucher_id,
       acc_voucher_gl._amount,
       acc_voucher_gl._trxn_type,
       acc_voucher_gl._status,
       acc_voucher_gl._entry_by,
       acc_voucher_gl._entry_date,
       acc_voucher_gl._update_by,
       acc_voucher_gl._last_update
  FROM acc_voucher_gl acc_voucher_gl
       LEFT JOIN acc_gl_head_ acc_gl_head_
          ON (acc_voucher_gl._gl_id = acc_gl_head_._id)
          
  where $where";

    $q = $this->con1->prepare($sql);
    $q->execute() or die(print_r($q->errorInfo()));
    
    while ($row = $q->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return isset($data)? $data :NULL;    
}

// ===========================================

public function day_book_balance($branchid,$date){

  $sql="SELECT
  IFNULL(cr.cr_amount,0) AS credit_amount,
  IFNULL(dr.dr_amount,0) AS debit_amount,
  (IFNULL(cr.cr_amount,0)-IFNULL(dr.dr_amount,0)) AS balance
  FROM
  (SELECT SUM(_amount) AS cr_amount,_entry_date FROM acc_voucher_gl  WHERE _trxn_type='C' AND acc_voucher_gl._br_id='$branchid' AND DATE(acc_voucher_gl._entry_date)='$date') AS cr,
  (SELECT SUM(_amount) AS dr_amount,_entry_date FROM acc_voucher_gl  WHERE _trxn_type='D' AND acc_voucher_gl._br_id='$branchid'AND DATE(acc_voucher_gl._entry_date)='$date') AS dr";
   $q = $this->con1->prepare($sql);
   $q->execute() or die(print_r($q->errorInfo()));
   $data = $q->fetch(PDO::FETCH_ASSOC);
   return isset($data)? $data :NULL;
}

// ===========================================

public function Quize_Result($where_cond){
  $sql="SELECT qm._id,
    qm._br_id,
    qm._qz_type_id,
    qt._quize_type,
    qt._assign_mark,
    qt._pass_mark,
    qm._subject_id,
    qs._sub_full_name,
    qs._sub_short_name,
    qs._sub_code,       
    qm._date,
    qm._section_id,
    qm._std_id,
    st._uniq_id,
    st._id_card,
    st._section_roll,
    st._full_name,
    st._nick_name,
    st._contact_mobile,
    st._contact_email,       
    qm._mark,       
    qm._status,
    qm._comments,
    qm._atd_status,    
    SUM(qm._mark) AS _total_mark,
    COUNT(qm._subject_id) AS _total_sub,
    AVG(qm._mark) AS _avg_marks,
    CONCAT('Exam Type: ', qt._quize_type, ', ', 'Std. Name: ', st._full_name, '(', st._section_roll, ')', ', ', (GROUP_CONCAT(CONCAT_WS('=', qs._sub_short_name, (IF(qm._atd_status = 'P',qm._mark,'Ab')))))) AS _result

  FROM ((_qz_mark_sheet qm
  LEFT JOIN _pf_std_personal_info st
    ON (qm._std_id = st._id))
  LEFT JOIN _qz_quize_type qt
    ON (qm._qz_type_id = qt._id))
  LEFT JOIN _qz_quize_subject qs ON (qm._subject_id = qs._id)
         
  WHERE $where_cond";
  $q = $this->con1->prepare($sql);
  $q->execute() or die(print_r($q->errorInfo()));
  while ($row = $q->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row;
  }
  return isset($data)? $data :NULL; 
}

// ====================================






// ====================================================

}

?>