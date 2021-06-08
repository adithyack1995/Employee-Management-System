<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Uploadcsv extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'uploadcsv';

		$this->load->model('model_uploadcsv');
	}

	/* 
    * It redirects to the uploadcsv page and displays all the uploadcsv information
    * It also updates the uploadcsv information into the database if the 
    * validation for each input field is successfully valid
    */
	public function index()
	{
		$this->form_validation->set_rules('uploadcsv_name', 'uploadcsv name', 'trim|required');
		$this->form_validation->set_rules('service_charge_value', 'Charge Amount', 'trim|integer');
		$this->form_validation->set_rules('vat_charge_value', 'Vat Charge', 'trim|integer');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('message', 'Message', 'trim|required');
		if ($this->form_validation->run() == TRUE) {

			$data = array(
				'uploadcsv_name' => $this->input->post('uploadcsv_name'),
				'service_charge_value' => $this->input->post('service_charge_value'),
				'vat_charge_value' => $this->input->post('vat_charge_value'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'country' => $this->input->post('country'),
				'message' => $this->input->post('message'),
				'currency' => $this->input->post('currency')
			);

			$update = $this->model_uploadcsv->update($data, 1);
			if ($update == true) {
				$this->session->set_flashdata('success', 'Successfully created');
				redirect('uploadcsv/', 'refresh');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('uploadcsv/index', 'refresh');
			}
		} else {

			$this->data['currency_symbols'] = $this->currency();
			$this->render_template('uploadcsv/index');
		}
	}
	public function import()
	{
		$data = array();
		if ($this->input->post('importSubmit')) {
			$this->load->library('form_validation');
			$this->load->helper('file');
			// Form field validation rules
			$this->form_validation->set_rules('file', 'file', 'file');
			// Validate submitted form data 
			if ($this->form_validation->run() == true) {
				$insertCount = $updateCount = $rowCount = $notAddCount = 0;
				// If file uploaded 
				if (is_uploaded_file($_FILES['file']['tmp_name'])) {
					// Load CSV reader library 
					$this->load->library('CSVReader');
					$fps = fopen($_FILES['file']['tmp_name'], 'r') or die("can't open file");
					$filename = file($_FILES['file']['tmp_name']);
					//validation for rows and coloumns
					if (count($filename) > 21) {
						$this->session->set_flashdata('error', 'Maximum 20 rows allowed.');
						redirect('/uploadcsv');
					} else {
						while ($csv_line = fgetcsv($fps, 1024)) {
							$columns = count($csv_line);
							if ($columns < 5) {
								$this->session->set_flashdata('error', 'Minimum 5 coloumns needed.');
								redirect('/uploadcsv');
							} else {
								//Insert csv to db
								$insert_csv = array();
								$insert_csv['name'] = $csv_line[0];
								$insert_csv['emp_code'] = $csv_line[1];
								$insert_csv['department'] = $csv_line[2];
								$insert_csv['dob'] = date("Y-m-d", strtotime($csv_line[3]));
								$insert_csv['joining_date'] = date("Y-m-d", strtotime($csv_line[4]));
								$insert = $this->model_uploadcsv->insert_csv($insert_csv);
							}
						}
						if ($insert) {
							$this->session->set_flashdata('success', 'success');
							redirect('/uploadcsv');
						}
					}
				}
			} else {
				$this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
			}
		} else {
			$this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
		}
	}
}
