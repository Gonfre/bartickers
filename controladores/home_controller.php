<?php

require_once("libs/controller.php");
require_once 'modelos/users.php';
require_once 'libs/localuser.php';

class HomeController extends Controller {
	
	public function __construct() {
		$this->layout = "noMenu";
		$this->titleShowed = "Inicio";	
		$this->pageTitle = "Inicio";
	}
	
	public function index() {
		LocalUser::clearCurrentUser();
	}
	
	/**
	 * Login mediante barticker
	 * @var user Correo
	 * @var pass Password
	 */
	public function xLogin() {
		extract($_REQUEST);
		
		$u = new Users();
		$u->addCondition("user_name", $user);
		$u->addCondition("password", "%md5('$pass')");
		
		if ($u->doSelectAll() && $u->next()) { //valido!
			//se utlizara la clase LocalUser
			/*
				id			user_id
				id_persona	email
				alias		user_name
				nivel		2
			*/
			LocalUser::setCurrentUser($u->getId(), $u->getValue("email"), $user, 2, null, null, null);
			
			echo "OK";
		} else {
			echo "KO";
		}
	}
}

?>
