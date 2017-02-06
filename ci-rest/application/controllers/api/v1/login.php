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
class Login extends REST_Controller {

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

    public function user_post()
    {

        // hemos de comprobar que vienen con informacion
        $email = $this->post('email');
        $passw = $this->post('password');
        if ($email == '' || $passw == '')
        {
            // error. los campos de entrada estan vacios
            $output['status'] = false;
            $output['errors'] = 'email or password empty';
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
        }
        // una vez comprobados buscamos al user en la bbdd
        $id = $this->users_model->login($email,$passw);
        if ($id != FALSE){
            // predefinicion de variables del token
            $issuedAt   = time();
            $notBefore  = $issuedAt + (int) 5;      //+ 5 segundos
            $expire     = $notBefore + (int) (60*60*4); // + 4 horas
            // definicion del token y creacion
            $token = array();
            $token['id'] = $id;
            $token['iat'] = $issuedAt;
            $token['nbf'] = $notBefore;
            $token['exp'] = $expire;
            $output['status'] = true;
            $output['email'] = $email;
            $output['token'] = JWT::encode($token, $this->config->item('jwt_key'));
            $this->response($output, REST_Controller::HTTP_OK);
        }
        else
        {
            // error. las credenciales son erroneas
            $output['status'] = FALSE;
            $output['errors'] = 'email or password error';
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
        }

    }

    /**
     * Funcion de alta de nuevos usuarios
     *
     * @param           user email
     * @param           user password
     * @return          success: object with a jwt and email
     * @return          error: object with error
     * @author          Enric Badia.
     */

    public function users_post()
    {
        
        $envio = $this->post();

        $email = $this->post('email');
        $password = $this->post('password');
        // echo $email ;

        // comprobamos si el usuario existe
        $existo = $this->users_model->exists($email);
        if ($existo > 0) {
            // error. el usuario ya existe
            $output['status'] = false;
            $output['errors'] = 'the user exists';
            $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
        } else {
            // si no existe intentamos crearlo
            $id = $this->users_model->register($envio);
            if ($id != ""){
                $output['status'] = true;
                $output['email'] = $email;
                $this->response($output, REST_Controller::HTTP_CREATED); // CREATED (201)
            } else {
                // error. no se ha podido crear el usuario
                $output['status'] = false;
                $output['errors'] = 'cannot create new user';
                $this->response($output, REST_Controller::HTTP_NOT_FOUND); // BAD_REQUEST (400)
            }            
        }
        
    }

}

/* End of file login.php */
/* Location: ./application/controllers/api/v1/login.php */