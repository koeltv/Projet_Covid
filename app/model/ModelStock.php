
<!-- debut ModelStock -->
<?php
    require_once 'Model.php';

    class ModelStock
    {
        private $centreId, $vaccinId, $quantite;

        public function __construct($centreId = NULL, $vaccinId = NULL, $quantite = NULL) {
            //valeurs nulles si pas de passage de paramètres
            if (!is_null($centreId)) {
                $this->centreId = $centreId;
                $this->vaccinId = $vaccinId;
                $this->quantite = $quantite;
            }
        }

        /**
         * @return mixed
         */
        public function getCentreId()
        {
            return $this->centreId;
        }

        /**
         * @param mixed $centreId
         */
        public function setCentreId($centreId)
        {
            $this->centreId = $centreId;
        }

        /**
         * @return mixed|null
         */
        public function getVaccinId()
        {
            return $this->vaccinId;
        }

        /**
         * @param mixed|null $vaccinId
         */
        public function setVaccinId($vaccinId)
        {
            $this->vaccinId = $vaccinId;
        }

        /**
         * @return mixed|null
         */
        public function getQuantite()
        {
            return $this->quantite;
        }

        /**
         * @param mixed|null $quantite
         */
        public function setQuantite($quantite)
        {
            $this->quantite = $quantite;
        }

        /**
         * @return array|null - Liste des stocks de vaccin par centre
         */
        public static function getVaccinForEachCenter() {
            try {
                $database = Model::getInstance();
                $query = "SELECT centre.label AS centre, vaccin.label AS vaccin, stock.quantite AS quantite FROM stock, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id AND NOT quantite = 0";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @return array|null - Nombre global de doses par centre
         */
        public static function getGlobalDosesPerCentre() {
            try {
                $database = Model::getInstance();
                $query = "SELECT centre.label AS centre, SUM(stock.quantite) AS doses FROM stock, centre WHERE centre_id = centre.id GROUP BY centre.label ORDER BY doses DESC";
                $statement = $database->prepare($query);
                $statement->execute();
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $centreId - Id du centre où l'on met à jour les stocks
         * @param $vaccin - Liste des vaccins avec leurs quantités ajoutées
         * @return array|null - Liste des vaccins avec leurs quantités ajoutées ou NULL
         */
        public static function update($centreId, $vaccin) {
            $database = Model::getInstance();
            try {
                $query1 = "INSERT INTO stock VALUE (:centreId, (SELECT id FROM vaccin WHERE label = :label), :quantite)";
                $query2 = "UPDATE stock SET quantite = quantite + :quantite WHERE centre_id = :centreId AND vaccin_id = (SELECT id FROM vaccin WHERE label = :label)";
                $database->beginTransaction();
                $result = [];
                foreach ($vaccin as $key => $value) {
                    //Recherche d'un stock existant
                    $query3 = "SELECT * FROM stock WHERE centre_id = :centreId AND vaccin_id = (SELECT id FROM vaccin WHERE label = :label)";
                    $statement = $database->prepare($query3);
                    $statement->execute(['centreId' => $centreId, 'label' => $key]);
                    //S'il existe on le met à jour, sinon on le créer
                    $query = $statement->fetch() ? $query2 : $query1;

                    $statement = $database->prepare($query);
                    $statement->execute([
                        'centreId' => $centreId,
                        'label' => $key,
                        'quantite' => $value,
                    ]);
                    $result[$key] = $value;
                }
                $database->commit();
                return $result;
            } catch (Exception $e) {
                $database->rollBack();
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $vaccinId - Id du vaccin
         * @return array|null - Liste des centres avec le vaccin ou NULL
         */
        public static function getCentreWithVaccin($vaccinId) {
            try {
                $database = Model::getInstance();
                $query = "SELECT DISTINCT centre.id, centre.label, centre.adresse FROM stock, centre, vaccin WHERE stock.vaccin_id = :vaccinId AND stock.centre_id = centre.id AND quantite > 0";
                $statement = $database->prepare($query);
                $statement->execute(['vaccinId' => $vaccinId]);
                return $statement->fetchAll(PDO::FETCH_CLASS, 'ModelCentre');
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $centreId - Id du centre
         * @return array|null - Liste des vaccins ayant le plus de stock dans le centre ou NULL
         */
        public static function getVaccinIdWithMostStockInCentre($centreId) {
            try {
                $database = Model::getInstance();
                $query = "SELECT vaccin.id FROM vaccin, stock WHERE vaccin_id = vaccin.id AND centre_id = :centreId AND quantite = (SELECT MAX(quantite) FROM stock WHERE centre_id = :centreId)";
                $statement = $database->prepare($query);
                $statement->execute(['centreId' => $centreId]);
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }
    }
?>
<!-- fin ModelStock -->

