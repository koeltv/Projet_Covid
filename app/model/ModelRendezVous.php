
<!-- debut ModelRendezVous -->
<?php
    require_once 'Model.php';

    class ModelRendezVous
    {
        private $centreId, $patientId, $injection, $vaccinId;

        public function __construct($centreId = NULL, $patientId = NULL, $injection = NULL, $vaccinId = NULL) {
            //valeurs nulles si pas de passage de paramètres
            if (!is_null($centreId)) {
                $this->centreId = $centreId;
                $this->patientId = $patientId;
                $this->injection = $injection;
                $this->vaccinId = $vaccinId;
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
        public function getPatientId()
        {
            return $this->patientId;
        }

        /**
         * @param mixed|null $patientId
         */
        public function setPatientId($patientId)
        {
            $this->patientId = $patientId;
        }

        /**
         * @return mixed|null
         */
        public function getInjection()
        {
            return $this->injection;
        }

        /**
         * @param mixed|null $injection
         */
        public function setInjection($injection)
        {
            $this->injection = $injection;
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
         * @param $patientId - Id du patient dont on cherche les rendez-vous
         * @return array|null - Rendez-vous du patient ou NULL
         */
        public static function getForPatient($patientId) {
            try {
                $database = Model::getInstance();
                $query = "SELECT patient_id, centre.label AS centre, vaccin.label AS vaccin, injection FROM rendezvous, centre, vaccin WHERE patient_id = :patientId AND centre.id = centre_id AND vaccin.id = vaccin_id ORDER BY injection";
                $statement = $database->prepare($query);
                $statement->execute(['patientId' => $patientId]);
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $patientId - Patient pour lequel on cherche le vaccin utilisé
         * @return array|null - Id du vaccin utilisé ou NULL
         */
        public static function getPatientVaccin($patientId) {
            try {
                $database = Model::getInstance();
                $query = "SELECT DISTINCT vaccin_id FROM rendezvous WHERE patient_id = :patientId";
                $statement = $database->prepare($query);
                $statement->execute(['patientId' => $patientId]);
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $patientId - Id du patient dont on cherche la dernière injection
         * @return array|null - Dernière injection du patient ou NULL
         */
        public static function getMaxInjection($patientId) {
            try {
                $database = Model::getInstance();
                $query = "SELECT MAX(injection) FROM rendezvous WHERE patient_id = :patientId";
                $statement = $database->prepare($query);
                $statement->execute(['patientId' => $patientId]);
                return $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $centreId - Id du centre
         * @param $patientId - Id du patient
         * @param $vaccinId - Id du vaccin
         * @return array|null - Id du centre ou NULL
         */
        public static function insert($centreId, $patientId, $vaccinId) {
            $database = Model::getInstance();
            try {
                $database->beginTransaction();
                $query = "INSERT INTO rendezvous VALUE (:centreId, :patientId, :injection, :vaccinId)";
                $statement = $database->prepare($query);
                $statement->execute([
                    'centreId' => $centreId,
                    'patientId' => $patientId,
                    'injection' => ++ModelRendezVous::getMaxInjection($patientId)[0],
                    'vaccinId' => $vaccinId,
                ]);

                //Mise à jour des stocks
                $query = "UPDATE stock SET quantite = quantite - 1 WHERE centre_id = :centreId AND vaccin_id = :vaccinId";
                $statement = $database->prepare($query);
                $statement->execute([
                    'centreId' => $centreId,
                    'vaccinId' => $vaccinId,
                ]);
                $database->commit();
                return [$centreId];
            } catch (PDOException $e) {
                $database->rollBack();
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }

        /**
         * @param $query - Query à utiliser sur la base de données
         * @return array[]|null - Sortie de la query
         */
        public static function getMany($query) {
            try {
                $database = Model::getInstance();
                $statement = $database->prepare($query);
                $statement->execute();

                $results = ['columnNames' => [], 'rows' => []];
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if (empty($row)) return $results;
                foreach (array_keys($row) as $key) array_push($results['columnNames'], $key);

                do {
                    $currentRow = [];
                    foreach ($row as $value) array_push($currentRow, $value);
                    array_push($results['rows'], $currentRow);
                } while ($row = $statement->fetch(PDO::FETCH_ASSOC));

                return $results;
            } catch (PDOException $e) {
                printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
                return NULL;
            }
        }
    }
?>
<!-- fin ModelStock -->

