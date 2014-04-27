/**
 * 
 */
function omitirAcentos(text) {
    var acentos = "√¿¡ƒ¬»…À ÃÕœŒ“”÷‘Ÿ⁄‹€„‡·‰‚ËÈÎÍÏÌÔÓÚÛˆÙ˘˙¸˚—Ò«Á";
    var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc";
    for (var i=0; i<acentos.length; i++) {
        text = text.replace(acentos.charAt(i), original.charAt(i));
    }
    return text;
}

function getLocationInputObj(idUl) {
	return $("#"+idUl).parent().find(":input");
}

function getPlaces( q, startWith, country, callback) {
	$.ajax({
    	url: "http://api.geonames.org/search",
        dataType: "jsonp",
        crossDomain: true,
        data: {
            q: q,
            name_startsWith: startWith,
            fuzzy: "4",
            maxRows: "10",
            username: "xionjames",
            cities: "cities1000",
            country: country,
            featureClass: "P",
            type: "json",
            style: "FULL",
            lang: "en"
        }
    })
    .then( callback );
}

function loadGeoData(idText) {
	$( "#"+idText ).on( "filterablebeforefilter", function ( e, data ) {
        var $ul = $( this );
        inputLocation = $( data.input );
        value = inputLocation.val();
        html = "";
        $ul.html( "" );
        if ( value && value.length > 2 ) {
            $ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
            $ul.listview( "refresh" );
            getPlaces(inputLocation.val(), inputLocation.val(), sGeobytesInternet, function(response){
            	$.each( response.geonames, function ( i, val ) {
                	var li = document.createElement("LI");
                	var a = document.createElement("A");
                	var texto = val.name + (val.adminName1 ? (val.adminName1 != val.name ? ", "+val.adminName1 : "") : "") + ", " + val.countryName;
                	texto = omitirAcentos(texto);
                	a.innerHTML = "<p><strong>"+texto+"</strong></p>";
                	a.setAttribute("class", "ui-btn");
                	a.setAttribute("rel", "dialog");
                	a.onclick = function() {
                		inputLocation.val( texto );
                        $ul.html( "" );
                        $ul.listview( "refresh" );
                        $ul.trigger( "updatelayout");
                	}
                	li.appendChild(a);
                	$ul.append(li);
                });
                $ul.listview( "refresh" );
                $ul.trigger( "updatelayout");
            });
            
            
        }
    });
}

function putValue(id, val) {
	alert($( "#"+id ).val());
}

function showConfirmDialog(title, msg, msg2, action) {
	
	var divPopup = document.createElement("DIV");
	divPopup.setAttribute("data-role", "popup");
	divPopup.setAttribute("id", "confirmDialog");
	divPopup.setAttribute("data-overlay-theme", "b");
	divPopup.setAttribute("data-theme", "b");
	divPopup.setAttribute("data-dismissible", "false");
	divPopup.setAttribute("style", "max-width:400px;");
	
	var divHeader = document.createElement("DIV");
	divHeader.setAttribute("data-role", "header");
	divHeader.setAttribute("data-theme", "a");
	divHeader.setAttribute("role", "banner");
	divHeader.setAttribute("class", "ui-header ui-bar-a");
	
	var h1 = document.createElement("H1");
	h1.setAttribute("class", "ui-title");
	h1.setAttribute("role", "heading");
	h1.innerHTML = title;
	
	var divMain = document.createElement("DIV");
	divMain.setAttribute("role", "main");
	divMain.setAttribute("class", "ui-content");
	
	var h3 = document.createElement("H3");
	h3.setAttribute("class", "ui-title");
	h3.innerHTML = msg;
	
	var p = document.createElement("P");
	p.innerHTML = msg2;
	
	var a1 = document.createElement("A");
	a1.setAttribute("href", "javascript:closeDialog('confirmDialog');");
	a1.setAttribute("class", "ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext");
	a1.innerHTML = "Cancel";
	
	var a2 = document.createElement("A");
	a2.setAttribute("href", "javascript:"+action);
	a2.setAttribute("class", "ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext");
	a2.innerHTML = "Ok";
	
	divPopup.appendChild(divHeader);
	divPopup.appendChild(divMain);
	divHeader.appendChild(h1);
	divMain.appendChild(h3);
	divMain.appendChild(p);
	divMain.appendChild(a2);
	divMain.appendChild(a1);
	
	document.getElementById("content").appendChild(divPopup);
	
	// preparo el div
	$( "#confirmDialog" ).popup();
	$( "#confirmDialog" ).popup( "open", {transition: "flip"} );
}

function showErrorDialog(title, msg) {
	
	var divPopup = document.createElement("DIV");
	divPopup.setAttribute("data-role", "popup");
	divPopup.setAttribute("id", "errorDialog");
	divPopup.setAttribute("data-overlay-theme", "b");
	divPopup.setAttribute("data-theme", "b");
	divPopup.setAttribute("data-dismissible", "false");
	divPopup.setAttribute("style", "max-width:400px;");
	
	var divHeader = document.createElement("DIV");
	divHeader.setAttribute("data-role", "header");
	divHeader.setAttribute("data-theme", "a");
	divHeader.setAttribute("role", "banner");
	divHeader.setAttribute("class", "ui-header ui-bar-d");
	
	var h1 = document.createElement("H1");
	h1.setAttribute("class", "ui-title");
	h1.setAttribute("role", "heading");
	h1.innerHTML = title;
	
	var divMain = document.createElement("DIV");
	divMain.setAttribute("role", "main");
	divMain.setAttribute("class", "ui-content");
	
	var h3 = document.createElement("H4");
	//h3.setAttribute("class", "ui-title");
	h3.innerHTML = msg;
	
	var a1 = document.createElement("A");
	a1.setAttribute("href", "javascript:closeDialog('errorDialog');");
	a1.setAttribute("class", "ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b ui-btn-icon-notext");
	a1.innerHTML = "Ok";
	
	divPopup.appendChild(divHeader);
	divPopup.appendChild(divMain);
	divHeader.appendChild(h1);
	divMain.appendChild(h3);
	divMain.appendChild(a1);
	
	document.getElementById("content").appendChild(divPopup);
	
	// preparo el div
	$( "#errorDialog" ).popup();
	$( "#errorDialog" ).popup( "open", {transition: "flip"} );
}

function showAlbumsDialog(msg) {
	
	var divPopup = document.createElement("DIV");
	divPopup.setAttribute("data-role", "popup");
	divPopup.setAttribute("id", "albumsDialog");
	divPopup.setAttribute("class", "ui-corner-all");
	divPopup.setAttribute("data-theme", "a");
	
	var divMain = document.createElement("DIV");
	divMain.setAttribute("role", "main");
	divMain.setAttribute("class", "ui-content");
	
	var h3 = document.createElement("H3");
	h3.setAttribute("class", "ui-title");
	h3.innerHTML = msg;
	
	var a1 = document.createElement("A");
	a1.setAttribute("href", "#");
	a1.setAttribute("data-rel", "back");
	a1.setAttribute("class", "ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right");
	a1.innerHTML = "Close";
	
	divPopup.appendChild(divMain);
	divPopup.appendChild(a1);
	divMain.appendChild(h3);
	document.getElementById("content").appendChild(divPopup);
	
	// preparo el div
	$( "#albumsDialog" ).popup();
	$( "#albumsDialog" ).popup( "open", {transition: "flip"} );
}

function closeDialog(id, keep) {
	$( "#"+id ).popup( "close" );
	if (!keep) {
		$( "#"+id ).remove();
	}
}

function createLoadMsg() {
    var $this = $( this ),
        theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
        msgText = "Cargando...",
        textVisible = "true",
        textonly = !!$this.jqmData( "textonly" );
        html = $this.jqmData( "html" ) || "";
    $.mobile.loading( "show", {
            text: msgText,
            textVisible: textVisible,
            theme: theme,
            textonly: textonly,
            html: html
    });
}

function destroyMsg() {
	$.mobile.loading( "hide" );
}


function openMenuOnSwipe() {
    $( document ).on( "swiperight", "#page", function( e ) {
        if ( $( ".ui-page-active" ).jqmData( "panel" ) !== "open" ) {
            if ( e.type === "swiperight" ) {
                $( "#panel-menu" ).panel( "open" );
            }
        }
    });
} 

function holdTapBox() {
	$("button.box").bind( "taphold", tapholdHandler );
	
	function tapholdHandler( event ){
		//$( event.target ).parent().parent().addClass( "taphold" );
		showAlbumsDialog("pepito perez");
		//showConfirmDialog('001');
	}	
}

function changeColor(item){
	var nombre = $(item).attr("nombre");	
	if(nombre == "coloreadoa"){
		$(item).attr("nombre","coloreadoc");
		$(item).removeClass("ui-btn-a").addClass("ui-btn-c");
		$(item).children().text("1");
	}
	else if(nombre == "coloreadoc"){
		$(item).attr("nombre","coloreadod");
		$(item).removeClass("ui-btn-c").addClass("ui-btn-d");
		$(item).children().text("2");
	}
	else{
		/*$(item).attr("nombre","coloreadoa");
		$(item).removeClass("ui-btn-d").addClass("ui-btn-a");*/
		var valor = parseInt($(item).children().text());	
		$(item).children().text(function() {
			  return valor + 1;
			});
	}
}
