<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

/**
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Enric Badia. Basado en Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Usuario extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('users_model');

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    /**
     * Funcion de autenticacion de usuarios
     *
     * @param           user email
     * @param           user password
     * @return          success: object with a jwt and email
     * @return          error: object with error
     * @author          Enric Badia.
     */

    public function users_get()
    {

        // hemos de comprobar el token
        $token = $this->get('token');
        try {
            $goodtoken = JWT::decode($token, $this->config->item('jwt_key'));
            // var_dump($goodtoken);
            if ($goodtoken == false)
            {
                // error. los campos de entrada estan vacios
                $output['status'] = false;
                $output['errors'] = 'authentication error';
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
            } else {
                // find all users in ddbb
                $users = $this->users_model->get();
                // Check if the users data store contains users (in case the database result returns NULL)
                if ($users)
                {
                    // Set the response and exit
                    $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    // Set the response and exit
                    $output['errors'] = '{"type": "No users were found"}';
                    $this->response($output, REST_Controller::HTTP_OK); // BAD_REQUEST (400)
                }
            }        
        } catch (Exception $e){
            $output['errors'] = $e->getMessage();
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
        }

    }

}

/* End of file usuario.php */
/* Location: ./application/controllers/api/v1/usuario.php */