<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
switch ($action) {
    case 'selectionnerMois': {
            $lesMois = $pdo->afficherLesMois();
            include 'vues/v_listeMois.php';
            break;
        }
    case 'afficherListeFicheVA': {
            $lesMois = $pdo->afficherLesMois();
            include 'vues/v_listeMois.php';
            $today = explode(' ', date("Y-m-d"))[0];
            $todayExplode = explode("-", $today);
            $todayYear = $todayExplode[0];
            $todayMonth = $todayExplode[1];

            $lesfichesValidees = $pdo->getLesFichesValidees('', $todayYear, $todayMonth);
            include("vues/v_listeFicheVA.php");
            break;
        }



        //     case 'choixVisiteurMois': {

        //             $lesVisiteurs = $pdo->afficherListeVisiteur();
        //             $lesMois = $pdo->afficherLesMois();


        //             // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        //             // on demande toutes les clés, et on prend la première,
        //             // les mois étant triés décroissants
        //             // $lesCles = array_keys($lesMois);
        //             // $moisASelectionner = $lesCles[0];
        //             include("vues/v_listeMoisVisiteur.php");
        //             break;
        //         }
        //     case 'afficherEtat': {
        //             $leMois = $_REQUEST['lstMois'];
        //             $leVisiteur = $_REQUEST['lstVisiteur'];
        //             include("vues/v_listeMoisVisiteur.php");
        //             include("vues/v_ficheEtat.php");




        //             // $ficheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);

        //             // $ficheEtat = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
        //             // include("../vues/v_listeMoisVisiteur.php");

        //             // break;
        //         }
        //     case 'voirEtatFrais': {
        //             // $leMois = $_REQUEST['lstMois'];
        //             // $lesMois = $pdo->getLesMoisDisponibles($idComptable);
        //             // $moisASelectionner = $leMois;
        //             // include("vues/v_listeMois.php");
        //             // $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idComptable, $leMois);
        //             // $lesFraisForfait = $pdo->getLesFraisForfait($idComptable, $leMois);
        //             // $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idComptable, $leMois);
        //             // $numAnnee = substr($leMois, 0, 4);
        //             // $numMois = substr($leMois, 4, 2);
        //             // $libEtat = $lesInfosFicheFrais['libEtat'];
        //             // $montantValide = $lesInfosFicheFrais['montantValide'];
        //             // $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        //             // $dateModif = $lesInfosFicheFrais['dateModif'];
        //             // $dateModif = dateAnglaisVersFrancais($dateModif);
        //             // include("vues/v_etatFrais.php");
        //         }
}
