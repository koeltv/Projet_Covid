
<!-- debut ModelVaccin -->
<?php
    require_once 'Model.php';

    class ModelVaccin
    {
        private $id, $label, $doses;

        public function __construct($id = NULL, $label = NULL, $doses = NULL) {
            //valeurs nulles si pas de passage de paramètres
            if (!is_null($id)) {
                $this->id = $id;
                $this->label = $label;
                $this->doses = $doses;
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
        public function getLabel()
        {
            return $this->label;
        }

        /**
         * @param mixed|null $label
         */
        public function setLabel($label)
        {
            $this->label = $label;
        }

        /**
         * @return mixed|null
         */
        public function getDoses()
        {
            return $this->doses;
        }

        /**
         * @param mixed|null $doses
         */
        public function setDoses($doses)
        {
            $this->doses = $doses;
        }

        /**
         * @return array|null - Liste des IDs ou Null
         */
        public static function getAllId() {
            try {
                $database = Model::getInstance();
                $query = "SELECT id FROM vaccin";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @return array|null - Liste de tous les vaccins
         */
        public static function getAll() {
            try {
                $database = Model::getInstance();
                $query = "SELECT * FROM vaccin";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_CLASS, "ModelVaccin");
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $label - Nom du vaccin
         * @param $doses - Nombre de doses
         * @return mixed|null - ID du vaccin ou NULL
         */
        public static function insert($label, $doses) {
            try {
                $database = Model::getInstance();

                //Recherche de la valeur de la clé = max(id) + 1
                $query = "SELECT MAX(id) FROM vaccin";
                $statement = $database->query($query);
                $id = $statement->fetch()['0'];

                //Ajout d'un nouveau tuple;
                $query = "INSERT INTO vaccin VALUE (:id, :label, :doses)";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => ++$id,
                    'label' => $label,
                    'doses' => $doses,
                ]);
                return ['insert', $id, $label];
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $id - ID du vaccin
         * @param $doses - Nombre de doses à ajouter
         * @return mixed|null - ID du vaccin ou NULL
         */
        public static function update($id, $doses) {
            try {
                $database = Model::getInstance();

                //Mise à jour d'un vaccin existant
                $query = "UPDATE vaccin SET doses = :doses WHERE id = :id";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => $id,
                    'doses' => $doses,
                ]);
                return ['update', $id];
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $id - Id du vaccin
         * @return array|null - Doses nécessaires pour la vaccination avec le vaccin ou NULL
         */
        public static function getDosesFromId($id) {
            try {
                $database = Model::getInstance();
                $query = "SELECT doses FROM vaccin WHERE id = :id";
                $statement = $database->prepare($query);
                $statement->execute(['id' => $id]);
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $label - Label du vaccin
         * @return array|null - Id du vaccin ou NULL
         */
        public static function getIdFromLabel($label) {
            try {
                $database = Model::getInstance();
                $query = "SELECT id FROM vaccin WHERE label = :label";
                $statement = $database->prepare($query);
                $statement->execute(['label' => $label]);
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }
    }
?>
<!-- fin ModelVaccin -->

