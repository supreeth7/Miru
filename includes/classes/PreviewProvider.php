<?php

class PreviewProvider
{
    private $db;
    private $username;

    public function __construct($db, $username)
    {
        $this->db = $db;
        $this->username = $username;
    }

    private function getRandomEntity()
    {
        $query = $this->db->prepare("SELECT * FROM entities ORDER BY RAND() LIMIT 1");
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        echo $row["name"];
    }

    public function createPreviewVideo($entity)
    {
        if ($entity==null) {
            $entity = $this->getRandomEntity();
        }
    }
}
