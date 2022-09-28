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
            $lesCles = array_keys($lesMois);
            $moisASelectionner = $lesCles[0];
            include("vues/v_listeMoisVisiteur.php");
            break;
        }
    case 'afficherEtat': {
            if (!empty($_POST['lstVisiteur']) && !empty($_POST['lstMois'])) {
                $lesVisiteurs = $pdo->afficherListeVisiteur();
                $lesMois = $pdo->afficherLesMois();
                include("vues/v_listeMoisVisiteur.php");
                $leMois = $_REQUEST['lstMois'];
                $leVisiteur = $_REQUEST['lstVisiteur'];
                $lesinfosVisiteur = $pdo->getLesInfosVisiteur($leVisiteur);
                $infosFiche = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
                if (is_array($infosFiche)) {
                    $numMois = substr($infosFiche['mois'], 4, 2);
                    $numAnnee = substr($infosFiche['mois'], 0, 4);
                    $moisString = $pdo->convertirNumMoisString($numMois);
                    // $moisConvertiString = $pdo->convertirMoisDateComplete($leMois);
                    $lesinfosForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
                    $totalFraisForfait = $pdo->getTotalFraisForfait($leVisiteur, $leMois);
                    $lesinfosHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
                    $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($leVisiteur, $leMois);
                    include("vues/v_ficheEtat.php");
                } else {
                    ajouterErreur("Pas de fiche de frais pour ce visiteur ce mois");
                    include("vues/v_erreurs.php");
                }
                break;
            } else {
                ajouterErreur("Aucun visiteur n'a été sélectionné");
                include("vues/v_erreurs.php");
            }
        }
    case 'validerFicheFrais': {
            $lemoisFiche = $_GET['moisFiche'];
            $levisiteurFiche = $_GET['idVisiteur'];
            echo "<script>alert('" . $levisiteurFiche . " " . $lemoisFiche . "')</script>";
            $totalFraisForfait = $pdo->getTotalFraisForfait($levisiteurFiche, $lemoisFiche);
            $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($levisiteurFiche, $lemoisFiche);
            $montantValide = $totalFraisForfait['totalFraisForfait'] + $totalFraisHorsForfait['totalFraisHorsForfait'];
            $validation = $pdo->validerFicheFrais($levisiteurFiche, $lemoisFiche, $montantValide);
            include("vues/v_listeMoisVisiteur.php");
            include("vues/v_ficheEtat.php");
            break;
        }


    case 'rejeterFrais': {
            // recuperer parametres de l'URL sous forme de tableau avec regex 
            // $idFrais = $_GET['idFrais'];
            // $moisFiche = $_GET['moisFiche'];
            // $idVisiteur = $_GET['idVisiteur'];
            // $pdo->rejeterFrais($idFrais);
            // $lesinfosHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $moisFiche);
            // $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($idVisiteur, $moisFiche);
            // include("vues/v_ficheEtat.php");
            // include("vues/v_listeMoisVisiteur.php");
            // $idVisiteur = $params[3];

            // echo $_GET['idEtat'];
            $idEtat = $_GET['idEtat'];
            $idFrais = $_GET['idFrais'];
            $moisFiche = $_GET['moisFiche'];
            $idVisiteur = $_GET['idVisiteur'];

            echo "<script>console.log('idEtat = " . $idEtat . "')</script>";
            echo "<script>console.log('idFrais = " . $idFrais . "')</script>";
            echo "<script>console.log('moisFiche = " . $moisFiche . "')</script>";
            echo "<script>console.log('idVisiteur = " . $idVisiteur . "')</script>";

            $pdo->majEtatFraisHorsForfait($idFrais, $idVisiteur, $moisFiche, $idEtat);

            // echo "<script>alert('" . $moisFiche . "')</script>";

            // echo "<script>alert('" . var_dump(($_GET)) . "')</script>";
            // die();

            // $lesVisiteurs = $pdo->afficherListeVisiteur();
            // $lesMois = $pdo->afficherLesMois();
            // include("vues/v_listeMoisVisiteur.php");
        }
}
