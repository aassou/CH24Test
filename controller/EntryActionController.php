<?php
class EntryActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_entryManager;

    //constructor
    public function __construct($source){
        $this->_entryManager = new EntryManager(PDOFactory::getMysqlConnection());
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
    public function add($entry){
        if( !empty($entry['title']) and !empty($entry['content']) ){
            $created = date('Y-m-d h:i:s');
            $title = htmlentities($entry['title']);
            $content = htmlentities($entry['content']);
            $authore = $_SESSION['userCH24Test']->login();
            $comments = 0;
            $idUser = $_SESSION['userCH24Test']->id();
            //create object
            $entry = new Entry(array(
                'created' => $created,
                'title' => $title,
                'content' => $content,
                'authore' => $authore,
                'comments' => $comments,
                'idUser' => $idUser,
            ));
            //add it to db
            $this->_entryManager->add($entry);
            $this->_actionMessage = "Successful Action : Entry added successfully";  
            $this->_typeMessage = "success";
            $this->_source = "view/entry.php";
        }
        else{
            $this->_actionMessage = "Invalide Action : All inputs must be filled";
            $this->_typeMessage = "error";
            $this->_source = "view/entry.php";
        }
    }
    

    public function update($entry){
        if( !empty($entry['title']) and !empty($entry['content']) and !empty($entry['id']) ){
            $id = htmlentities($entry['id']);
            $title = htmlentities($entry['title']);
            $content = htmlentities($entry['content']);
            $entry = new Entry(array(
                'id' => $id,
                'title' => $content,
                'text' => $text,
            ));
            $this->_entryManager->update($entry);
            $this->_actionMessage = "Successful Action : Entry updated successfully";
            $this->_typeMessage = "success";
            $this->_source = "view/entry.php";
        }
        else{
            $this->_actionMessage = "Invalide Action : All inputs must be filled";
            $this->_typeMessage = "error";
            $this->_source = "view/entry.php";
        }
    }
    

    public function delete($entry){
        if( !empty($entry['id']) ){
            $id = htmlentities($entry['id']);
            $this->_entryManager->delete($id);
            $this->_actionMessage = "Successful Action : Entry deleted successfully";
            $this->_typeMessage = "success";
            $this->_source = "view/entry.php";
        }
        else{
            $this->_actionMessage = "Invalide Action: Entry doesn't exist";
            $this->_typeMessage = "error";
            $this->_source = "view/entry.php";
        }
    }
    

    public function getOneById($id){
        return $this->_entryManager->getOneById($id);
    }
    
    public function getOneByIdUser($idUser){
        return $this->_entryManager->getOneByIdUser($idUser);
    }

    public function getAll(){
        return  $this->_entryManager->getAll();
    }
    
    public function getAllByIdUser($idUser){
        return $this->_entryManager->getAllByIdUser($idUser);
    }
    
    public function getAllByLimits($begin, $end){
        return $this->_entryManager->getAllByLimits($begin, $end);
    }
    

    public function getAllNumber(){
        return $this->_entryManager->getAllNumber();
    }
    

    public function getLastId(){
        return $this->_entryManager->getLastId();
    }
    
    public function wrapString($string, $repl, $limit){
        if(strlen($string) > $limit){
            return substr($string, 0, $limit) . $repl; 
        }
        else{
            return $string;
        }
    }
    
}
    