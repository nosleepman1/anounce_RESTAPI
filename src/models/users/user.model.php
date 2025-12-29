<?php 

    require_once BASE_PATH . '/src/config/db.php';
    class User {

        private ?int $id = null;
        private ?string $name ;
        private ?string $email ;
        private ?string $password ;

        public function __construct(string $name, string $email, string $password ) {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }

        public function getId(): ?int {
            return $this->id;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getPassword(): string {
            return $this->password;
        }

    }