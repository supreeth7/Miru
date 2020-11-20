<?php

class Entity
{
    private $db;
    private $input;

    public function __construct($db, $input)
    {
        $this->db = $db;

        if (is_array($input)) {
            $this->input = $input;
        } else {
            $query = $this->db->prepare("SELECT * FROM entities WHERE id=:id");
            $query->bindParam(":id", $input);
            $query->execute();

            $this->input = $query->fetch(PDO::FETCH_ASSOC);
        }
        $this->input = $input;
    }
}
