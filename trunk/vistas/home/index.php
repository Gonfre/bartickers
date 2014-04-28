<script type="text/javascript">
<!--
$(document).on("ready", function() {
	$("div.invalidUser").hide();
	
	$("#popupLogin input").each( function() {
		$(this).on("input", function(e, ui) {
			var un = $("#un").val();
			var pw = $("#pw").val();
			
			if (un != "" && pw != "") {
				//if ($("#btnLogin").hasClass("ui-state-disabled")) {
					$("#btnLogin").removeClass("ui-state-disabled");
				//}
			} else {
				//if (!$("#btnLogin").hasClass("ui-state-disabled")) {
					$("#btnLogin").addClass("ui-state-disabled");
				//}
			}
		});
	});
});
//-->
</script>

<style>
<!--
div.invalidUser {
	color: red;
	text-align: center;
}
-->
</style>

<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
	<li data-role="list-divider">
		<div class="ui-bar ui-bar-a" style="border:0px;">
		    <label><strong>Inicia Sesi&oacute;n con:</strong></label>
		</div>
	</li>
	<li>
		<div class="ui-grid-a" style="text-align:center;">
			 <div class="ui-block-a" style="width:100%;text-align:center;">
				<!--  <img src="recursos/imgs/face_sesion.png" alt="facebook"> -->
				<img src="recursos/imgs/face_sesion.png" style="cursor:pointer;" onclick="Login()"/>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!-- <img src="recursos/imgs/google_sesion.png" alt="Google +"> -->
				<span id="signinButton">
				  <span
					class="g-signin"
					data-callback="signinCallback"
					data-clientid="640066723166-s3l58f6aju3ifce8f94loivd40b8960o.apps.googleusercontent.com"
					data-cookiepolicy="single_host_origin"
					data-requestvisibleactions="http://schemas.google.com/AddActivity"
					data-scope="https://www.googleapis.com/auth/plus.login"
					data-width="iconOnly"
					data-height="tall">
				  </span>
				</span>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<a href="#popupLogin" data-rel="popup" data-position-to="window" data-transition="pop" data-shadow="false" data-theme="none"><img src="recursos/imgs/45x45.png" border="0"/></a>
				<br/>
				<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
			        <div style="padding:10px 20px;">
			            <h3>Ingrese Usuario y Contraseña</h3>
			            <label for="un" class="ui-hidden-accessible">Usuario:</label>
			            <input type="text" name="user" id="un" value="" placeholder="usuario" data-theme="a" required="required">
			            <label for="pw" class="ui-hidden-accessible">Contrase&ntilde;a:</label>
			            <input type="password" name="pass" id="pw" value="" placeholder="contraseña" data-theme="a" required="required">
			            <div class="invalidUser">* Usuario y/o password inv&aacute;lidos</div>
			            <button type="button" onclick="loginWithBarticker()" id="btnLogin" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check ui-state-disabled">Ingresar</button>
			        </div>
				</div>			 
			 </div>
		</div>
    </li>
</ul>

<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
	<li data-role="list-divider">
		<div class="ui-bar ui-bar-a" style="border:0px;">
			<table border="0" style="width:100%;margin:left;">
				<tr>
					<td><label><strong>Registrate en Barticker</strong></label></td>
					<td style="text-align:left;"><img src="recursos/imgs/24x24.png" alt="facebook"></td>
				</tr>
			</table>
		    
		</div>
	</li>
	<li>
		<div class="ui-grid-a" style="text-align:center;">
			 <div class="ui-block-a" style="width:100%;text-align:center;">
				<table border="0" style="margin:auto;">
				<tr>
				  <td style="text-align:right;"><label for="usuario">Usuario:</label></td>
				  <td><input type="text" name="usuario" id="usuario" value=""></td>
				</tr>
				<tr>
				  <td style="text-align:right;"><label for="email">Email:</label></td>
				  <td><input type="email" data-clear-btn="false" name="email" id="email" value=""></td>
				</tr>
				<tr>
				  <td style="text-align:right;"><label for="contra">Contrase&ntilde;a:</label></td>
				  <td><input type="password" data-clear-btn="false" name="contra" id="contra" value="" autocomplete="off"></td>
				</tr>
				<tr>
				  <td colspan="2"><input type="button" value="Enviar"></td>
				</tr>
				</table>
				<p>
				<b>¿No est&aacute;s seguro de registrarte?</b><br/>
				Entonces prueba <a href="#">nuestro demo</a> para<br/>
				conocer todas las ventajas que<br/>te ofrecemos.
				</p>			 
			 </div>
		</div>
    </li>
</ul>
