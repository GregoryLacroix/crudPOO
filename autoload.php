<?php
class Autoload
{
	public static function className($className)
	{
		require __DIR__ . '/' . str_replace('\\', '/', $className . '.php');
		//echo __DIR__ . '/' . str_replace('\\', '/', $className . '.php'); // str_replace permet de remplacer les '\' dans l'insantaciantion par des '/' 
	}
}

spl_autoload_register(array('Autoload', 'className'));

//$a = new Controller\Controller;

/*
	spl_autoload_register s'execute quand on oinstancie un classe, il detecte le mt clé 'new' et nous retourne le fichier ou est déclarée la classe
*/


