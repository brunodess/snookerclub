<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user($usrid = FALSE, $usrname = FALSE)
	{
		if ($usrid === FALSE)
		{
			if ($usrname === FALSE)
			{
				$query = $this->db->get('t02_morador');
				return $query->result_array();
			}				
			$query = $this->db->get_where('t02_morador', array('t02_nome' => $usrname));
			return $query->row_array();
		}

		$query = $this->db->get_where('t02_morador', array('t02_id' => $usrid));
		return $query->row_array();
	}
	
	public function set_user()
	{

		$data = array(
			't02_nome' => $this->input->post('usrname'),
			't02_email' => $this->input->post('usremail'),
			't02_dataini' => $this->input->post('usrdataini'),
			't02_datafim' => $this->input->post('usrdatafim')
		);

		return $this->db->insert('t02_morador', $data);
	}
	
	public function desliga_user($usrid, $datafim = FALSE)
	{
		$this->load->helper('date');
		
		if ($datafim === FALSE){
			$datafim = mdate('%d%m%Y');
		}

		$data = array(
			't02_datafim' => $datafim
		);
		$this->db->where('t02_id', $usrid);
		return $this->db->update('t02_morador', $data);
	}
}