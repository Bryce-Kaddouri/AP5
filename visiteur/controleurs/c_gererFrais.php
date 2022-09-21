<?php
/*
 * GSB Project 2022
*/
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];

$action = $_REQUEST['action'];
$today = explode(' ', date("Y-m-d"))[0];
$todayExplode = explode("-", $today);
$todayYear = $todayExplode[0];
$todayMonth = $todayExplode[1];
$mois = $todayYear . $todayMonth;
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
switch ($action) {
	case 'saisirFrais': {
			if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
				$pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
			}
			break;
		}
	case 'validerMajFraisForfait': {
			$lesFrais = $_REQUEST['lesFrais'];
			if (lesQteFraisValides($lesFrais)) {
				$pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
			} else {
				ajouterErreur("Les valeurs des frais doivent être numériques");
				include("vues/v_erreurs.php");
			}
			break;
		}
	case 'validerCreationFrais': {
			$dateFrais = new DateTime($_REQUEST['dateFrais']);
                        $dateFraisSaisi = $dateFrais->format("Y-m-d");
                        $mois =  $dateFrais->format('Ym');
			$libelle = $_REQUEST['libelle'];
			$montant = $_REQUEST['montant'];
			$justificatif = $_REQUEST['justificatif'];
                        
			//valideInfosFrais($dateFrais, $libelle, $montant, $justificatif);
			if (nbErreurs() != 0) {
				include("vues/v_erreurs.php");
			} else {
				$pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $dateFraisSaisi, $montant, $justificatif);
			}
			break;
		}
	case 'supprimerFrais': {
			$idFrais = $_REQUEST['idFrais'];
			$pdo->supprimerFraisHorsForfait($idFrais);
			break;
		}
}
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
$totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($idVisiteur, $mois);
include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");
