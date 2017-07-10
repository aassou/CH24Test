<?php
class CommentActionController {

    //attributes
    protected $_actionMessage;
    protected $_typeMessage;
    protected $_source;
    protected $_commentManager;

    //constructor
    public function __construct($source){
    	$this->_commentManager = new CommentManager(PDOFactory::getMysqlConnection());
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
    public function add($comment){
        $idEntry = htmlentities($comment['idEntry']);
        if( !empty($comment['name']) and !empty($comment['remark']) and filter_var($comment['email'], FILTER_VALIDATE_EMAIL) ){
			$name = htmlentities($comment['name']);
			$email = htmlentities($comment['email']);
			$url = htmlentities($comment['url']);
			$remark = htmlentities($comment['remark']);
            $created = date('Y-m-d h:i:s');
            //create object
            $comment = new Comment(array(
				'name' => $name,
				'email' => $email,
				'url' => $url,
				'remark' => $remark,
				'idEntry' => $idEntry,
				'created' => $created,
			));
            //add it to db
            $this->_commentManager->add($comment);
            $this->_actionMessage = "Successful Action : Comment added successfully";  
            $this->_typeMessage = "success";
            $this->_source = "view/entry-details.php?id=".$idEntry;
        }
        else{
            $this->_actionMessage = "Invalide Action : Name and Remark are required/ Invalide Email or URL ";
            $this->_typeMessage = "error";
            $this->_source = "view/entry-details.php?id=".$idEntry;
        }
    }
    

    public function update($comment){
        $idEntry = htmlentities($comment['idEntry']);
        if(!empty($comment['id']) and !empty($comment['name']) and !empty($comment['remark']) ){
            $id = htmlentities($comment['id']);
			$name = htmlentities($comment['name']);
			$email = htmlentities($comment['email']);
			$url = htmlentities($comment['url']);
			$remark = htmlentities($comment['remark']);
            $comment = new Comment(array(
				'id' => $idComment,
				'name' => $name,
				'email' => $email,
				'url' => $url,
				'remark' => $remark
			));
            $this->_commentManager->update($comment);
            $this->_actionMessage = "Successful Action : Comment updated successfully";
            $this->_typeMessage = "success";
            $this->_source = "view/entry-details.php?id=$idEntry";
        }
        else{
            $this->_actionMessage = "Invalide Action : Name and Remark are required";
            $this->_typeMessage = "error";
            $this->_source = "view/entry-details.php?id=$idEntry";
        }
    }
    

    public function delete($comment){
        $idEntry = htmlentities($comment['idEntry']);
        $idComment = htmlentities($comment['idComment']);
        $this->_commentManager->delete($idComment);
        $this->_actionMessage = "Successful Action : Comment deleted successfully";
        $this->_typeMessage = "success";
        $this->_source = "view/entry-details.php?id=$idEntry";
    }
    

    public function getOneById($id){
        return $this->_commentManager->getOneById($id);
    }
    
    public function getAllByIdEntry($idEntry){
        return $this->_commentManager->getAllByIdEntry($idEntry);
    }
    

    public function getAll(){
        return  $this->_commentManager->getAll();
    }
    

    public function getAllByLimits($begin, $end){
        return $this->_commentManager->getCommentsByLimits($begin, $end);
    }
    

    public function getAllNumber(){
        return $this->_commentManager->getAllNumber();
    }
    

    public function getLastId(){
        return $this->_commentManager->getLastId();
    }
    
}
    