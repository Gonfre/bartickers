<?php

#----------------------------------------------------------------------
# Archivo de configuracion
#
# Contiene configuraciones relacionadas con la aplicacion en general
#----------------------------------------------------------------------

$array = explode('/', $_SERVER["REQUEST_URI"],3);


#----------------------------------------------------------------------
# Section [RUTAS]
# Creadas por default
# Normalmente se dejan tal cual aparecen
#
# [Variables]
#   APP_PATH : Define el path de la aplicacion
#   APP_URL  : Define el URL de la aplicacion
#   APP_BASE : Define el path base de la aplicacion
#----------------------------------------------------------------------

define ("APP_PATH", $_SERVER['HTTP_HOST'].'/'.$array[1]);
define ("APP_URL",  'http://'.APP_PATH.'/');
define ("APP_BASE", "<base href='". APP_URL ."' />");


#----------------------------------------------------------------------
# Section [PRINCIPAL]
# Titulo inicial de las ventanas
# [Variables]
#   APP_TITLE   : Titulo inicial de las ventanas
#   APP_DEFAULT : controlador/metodo por defecto a mostrar. Si es vacio, se accede a la pagina de bienvenida del framework.
#----------------------------------------------------------------------

define ("APP_TITLE", "Barticker");
define ("APP_DEFAULT", "home");

	
#----------------------------------------------------------------------
# Section [SESIONES]
# Para controlar las sesiones
# [Variables]
#   SESSION_TIME           : Tiempo de time_out de la sesion activa. Se establece en segundos
#   SESSION_EXPIRE_TYPE    : Manera de controlar la sesion expirada
#                            [Posibles valores]
#                               1 : (MANUAL) Al intentar acceder a una funcionalidad, verifica si ya ha pasado el tiempo de inactividad
#                               2 : (AUTO) Al pasar el tiempo de inactividad se cierra automaticamente y se emite un mensaje (No implementado aun)
#----------------------------------------------------------------------

define ("SESSION_TIME", 3000); // 300 Segundos = 5 min
define ("SESSION_EXPIRE_TYPE", 1); 


#----------------------------------------------------------------------
# Section [ESTATUS]
# Define el estatus actual de la aplicacion
# [Variables]
#   APP_STATUS         : Define el estatus actual de la aplicacion
#                        [Posibles valores]
#                           1 : (ACTIVA) Aplicacion se encuentra en funcionamiento
#                           2 : (EN MANTENIMIENTO) Muestra un mensaje
#   APP_STATUS_MESSAGE : Mensaje a mostrar en caso de que la aplicacion se encuentre en mantenimiento
#----------------------------------------------------------------------

define ("APP_STATUS", 1);
define ("APP_STATUS_MESSAGE","ACTIVO");


#----------------------------------------------------------------------
# Section [i18n]
# Valores relacionados al i18n
# [Variables]
#   DEFAULT_LANG       : Define el lenguaje por default
#   I18N_METHOD        : Especifica el metodo empleado
#                        [Posibles valores]
#                           "DB"  : Base de datos (scripts de creacion de tablas: i18n.sql).
#                           "XML" : (En desarrollo)
#----------------------------------------------------------------------

define ("DEFAULT_LANG", "es");
define ("I18N_METHOD","XML");

?>
