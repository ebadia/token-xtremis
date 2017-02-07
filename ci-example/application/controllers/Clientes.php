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
        $peticion = $this->uri->uri_to_assoc();
        $token = MIDDLE::verify($peticion);
        if ($token == false ){
            $this->load->view('error');
            return;
        }

        /**
         * procesa la peticion
         * find all users in ddbb
        */

        $clientes = $this->clientes_model->get();

        // Check if the users data store contains users (in case the database result returns NULL)
        if ($clientes)
        {
            $data['clientes'] = $clientes;
            $data['token'] = $token;
            $this->load->view('header');
            $this->load->view('lista_clientes', $data);
            $this->load->view('footer');
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

    public function cliente(){

        // hemos de comprobar el token
        $peticion = $this->uri->uri_to_assoc();
        $token = MIDDLE::verify($peticion);
        if ($token == false ){
            $this->load->view('error');
            return;
        }

        /**
         * procesa la peticion
         * find all users in ddbb
        */

        $res = $this->clientes_model->read($peticion['id']);

        // Check if the users data store contains users (in case the database result returns NULL)
        if ($res)
        {
            $data['cliente'] = $res;
            $data['token'] = $token;
            $this->load->view('header');
            $this->load->view('detalle_clientes', $data);
            $this->load->view('footer');
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

}
