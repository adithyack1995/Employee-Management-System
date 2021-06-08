<?php

class Employee extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Store';
		$this->load->model('model_employee');
	}

	public function index()
	{
		if (!in_array('viewStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['js'] = 'application/views/employee/index-js.php';
		$this->render_template('employee/index', $this->data);
	}

	public function fetchCategoryData()
	{
		$result = array('data' => array());

		$data = $this->model_employee->getEmployeeData();

		foreach ($data as $key => $value) {

			$birthDate = date("d/m/Y", strtotime($value['dob']));
			$birthDate = explode("/", $birthDate);
			//get age from date or birthdate
			$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
				? ((date("Y") - $birthDate[2]))
				: (date("Y") - $birthDate[2]) - 1);
			//get experiance
			$date1 = $value['joining_date'];
			$date2 = date("Y-m-d");
			$diff = abs(strtotime($date2) - strtotime($date1));
			$years = floor($diff / (365 * 60 * 60 * 24));
			$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
			$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

			$result['data'][$key] = array(
				$value['emp_code'],
				$value['name'],
				$value['department'],
				$age,
				$years . ' Year ' . $months . ' Months ' . $days . ' days',
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{

		$response = array();

		$this->form_validation->set_rules('name', 'Employee Name', 'trim|required');
		$this->form_validation->set_rules('emp_code', 'Employee Code', 'trim|required');
		$this->form_validation->set_rules('department', 'Department', 'trim|required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('joining', 'Joining Date', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'name' => $this->input->post('name'),
				'emp_code' => $this->input->post('emp_code'),
				'department' => $this->input->post('department'),
				'dob' => $this->input->post('dob'),
				'joining_date' => $this->input->post('joining'),
			);

			$create = $this->model_employee->create($data);
			if ($create == true) {
				$response['success'] = true;
				$response['messages'] = 'Succesfully created';
			} else {
				$response['success'] = false;
				$response['messages'] = 'Error in the database while creating the brand information';
			}
		} else {
			$response['success'] = false;
			foreach ($_POST as $key => $value) {
				$response['messages'][$key] = form_error($key);
			}
		}

		echo json_encode($response);
		die;
	}
}
