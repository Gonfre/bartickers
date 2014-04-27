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
function addIt(tipo, text, popup) {
	createLoadMsg();
	text = (tipo == "location" ? getLocationInputObj("txtNewPlace").val() : text); 
	closeDialog(popup, true);
	getLocationInputObj("txtNewPlace").val("");
	$.ajax({
		type: "POST",
		url: "profile/xAddSomething",
		data: {
			type: tipo, 
			text: text
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
			}
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error eliminado los datos");
	});
}