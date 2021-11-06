<?php

namespace Storage;
use Storage\Contracts\PhotoStorageInterface;
use Core\Database;
use Models\Photo;

class MySqlDatabasePhotoStorage extends Database implements PhotoStorageInterface
{
    private $dbInstance;
    private $dbConn;

    public function __construct() 
    {
        $this->dbInstance = Database::getInstance();
        $this->dbConn = $this->dbInstance->getConnection();
    }

    public function save(Photo $photo)
    {
        $sql = 'INSERT INTO photo(fileName, user_id, created_at) 
                VALUES(:fileName, :user_id, :created_at)';
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue(':fileName', $photo->getFileName());
        $statement->bindValue(':user_id', $photo->getUser());
        $statement->bindValue(':created_at', 
                    $photo->getCreatedAt()->format('Y-m-d H:i:s'));
        $statement->execute();
        $_SESSION['uploaded'] = 'Photo(s) successfully uploaded & saved.';
        header('Location: /management');
    }

    public function findAll()
    {
        $sql = "SELECT * FROM photo 
                INNER JOIN user ON photo.user_id = user.id     
                ORDER BY photo.id DESC";
        $statement = $this->dbConn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        var_dump($statement->fetchAll());
        return $statement->fetchAll();
    }

    public function delete(int $id)
    {
        $photo = $this->findById($id);
        unlink('/var/www/shared-gallery/app/Public/Uploads/'.$photo->fileName);
        $sql = "DELETE FROM photo WHERE id = :id";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();
        $_SESSION['deletedPhoto'] = 'Photo successfully deleted.';
        header('Location: /management');
    }

    public function findById(int $id)
    {
        $sql = "SELECT * FROM photo WHERE id = :id";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetch();
    }
}