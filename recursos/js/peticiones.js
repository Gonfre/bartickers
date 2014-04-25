/**
 * Archivo con peticiones 
 */


/********************* PROFILE *********************/
function saveBasicData() {
	createLoadMsg();
	//alert(document.getElementById("txtlocation").parentNode);
	//alert($("#txtLocation").parent().children(":first").children(":first").children(":first").val());
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