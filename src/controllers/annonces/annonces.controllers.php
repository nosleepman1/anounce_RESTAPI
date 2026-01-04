<?php 

    require_once __DIR__ .'/../../repositories/AnounceRepository.php';
    require_once __DIR__ .'/../../repositories/UserRepository.php';
    require BASE_PATH . '/src/helpers/json.php';
    class annoncesControllers {
        private $anounceRepository;

        public function __construct() {
            $this->anounceRepository = new AnounceRepository();
        }

        public function new() {
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents('php://input'), true);
            
            try {
                if ($_SESSION['user_id']) {

                    $annonce = new annoncesModel(
                    $data['title'],
                    $data['description'],
                    $data['price'],
                    null,
                    $_SESSION['user_id']
                    );

                    $this->anounceRepository->new($_SESSION['user_id'], $annonce);

                    message::json_datas(
                        [
                            'status' => 201,
                            'message'   => 'Annonce cree avec succes',
                            'datas' => $annonce
                        ]
                    );
                    
                } else {
                    message::json_datas(
                        [
                            'status' => 401,
                            'message'   => 'Utilisateur non authentifie'
                        ]
                    );
                }

            } catch (Exception $e) {
                message::json_datas(
                    [
                        'status' => 400,
                        'message'   => 'Erreur lors de la creation de l\'annonce',
                        'error' => $e->getMessage()
                    ]
                );
            }
        }  

        public function All() {
            header('Content-Type: application/json');

            message::json_datas(
                [
                    'status' => 200,
                    'message'   => 'Liste des annonces',
                    'datas' => $this->anounceRepository->getAll()
                ]
            );
        }
    }