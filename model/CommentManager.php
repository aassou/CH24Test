<?php
class CommentManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Comment $comment){
        $query = $this->_db->prepare(' INSERT INTO t_comment (
		name, email, url, remark, idEntry, created)
		VALUES (:name, :email, :url, :remark, :idEntry, :created)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':name', $comment->name());
		$query->bindValue(':email', $comment->email());
		$query->bindValue(':url', $comment->url());
		$query->bindValue(':remark', $comment->remark());
		$query->bindValue(':idEntry', $comment->idEntry());
		$query->bindValue(':created', $comment->created());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Comment $comment){
        $query = $this->_db->prepare(' UPDATE t_comment SET 
		name=:name, email=:email, url=:url, remark=:remark
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $comment->id());
		$query->bindValue(':name', $comment->name());
		$query->bindValue(':email', $comment->email());
		$query->bindValue(':url', $comment->url());
		$query->bindValue(':remark', $comment->remark());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_comment
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_comment
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Comment($data);
	}

	public function getAll(){
        $comments = array();
		$query = $this->_db->query('SELECT * FROM t_comment
        ORDER BY id ASC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$comments[] = new Comment($data);
		}
		$query->closeCursor();
		return $comments;
	}
    
    public function getAllByIdEntry($idEntry){
        $comments = array();
        $query = $this->_db->prepare('SELECT * FROM t_comment
        WHERE idEntry=:idEntry
        ORDER BY id ASC');
        $query->bindValue('idEntry', $idEntry);
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $comments[] = new Comment($data);
        }
        $query->closeCursor();
        return $comments;
    }

	public function getAllByLimits($begin, $end){
        $comments = array();
		$query = $this->_db->query('SELECT * FROM t_comment
        ORDER BY id DESC LIMIT '.$begin.', '.$end);
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$comments[] = new Comment($data);
		}
		$query->closeCursor();
		return $comments;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS commentsNumber FROM t_comment');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $comment = $data['commentsNumber'];
        return $comment;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_comment
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}