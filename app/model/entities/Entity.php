<?php

namespace MaureenBruihier\Projet4\model\entities;

class Entity {
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur)
        {
          $methode = 'set'.ucfirst($attribut);
          
          if (is_callable([$this, $methode]))
          {
            $this->$methode($valeur);
          }
        }
    }
}