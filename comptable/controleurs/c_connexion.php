<?php
/*
 * GSB Project 2022
*/
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
	case 'demandeConnexion': {
			include("vues/v_connexion.php");
			break;
		}
	case 'valideConnexion': {
			$login = $_REQUEST['login'];
			$mdp = $_REQUEST['mdp'];
			if (isset($login) && isset($mdp) && !empty($login) && !empty($mdp)) {
				$comptable = $pdo->getInfosComptable($login, $mdp);
				if (!is_array($comptable)) {
					header('Location: index.php');
				} else {
					$id = $comptable['id'];
					$nom =  $comptable['nom'];
					$prenom = $comptable['prenom'];
					connecter($id, $nom, $prenom);
					include("vues/v_sommaire.php");
				}
				break;
			} else {
				header('Location: index.php');
			}
		}
	default: {
			include("vues/v_connexion.php");
			break;
		}
}
