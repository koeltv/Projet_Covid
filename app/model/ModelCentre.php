
<!-- debut ModelCentre -->
<?php
    require_once 'Model.php';

    class ModelCentre
    {
        private $id, $label, $adresse;

        public function __construct($id = NULL, $label = NULL, $adresse = NULL) {
            //valeurs nulles si pas de passage de paramètres
            if (!is_null($id)) {
                $this->id = $id;
                $this->label = $label;
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
         * @return array|null - Liste de tous les centres
         */
        public static function getAll() {
            try {
                $database = Model::getInstance();
                $query = "SELECT * FROM centre";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $label - Nom du centre
         * @param $adresse - Adresse du centre
         * @return mixed|null - ID de l'objet inséré ou NULL
         */
        public static function insert($label, $adresse) {
            try {
                $database = Model::getInstance();

                //Recherche de la valeur de la clé = max(id) + 1
                $query = "SELECT MAX(id) FROM centre";
                $statement = $database->query($query);
                $id = $statement->fetch()['0'];

                //Ajout d'un nouveau tuple;
                $query = "INSERT INTO centre VALUE (:id, :label, :adresse)";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => ++$id,
                    'label' => $label,
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
<!-- fin ModelCentre -->

