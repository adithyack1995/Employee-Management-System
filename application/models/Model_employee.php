<?php

class Model_employee extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getEmployeeData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM employees WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM employees ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function create($data = array())
	{
		if ($data) {
			$create = $this->db->insert('employees', $data);
			return ($create == true) ? true : false;
		}
	}
}
