<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name = "viewport" content = "user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes">
    
    	<?php echo APP_BASE; ?>
		<title><?php echo APP_TITLE; ?> - <?php echo $this->pageTitle; ?></title>
		<script type="text/javascript" src="recursos/js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="recursos/js/jquery.mobile-1.4.2.min.js"></script>
		
		<link rel="stylesheet" type='text/css' href="recursos/css/jquery.mobile.structure-1.4.2.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/jquery.mobile.icons.min.css"/>
		<link rel="stylesheet" type='text/css' href="recursos/themes/barticker-green.css"/>

    </head>
    <body>
    
    <!-- INICIO LOGIN FACEBOOK -->
    
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
			  appId      : '1468030403430841', // Set YOUR APP ID
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});

			FB.Event.subscribe('auth.authResponseChange', function(response){
				if (response.status === 'connected'){
					document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
					//SUCCESS
				}    
				else if (response.status === 'not_authorized'){
					document.getElementById("message").innerHTML +=  "<br>Failed to Connect";
					//FAILED
				} else {
					document.getElementById("message").innerHTML +=  "<br>Logged Out";
					//UNKNOWN ERROR
				}
			}); 

		};
	 
		function Login(){
			FB.login(function(response) {
				if (response.authResponse){
					getUserInfo();
				} else{
					console.log('User cancelled login or did not fully authorize.');
				}
			},{scope: 'email,user_photos,user_videos'});
		}
	 
		function getUserInfo() {
			FB.api('/me', function(response) {
				var str="<b>Name</b> : "+response.name+"<br>";
				  //str +="<b>Link: </b>"+response.link+"<br>";
				  str +="<b>Username:</b> "+response.username+"<br>";
				  str +="<b>id: </b>"+response.id+"<br>";
				  str +="<b>Email:</b> "+response.email+"<br>";
				  //str +="<input type='button' value='Get Photo' onclick='getPhoto();'/>";
				  //str +="<input type='button' value='Logout' onclick='Logout();'/>";
				  alert("Bienvenido "+response.name +"("+response.username+"). Email: "+ response.email);
				  //document.getElementById("status").innerHTML=str;
			});
		}
		
		
		function Logout(){
			FB.logout(function(){document.location.reload();});
		}
	 
	  // Load the SDK asynchronously
	  (function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 ref.parentNode.insertBefore(js, ref);
	   }(document));
	   
	 
	</script>
	
	<!-- FIN LOGIN FACEBOOK -->
    
    
    	<div data-role="page" data-theme="a" id="page" data-url="page">
			
			<!-- header -->
			<div data-role="header" data-position="fixed">
				<h1><?php echo $this->titleShowed; ?></h1>
				<?php echo (isset($this->right) ? $this->right : "");?>
			</div>
			
			<!-- content -->
			<div data-role="content" data-theme="a">
				<?php $this->showContent(); ?>
			</div>
			
			<!-- footer -->
			<div data-role="footer" data-theme="a">
				<h2>..:: Powered by El_nombre ::..</h2>
			</div>
					
		</div><!-- page -->

    </body>
</html>
