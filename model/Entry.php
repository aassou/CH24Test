<?php
class Entry{

	//attributes
	private $_id;
	private $_created;
	private $_title;
	private $_content;
	private $_authore;
	private $_comments;
	private $_idUser;

	//le constructeur
    public function __construct($data){
        $this->hydrate($data);
    }
    
    //la focntion hydrate sert à attribuer les valeurs en utilisant les setters d\'une façon dynamique!
    public function hydrate($data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

	//setters
	public function setId($id){
        $this->_id = $id;
    }
	public function setCreated($created){
        $this->_created = $created;
    }

	public function setTitle($title){
        $this->_title = $title;
    }

	public function setContent($content){
        $this->_content = $content;
    }

	public function setAuthore($authore){
        $this->_authore = $authore;
    }

	public function setComments($comments){
        $this->_comments = $comments;
    }

	public function setIdUser($idUser){
        $this->_idUser = $idUser;
    }

	//getters
	public function id(){
        return $this->_id;
    }
	public function created(){
        return $this->_created;
    }

	public function title(){
        return $this->_title;
    }

	public function content(){
        return $this->_content;
    }

	public function authore(){
        return $this->_authore;
    }

	public function comments(){
        return $this->_comments;
    }

	public function idUser(){
        return $this->_idUser;
    }

}