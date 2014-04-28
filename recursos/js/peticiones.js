/** ***************************************
 * Archivo con peticiones 
 ******************************************/


/*********************  LOGIN  *********************/

function loginWithBarticker() {
	var un = $("#un").val();
	var pw = $("#pw").val();
	
	createLoadMsg();
	$.ajax({
		type: "POST",
		url: "home/xLogin",
		data: {
			user: un, 
			pass: pw
		}
	})
	.done(function( msg ) {
		destroyMsg();
		if (msg == "KO") {
			$("div.invalidUser").show();
		} else {
			//redirect to profile!
			var loc = window.location.href;
			loc = loc.replace("home", "profile");
			loc = loc.substring(0, loc.indexOf("profile")+7);
			window.location.href = loc;
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error en login");
	});
}


/********************* PROFILE *********************/

/**
 * Guarda los datos básicos del cliente
 */
function saveBasicData() {
	createLoadMsg();
	$.ajax({
		type: "POST",
		url: "profile/xSaveBasicData",
		data: {
			phone: $("#txtPhone").val(), 
			location: $("#txtLocation").parent().children(":first").children(":first").children(":first").val(), 
			notif: ($("#checkNotif").is(":checked") ? "Y" : "N")
		}
	})
	.done(function( msg ) {
		destroyMsg();
		if (msg == "KO") {
			showErrorDialog("Error", "Error guardando datos");
		} else {
			showErrorDialog("Informaci&oacute;n", "Datos b&aacute;sicos guardados", "a");
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error guardando datos");
	});
}

/**
 * Elimina un location o un album
 */
function deleteIt(tipo, id) {
	createLoadMsg();
	closeDialog("confirmDialog");
	$.ajax({
		type: "POST",
		url: "profile/xDeleteSomething",
		data: {
			type: tipo, 
			id: id
		}
	})
	.done(function( msg ) {
		destroyMsg();
		if (msg == "KO") {
			showErrorDialog("Error", "Error guardando datos");
		} else {
			if (tipo == "location") {
				$("#liLocation-"+id).remove();
				$("#ulLocations").listview("refresh");
			} else {
				$("#liAlbum-"+id).remove();
				$("#ulAlbums").listview("refresh");
				
				//menu
				$("#menuAlbum-"+id).remove();
				$("#menuAlbums").collapsibleset("refresh");
			}
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error eliminado los datos");
	});
}

/**
 * Agrega al usuario un album o un location
 */
function addIt(tipo, popup, cant) {
	createLoadMsg();
	var text = "";
	var id = "";
	if (tipo == "location") {
		text = getFilterlistInputObj("txtNewPlace").val()
	} else {
		text = $("#txtAlbumName").val();
		id = $("#txtAlbumId").val();
	}
	closeDialog(popup, true);
	getFilterlistInputObj("txtNewPlace").val("");
	$.ajax({
		type: "POST",
		url: "profile/xAddSomething",
		data: {
			type: tipo, 
			text: text,
			id: id
		}
	})
	.done(function( msg ) {
		destroyMsg();
		if (msg == "KO") {
			showErrorDialog("Error", "Error guardando datos");
		} else {
			if (tipo == "location") {
				if (msg == "YA") {
					showErrorDialog("Aviso", "Ya existe!");
				} else {
					var toAdd = '<li id="liLocation-'+msg+'">' +
								'	<a href="#"><label>'+text+'</label></a>' +
								'	<a href="#confirmDialog" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar la ubicacion &quot;'+text+'&quot;?\', \'Esto no se puede deshacer.\', \'deleteIt(\\\'location\\\','+msg+')\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>' +
								'</li>';
					$("#ulLocations").append(toAdd);
					$("#ulLocations").listview("refresh");
				}
			} else {
				var toAdd = '<li id="liAlbum-'+msg+'">' +
							'  <a href="#"><label>'+text+'</label><span class="ui-li-count">0/'+$("#txtAlbumStickers").val()+'</span></a>' +
							'  <a href="#" onclick="javascript:showConfirmDialog(\'Eliminar?\',\'Desea eliminar el album &quot;'+text+'&quot;?\', \'Esto no se puede deshacer.\', \'deleteIt(\\\'album\\\','+msg+')\');" data-rel="popup" data-position-to="window" data-transition="flip"></a>' +
							'</li>';
				$("#ulAlbums").append(toAdd);
				$("#ulAlbums").listview("refresh");
				
				//menu
				var toAddMenu = '<div id="menuAlbum-'+msg+'" data-role="collapsible">' +
								'   <h5>'+text+' (<span id="menuCant-'+msg+'">0</span>/'+$("#txtAlbumStickers").val()+')</h5>' +
								'   <fieldset data-role="controlgroup" data-mini="true">' +
								'      <a href="#" rel="external" class="ui-btn ui-mini ui-corner-all ui-btn-a ui-icon-eye ui-btn-icon-left">' +
										'Ver &aacute;lbum' +
									  '</a>' +
								'      <a href="bartering?album_id='+msg+'" rel="external" class="ui-btn ui-corner-all ui-btn-a ui-icon-recycle ui-btn-icon-left">' +
										'Truequear' +
									  '</a>' +
								'   </fieldset>' +
								'</div>';
				
				$("#menuAlbums").append(toAddMenu);
				$("#menuAlbums").collapsibleset("refresh");
			}
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error eliminado los datos");
	});
}

/**
 * Almacena la location (GPS) del usuario
 * @param lat
 * @param lon
 */
function saveUserLocation(lat, lon) {
	$.ajax({
		type: "POST",
		url: "profile/xSaveUserLocation",
		data: {
			lat: lat, 
			lon: lon
		}
	})
	.done(function( msg ) {
		
	})
	.fail(function() {
		
	});
}