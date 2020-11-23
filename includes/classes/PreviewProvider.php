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
        <img src='$thumbnail' class = 'preview-img'>
        <video autoplay muted class='preview-video' onended = 'showThumbnail()'>
            <source src='$preview' type='video/mp4'>
            <p>Your browser cannot play the provided video file.</p>
        </video>

        <div class = 'preview-overlay'>
            <div class='preview-header'>
                <div>
                    <h1>$name</h1>
                </div>
                <div class='preview-buttons mt-4'>
                    <button class='btn btn-dark'><i class='fas fa-play'></i>&nbsp&nbsp Play</button>
                    <button class='btn btn-dark' onclick = 'volumeToggle(this)'><i class='fas fa-volume-mute'></i></button>
                </div>
            </div>
        </div>
        </div>";
    }
}
