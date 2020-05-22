<?php
namespace model;

class EntityRepository
{
	private $db;
	public $table;
	public function getDb() // méthode permettant d'instancier la classe PDO et de créer un objet
	{
		if(!$this->db) // seulement si $this->db n'est pas rempli, si il n' ya pas connexion, alors on la construit 
		{
			try
			{
				$xml = simplexml_load_file('app/config.xml'); // simplexml_load_file permet de convertir mon fichier XML en objet
				//echo '<pre>'; var_dump($xml); echo '</pre>';
				$this->table = $xml->table; // on asssocie le nom de la table du fivhier XML à la propriété de la classe
				try // on tente d'executer le code 
				{
					$this->db = new \PDO("mysql:dbname=" . $xml->db . ";host=" . $xml->host, $xml->user, $xml->password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); 
					//echo '<pre>'; var_dump($this->db); echo '</pre>'; echo '<pre>'; var_dump(get_class_methods($this->db)); echo '</pre>';// connexion à la BDD, si jamais on change de BDD, nous n'autons pas besoin de toucher à ce code, c'est un code générique, il y aura une connexion quE soit la BDD
				}
				catch(\PDOException $e) // si jamais erreur de connexion, on tombe ici
				{
					die('Problème de connexion bdd ' . $e->getMessage());
				}
			}
			catch(\PDOException $e) // on tombe dans le catch si il y a une erreur avec le chargement du fichier XML
			{
				die('Problème de fichier xml manquant');
			}
		}
		return $this->db; // on retourne la connexion
	}
	public function getFields() // méthode permettant de recolter les donnéees des champs/colonne de la table, c'est un code générique, on recupèrera les données de n'importe quelle table
	{
		$q = $this->getDb()->query("DESC " . $this->table);
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		// echo '<pre>'; var_dump($r); echo '</pre>';
		return array_splice($r,1); //permet de ne pas récupérer le premier champs id_employes dans le formulaire
		//return $r;
	}
	public function select($id)
	{
		$q = $this->getDb()->query("SELECT * FROM " . $this->table . ' WHERE id' . ucfirst($this->table) . '=' . (int) $id);
		$r = $q->fetch(\PDO::FETCH_ASSOC);
		return $r;
	}

	public function selectAll() 
	{ 
		$q = $this->getDb()->query("SELECT * FROM " . $this->table); // requete permettant de selectionner toute une table , $this->table: représente dans notre cas la table employé
		$r = $q->fetchAll(\PDO::FETCH_ASSOC);
		return $r;
	}

	public function save()
	{
		// on contrôle si un id est passé dans l'url ou non,  savoir si on cliqué sur modifier ou insérer
		$id = isset($_GET['id'])? $_GET['id'] : 'NULL';
		$q = $this->getDb()->query('REPLACE INTO '. $this->table . '(id' . ucfirst($this->table) . ',' . implode(',',array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

	//$q = $this->getDb()->query('INSERT INTO '. $this->table . '(id' . ucfirst($this->table) . ',' . implode(',',array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')');

		//echo $this->table;
		//echo 'REPLACE INTO '. $this->table . '(id' . ucfirst($this->table) . ',' . implode(',',array_keys($_POST)) . ') VALUES (' . $id . ',' . "'" . implode("','", $_POST) . "'" . ')';


		//var_dump($this);
		//return $this->getDb()->lastInsertId();
		//ucfirst($this->table) : Employe, nous avons besoin avec la requete REPLACE de recupérer le champs idEmploye, uncfirt permet de mettre en majuscule le premier caractère comme dans la BDD
		// array_keys($_POST) permet d'extraire seulement les indices du formulaire
		
	}
	public function delete($id)
	{
		$q = $this->getDb()->query("DELETE FROM " . $this->table . ' WHERE id' . ucfirst($this->table) . '=' . (int) $id);
	}
}

// $e = new EntityRepository;
// $e->getDb();
