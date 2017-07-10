<?php
class UserActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_userManager;

    //constructor
    public function __construct($source){
    	$this->_userManager = new UserManager(PDOFactory::getMysqlConnection());
    	$this->_source = $source;
    }

    //getters
    public function actionMessage(){
        return $this->_actionMessage;
    }
    

    public function typeMessage(){
        return $this->_typeMessage;
    }
    

    public function source(){
        return $this->_source;
    }
    
    //actions
    public function login($user){
        //Test if the user credentials are set
        //Case 1 : Something missing
        if ( empty($user['login']) || empty($user['password']) ) {
            $this->_actionMessage = "Invalide Action : All fields must be filled";
            $this->_typeMessage = "error";
            $this->_source = "index";
        }
        //Case 2 : User's credentials are set
        else{
            $login = htmlspecialchars($user['login']);
            $password = htmlspecialchars($user['password']);
            if ( $this->exist2($login) ) {
                $_SESSION['userCH24Test'] = $this->getUserByLogin($login);
                $this->_actionMessage = "Welcome back ".ucfirst($_SESSION['userCH24Test']->login());
                $this->_typeMessage = "success";
                $this->_source = "view/index.php";
            }
            else{
                $this->_actionMessage = "Invalide Action : Wrong login";
                $this->_typeMessage = "error";
                $this->_source = "view/index.php";
            }
        }
    }

    public function getUserById($id){
        return $this->_userManager->getUserById($id);
    }

    public function getUsers(){
        return $this->_userManager->getUsers();
    }

    public function getUsersByLimits($begin, $end){
        return $this->_userManager->getUsersByLimits($begin, $end);
    }

    public function getLastId(){
        return $this->_userManager->getLastId();
    }
    
    public function getUsersNumber(){
        return $this->_userManager->getUsersNumber();
    }
    
    public function getStatus($login){
        return $this->_userManager->getStatus($login);
    }
    
    public function getStatusById($idUser){
        return $this->_userManager->getStatusById($idUser);
    }
    
    public function getUserByLoginPassword($login, $password){
        return $this->_userManager->getUserByLoginPassword($login, $password);
    }
    
    public function getUserByLogin($login){
        return $this->_userManager->getUserByLogin($login);
    }
    
    public function getPasswordByLogin($login){
        return $this->_userManager->getPasswordByLogin($login);
    }
    
    public function exists($login, $password){
        return $this->_userManager->exists($login, $password);
    }
    
    public function exist2($login){
        return $this->_userManager->exist2($login);
    }
    
}
    