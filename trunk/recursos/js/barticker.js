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
                	a.innerHTML = texto;
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
	a1.setAttribute("class", "ui-btn ui-icon-delete ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b");
	a1.innerHTML = "Cancelar";
	
	var a2 = document.createElement("A");
	a2.setAttribute("href", "javascript:"+action);
	a2.setAttribute("class", "ui-btn ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b");
	a2.innerHTML = "Aceptar";
	
	var grid = document.createElement("DIV");
	grid.setAttribute("class", "ui-grid-a");
	
	var g1 = document.createElement("DIV");
	g1.setAttribute("class", "ui-block-a");
	
	var g2 = document.createElement("DIV");
	g2.setAttribute("class", "ui-block-b");
	
	
	divPopup.appendChild(divHeader);
	divPopup.appendChild(divMain);
	divHeader.appendChild(h1);
	divMain.appendChild(h3);
	divMain.appendChild(p);
	divMain.appendChild(grid);
	grid.appendChild(g1);
	grid.appendChild(g2);
	g1.appendChild(a2);
	g2.appendChild(a1);
	
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
	a1.setAttribute("class", "ui-btn ui-icon-check ui-btn-icon-left ui-corner-all ui-shadow ui-btn-b");
	a1.innerHTML = "Aceptar";
	
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

function closeDialog(id) {
	$( "#"+id ).popup( "close" );
	$( "#"+id ).remove();
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
	$(".box").bind( "taphold", tapholdHandler );
	
	function tapholdHandler( event ){
		//$( event.target ).parent().parent().addClass( "taphold" );
		$( event.target ).parent().attr("href","#confirmDialog");
		$( event.target ).parent().attr("data-rel","popup");
		$( event.target ).parent().attr("data-position-to","window");
		$( event.target ).parent().attr("data-transition","slidefade");
		showConfirmDialog('001');
	}	
}

function tapBox() {
	$( ".box" ).bind( "tap", tapHandler );
	 
	function tapHandler( event ){
		$( event.target ).parent().parent().addClass( "tap" );
	}	
}

function changeColor(item){
	var nombre = $(item).attr("nombre");	
	if(nombre == "coloreadoa"){
		$(item).attr("nombre","coloreadoc");
		$(item).removeClass("ui-btn-a").addClass("ui-btn-c");
	}
	else if(nombre == "coloreadoc"){
		$(item).attr("nombre","coloreadoa");
		$(item).removeClass("ui-btn-c").addClass("ui-btn-a");
	}
	else{
		$(item).attr("nombre","coloreadoa");
	}
}
