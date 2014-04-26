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
 * Guarda los datos básicos del cliente
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
			$("#liLocation-"+id).remove();
			$("#ulLocations").listview("refresh");
		}
	})
	.fail(function() {
		destroyMsg();
		showErrorDialog("Error", "Error eliminado los datos");
	});
}