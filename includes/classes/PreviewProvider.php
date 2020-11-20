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

        return new Entity($this->db, $row);
    }

    public function createPreviewVideo($entity)
    {
        if ($entity==null) {
            $entity = $this->getRandomEntity();
        }

        $name = $entity->getName();
        $thumbnail = $entity->getThumbnail();
        $preview = $entity->getPreview();

        return "<div class = 'preview-container'>
        <img src='$thumbnail' class = 'preview-img img-fluid' hidden/>
        <video autoplay  muted class = 'preview-video' src='$preview' type='video/mp4'></video>
        <div class = 'preview-overlay'>
        <div class='preview-header'>
            <div>
            <h1>$name</h1>
            </div>
            <div class='preview-buttons mt-4'>
                    <button class='btn btn-dark'>Play</button>
                    <button class='btn btn-dark'>Play</button>
            </div>
        </div>
        </div>
        </div>";
    }
}