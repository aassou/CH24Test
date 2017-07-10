<?php
class User{

	//attributes
	private $_id;
	private $_login;
	private $_password;
	private $_email;
	private $_fullname;
	private $_street;
	private $_postcode;
	private $_place;
	private $_created;
	private $_createdBy;
	private $_updated;
	private $_updatedBy;

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
	public function setLogin($login){
        $this->_login = $login;
    }

	public function setPassword($password){
        $this->_password = $password;
    }

	public function setEmail($email){
        $this->_email = $email;
    }

	public function setFullname($fullname){
        $this->_fullname = $fullname;
    }

	public function setStreet($street){
        $this->_street = $street;
    }

	public function setPostcode($postcode){
        $this->_postcode = $postcode;
    }

	public function setPlace($place){
        $this->_place = $place;
    }

	public function setCreated($created){
        $this->_created = $created;
    }

	public function setCreatedBy($createdBy){
        $this->_createdBy = $createdBy;
    }

	public function setUpdated($updated){
        $this->_updated = $updated;
    }

	public function setUpdatedBy($updatedBy){
        $this->_updatedBy = $updatedBy;
    }

	//getters
	public function id(){
        return $this->_id;
    }
	public function login(){
        return $this->_login;
    }

	public function password(){
        return $this->_password;
    }

	public function email(){
        return $this->_email;
    }

	public function fullname(){
        return $this->_fullname;
    }

	public function street(){
        return $this->_street;
    }

	public function postcode(){
        return $this->_postcode;
    }

	public function place(){
        return $this->_place;
    }

	public function created(){
        return $this->_created;
    }

	public function createdBy(){
        return $this->_createdBy;
    }

	public function updated(){
        return $this->_updated;
    }

	public function updatedBy(){
        return $this->_updatedBy;
    }

}