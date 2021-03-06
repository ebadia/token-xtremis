<?php

/**
 * JSON Web Token implementation, based on this spec:
 * http://tools.ietf.org/html/draft-ietf-oauth-json-web-token-06
 *
 * PHP version 5
 *
 * @category Authentication
 * @package  Authentication_MIDDLE
 * @author   Enric Badia <enric@ideatius.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */
class MIDDLE
{
	/**
	 * Verifica a JWT string into a PHP object.
	 *
	 * @return object      The JWT's payload as a PHP object
	 * @throws UnexpectedValueException Provided JWT was invalid
	 * @throws DomainException          Algorithm was not provided
	 *
	 * @uses jsonDecode
	 * @uses urlsafeB64Decode
	 */
	public static function verify($peticion)
	{
        $CI = get_instance();

        try {
            // verifica token
            $token = $peticion['token'];
			// si el token ta vacio
            if ( $token == ""){
				redirect($CI->config->item('redireccion'));
			}

            $goodtoken = JWT::decode($token, $CI->config->item('jwt_key'));
			// si el token es incorrecto o esta expirado
            if ($goodtoken == false || $goodtoken->exp <= time())
            {
                // error. los campos de entrada estan vacios
				redirect($CI->config->item('redireccion'));
                return false;
            } else {
                return $token;
            }
        } catch (Exception $e){
            return false;
        }

        return false;
	}

}
