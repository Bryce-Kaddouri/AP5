<?php
/*
 * GSB Project 2022
*/
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch ($action) {
	case 'selectionnerMois': {
			$lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
			// Afin de sélectionner par défaut le dernier mois dans la zone de liste
			// on demande toutes les clés, et on prend la première,
			// les mois étant triés décroissants
			$lesCles = array_keys($lesMois);
			$moisASelectionner = $lesCles[0];
			include("vues/v_listeMois.php");
			break;
		}
	case 'voirEtatFrais': {
			// liste des mois 
			$leMois = $_REQUEST['lstMois'];
			$lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
			$moisASelectionner = $leMois;
			include("vues/v_listeMois.php");
			// fin liste des mois 

			// récupération infos fiche de frais
			$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
			$numAnnee = substr($leMois, 0, 4);
			$numMois = substr($leMois, 4, 2);
			$libEtat = $lesInfosFicheFrais['libEtat'];
			$montantValide = $lesInfosFicheFrais['montantValide'];
			$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
			$dateModif =  $lesInfosFicheFrais['dateModif'];
			$dateModif =  dateAnglaisVersFrancais($dateModif);
			// fin récupération infos fiche de frais 

			// récupération infos frais forfait
			$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
			// fin récupération infos frais forfait

			// récupération infos frais hors forfait
			$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
			// fin récupération infos frais hors forfait

			// inclusion vue état frais
			include("vues/v_etatFrais.php");
			// fin inclusion vue état frais
			break;
		}
}
