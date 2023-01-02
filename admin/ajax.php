<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login_facilitator'){
	$login_facilitator = $crud->login_facilitator();
	if($login_facilitator)
		echo $login_facilitator;
}

if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}

if($action == "save_course"){
	$save = $crud->save_course();
	if($save)
		echo $save;
}

if($action == "delete_course"){
	$delete = $crud->delete_course();
	if($delete)
		echo $delete;
}

if($action == "save_facilitator"){
	$save = $crud->save_facilitator();
	if($save)
		echo $save;
}
if($action == "delete_facilitator"){
	$save = $crud->delete_facilitator();
	if($save)
		echo $save;
}

if($action == "save_schedule"){
	$save = $crud->save_schedule();
	if($save)
		echo $save;
}
if($action == "delete_schedule"){
	$save = $crud->delete_schedule();
	if($save)
		echo $save;
}
if($action == "get_schecdule"){
	$get = $crud->get_schecdule();
	if($get)
		echo $get;
}

ob_end_flush();
?>
