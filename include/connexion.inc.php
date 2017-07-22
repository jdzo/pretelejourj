<?php 
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
// Émulation de register_globals à on
if (!ini_get('register_globals')) {
    $superglobals = array($_SERVER, $_ENV,
        $_FILES, $_COOKIE, $_POST, $_GET);
    if (isset($_SESSION)) {
        array_unshift($superglobals, $_SESSION);
    }
    foreach ($superglobals as $superglobal) {
        extract($superglobal, EXTR_SKIP);
    }
}

define("PATH_VUE", "./vue"); 

include "mysql.inc.php";
include"function.php";
?>