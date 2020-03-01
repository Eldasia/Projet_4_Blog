<?php 

namespace MaureenBruihier\Projet4\model\entities;

class PostEntity
{

    protected $_id, $_author, $_title, $_content, $_creationDate, $_changeDate;

    public function __construct(int $id, string $author, string $title, string $content, $creationDate, $changeDate)
    {
        $this->setId($id);
        $this->setauthor($author);
        $this->setTitle($title);
        $this->setContent($content);
        $this->setCreationDate($creationDate);
        $this->setChangeDate($changeDate);
    }

    //GETTERS//

    public function getId() {return $this->_id;}
    public function getAuthor() {return $this->_author;}
    public function getTitle() {return $this->_title;}
    public function getContent() {return $this->_content;}
    public function getCreationDate() {return $this->_creationDate;}
    public function getChangeDate() {return $this->_changeDate;}

    //SETTERS//

    protected function setId(int $id) {$this->_id = $id;}
    protected function setAuthor(string $author) {$this->_author = $author;}
    protected function setTitle(string $title) {$this->_title = $title;}
    protected function setContent(string $content) {$this->_content = $content;}
    protected function setCreationDate($creationDate) {$this->_creationDate = $creationDate;}
    protected function setChangeDate($changeDate) {$this->_changeDate = $changeDate;}
}