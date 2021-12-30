
<!-- debut ModelPatient -->
<?php
    require_once 'Model.php';

    class ModelPatient
    {
        private $id, $nom, $prenom, $adresse;

        public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL) {
            //valeurs nulles si pas de passage de paramètres
            if (!is_null($id)) {
                $this->id = $id;
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->adresse = $adresse;
            }
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed|null
         */
        public function getNom()
        {
            return $this->nom;
        }

        /**
         * @param mixed|null $nom
         */
        public function setNom($nom)
        {
            $this->nom = $nom;
        }

        /**
         * @return mixed|null
         */
        public function getPrenom()
        {
            return $this->prenom;
        }

        /**
         * @param mixed|null $prenom
         */
        public function setPrenom($prenom)
        {
            $this->prenom = $prenom;
        }

        /**
         * @return mixed|null
         */
        public function getAdresse()
        {
            return $this->adresse;
        }

        /**
         * @param mixed|null $adresse
         */
        public function setAdresse($adresse)
        {
            $this->adresse = $adresse;
        }

        /**
         * @return array|null - Liste de tous les patients
         */
        public static function getAll() {
            try {
                $database = Model::getInstance();
                $query = "SELECT * FROM patient";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $nom - Nom du patient
         * @param $prenom - Prénom du patient
         * @param $adresse - Adresse du patient
         * @return mixed|null - ID du patient ou NULL
         */
        public static function insert($nom, $prenom, $adresse) {
            try {
                $database = Model::getInstance();

                //Recherche de la valeur de la clé = max(id) + 1
                $query = "SELECT MAX(id) FROM patient";
                $statement = $database->query($query);
                $id = $statement->fetch()['0'];

                //Ajout d'un nouveau tuple;
                $query = "INSERT INTO patient VALUE (:id, :nom, :prenom, :adresse)";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => ++$id,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'adresse' => $adresse,
                ]);
                return $id;
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }
    }
?>
<!-- fin ModelPatient -->

