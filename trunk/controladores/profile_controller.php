<?php

require_once("libs/controller.php");
require_once("libs/localuser.php");
require_once("libs/i18n.php");
require_once("modelos/users.php");
require_once("modelos/albums.php");
require_once("modelos/album_stickers.php");
require_once("modelos/album_types.php");
require_once("modelos/locations.php");
require_once("modelos/user_locations.php");

class ProfileController extends Controller {
	
	public function __construct() {
		$this->layout = "main";
		$this->titleShowed = "Mi Perfil";
		$this->pageTitle = "Mi Perfil";
		//$this->nivelesPermitidos = array(2);
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
			
			//albums
			$this->albums = new Albums();
			$this->albums->addCondition("user_id", $u->getId());
			$this->albums->doSelectAllWithForeign("album_types", "album_type", DB_SAME_FIELD);
			
			//user locations
			$this->userLocations = new User_locations();
			$this->userLocations->addCondition("user_id", $u->getId());
			$this->userLocations->doSelectAllWithForeign("locations", "location_id", DB_SAME_FIELD);
			
			//album types
			$this->albumTypes = new Album_types();
			$this->albumTypes->doSelectAll();
		}
	}
	
	public function reputation() {
	
	}
	
	
	/*************************************************
	 * Funciones sin vistas
	 *************************************************/
	 
	/**
	 * Guarda los datos básicos del usuario
	 * @var phone Teléfono del usuario
	 * @var location Ubicación del usuario
	 * @var notif Notificaciones por email: Y/N
	 * @return string
	 */
	public function xSaveBasicData() {
		
		extract($_REQUEST);
		
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
		$u = new Users(2); //<<<< LocalUser
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
	
	
	/**
	 * Elimina un album o una location del usuario
	 * @var type Tipo a eliminar: album, location 
	 * @var id ID a eliminar
	 * @return string
	 */
	public function xDeleteSomething() {
		extract($_REQUEST);
		
		$ok = false;
		if ($type == "album") {
			$o = new Albums($id);
			$ok = $o->doDelete(); 
		} else if ($type == "location") {
			$o = new User_locations();
			$o->addCondition("user_id", 2); //<<<< LocalUser
			$o->addCondition("location_id", $id);
			$ok = $o->doDeleteAll();
		}
		
		if ($ok) {
			echo "OK";
		} else {
			echo "KO";
		}
	}
	
	
	/**
	 * Agrega un album o location al usuario
	 * @var type Tipo a eliminar: album, location 
	 * @var text Texto a guardar
	 * @return string
	 */
	public function xAddSomething() {
		extract($_REQUEST);
		
		$ok = "KO";
		if ($type == "album") {
			
		} else if ($type == "location") {
			//busco la location si existe
			$l = new Locations();
			$l->addCondition("location_name", $text);
			if ($l->doSelectAll()) {
				if (!$l->next()) { //no existe
					$l->clear();
					$l->setValue("location_name", $text);
					if ($l->doSave()) {
						$locId = $l->getId();
					}
				} else {
					$locId = $l->getId();
				}
			}
			
			//actualizo la user_location
			$this->ul = new User_locations();
			$this->ul->setValue("user_id", 2); //<<<< LocalUser
			$this->ul->setValue("location_id", $locId);
			if ($this->ul->doSave()) {
				$ok = "$locId";
			} else {
				$ok = "YA";
			}
		}
		
		echo $ok;
	}
}

?>
