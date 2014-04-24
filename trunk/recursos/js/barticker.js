/**
 * 
 */

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
            $.ajax({
                url: "http://gd.geobytes.com/AutoCompleteCity",
                dataType: "jsonp",
                crossDomain: true,
                data: {
                    q: inputLocation.val()
                }
            })
            .then( function ( response ) {
                $.each( response, function ( i, val ) {
                	var li = document.createElement("LI");
                	var a = document.createElement("A");
                	a.innerHTML = val;
                	a.setAttribute("class", "ui-btn");
                	a.setAttribute("rel", "dialog");
                	a.onclick = function() {
                		inputLocation.val( val );
                        $ul.html( "" );
                        $ul.listview( "refresh" );
                        $ul.trigger( "updatelayout");
                	}
                	li.appendChild(a);
                	$ul.append(li);
                });
                //$ul.html( html );
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
	a1.setAttribute("class", "ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b");
	a1.innerHTML = "Cancelar";
	
	var a2 = document.createElement("A");
	a2.setAttribute("href", "javascript:"+action);
	a2.setAttribute("class", "ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b");
	a2.innerHTML = "Aceptar";
	
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
	a1.setAttribute("class", "ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b");
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