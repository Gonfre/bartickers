<?php

require_once("libs/controller.php");
require_once("libs/localuser.php");
require_once("modelos/users.php");
require_once("modelos/albums.php");
require_once("modelos/album_stickers.php");

class ProfileController extends Controller {
	
	public function __construct() {
		$this->layout = "main";
		$this->titleShowed = "Mi Perfil";	
		$this->pageTitle = "Mi Perfil";
	}
	
	public function index() {
		$u = new Users();
		//$u->doSelectOne( LocalUser::getCurrentUser()->getId() );
		$u->doSelectOne(2); 
		
		if ($u->next()) {
			$this->name = $u->getValue("user_name");
			$this->email = $u->getValue("email");
			$this->locationId = $u->getValue("location_id");
			$this->notif = $u->getValue("notif");
			
			$this->albums = new Albums();
			$this->albums->addCondition("user_id", $u->getId());
			if ($this->albums->doSelectAllWithForeign("album_types", "album_type", DB_SAME_FIELD)) {
			}
			
		}
	}
	
	public function reputation() {
	
	}
	
	
	//Funciones sin vistas
	public function xSaveBasicData() {
		$phone = $_REQUEST["phone"];
		$location = $_REQUEST["location"];
		$notif = $_REQUEST["notif"];
		
		echo "KO";
	}
}

?>
