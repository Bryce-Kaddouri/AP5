<?php
/*
 * GSB Project 2022
*/
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
switch ($action) {
    case 'choixVisiteurMois': {

            $lesVisiteurs = $pdo->afficherListeVisiteur();
            $lesMois = $pdo->afficherLesMois();


            // Afin de sélectionner par défaut le dernier mois dans la zone de liste
            // on demande toutes les clés, et on prend la première,
            // les mois étant triés décroissants
            // $lesCles = array_keys($lesMois);
            // $moisASelectionner = $lesCles[0];
            include("vues/v_listeMoisVisiteur.php");
            break;
        }
    case 'afficherEtat': {
            $leMois = $_REQUEST['lstMois'];
            $leVisiteur = $_REQUEST['lstVisiteur'];

            // $ficheEtat = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
            // include("../vues/v_listeMoisVisiteur.php");

            // break;
        }
    case 'voirEtatFrais': {
            // $leMois = $_REQUEST['lstMois'];
            // $lesMois = $pdo->getLesMoisDisponibles($idComptable);
            // $moisASelectionner = $leMois;
            // include("vues/v_listeMois.php");
            // $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idComptable, $leMois);
            // $lesFraisForfait = $pdo->getLesFraisForfait($idComptable, $leMois);
            // $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idComptable, $leMois);
            // $numAnnee = substr($leMois, 0, 4);
            // $numMois = substr($leMois, 4, 2);
            // $libEtat = $lesInfosFicheFrais['libEtat'];
            // $montantValide = $lesInfosFicheFrais['montantValide'];
            // $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            // $dateModif =  $lesInfosFicheFrais['dateModif'];
            // $dateModif =  dateAnglaisVersFrancais($dateModif);
            // include("vues/v_etatFrais.php");
        }
}
