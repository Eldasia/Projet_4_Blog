<?php 

namespace MaureenBruihier\Projet4\model\entities;

use MaureenBruihier\Projet4\model\entities\Entity;

class PostEntity extends Entity
{

    protected $_id, $_title, $_content, $_creationDate, $_changeDate;

    public function __construct($valeurs = [])
    {
        if (!empty($valeurs))
        {
          $this->hydrate($valeurs);
        }
    }

    //GETTERS//

    public function getId() {return $this->_id;}
    public function getTitle() {return $this->_title;}
    public function getContent() {return $this->_content;}
    public function getCreationDate() {return $this->_creationDate;}
    public function getChangeDate() {return $this->_changeDate;}

    //SETTERS//

    protected function setId(int $id) {$this->_id = $id;}
    protected function setTitle(string $title) {$this->_title = $title;}
    protected function setContent(string $content) {$this->_content = $content;}
    protected function setCreationDate($creationDate) {$this->_creationDate = $creationDate;}
    protected function setChangeDate($changeDate) {$this->_changeDate = $changeDate;}
}