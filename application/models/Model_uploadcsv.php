<?php

class Model_uploadcsv extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the uploadcsv data */
	public function insert_csv($insert_csv)
	{
		$this->db->insert('employees', $insert_csv);
		return $this->db->insert_id();
	}
}
