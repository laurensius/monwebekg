<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		header('Content-type:json');
		$this->load->model('mod_patient');
		$this->load->model('mod_bpm');
	}

	public function index(){
		$this->load->view('welcome_message');
	}

	// --------------------------------BPM--------------------------
	public function bpm_insert($bpm){
		if($bpm != null){
			$current_patient = $this->mod_patient->patient_current();
			if(sizeof($current_patient) > 0){
				$insert_process = $this->mod_bpm->bpm_insert(
					array(
						"id_patient" => $current_patient[0]->id,
						"bpm" => $bpm,
						"datetime" => date("Y-m-d H:i:s")
					)
				);
				if($insert_process > 0){
					$severity = "success";
					$message = "Data saved!";
					$content = array();
				}else{
					$severity = "warning";
					$message = "Save data failed!";
					$content = array();
				}
			}else{
				$severity = "warning";
				$message = "Please select / input patient!";
				$content = array();
			}
		}else{
			$severity = "warning";
			$message = "No data post";
			$content = array();
		}
		echo json_encode(array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		), JSON_PRETTY_PRINT);
	}


	function bpm_monitoring($id_patient){
		if(isset($id_patient)){
			$monitoring = $this->mod_bpm->bpm_monitoring(array("id_patient" => $id_patient));
			if(sizeof($monitoring) > 0){
				$severity = "success";
				$message = "Data BPM loaded";
				$content = array("BPM" => $monitoring);
			}else{
				$severity = "success";
				$message = "Data BPM loaded";
				$content = array("BPM" => array());
			}
		}else{
			$severity = "warning";
			$message = "URL not match";
			$content = array();
		}
		echo json_encode(array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		), JSON_PRETTY_PRINT);
	}

	// --------------------------------END OF BPM--------------------------

	// --------------------------------PATIENT--------------------------------
	function patient_insert(){
		if($this->input->post('patient_name') == null && 
		$this->input->post('patient_age') == null && 
		$this->input->post('patient_gender') == null &&  
		$this->input->post('patient_address') == null ){
			$input = file_get_contents('php://input');
			$json = json_decode($input);
			if($json == null){
				$severity = "warning";
				$message = "Tidak ada data dikirim ke server";
				$content_count = "0";
				$content = array();
				$patient_name = null;
				$patient_age = null;
				$patient_gender = null;
				$patient_address = null;
			}else{
				$patient_name = $json->patient_name;
				$patient_age = $json->patient_age;
				$patient_gender = $json->patient_gender;
				$patient_address = $json->patient_address;
			}
		}else{
			$patient_name = $this->input->post('patient_name');
			$patient_age = $this->input->post('patient_age');
			$patient_gender = $this->input->post('patient_gender');
			$patient_address = $this->input->post('patient_address');
		}

		if($patient_name != null && $patient_age != null && $patient_gender != null && $patient_address != null){
			$insert_process = $this->mod_patient->patient_insert(
				array(
					"name" => $patient_name,
					"age" => $patient_age,
					"gender" => $patient_gender,
					"address" => $patient_address,
					"status" => "OPEN",
					"datetime" => date("Y-m-d H:i:s")
				)
			);
			if($insert_process > 0){
				$severity = "success";
				$message = "Data saved!";
				$content = array();
			}else{
				$severity = "warning";
				$message = "Save data failed!";
				$content = array();
			}
		}else{
			$severity = "warning";
			$message = "No data post";
			$content = array();
		}
		$response = array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		);
		echo json_encode($response,JSON_PRETTY_PRINT);
	}

	function patient_process(){
		$patient_process = $this->mod_patient->patient_current();
		if(sizeof($patient_process) > 0){
			$severity = "success";
			$message = "Data saved!";
			$content = array("patient" => $patient_process);
		}else{
			$severity = "warning";
			$message = "Please input patient before monitoring!";
			$content = array();
		}
		$response = array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		);
		echo json_encode($response,JSON_PRETTY_PRINT);
	}

	function patient_status_update($id_patient,$status){
		$patient_update = $this->mod_patient->patient_update_status(
			$id_patient,
			array("status" => $status)
		);
		if($patient_update > 0){
			$severity = "success";
			$message = "Sukses!";
			$content = array();
		}else{
			$severity = "warning";
			$message = "Proses gagal, silakan coba lagi!";
			$content = array();
		}
		$response = array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		);
		echo json_encode($response,JSON_PRETTY_PRINT);
	}

	function patient_riwayat(){
		$riwayat = $this->mod_patient->patient_riwayat();
		if(sizeof($riwayat) > 0){
			$severity = "success";
			$message = "Data BPM loaded";
			$content = array("patient" => $riwayat);
		}else{
			$severity = "warning";
			$message = "No data";
			$content = array("patient" => array());
		}
		echo json_encode(array(
			"severity" => $severity,
			"message" => $message,
			"content" => $content
		), JSON_PRETTY_PRINT);
	}
	// --------------------------------END OF PATIENT--------------------------
	
	
	
}
