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
            $lesVisiteurs = $pdo->afficherListeVisiteur();
            $lesMois = $pdo->afficherLesMois();
            include("vues/v_listeMoisVisiteur.php");
            $leMois = $_REQUEST['lstMois'];
            $leVisiteur = $_REQUEST['lstVisiteur'];
            $lesinfosVisiteur = $pdo->getLesInfosVisiteur($leVisiteur);
            $infosFiche = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
            $lesinfosForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);

            $lesinfosHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);

            include("vues/v_ficheEtat.php");
            break;
        }
}
