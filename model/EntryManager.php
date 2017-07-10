<?php
class EntryManager{

	//attributes
	private $_db;

	//constructor
    public function __construct($db){
        $this->_db = $db;
    }

	//BASIC CRUD OPERATIONS
	public function add(Entry $entry){
        $query = $this->_db->prepare(' INSERT INTO t_entry (
		created, title, content, authore, comments, idUser)
		VALUES (:created, :title, :content, :authore, :comments, :idUser)')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':created', $entry->created());
		$query->bindValue(':title', $entry->title());
		$query->bindValue(':content', $entry->content());
		$query->bindValue(':authore', $entry->authore());
		$query->bindValue(':comments', $entry->comments());
		$query->bindValue(':idUser', $entry->idUser());
		$query->execute();
		$query->closeCursor();
	}

	public function update(Entry $entry){
        $query = $this->_db->prepare(' UPDATE t_entry SET 
		created=:created, title=:title, content=:content, authore=:authore, comments=:comments, idUser=:idUser
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $entry->id());
		$query->bindValue(':created', $entry->created());
		$query->bindValue(':title', $entry->title());
		$query->bindValue(':content', $entry->content());
		$query->bindValue(':authore', $entry->authore());
		$query->bindValue(':comments', $entry->comments());
		$query->bindValue(':idUser', $entry->idUser());
		$query->execute();
		$query->closeCursor();
	}

	public function delete($id){
        $query = $this->_db->prepare(' DELETE FROM t_entry
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();
		$query->closeCursor();
	}

	public function getOneById($id){
        $query = $this->_db->prepare(' SELECT * FROM t_entry
		WHERE id=:id')
		or die (print_r($this->_db->errorInfo()));
		$query->bindValue(':id', $id);
		$query->execute();		
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$query->closeCursor();
		return new Entry($data);
	}

    public function getOneByIdUser($idUser){
        $query = $this->_db->prepare(' SELECT * FROM t_entry WHERE idUser=:idUser')
        or die (print_r($this->_db->errorInfo()));
        $query->bindValue(':idUser', $idUser);
        $query->execute();      
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return new Entry($data);
    }

	public function getAll(){
        $entrys = array();
		$query = $this->_db->query('SELECT * FROM t_entry
        ORDER BY created DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$entrys[] = new Entry($data);
		}
		$query->closeCursor();
		return $entrys;
	}
    
    public function getAllByIdUser($idUser){
        $entrys = array();
        $query = $this->_db->prepare('SELECT * FROM t_entry where idUser=:idUser ORDER BY created DESC');
        $query->bindValue(':idUser', $idUser);
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $entrys[] = new Entry($data);
        }
        $query->closeCursor();
        return $entrys;
    }

	public function getAllByLimits($begin, $end){
        $entrys = array();
		$query = $this->_db->query('SELECT * FROM t_entry
        ORDER BY id DESC LIMIT '.$begin.', '.$end.' ORDER BY created DESC');
		while($data = $query->fetch(PDO::FETCH_ASSOC)){
			$entrys[] = new Entry($data);
		}
		$query->closeCursor();
		return $entrys;
	}

	public function getAllNumber(){
        $query = $this->_db->query('SELECT COUNT(*) AS entrysNumber FROM t_entry');
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $entry = $data['entrysNumber'];
        return $entry;
    }

	public function getLastId(){
        $query = $this->_db->query(' SELECT id AS last_id FROM t_entry
		ORDER BY id DESC LIMIT 0, 1');
		$data = $query->fetch(PDO::FETCH_ASSOC);
		$id = $data['last_id'];
		return $id;
	}

}