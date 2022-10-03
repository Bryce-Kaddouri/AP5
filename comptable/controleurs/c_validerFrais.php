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
            if (isset($_POST['lstVisiteur']) && isset($_POST['lstMois'])) {
                if (empty($_POST['lstVisiteur']) || empty($_POST['lstMois'])) {
                    ajouterErreur("Aucun visiteur ou mois n'a été sélectionné");
                    include("vues/v_erreurs.php");
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
                if (!empty($_POST['lstVisiteur']) && !empty($_POST['lstMois'])) {
                    $lesVisiteurs = $pdo->afficherListeVisiteur();
                    $lesMois = $pdo->afficherLesMois();
                    include("vues/v_listeMoisVisiteur.php");
                    $leMois = $_REQUEST['lstMois'];
                    $leVisiteur = $_REQUEST['lstVisiteur'];
                    $lesinfosVisiteur = $pdo->getLesInfosVisiteur($leVisiteur);
                    $infosFiche = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois, 'CL');
                    if (is_array($infosFiche)) {
                        $numMois = substr($infosFiche['mois'], 4, 2);
                        $numAnnee = substr($infosFiche['mois'], 0, 4);
                        $moisString = $pdo->convertirNumMoisString($numMois);
                        $lesinfosForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
                        $totalFraisForfait = $pdo->getTotalFraisForfait($leVisiteur, $leMois);
                        $lesinfosHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
                        $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfait($leVisiteur, $leMois);
                        include("vues/v_ficheEtat.php");
                    } else {
                        ajouterErreur("Pas de fiche de frais pour ce visiteur ce mois");
                        include("vues/v_erreurs.php");
                        // include("vues/v_listeMoisVisiteur.php");
                    }
                    break;
                }
            } else {
                ajouterErreur("Aucun visiteur ou mois n'a été sélectionné");
                include("vues/v_erreurs.php");
            }
        }
    case 'validerFicheFrais': {
            $lemoisFiche = $_GET['moisFiche'];
            $levisiteurFiche = $_GET['idVisiteur'];
            // verif si fiche mois suivant existe deja si c'est pas le cas (==0) alors on la cree et on met a jour le mois du frais hors forfait
            // sinon juste mise a jour du mois du frais 
            $nbFicheMoisSuivant = $pdo->getNbFicheFrais($levisiteurFiche, $lemoisFiche);
            if ($nbFicheMoisSuivant == 0) {
                $pdo->creeNouvellesLignesFrais($levisiteurFiche, $lemoisFiche);
            }
            // validation de la fiche de frais avec recuperation du montant total des frais forfait + montant total frais HF numEtat=1
            $totalFraisForfait = $pdo->getTotalFraisForfait($levisiteurFiche, $lemoisFiche);
            $totalFraisHorsForfait = $pdo->getTotalFraisHorsForfaitVA($levisiteurFiche, $lemoisFiche);
            $montantValide = $totalFraisForfait['totalFraisForfait'] + $totalFraisHorsForfait['totalFraisHorsForfait'];
            $pdo->validerFicheFrais($levisiteurFiche, $lemoisFiche, $montantValide);
            $pdo->reporterFraisHF($levisiteurFiche, $lemoisFiche);
            // affichage de la liste des mois et visiteurs
            $lesVisiteurs = $pdo->afficherListeVisiteur();
            $lesMois = $pdo->afficherLesMois();
            include("vues/v_listeMoisVisiteur.php");
            break;
        }
    case 'majFrais': {
            $idEtat = $_GET['idEtat'];
            $idFrais = $_GET['idFrais'];
            $moisFiche = $_GET['moisFiche'];
            $idVisiteur = $_GET['idVisiteur'];

            $pdo->majEtatFraisHorsForfait($idFrais, $idVisiteur, $moisFiche, $idEtat);

            // apres mise a jour de l'etat du frais je raffiche l'action idEtat en remplcant
            // la valeur du mois et du visiteur par celle fournis lors du clique sur le bouton 
            // pour que la page reste sur la meme fiche

            $lesVisiteurs = $pdo->afficherListeVisiteur();
            $lesMois = $pdo->afficherLesMois();
            include("vues/v_listeMoisVisiteur.php");
            $leMois = $moisFiche;
            $leVisiteur = $idVisiteur;
            $lesinfosVisiteur = $pdo->getLesInfosVisiteur($leVisiteur);
            $infosFiche = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois, 'CL');


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
            }
        };
}
