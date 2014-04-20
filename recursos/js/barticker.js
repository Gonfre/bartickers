/**
 * 
 */

function loadGeoData(idText) {
	$( "#"+idText ).on( "filterablebeforefilter", function ( e, data ) {
        var $ul = $( this );
        input = $( data.input );
        value = input.val();
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
                    q: input.val()
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
                		input.val( val );
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
	a1.setAttribute("href", "javascript:closeDialog();");
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
	//$( "#confirmDialog" ).popup( "open" );
}

function closeDialog() {
	$( "#confirmDialog" ).popup( "close" );
	$( "#confirmDialog" ).remove();
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