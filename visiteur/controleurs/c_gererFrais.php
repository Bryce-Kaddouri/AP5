<?php
/*
 * GSB Project 2022
*/
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];

$action = $_REQUEST['action'];
$mois = date("Ym");
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
switch ($action) {
	case 'saisirFrais': {
			if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
				// revoir cette partie !!!!!!
				$pdo->majEtatFicheFrais($idVisiteur, $mois, 'CL');
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
			// verif date
			if (!empty($_REQUEST['dateFrais']) && preg_match("/\d{4}-\d{2}-\d{2}/", $_REQUEST['dateFrais'])) {
				$dateFrais = $_REQUEST['dateFrais'];
				// anee et mois de dateFrais au format YYYYMM
				// recuperation annee
				$annee1 = substr($dateFrais, 0, 4);
				// recuperation mois
				$mois1 = substr($dateFrais, 5, 2);
				$mois = $annee1 . $mois1;
			} else {
				ajouterErreur("Le format de la date n'est pas valide");
				include("vues/v_erreurs.php");
			}
			// verif libelle
			// seule les majuscule et minuscule sont accepté les chiffres et les caractères spéciaux ne sont pas accepté
			if (!empty($_REQUEST['libelle']) && preg_match("/^[a-zA-Z]+$/", $_REQUEST['libelle'])) {
				$libelle = $_REQUEST['libelle'];
			} else {
				ajouterErreur("Le format du libelle n'est pas valide");
				include("vues/v_erreurs.php");
			}
			//verif justificatif
			// verifit si boolean 
			if (!empty($_REQUEST['justificatif']) && preg_match("/[0-1]/", $_REQUEST['justificatif'])) {
				$justificatif = $_REQUEST['justificatif'];
			} else {
				ajouterErreur("Le format du justificatif n'est pas valide ou non renseigné");
				include("vues/v_erreurs.php");
			}
			// verif montant
			// seul les chiffres float avec un point ou une virgule sont accepté 
			// exemple : 1.5 ou 1,5
			// avant de faire la requete on remplace la virgule par un point
			if (!empty($_REQUEST['montant']) && preg_match("/[0-9]+[.,]?[0-9]*/", $_REQUEST['montant'])) {
				$montant = str_replace(",", ".", $_REQUEST['montant']);
			} else {
				ajouterErreur("Le format du montant n'est pas valide");
				include("vues/v_erreurs.php");
			}
			// si tout est ok (on verifit si toutes les veriables exitent) on fait la requete
			if (isset($dateFrais) && isset($libelle) && isset($justificatif) && isset($montant)) {
				$pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $dateFrais, $montant, $justificatif);
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
