<?php 

namespace MaureenBruihier\Projet4\Lib;

use \MaureenBruihier\Projet4\model\Manager;
use MaureenBruihier\Projet4\lib\Token;

/**
 * La classe Validation permet de gérer la vérification d'un formulaire
 * 
 * @author Maureen <maureen.bruihier@yahoo.fr>
 */

class Validation 
{
    public static $instance;
    protected $data = [];
    protected $rules = [];
    protected $errors = [];

    public function __construct(array $data = [], array $rules = [])
    {
        $this->data = $data;
        $this->rules = $rules;

        if (isset($_POST['_token']))
        {
            $this->data['_token'] = $_POST['_token'];
            $this->rules['_token'] = 'token';
        }

        if (isset($_SESSION['validation_errors']) AND !empty($_SESSION['validation_errors']))
        {
            $this->errors = $_SESSION['validation_errors'];
            unset($_SESSION['validation_errors']);
        }
    }
        
    /**
     * make
     *
     *  Permet de travailler tout le temps sur la même instance de Validation
     * 
     * @param  array $data Tableau de données à vérifier
     * @param  array $rules Tableau des règles
     * 
     * @return void
     */
    public static function make(array $data, array $rules) 
    {
        if (self::$instance == null)
        {
            self::$instance = new self($data, $rules);
        }

        return self::$instance;
    }
        
    /**
     * redirectWithErrors
     *
     * Stocke les messages d'erreurs en session et redirige le navigateur
     * 
     * @param  string $location Lien vers la page de redirection
     * 
     * @return void
     */
    public function redirectWithErrors(string $location) : void
    {
        $_SESSION['validation_errors'] = $this->errors;
        header('Location: ' . $location);
        exit;
    }
    
    /**
     * hasError
     *
     * Renvoie un booléen pour savoir si une erreur pour la clé a été enregistrée
     * 
     * @param  string $key Clé permettant de vérifier si il existe une erreur 
     * 
     * @return bool
     */
    public function hasError(string $key) : bool
    {
        return array_key_exists($key, $this->errors);
    }
    
    /**
     * getError
     * 
     * Vérifie si il y a une erreur existante pour la clé passée en paramètre 
     * et envoie un message d'erreur en fonction de la règle sur laquelle il y a une erreur
     *
     * @param  string $key Clé permettant de vérifier si il existe une erreur
     * 
     * @return string si il y a une erreur
     * sinon
     * @return null
     */
    public function getError(string $key) : ?string
    {
        if ($this->hasError($key))
        {
            $parts = explode(':', $this->errors[$key][0]);
            $rule = $parts[0];
            $param = isset($parts[1]) ? $parts[1] : null;

            switch ($rule) 
            {
                case 'required' :
                    return 'Le champ est requis.';
                    break;

                case 'min' :
                    return 'Le champ doit faire plus de ' . $param .  ' caractères.';
                    break;

                case 'max' :
                    return 'Le champ doit faire moins de ' . $param .  ' caractères.';
                    break;

                case 'exist' :
                    return 'Le champ n\'existe pas.';
                    break;

                case 'token' :
                    return 'La session a expirée.';
                    break;
                
                default :
                    return 'Erreur inconnue.';
                    break;
            }
        }

        return null;
    }
    
    /**
     * getOldValue
     * 
     * Permet de récupérer la valeur de la clé enregistrée pour pouvoir la restituer
     * et faire gagner du temps à l'utilisateur sur la correction de son erreur
     *
     * @param  string $key Clé permettant de vérifier si il existe une erreur
     * 
     * @return string Retourne l'ancienne valeur du champs vérifié si il y a une erreur
     * sinon
     * @return null
     */
    public function getOldValue(string $key) : ?string
    {
        if ($this->hasError($key))
        {
            return $this->errors[$key][1];
        }

        return null;
    }
    
    /**
     * isValid
     *
     * Vérifie que les données envoyées sont valides si elles ont une entrée dans le tableau des règles
     * 
     * @return bool Renvoie true si il n'y a pas d'erreurs, false si il y en a
     */
    public function isValid() : bool
    {
        foreach ($this->data as $key=>$value)
        {
            if (array_key_exists($key, $this->rules))
            {
                $this->validateAttr($key, $value);
            }
        }

        return count($this->errors) == 0;
    }
    
    /**
     * validateAttr
     * 
     * Valide chaque clé et sa value en fonction des règles données
     * Si la clé et sa value ne sont pas valides, crée une erreur dans le tableau d'erreurs
     *
     * @param  mixed $attr Nom du champ à vérifier
     * @param  mixed $value Valeur du champ à vérifier
     * 
     * @return void
     */
    protected function validateAttr($attr, $value) : void
    {
        $rules = is_array($this->rules[$attr]) ? $this->rules[$attr] : [$this->rules[$attr]];

        foreach ($rules as $rule)
        {
            if ($this->rule($rule, $value) == false)
            {
                $this->errors[$attr] = [$rule, $value];
                return;
            }
        }

        return;
    }
    
    /**
     * rule
     * 
     * Appelle les méthodes assignées pour chaque règle
     *
     * @param  mixed $rule La règle à vérifier
     * @param  mixed $value Valeur à valider
     * 
     * @return bool Hérité de la méthode qui a été return
     */
    protected function rule($rule, $value) : bool
    {
        if (stripos($rule, ':') === false) 
        {
            $method = 'rule' . ucfirst($rule);
            return $this->{$method}($value);
        } 

        $parts = explode(':', $rule);
        $method = 'rule' . ucfirst($parts[0]);

        return $this->{$method}($value, $parts[1]);
    }
    
    /**
     * ruleRequired
     *
     * Vérifie et retourne true si le paramètre entré n'est pas vide
     * 
     * @param  mixed $value Valeur du champ à valider
     * 
     * @return bool
     */
    protected function ruleRequired($value) : bool
    {
        return !empty($value);
    }
    
    /**
     * ruleMin
     * 
     * Retourne true si la chaine de caractère donnée est plus grande ou égale au paramètre de la règle
     *
     * @param  mixed $value Valeur du champ à valider
     * @param  mixed $param Paramètre de la règle
     * 
     * @return bool
     */
    protected function ruleMin($value, $param) : bool
    {
        return strlen($value) >= $param;
    }
    
    /**
     * ruleMax
     *
     * Retourne true si la chaine de caractère donnée est plus petite ou égale au paramètre de la règle
     * 
     * @param  mixed $value Valeur du champ à valider
     * @param  mixed $param Paramètre de la règle
     * 
     * @return bool
     */
    protected function ruleMax($value, $param) : bool
    {
        return strlen($value) <= $param;
    }
    
    /**
     * ruleExist
     * 
     * Vérifie grâce aux paramètres de la règle que le contenu du champ est existant dans la base de données
     * Renvoie true si il est dans la BDD
     *
     * @param  mixed $value Valeur du champ à valider
     * @param  mixed $param Paramètre de la règle (table,colonne)
     * 
     * @return bool
     */
    protected function ruleExist($value, $param) : bool
    {
        $params = explode(',', $param);

        $db = (new Manager)->db();
        $req = $db->prepare("SELECT COUNT(*) FROM ? WHERE ? = ? LIMIT 1");
        $req->execute([$params[0], $params[1], $value]);

        $req->debugDumpParams();

        $count = $req->fetch();

        var_dump($params[0]);
        var_dump($params[1]);
        var_dump($value);
        var_dump($count == 1);
        exit;

        return $count == 1;
    }
    
    /**
     * ruleToken
     *
     * Vérifie la validité du token
     * 
     * @param  mixed $value
     * 
     * @return bool
     */
    protected function ruleToken($value) : bool
    {
        return Token::make()->verify($value);
    }

}