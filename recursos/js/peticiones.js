/**
 * Archivo con peticiones 
 */


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
			alert(1);
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