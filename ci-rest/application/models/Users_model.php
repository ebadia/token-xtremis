<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function login($email, $password)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$result = $query->result();
			if (Password::validate_password($password, $result[0]->password))
			{
				return $result[0]->id;
			}
			return false;
		}
		return false;
	}
    
	public function register($envio)
	{

		$user = array(
			'nombre' => $envio['firstname'],
			'apellidos' => $envio['lastname'],
			'email' => $envio['email'],
			'password' => Password::create_hash($envio['password'])
		);

		$this->db->insert('users', $user);
		return $this->db->insert_id();
	}

	public function get(){
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function exists($email){
		$this->db->select('id');
		$this->db->where('email', $email);
		$this->db->from('users');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function read($id)
	{
		$user = new stdClass();

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{
			$result = $query->result();
			$user->id = $result[0]->id;
			$user->email = $result[0]->email;
		}

		return $user;
	}

	public function update($user)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $user->id);
		$this->db->limit(1);

		$query = $this->db->get();
		if ($query->num_rows() == 1)
		{

			$this->db->where('id', $user->id);
			$this->db->update('users', $user);             
            
			$user = $this->read($user->id);
		}

		return $user;
	}	

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
		$this->db->limit(1);
	}
    
}

/* End of file users.php */
/* Location: ./application/models/Users_model.php */