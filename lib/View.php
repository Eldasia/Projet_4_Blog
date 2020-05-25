<?php

namespace MaureenBruihier\Projet4\Lib;

use MaureenBruihier\Projet4\lib\Validation;
use MaureenBruihier\Projet4\lib\Token;

/**
 * La classe Views permet de gérer les vues sur un projet et de les appeler si besoin
 * Elle permet également de gérer le contenu de la page pour le générer en même temps que la page
 * 
 * @author Maureen <maureen.bruihier@yahoo.fr>
 */

class View 
{
    public $view;
    public $params = [];
    public $content;

    public function __construct ($view, array $params = []) 
    {
        $this->view = 'views/' . $view . '.php';
        $this->params = $params;
        $this->params['validation'] = Validation::$instance ?? new Validation;
        $this->params['token'] = Token::make();
    }
    
    /**
     * make
     * 
     * Génère une vue avec les paramètres donnés
     *
     * @param  string $view Lien de la vue à retourner
     * @param  array $params Les paramètres à afficher, comme le titre ou le contenu
     * 
     * @return void
     */
    public static function make(string $view, array $params = [])
    {
        return (new static($view, $params))->send();
    }
    
    /**
     * send
     * 
     * Extrait le titre du tableau de paramètres
     * Insère le titre, le contenu et la vue(tous les deux stocké dans la variable $content) souhaitée dans le template principal du site
     *
     * @return void
     */
    public function send ()
    {
        ob_start();
        extract($this->params);
        $content = $this->compile();
        require 'views/template.php';
        return ob_get_clean();
    }
    
    /**
     * compile
     * 
     * Extrait le contenu du tableau de paramètre et l'insère dans la vue que l'on veut
     *
     * @return void
     */
    protected function compile () 
    {
        ob_start();
        extract($this->params);
        require $this->view;
        return ob_get_clean();
    }
}