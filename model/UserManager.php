<?php
class UserManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_user WHERE id=:id')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':id', $id);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new User($data);
    }

    public function getAll(){
        $users = array();
        $query = $this->_db->query('SELECT * FROM t_user ORDER BY id DESC');
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $users[] = new User($data);
        }
        $query->closeCursor();
        return $users;
    }

    public function getAllByLimits($begin, $end){
        $users = array();
        $query = $this->_db->prepare('SELECT * FROM t_user ORDER BY id DESC LIMIT :begin, :end');
        $query->bindValue(':begin', $begin, PDO::PARAM_INT);
        $query->bindValue(':end', $end, PDO::PARAM_INT);
        $query->execute();     
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $users[] = new User($data);
        }
        $query->closeCursor();
        return $users;
    }

    public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_user ORDER BY id DESC LIMIT 0, 1');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $id = $data['last_id'];
        return $id;
    }
    
    public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS userNumbers FROM t_user');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['userNumbers'];
    }
    
    public function getStatus($login){
        $query = $this->_db->prepare('SELECT status FROM t_user WHERE login=:login');
        $query->bindValue(":login", $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['status'];
    }
    
    public function getStatusById($idUser){
        $query = $this->_db->prepare('SELECT status FROM t_user WHERE id=:idUser');
        $query->bindValue(":idUser", $idUser);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['status'];
    }
    
    public function getUserByLoginPassword($login, $password){
        $query = $this->_db->prepare('SELECT * FROM t_user WHERE login=:login AND password=:password');
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new User($data);
    }
    
    public function getUserByLogin($login){
        $query = $this->_db->prepare('SELECT * FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new User($data);
    }
    
    public function getPasswordByLogin($login){
        $query = $this->_db->prepare('SELECT password FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $data['password'];
    }
    
    public function exists($login, $password){
        $query = $this->_db->prepare('SELECT COUNT(*) FROM t_user WHERE login=:login AND password=:password');
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->execute();
        return (bool) $query->fetchColumn();
    }
    
    public function exist2($login){
        $query = $this->_db->prepare('SELECT COUNT(*) FROM t_user WHERE login=:login');
        $query->bindValue(':login', $login);
        $query->execute();
        return (bool) $query->fetchColumn();
    }

}