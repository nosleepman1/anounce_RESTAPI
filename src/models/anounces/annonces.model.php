<?php 
    require_once BASE_PATH . '/src/config/db.php';

    class annoncesModel {
        private $db;

        private string $title;
        private string $description;
        private int $price;
        private ?int $id = null;
        private int $user_id;



        public function __construct($title, $description, $price, $id = null, $user_id) {
            $this->title = $title;
            $this->description = $description;
            $this->price = $price;
            $this->id = $id;
            $this->user_id = $user_id;
        }

        public function getTitle(): string {
            return $this->title;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getPrice(): int {
            return $this->price;
        }

        public function getId(): int {
            return $this->id;
        }
        
        public function getUserId(): int {
            return $this->user_id;
        }


    }