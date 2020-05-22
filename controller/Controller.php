<?php
namespace Controller;

class Controller
{ 
	private $db;
	public function __construct()
	{
		$this->db = new \model\EntityRepository;
	}
	public function handlerRequest() // permet de savoir ce que l'internute demande (afficher/modifer/supprimer un/des employés)
	{
		$op = isset($_GET['op']) ? $_GET['op'] : NULL;
		try
		{
			if($op == 'add' || $op == 'update') $this->save($op); // si on ajoute ou modifie un employé, on appel la méthode save()
			elseif($op == 'select') $this->select(); // si on select un employé on appel la méthode select()
			elseif($op == 'delete') $this->delete(); // si on supprime un employé on appel le méthode delete()
			else $this->selectAll();
		}
		catch(Exception $e)
		{
			Throw new Exception($e->getMessage());	// permet d'envoyer un message d'erreur et d'arreter le script
		}
	}
	public function select()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : NULL;
			$this->render('layout.php', 'donnee.php', array(
			'title' => "Donnée de l'employé n° $id<hr>",
			'donnee' => $this->db->select($id)
			));
	}

	public function delete()
	{
  		$id = isset($_GET['id']) ? $_GET['id'] : NULL;
  		$r = $this->db->delete($id);
  		$this->redirect('index.php');
	}

	public function selectAll()
	{
		// $r = $this->db->getFields();
		// echo '<pre>'; var_dump($r); echo '</pre>';
		//echo 'Methode selectAll()';
		//$r = $this->db->selectAll();
		//echo '<pre>'; var_dump($r); echo '</pre>';
		$this->render('layout.php', 'donnees.php', array(
			'title' => 'Toute les données',
			'donnees' => $this->db->selectAll(),
			'fields' => $this->db->getFields(),
			'id' => 'id' . ucfirst($this->db->table) // affiche idEmployes, cela servira a pointe sur l'indice  idEmployes du tableau de données envoyer dans le layout pour les liens de select/modif/delete
		));	 
	}
	public function render($layout, $template, $parameters = array()) // permet d'afficher le layout et à la fois d'avaler à l'intérieur le template 
	{
		extract($parameters);
		ob_start(); // commence la temporisation, ob_start() démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
		require "view/$template";
		// $content = "view/$template"; enregistre le nom du fichier mais pas le contenu
		$content = ob_get_clean(); // tout ce qui se trouve dans le template sera stocké dans $content / Lit le contenu courant du tampon de sortie puis l'efface
		// $content contient le fichier
		// $content va afficher le contenu de tout un fichier, c'est comme ci on avait mis un require directement

		ob_start(); // temporiser la sortie de l'affichage
		require "view/$layout";
		return ob_end_flush(); // libère l'affichage et fait tout apparaitre sur la page /  Envoie les données du tampon de sortie et éteint la temporisation de sortie

		// celui qui s'affiche en premier c'est le layout
	}

	public function redirect($url)
	{
		header("Location:" . $url);
	}
	
	public function save($op)
	{
		$title = $op;

		$id = isset($_GET['id']) ? $_GET['id'] : NULL; // permet de savoir si un id a été envoyé dans l'url, si on cilque sur modifié on envoie l'id dans l'url sinon c'est un ajout
		$values = ($op == 'update') ? $this->db->select($id) : ''; // si on a envoyé un id dans l'url, on l'envoi en argument de la méthode select de EntityRepository, cela permettra de selectionner toute les données de l'employé pour la modification
		//var_dump($values);
		if($_POST)
		{ 
			//contrôle setteur/getteur
			$r = $this->db->save();
			$this->redirect('index.php');
		}
		$this->render('layout.php', 'donnees-form.php', array(
			"title" => "Donnée : $title",
			"op" => $op,
			"fields" => $this->db->getFields(),
			"values" => $values
		));
	}  
}