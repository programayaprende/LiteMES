<?php
namespace App\Controllers;

/**
 * Class SecureController
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class SecureController extends Controller
{
    /**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.
        // $this->session = \Config\Services::session();
        
        if(!session()->get('isLoggedIn')){
			
			//Guarda el registro del intento
			///
			//
			
			header("Location: ".base_url("/Login"));
            die();
        }
	}
}
