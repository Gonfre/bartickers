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
		$this->nivelesPermitidos = array(2);
	}
	
	public function index() {
		$u = new Users();
		$u->doSelectOne( LocalUser::getCurrentUser()->getId() );
		//$u->doSelectOne(2); 
		
		if ($u->next()) {
			$this->name = $u->getValue("user_name");
			$this->email = $u->getValue("email");
			$this->telephone = $u->getValue("telephone");
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
	 */
	public function xSaveBasicData() {
		extract($_REQUEST);
		
		//Si el usuario colocó location
		if ($location != "") {
			//busco la location si existe
			$locId = $this->getLocationId($location);
			if ($locId == -1) { // no existe
				$l = new Locations();
				$l->setValue("location_name", $location);
				if ($l->doSave()) {
					$locId = $this->getLocationId($location);
				}
			}
		}
		
		//continuo...
		$u = new Users( LocalUser::getCurrentUser()->getId() ); //<<<< LocalUser
		$u->setValue("notif", $notif);
		$u->setValue("telephone", $phone);
		if (isset($locId)) {
			$u->setValue("location_id", $locId);
		}
		if ($u->doUpdate()) {
			echo "OK";
		} else {
			echo "KO";
		}
	}
	
	
	/**
	 * Elimina un album o una location del usuario
	 * @var type Tipo a eliminar: album, location 
	 * @var id ID a eliminar
	 */
	public function xDeleteSomething() {
		extract($_REQUEST);
		
		$ok = false;
		if ($type == "album") {
			$o = new Albums($id);
			$ok = $o->doDeleteIt(); 
		} else if ($type == "location") {
			$o = new User_locations();
			$o->addCondition("user_id", LocalUser::getCurrentUser()->getId() ); //<<<< LocalUser
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
	 */
	public function xAddSomething() {
		extract($_REQUEST);
		
		$ok = "KO";
		if ($type == "album") {
			$a = new Albums();
			$a->setValue("user_id", LocalUser::getCurrentUser()->getId() ); //LocalUser
			$a->setValue("album_type", $id);
			$a->setValue("album_name", $text);
			$a->setValue("ini_date", "%NOW()");
			if ($a->doSave()) {
				$ok = $a->getId();
			} else {
				$ok = "YA";
			}
		} else if ($type == "location") {
			//busco la location si existe
			$locId = $this->getLocationId($text);
			if ($locId == -1) { // no existe
				$l = new Locations();
				$l->setValue("location_name", $text);
				if ($l->doSave()) {
					$locId = $this->getLocationId($text);
				}
			}
			
			//actualizo la user_location
			$ul = new User_locations();
			$ul->setValue("user_id", LocalUser::getCurrentUser()->getId() ); //<<<< LocalUser
			$ul->setValue("location_id", $locId);
			if ($ul->doSave()) {
				$ok = "$locId";
			} else {
				$ok = "YA";
			}
		}
		
		echo $ok;
	}
	
	/**
	 * Almacena la lcoation (GPS) del usuario
	 * @var lat Latitud
	 * @var lon longitud
	 */
	public function xSaveUserLocation() {
		extract($_REQUEST);
		
		$u = new Users( LocalUser::getCurrentUser()->getId() ); //<<<< LocalUser
		$u->setValue("latitude", $lat);
		$u->setValue("longitude", $lon);
		
		if ($u->doUpdate()) {
			echo "OK";
		} else {
			echo "KO";
		}
	}
	
	
	private function getLocationId($locName) {
		$l = new Locations();
		$l->addCondition("location_name", $locName);
		if ($l->doSelectAll()) {
			if (!$l->next()) { //no existe
				return -1;
			} else {
				return $l->getId();
			}
		} else {
			return -1;
		}
	}
}

?>
