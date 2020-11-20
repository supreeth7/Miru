<?php

class Entity
{
    private $db;
    private $data;

    public function __construct($db, $input)
    {
        $this->db = $db;

        if (is_array($input)) {
            $this->data = $input;
        } else {
            $query = $this->db->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $this->data = $query->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function getId()
    {
        return $this->data["id"];
    }

    public function getName()
    {
        return $this->data["name"];
    }

    public function getThumbnail()
    {
        return $this->data["thumbnail"];
    }

    public function getPreview()
    {
        return $this->data["preview"];
    }
}
