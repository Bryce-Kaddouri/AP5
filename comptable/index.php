<?php
/*
 * GSB Project 2022
*/
require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
include("vues/v_entete.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if (!isset($_REQUEST['uc']) || !$estConnecte) {
	$_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
switch ($uc) {
	case 'connexion': {
			include("controleurs/c_connexion.php");
			break;
		}
	case 'validerFrais': { 
			include("controleurs/c_validerFrais.php");
			break;
		}
	case 'suivrePaiement': { 
			include("controleurs/c_suivrePaiement.php");
			break;
		}
}
include("vues/v_pied.php");
