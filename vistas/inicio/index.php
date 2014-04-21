<ul data-role="listview" data-split-icon="delete" data-theme="a" data-divider-theme="a" data-count-theme="c" data-inset="true">
	<li data-role="list-divider">
		<div class="ui-bar ui-bar-a" style="border:0px;">
		    <label><strong>Inicia Sesi&oacute;n con:</strong></label>
		</div>
	</li>
	<li>
		<div class="ui-grid-a" style="text-align:center;">
			 <div class="ui-block-a" style="width:100%;text-align:center;">
				<img src="recursos/imgs/face_sesion.png" alt="facebook">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<img src="recursos/imgs/google_sesion.png" alt="Google +">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<a href="#popupLogin" data-rel="popup" data-position-to="window" data-transition="pop" data-shadow="false" data-theme="none"><img src="recursos/imgs/50x50.png" border="0"/></a>
				<br/>
				<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
					<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
				    <form>
				        <div style="padding:10px 20px;">
				            <h3>Ingrese Usuario y Contraseña</h3>
				            <label for="un" class="ui-hidden-accessible">Usuario:</label>
				            <input type="text" name="user" id="un" value="" placeholder="usuario" data-theme="a">
				            <label for="pw" class="ui-hidden-accessible">Contrase&ntilde;a:</label>
				            <input type="password" name="pass" id="pw" value="" placeholder="contraseña" data-theme="a">
				            <button type="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">Ingresar</button>
				        </div>
				    </form>
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
