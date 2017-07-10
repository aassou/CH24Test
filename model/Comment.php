<?php
class Comment{

	//attributes
	private $_id;
	private $_name;
	private $_email;
	private $_url;
	private $_remark;
	private $_idEntry;
	private $_created;

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
	public function setName($name){
        $this->_name = $name;
    }

	public function setEmail($email){
        $this->_email = $email;
    }

	public function setUrl($url){
        $this->_url = $url;
    }

	public function setRemark($remark){
        $this->_remark = $remark;
    }

	public function setIdEntry($idEntry){
        $this->_idEntry = $idEntry;
    }

	public function setCreated($created){
        $this->_created = $created;
    }

	//getters
	public function id(){
        return $this->_id;
    }
	public function name(){
        return $this->_name;
    }

	public function email(){
        return $this->_email;
    }

	public function url(){
        return $this->_url;
    }

	public function remark(){
        return $this->_remark;
    }

	public function idEntry(){
        return $this->_idEntry;
    }

	public function created(){
        return $this->_created;
    }

}