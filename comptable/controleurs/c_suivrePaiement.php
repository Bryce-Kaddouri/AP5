<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idVisiteur'];
switch ($action) {
    case 'selectionnerMois': {
            $lesMois = $pdo->afficherLesMois();
            $lesVisiteurs = $pdo->afficherListeVisiteur();

            include 'vues/v_listeMoisVisteurVA.php';
            break;
        }
    case 'afficherListeFicheVA': {
            $lesMois = $pdo->afficherLesMois();
            $lesVisiteurs = $pdo->afficherListeVisiteur();

            include 'vues/v_listeMoisVisteurVA.php';
            $mois = $_REQUEST['lstMois'];
            $idVisiteur = $_REQUEST['lstVisiteur'];

            $lesfichesValidees = $pdo->getLesFichesValidees($idVisiteur, $mois);
            if (is_array(($lesfichesValidees))) {
                if (!isset($lesfichesValidees[0])) {
                    ajouterErreur("Pas de fiche de frais validée pour ce mois");
                    include("vues/v_erreurs.php");
                } else {
                    include 'vues/v_listeFicheVA.php';
                    break;
                }
            }
        }
}
