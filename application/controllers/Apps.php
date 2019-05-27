<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	public function __construct(){
		parent::__construct();
		require(APPPATH.'middleware/fpdf.php');
		$this->load->model('mod_patient');
		$this->load->model('mod_bpm');
	}

	public function index(){
		$this->load->view('apps/header');
		$this->load->view('apps/body_beranda');
		$this->load->view('apps/footer');
	}

	public function input_pasien(){
		$this->load->view('apps/header');
		$this->load->view('apps/body_input_pasien');
		$this->load->view('apps/footer');
	}

	public function monitoring(){
		$this->load->view('apps/header');
		$this->load->view('apps/body_monitoring');
		$this->load->view('apps/footer');
	}

	public function print_result(){
		$this->load->view('apps/header');
		$this->load->view('apps/body_riwayat');
		$this->load->view('apps/footer');
	}

	public function download($id){
		$patient = $this->mod_patient->patient_detail(
			array("id" => $id)
		);
		$bpm = $this->mod_bpm->bpm_detail(
			array("id_patient" => $id)
		);
		$data["patient"] = $patient;
		$data["bpm"] = $bpm;
		$this->load->view('apps/download',$data);
	}

	public function download_pdf($id){
		header('content-type:application/pdf');
		
		$dataset = $this->mod_bpm->bpm_detail(
			array("id_patient" => $id)
		);

		$patient = $this->mod_patient->patient_detail(
			array("id" => $id)
		);

		$pdf = new FPDF();
		$pdf = new FPDF('P','mm',array(210,330)); //210 x 330
		$header = array('No', 'BPM', 'Datetime');
		$pdf->SetFont('Arial','',14);
		$pdf->AddPage();
		
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(1);
		$pdf->Cell(0,10,'Riwayat Pengukuran EKG',0,0,'C');
		$pdf->Ln(20);
	
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(1);
		$pdf->Cell(0,0,'Nama Pasien : ' . $patient[0]->name ,0,0,'L');
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(1);
		$pdf->Cell(0,0,"Umur Pasien : " . $patient[0]->age ,0,0,'L');
		$pdf->Ln(10);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(1);
		$pdf->Cell(0,0,"Jenis Kelamin : " . $patient[0]->gender ,0,0,'L');
		$pdf->Ln(10);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(1);
		$pdf->Cell(0,0,"Alamat : " . $patient[0]->address ,0,0,'L');
		$pdf->Ln(10);

		//Header Tabel 
		$pdf->SetFillColor(66, 161, 244);
		$pdf->SetTextColor(255);
		$pdf->SetLineWidth(.3);
		$pdf->SetFont('','B');
		$w = array(15, 40, 50);
		for($i=0;$i<count($header);$i++)
		$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
		$pdf->Ln();
		$pdf->SetFillColor(224,235,255);
		$pdf->SetTextColor(0);
		$pdf->SetFont('');
		//Isi Tabel <Dataset>
		$fill = false;
		$ctr = 1;
		$recent = "";
		$init = true;
		foreach($dataset as $row){
			$pdf->Cell($w[0],6,$ctr,'TBLR',0,'C',$fill);
			$pdf->Cell($w[1],6,$row->bpm,'TBLR',0,'C',$fill);
			$pdf->Cell($w[2],6,$row->datetime,'TBLR',0,'C',$fill);	
			$pdf->Ln();
			$fill = !$fill;
			$init = false;
			$ctr++;
		}
		$pdf->output();
	}
	
}
