<?php 

namespace MaureenBruihier\Projet4\model\entities;

use MaureenBruihier\Projet4\model\entities\Entity;

class CommentEntity extends Entity
{

    protected $_id, $_postId, $_author, $_content, $_creationDate, $_reporting;

    public function __construct($valeurs = [])
    {
        if (!empty($valeurs))
        {
          $this->hydrate($valeurs);
        }
    }

    //GETTERS//

    public function getId() {return $this->_id;}
    public function getPostId(){return $this->_postId;}
    public function getAuthor() {return $this->_author;}
    public function getContent() {return $this->_content;}
    public function getCreationDate() {return $this->_creationDate;}
    public function getReporting() {return $this->_reporting;}

    //SETTERS//

    protected function setId(int $id) {$this->_id = $id;}
    protected function setpostId(int $postId) {$this->_postId = $postId;}
    protected function setAuthor(string $author) {$this->_author = $author;}
    protected function setContent(string $content) {$this->_content = $content;}
    protected function setCreationDate($creationDate) {$this->_creationDate = $creationDate;}
    protected function setReporting($reporting) {$this->_reporting = $reporting;}
}