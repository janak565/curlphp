<?php
	//include connection file 
	include_once("connect/db_cls_connect.php");
	include_once("main.class.php");

	$db = new dbObj();
	$connString =  $db->getConnstring();
 
	$params = $_REQUEST;
	$action = $params['action'] !='' ? $params['action'] : '';
	$mainCls = new Main($connString);
 
	switch($action) {
	 	case 'login':
			$mainCls->login();
	 	break;
	 	case 'checkopt':
			$mainCls->checkopt();
	 	break;
	 	case 'getStateListByCountryId':
	 		echo $data = $mainCls->getStateListByCountry();
	 	break;
	 	case 'add_employee_information':
	 		echo $data = $mainCls->add_employee_information();
	 	break;
	 	case 'delete_employee_information':
	 		echo $data = $mainCls->delete_employee_information();
	 	break;
	 	case 'edit_employee_information':
	 		echo $data = $mainCls->update_employee_information();
	 	break;	
	 	default:
	 		return;
	}
	 		
	  
?>