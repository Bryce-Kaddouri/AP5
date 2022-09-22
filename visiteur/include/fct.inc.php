<?php

/**
 * Fonctions pour l'application GSB
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 */
/**
 * Teste si un quelconque visiteur est connecté
 * @return vrai ou faux 
 */
function estConnecte()
{
	return isset($_SESSION['idVisiteur']);
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $id 
 * @param $nom
 * @param $prenom
 */
function connecter($id, $nom, $prenom)
{
	$_SESSION['idVisiteur'] = $id;
	$_SESSION['nom'] = $nom;
	$_SESSION['prenom'] = $prenom;
}
/**
 * Détruit la session active
 */
function deconnecter()
{
	session_destroy();
}
/**
 * Transforme une date au format français jj/mm/aaaa vers le format anglais aaaa-mm-jj
 
 * @param $madate au format  jj/mm/aaaa
 * @return la date au format anglais aaaa-mm-jj
 */
function dateFrancaisVersAnglais($maDate)
{
	@list($jour, $mois, $annee) = explode('/', $maDate);
	return date('Y-m-d', mktime(0, 0, 0, $mois, $jour, $annee));
}
/**
 * Transforme une date au format format anglais aaaa-mm-jj vers le format français jj/mm/aaaa 
 
 * @param $madate au format  aaaa-mm-jj
 * @return la date au format format français jj/mm/aaaa
 */
function dateAnglaisVersFrancais($maDate)
{
	@list($annee, $mois, $jour) = explode('-', $maDate);
	$date = "$jour" . "/" . $mois . "/" . $annee;
	return $date;
}
/**
 * retourne le mois au format aaaamm selon le jour dans le mois
 
 * @param $date au format  jj/mm/aaaa
 * @return le mois au format aaaamm
 */
function getMois($date)
{
	@list($jour, $mois, $annee) = explode('/', $date);
	if (strlen($mois) == 1) {
		$mois = "0" . $mois;
	}
	return $annee . $mois;
}

/* gestion des erreurs*/
/**
 * Indique si une valeur est un entier positif ou nul
 
 * @param $valeur
 * @return vrai ou faux
 */
function estEntierPositif($valeur)
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}

/**
 * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
 
 * @param $tabEntiers : le tableau
 * @return vrai ou faux
 */
function estTableauEntiers($tabEntiers)
{
	$ok = true;
	foreach ($tabEntiers as $unEntier) {
		if (!estEntierPositif($unEntier)) {
			$ok = false;
		}
	}
	return $ok;
}
/**
 * Vérifie si une date est inférieure d'un an à la date actuelle
 
 * @param $dateTestee 
 * @return vrai ou faux
 */
function estDateDepassee($dateTestee)
{
	$dateActuelle = date("d/m/Y");
	@list($jour, $mois, $annee) = explode('/', $dateActuelle);
	$annee--;
	$AnPasse = $annee . $mois . $jour;
	@list($jourTeste, $moisTeste, $anneeTeste) = explode('/', $dateTestee);
	return ($anneeTeste . $moisTeste . $jourTeste < $AnPasse);
}
/**
 * Vérifie la validité du format d'une date française jj/mm/aaaa 
 
 * @param $date 
 * @return vrai ou faux
 */
function estDateValide($date)
{
	$tabDate = explode('/', $date);
	$dateOK = true;
	if (count($tabDate) != 3) {
		$dateOK = false;
	} else {
		if (!estTableauEntiers($tabDate)) {
			$dateOK = false;
		} else {
			if (!checkdate($tabDate[1], $tabDate[0], $tabDate[2])) {
				$dateOK = false;
			}
		}
	}
	return $dateOK;
}

/**
 * Vérifie que le tableau de frais ne contient que des valeurs numériques 
 
 * @param $lesFrais 
 * @return vrai ou faux
 */
function lesQteFraisValides($lesFrais)
{
	return estTableauEntiers($lesFrais);
}
/**
 * Vérifie la validité des trois arguments : la date, le libellé du frais et le montant 
 
 * des message d'erreurs sont ajoutés au tableau des erreurs
 
 * @param $dateFrais 
 * @param $libelle 
 * @param $m
 * @param $justificatif
 */
function valideInfosFrais($dateFrais, $libelle, $montant, $justificatif)
{
	if ($dateFrais == "") {
		ajouterErreur("Le champ date ne doit pas être vide");
		echo "<script>alert('Le champ date ne doit pas être vide')</script>";
	} else {
		if (!estDatevalide($dateFrais)) {
			ajouterErreur("Date invalide");
			echo "<script>alert('Date invalide')</script>";
		} else {
			if (estDateDepassee($dateFrais)) {
				ajouterErreur("date d'enregistrement du frais dépassé, plus de 1 an");
				echo "<script>alert('date d'enregistrement du frais dépassé, plus de 1 an')</script>";
			}
		}
	}
	if ($libelle == "") {
		ajouterErreur("Le champ description ne peut pas être vide");
		echo "<script>alert('Le champ description ne peut pas être vide')</script>";
	}
	if ($montant == "") {
		ajouterErreur("Le champ montant ne peut pas être vide");
		echo "<script>alert('Date invalide')</script>";
	} else
		if (!is_numeric($montant)) {
		ajouterErreur("Le champ montant doit être numérique");
		echo "<script>alert('Le champ montant doit être numérique')</script>";
	} else 
		if ($montant <= 0) {
		ajouterErreur("Le champ montant n'est pas valide");
	} else 
		if ($justificatif != '0' || $justificatif != '1') {
		ajouterErreur("Le champ justificatif doit être rempli");
		echo "<script>alert('Le champ justificatif ne peut pas être vide')</script>";
	}
}
/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg)
{
	if (!isset($_REQUEST['erreurs'])) {
		$_REQUEST['erreurs'] = array();
	}
	$_REQUEST['erreurs'][] = $msg;
}
/**
 * Retoune le nombre de lignes du tableau des erreurs 
 
 * @return le nombre d'erreurs
 */
function nbErreurs()
{
	if (!isset($_REQUEST['erreurs'])) {
		return 0;
	} else {
		return count($_REQUEST['erreurs']);
	}
}

// -----------------------------------------Auteur : Bryce Kaddouri -------------------------------------------------------- //
/**
 * retourne vrai si la valeur du paramétre regex correspond à l'expression régulière regex
 * @param $regex
 * @param $input
 * @return bool
 */

function verifiInputRegex($input, $regex)
{
	if (preg_match($regex, $input)) {
		return true;
	} else {
		return false;
	}
}

function validerInputRegex($input, $regex, $messageErreur)
{
	if (!verifiInputRegex($input, $regex)) {
		$erreur = array(false, $messageErreur);
		return $erreur;
	} else {
		return true;
	}
}

function validerAjoutFraisHF($date, $libelle, $montant, $justificatif)
{
	$verifDate = validerInputRegex($date, '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', "La date doit être au format JJ/MM/AAAA");
	$verifLibelle = validerInputRegex($libelle, '/^[a-zA-Z0-9 ]{1,100}$/', "Le libellé doit être composé de 1 à 100 caractères alphanumériques");
	$verifMontant = validerInputRegex($montant, '/^[0-9]+[.,]?[0-9]*$/', "Le montant doit être composé de 1 à 10 chiffres");
	$verifJustificatif = validerInputRegex($justificatif, '/^[0-1]{1}$/', "Le justificatif doit être composé de 1 chiffre");

	if ($verifDate == true && $verifLibelle == true && $verifMontant == true && $verifJustificatif == true) {
		return true;
	} else {
		$erreur = array(false, $verifDate[1], $verifLibelle[1], $verifMontant[1], $verifJustificatif[1]);
		return $erreur;
	}
}




	// regex valeur numérique uniquement
	// $regex = "/^[0-9]+$/";

	// regex valeur numérique avec virgule uniquement
	// $regex = "/^[0-9]+[.,]?[0-9]*$/";

	// regex valeur numérique avec un point ou une virgule
	// $regex = "/^[0-9]+[.,]?[0-9]*$/";

	// regex date au format jj/mm/aaaa uniquement
	// $regex = "/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/";
	// explication : / permet de délimiter le début et la fin de l'expression
	// ^ permet de dire que l'expression doit commencer par
	// [0-2] permet de dire que le premier chiffre doit être compris entre 0 et 2
	// [0-9] permet de dire que le deuxième chiffre doit être compris entre 0 et 9
	// | permet de dire ou
	// (3) permet de dire que le premier chiffre doit être égal à 3
	// [0-1] permet de dire que le deuxième chiffre doit être compris entre 0 et 1
	// (\/) permet de dire que le caractère suivant doit être un /
	// (((0)[0-9])|((1)[0-2])) permet de dire que le premier chiffre doit être compris entre 0 et 1 et le deuxième chiffre entre 0 et 9
	// | permet de dire ou
	// ((1)[0-2]) permet de dire que le premier chiffre doit être égal à 1 et le deuxième chiffre entre 0 et 2
	// (\/) permet de dire que le caractère suivant doit être un /
	// \d{4} permet de dire que les 4 chiffres suivants doivent être compris entre 0 et 9
	// $ permet de dire que l'expression doit se terminer par

	// 
