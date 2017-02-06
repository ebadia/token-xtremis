<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('clientes_model');

    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function lista(){
        // hemos de comprobar el token
        // /clientes/lista/
        $token = $this->uri->segment(3);
        try {
            $goodtoken = JWT::decode($token, $this->config->item('jwt_key'));
            // var_dump($goodtoken);
            if ($goodtoken == false)
            {
                // error. los campos de entrada estan vacios
                //$output['status'] = false;
                //$output['errors'] = 'authentication error';
                //$this->response($output, 404); // BAD_REQUEST (400)
                $this->output->set_status_header(400);
                $this->output->set_output('Not allowed');
            } else {
                // find all users in ddbb
                $clientes = $this->clientes_model->get();
                // Check if the users data store contains users (in case the database result returns NULL)
                if ($clientes)
                {
                    $data['clientes'] = $clientes;
                    $this->load->view('lista_clientes', $data);
                    // Set the response and exit
                    //$this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    // Set the response and exit
                    //$output['errors'] = '{"type": "No users were found"}';
                    //$this->response($output, 400); // BAD_REQUEST (400)
                    $this->output->set_status_header(400);
                    $this->output->set_output('No users were found');
                }
            }
        } catch (Exception $e){
            //$output['errors'] = $e->getMessage();
            //$this->response($output, 400); // BAD_REQUEST (400)
            $this->output->set_status_header(400);
            $this->output->set_output($e->getMessage());
        }
    }

}
