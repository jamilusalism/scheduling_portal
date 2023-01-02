<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function login_facilitator(){
		
		extract($_POST);		
		$qry = $this->db->query("SELECT *,concat(UPPER(lastname),', ',othernames) as name FROM facilitators where id_no = '".$id_no."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 3;
		}
}

	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	
	function save_course(){
		extract($_POST);
		$data = " course = '$course' ";
		$data .= ", description = '$description' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO programme set $data");
			}else{
				$save = $this->db->query("UPDATE programme set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_course(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM programme where id = ".$id);
		if($delete){
			return 1;
		}
	}

	function save_facilitator(){
		extract($_POST);
		$data = '';
		$sendIDCode = '';
		foreach($_POST as $k=> $v){
			if(!empty($v)){
				if($k !='id'){
					if(empty($data))
					$data .= " $k='{$v}' ";
					else
					$data .= ", $k='{$v}' ";
				}
			}
		}
			if(empty($id_no)){
				$i = 1;
				while($i == 1){
					$rand = mt_rand(1,99999999);
					$rand =sprintf("%'08d",$rand);
					$sendIDCode = $rand;
					$chk = $this->db->query("SELECT * FROM facilitators where id_no = '$rand' ")->num_rows;
					if($chk <= 0){
						$data .= ", id_no='$rand' ";
						$i = 0;
					}
				}

				//start sending email
				$from = 'info@skillacquisitionscheduling.com.ng';
				$subject = 'Scheduling Portal Login ID';
				$message = 
'Hello, please find below your login ID to the Scheduling Portal.
					
	Login ID: '.$sendIDCode;
				
				mail($email, $subject, $message);
			//end send email
			}

		if(empty($id)){
			if(!empty($id_no)){
				$chk = $this->db->query("SELECT * FROM facilitators where id_no = '$id_no' ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("INSERT INTO facilitators set $data ");

		}else{
			if(!empty($id_no)){
				$chk = $this->db->query("SELECT * FROM facilitators where id_no = '$id_no' and id != $id ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("UPDATE facilitators set $data where id=".$id);
		}
		if($save)
			return 1;
			
	}
	function delete_facilitator(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM facilitators where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_schedule(){

		extract($_POST);

		$data = " facilitator_id = '$facilitator_id' ";
		$data .= ", facilitator_email = '$facilitator_email' ";
		$data .= ", title = '$title' ";
		$data .= ", state = '$state' ";
		$data .= ", lga = '$lga' ";
		$data .= ", location = '$location' ";
		$data .= ", contact_person = '$contact_person' ";
		
		$data .= ", schedule_date = '$schedule_date' ";
		$data .= ", time_from = '$time_from' ";
		$data .= ", time_to = '$time_to' ";
		$data .= ", description = '$description' ";
		$data .= ", is_repeating = 0 ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO schedules set ".$data);
		}else{
			$save = $this->db->query("UPDATE schedules set ".$data." where id=".$id);
		}
	
if($save) {

    //Globally
    $from = 'info@skillacquisitionscheduling.com.ng';
    $subject = 'New Training Notification';

    $message = 
'Hello Facilitator, find below the training schedule for your review and further action.

    Programme Title: '.$title.'
    Traning Location: '.$location.', '.$lga.', '.$state.'
    Date: '.$schedule_date.' by '.$time_from.' - '.$time_to.'
    Contact person: '.$contact_person.'

   Please ensure you get in touch with the contact person above for further information.
   Kind regards.'; 
    
    // Sending email
    mail($facilitator_email, $subject, $message);
	
return 1;
}
	}
	
	function delete_schedule(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM schedules where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_schecdule(){
		extract($_POST);
		$data = array();

		if ($facilitator_id == "all") {
			$qry = $this->db->query("SELECT * FROM schedules");
			while($row=$qry->fetch_assoc()){
				if($row['is_repeating'] == 1){
					$rdata = json_decode($row['repeating_data']);
					foreach($rdata as $k =>$v){
						$row[$k] = $v;
					}
				}
				$data[] = $row;
			}
				return json_encode($data);

		} else {
			$qry = $this->db->query("SELECT * FROM schedules where facilitator_id = 0 or facilitator_id = $facilitator_id");
			while($row=$qry->fetch_assoc()){
				if($row['is_repeating'] == 1){
					$rdata = json_decode($row['repeating_data']);
					foreach($rdata as $k =>$v){
						$row[$k] = $v;
					}
				}
				$data[] = $row;
			}
				return json_encode($data);
		}//end if
		
	}

}