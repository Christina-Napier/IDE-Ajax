<?php
//
//error_reporting(E_ALL);
//var_dump($_SERVER);
if(isset($_POST['data'])){ 
//$post_data = $_POST['data'];
//$data = ($_POST);
//$data = array('2','3','4');
//$post_data = implode (',',$data);
	$postdata = print_r($_POST);
	
	$file = "executed-file.php";
	$filename = $file;
	$handle = fopen($filename, "w");
	fwrite($handle, $post_data);
	fclose($handle);
	echo $file;
	echo $post_data;
}
?>
 

