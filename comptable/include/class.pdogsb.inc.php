<?php

/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb
{
	private static $serveur = 'mysql:host=localhost';
	// private static $serveur = 'mysql:host=172.18.156.100';
	private static $bdd = 'dbname=gsb_frais';
	// private static $bdd = 'dbname=ap5_BDMEDOCLAB3';
	private static $user = 'root';
	// private static $user = 'gsb_dbuser3';
	private static $mdp = '';
	// private static $mdp = '239xc_w13';
	private static $monPdo;
	private static $monPdoGsb = null;
	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 */
	private function __construct()
	{
		PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function __destruct()
	{
		PdoGsb::$monPdo = null;
	}
	/**
	 * Fonction statique qui crée l'unique instance de la classe
 
	 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
	 * @return l'unique objet de la classe PdoGsb
	 */
	public  static function getPdoGsb()
	{
		if (PdoGsb::$monPdoGsb == null) {
			PdoGsb::$monPdoGsb = new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;
	}
	/**
	 * Retourne les informations d'un comptable
 
	 * @param $login 
	 * @param $mdp
	 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
	 */
	public function getInfosComptable($login, $mdp)
	{
		$req = "select comptable.id as id, comptable.nom as nom, comptable.prenom as prenom from comptable 
		where comptable.login='$login' and comptable.mdp='$mdp'";

		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

	/**
	 * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
	 * concernées par les deux arguments
 
	 * La boucle foreach ne peut être utilisée ici car on procède
	 * à une modification de la structure itérée - transformation du champ date-
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
	 */
	public function getLesFraisHorsForfait($idVisiteur, $mois)
	{
		$req = "select lignefraishorsforfait.*, statutfraishf.libelle as libEtat from lignefraishorsforfait inner join statutfraishf on numEtat = statutfraishf.id where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois = '$mois';";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i = 0; $i < $nbLignes; $i++) {
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes;
	}
	/**
	 * Retourne le nombre de justificatif d'un visiteur pour un mois donné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return le nombre entier de justificatifs 
	 */
	public function getNbjustificatifs($idVisiteur, $mois)
	{
		$req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne['nb'];
	}
	/**
	 * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
	 * concernées par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
	 */
	public function getLesFraisForfait($idVisiteur, $mois)
	{
		$req = "select fraisforfait.id as idfrais, 
		fraisforfait.libelle as libelle, 
		fraisforfait.montant as montant,
		lignefraisforfait.quantite as quantite 
		from lignefraisforfait 
		inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' 
		and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	/**
	 * Retourne le montant total pour les frais forfait d'un visiteur pour un mois 
	 * donné concernés par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
	 */
	public function getTotalFraisForfait($idVisiteur, $mois)
	{
		$req = "SELECT SUM(lignefraisforfait.quantite * fraisforfait.montant) 
		as totalFraisForfait
		FROM `lignefraisforfait` 
		inner join fraisforfait 
		on lignefraisforfait.idFraisForfait = fraisforfait.id
		where lignefraisforfait.idvisiteur ='$idVisiteur' 
		and lignefraisforfait.mois='$mois';";
		$res = PdoGsb::$monPdo->query($req);
		$totalFraisForfait = $res->fetch();
		return $totalFraisForfait;
	}
	/**
	 * Retourne tous les id de la table FraisForfait
 
	 * @return un tableau associatif 
	 */
	public function getLesIdFrais()
	{
		$req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	/**
	 * Retourne le mois au format numérique e l'annee
	 * @param $date sous la forme dd/mm/aaaa
 
	 * @return un tableau associatif 
	 */
	public function convertirNumMoisString($numMois)
	{
		$moisStringTableau = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
		// $moisChiffre = explode('/', $date);

		$moisStr = $moisStringTableau[intval($numMois)];

		return $moisStr;
	}
	/**
	 * Met à jour la table ligneFraisForfait
 
	 * Met à jour la table ligneFraisForfait pour un visiteur et
	 * un mois donné en enregistrant les nouveaux montants
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
	 * @return un tableau associatif 
	 */
	public function majFraisForfait($idVisiteur, $mois, $lesFrais)
	{
		$lesCles = array_keys($lesFrais);
		foreach ($lesCles as $unIdFrais) {
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			PdoGsb::$monPdo->exec($req);
		}
	}
	/**
	 * met à jour le nombre de justificatifs de la table ficheFrais
	 * pour le mois et le visiteur concerné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs)
	{
		$req = "update fichefrais set nbjustificatifs = $nbJustificatifs 
		where fichefrais.idvisiteur = '$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}
	/**
	 * Teste si un visiteur possède une fiche de frais pour le mois passé en argument
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return vrai ou faux 
	 */
	public function estPremierFraisMois($idVisiteur, $mois)
	{
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		if ($laLigne['nblignesfrais'] == 0) {
			$ok = true;
		}
		return $ok;
	}
	/**
	 * Retourne le dernier mois en cours d'un visiteur
 
	 * @param $idVisiteur 
	 * @return le mois sous la forme aaaamm
	 */
	public function dernierMoisSaisi($idVisiteur)
	{
		$req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		$dernierMois = $laLigne['dernierMois'];
		return $dernierMois;
	}

	/**
	 * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés
 
	 * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
	 * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function creeNouvellesLignesFrais($idVisiteur, $mois)
	{
		$dernierMois = $this->dernierMoisSaisi($idVisiteur);
		$laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
		if ($laDerniereFiche['idEtat'] == 'CR') {
			$this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL');
		}
		$req = "insert into fichefrais(idVisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values('$idVisiteur','$mois',0,0,now(),'CR')";
		PdoGsb::$monPdo->exec($req);
		$lesIdFrais = $this->getLesIdFrais();
		foreach ($lesIdFrais as $uneLigneIdFrais) {
			$unIdFrais = $uneLigneIdFrais['idfrais'];
			$req = "insert into lignefraisforfait(idVisiteur,mois,idFraisForfait,quantite) 
			values('$idVisiteur','$mois','$unIdFrais',0)";
			PdoGsb::$monPdo->exec($req);
		}
	}
	/**
	 * Crée un nouveau frais hors forfait pour un visiteur un mois donné
	 * à partir des informations fournies en paramètre
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @param $libelle : le libelle du frais
	 * @param $date : la date du frais au format français jj//mm/aaaa
	 * @param $montant : le montant
	 */
	public function creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant)
	{
		$dateFr = dateFrancaisVersAnglais($date);
		$req = "insert into lignefraishorsforfait 
		values(NULL,'$idVisiteur','$mois','$libelle','$dateFr','$montant')";
		PdoGsb::$monPdo->exec($req);
	}
	/**
	 * Supprime le frais hors forfait dont l'id est passé en argument
 
	 * @param $idFrais 
	 * @param $idVisiteur
	 * @param $mois sous la forme aaaamm
	 * @param $idEtat : idEtat du frais (int)
	 */
	public function majEtatFraisHorsForfait($idFrais, $idVisiteur, $mois, $idEtat)
	{
		echo "<script>console.log('test:-" . $mois . "-')</script>";
		// $req = "update  from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais and idVisiteur = '" . $idVisiteur . "' and mois='" . $mois . "';";
		$req = "update lignefraishorsforfait set numEtat = $idEtat where lignefraishorsforfait.id =$idFrais and idVisiteur = '" . $idVisiteur . "' and mois = '" . $mois . "';";
		return PdoGsb::$monPdo->exec($req);

		// header("Location: index.php?uc=validerFrais&action=afficherEtat");
	}
	/**
	 * change le statut d'une fiche de frais en VA (valider)
 
	 * @param $moisFicheFrais 
	 * @param $idVisiteur
	 */
	public function validerFicheFrais($idVisiteur, $moisFicheFrais, $montantValide)
	{
		$req = "update fichefrais set idEtat = 'VA', montantValide=" . $montantValide . ", dateModif=now() where idVisiteur = '" . $idVisiteur . "' and mois = '" . $moisFicheFrais . "';";
		PdoGsb::$monPdo->exec($req);
	}
	/**
	 * Retourne les mois pour lesquel un visiteur a une fiche de frais
 
	 * @param $idVisiteur 
	 * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
	 */
	public function getLesMoisDisponibles($idVisiteur)
	{
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		order by fichefrais.mois desc ";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois = array();
		$laLigne = $res->fetch();
		while ($laLigne != null) {
			$mois = $laLigne['mois'];
			$numAnnee = substr($mois, 0, 4);
			$numMois = substr($mois, 4, 2);
			$lesMois["$mois"] = array(
				"mois" => "$mois",
				"numAnnee"  => "$numAnnee",
				"numMois"  => "$numMois"
			);
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}

	/* fonction pour afficher l'id, le nom et prenom de tous les visiteurs*/
	public function afficherListeVisiteur()
	{
		$req = "select id, nom, prenom from visiteur order by nom;";
		$res = PdoGsb::$monPdo->query($req);
		$lesVisiteurs = array();
		$laLigne = $res->fetch();
		while ($laLigne != null) {
			$id = $laLigne['id'];
			$nom = $laLigne['nom'];
			$prenom = $laLigne['prenom'];
			$lesVisiteurs["$id"] = array(
				"id" => "$id",
				"nom"  => "$nom",
				"prenom"  => "$prenom"
			);
			$laLigne = $res->fetch();
		}
		return $lesVisiteurs;
	}

	/* fonction pour afficher l'ensemble des mois et des années sur deux ans */

	public function afficherLesMois()
	{
		$req = "select mois from fichefrais order by mois desc;";
		$res = PdoGsb::$monPdo->query($req);
		$lesMois = array();
		$laLigne = $res->fetch();
		while ($laLigne != null) {
			$mois = $laLigne['mois'];
			$lesMois["$mois"] = array(
				"unMois" => "$mois"
			);
			$laLigne = $res->fetch();
		}
		return $lesMois;
	}
	/**
	 * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
	 */
	public function getLesInfosFicheFrais($idVisiteur, $mois, $etat)
	{
		$req = "select ficheFrais.idEtat as idEtat,
		ficheFrais.dateModif as dateModif, 
		ficheFrais.mois as mois, 
		ficheFrais.nbJustificatifs as nbJustificatifs, 
		ficheFrais.montantValide as montantValide, 
		fichefrais.idVisiteur as idVisiteur,
		etat.libelle as libEtat 
		from  fichefrais 
		inner join Etat 
		on ficheFrais.idEtat = Etat.id
		where fichefrais.idVisiteur ='$idVisiteur'
		and idEtat='$etat' 
		and fichefrais.mois = '$mois';";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}
	/**
	 * Modifie l'état et la date de modification d'une fiche de frais
 
	 * Modifie le champ idEtat et met la date de modif à aujourd'hui
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */

	public function majEtatFicheFrais($idVisiteur, $mois, $etat)
	{
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		PdoGsb::$monPdo->exec($req);
	}

	/**
	 * Retourne l'id, le nom et le prenom du visiteur
	 * @param $idVisiteur
	 * @return array
	 */
	public function getLesInfosVisiteur($idVisiteur)
	{
		$req = "select id, nom, prenom from visiteur where id = '" . $idVisiteur . "'";
		$res = PdoGsb::$monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}

	/**
	 * Retourne l'ensemble des fiches de frais qui sont validee
	 * 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
	 */
	public function getLesFichesValidees($idVisiteur, $anneeMois)
	{

		$condition = '';
		if (!empty($idVisiteur)) {
			$condition .= " and fichefrais.idVisiteur = '$idVisiteur'";
		}
		if (!empty($anneeMois)) {
			$condition .= " and fichefrais.mois = '$anneeMois'";
		}

		$req = "select fichefrais.idVisiteur as idVisiteur,
					   	fichefrais.mois as mois,
						fichefrais.montantValide as montantValide,
						fichefrais.idEtat as idEtat, 
						fichefrais.dateModif as dateModif, 
						etat.libelle as libEtat,
						concat(visiteur.nom, ' ', visiteur.prenom) as nomVisiteur
						from fichefrais
						inner join etat
						on fichefrais.idEtat = etat.id 
						inner join visiteur
						on fichefrais.idVisiteur = visiteur.id
						where fichefrais.idEtat = 'VA'" . $condition . ";";
		$res = PdoGsb::$monPdo->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i = 0; $i < $nbLignes; $i++) {
			$idVisiteur = $lesLignes[$i]['idVisiteur'];
			$nomVisiteur = $lesLignes[$i]['nomVisiteur'];
			$mois = $lesLignes[$i]['mois'];
			$montantValide = $lesLignes[$i]['montantValide'];
			$idEtat = $lesLignes[$i]['idEtat'];
			$dateModif = $lesLignes[$i]['dateModif'];
			$libEtat = $lesLignes[$i]['libEtat'];
		}

		return $lesLignes;
	}

	function ficheFraisIdEtat()
	{
		$sql = "SELECT id FROM fichefrais 
		INNER JOIN etat 
		ON fichefrais.idEtat = etat.id WHERE idEtat = 'VA';";
		$req = PdoGsb::$monPdo->prepare($sql);
		$req->execute();
		$lesidFicheFrais = $req->fetchAll();
		return $lesidFicheFrais;
	}

	/**
	 * Retourne le montant total pour les frais hors forfait d'un visiteur pour un mois 
	 * donné concernés par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
	 */
	public function getTotalFraisHorsForfait($idVisiteur, $mois)
	{
		$req = "SELECT SUM(lignefraishorsforfait.montant) 
		as totalFraisHorsForfait
		FROM `lignefraishorsforfait`
		where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois='$mois';";
		$res = PdoGsb::$monPdo->query($req);
		$totalFraisForfait = $res->fetch();
		return $totalFraisForfait;
	}

	/**
	 * Retourne le montant total pour les frais hors forfait d'un visiteur pour un mois 
	 * donné concernés par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
	 */
	public function getTotalFraisHorsForfaitVA($idVisiteur, $mois)
	{
		$req = "SELECT SUM(lignefraishorsforfait.montant) 
		as totalFraisHorsForfait
		FROM `lignefraishorsforfait`
		where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois='$mois' and numEtat=1;";
		$res = PdoGsb::$monPdo->query($req);
		$totalFraisForfait = $res->fetch();
		return $totalFraisForfait;
	}

	/**
	 * Retourne le montant total pour les frais hors forfait d'un visiteur pour un mois 
	 * donné concernés par les deux arguments
 
	 * @param $idVisiteur 
	 * @param $mois sous la forme aaaamm
	 */
	public function reporterFraisHF($idVisiteur, $mois)
	{
		$numAnnee = substr($mois, 0, 4);
		$numMois = substr($mois, 4, 2);
		$numMoisSuivant = $numMois + 1;
		$req = "UPDATE `lignefraishorsforfait` SET `mois`='[value-3]',`date`='[value-5]' where idVisiteur='" . $idVisiteur . "' and mois='" . $numAnnee . $numMoisSuivant . "' ";
		$res = PdoGsb::$monPdo->query($req);
		$totalFraisForfait = $res->fetch();
		return $totalFraisForfait;
	}
}
