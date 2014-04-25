<?php

require_once("libs/controller.php");
require_once("libs/localuser.php");
require_once("libs/i18n.php");
require_once("modelos/users.php");
require_once("modelos/albums.php");
require_once("modelos/album_stickers.php");
require_once("modelos/locations.php");

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
			if ($this->locationId != 0) {
				$this->location = $u->getForeign("locations", "location_id")->getValue("location_name");
			}
			
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
		
		//Si el usuario colocó location
		if ($location != "") {
			$l = new Locations();
			$l->addCondition("location_name", $location);
			if ($l->doSelectAll()) {
				if (!$l->next()) { //no existe
					$l->clear();
					$l->setValue("location_name", $location);
					if ($l->doSave()) {
						$locId = $l->getId();
					}
				} else {
					$locId = $l->getId();
				}
			}
		}
		
		//continuo...
		$u = new Users(2);
		$u->setValue("notif", $notif);
		//<<<< Aca va el numero de telf
		if (isset($locId)) {
			$u->setValue("location_id", $locId);
		}
		if ($u->doUpdate()) {
			return "OK";
		} else {
			echo "KO";
		}
	}
}

?>
