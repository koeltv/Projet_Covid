
<!-- debut ControllerRendezVous -->
<?php
    require_once '../model/ModelRendezVous.php';
    const RENDEZVOUS_VIEW_PATH = '/app/view/rendezVous/';

    class ControllerRendezVous
    {
        public static function rdvGetPatient() {
            $results = ModelPatient::getAll();
            include 'config.php';
            $vue = $root . '/app/view/patient/viewSelect.php';
            if (DEBUG) echo "ControllerRendezVous : rdvGetPatient : vue = $vue";
            require $vue;
        }

        public static function rdvReadForPatient() {
            $patientId = htmlspecialchars(explode(' ', $_GET['patient'])[0]);
            $results['rdv'] = ModelRendezVous::getForPatient($patientId);
            $results['lastInjection'] = ModelRendezVous::getMaxInjection($patientId);
            if (!empty($results['rdv'])) {
                $vaccinId = ModelVaccin::getIdFromLabel($results['rdv'][0]['vaccin']);
                $vaccinId = $vaccinId[0];
                $results['doses'] = ModelVaccin::getDosesFromId($vaccinId);
            }
            //Si tous les vaccins ne sont pas fait, on affichera les centres disponibles
            if ($results) {
                //Si il n'y a aucune injection effectuée
                if (!$results['lastInjection'][0]) {
                    $results['centre'] = ModelCentre::getAll();
                } else if ($results['lastInjection'][0] < $results['doses'][0]) {
                    $results['centre'] = ModelStock::getCentreWithVaccin($vaccinId);
                }
            }
            include 'config.php';
            $vue = $root . RENDEZVOUS_VIEW_PATH . 'viewAll.php';
            if (DEBUG) echo "ControllerRendezVous : rdvReadForPatient : vue = $vue";
            require $vue;
        }

        public static function rdvCreated() {
            $centerId = htmlspecialchars(explode(' ', $_GET['centre'])[0]);
            $patientId = htmlspecialchars($_GET['patientId']);

            $vaccinId = ModelRendezVous::getPatientVaccin($patientId);
            if (empty($vaccinId)) {
                $vaccinId = ModelStock::getVaccinIdWithMostStockInCentre($centerId);
                shuffle($vaccinId);
            }

            $results = ModelRendezVous::insert($centerId, $patientId, $vaccinId[0]);
            $results['vaccin'] = $vaccinId[0];
            $results['patientId'] = $patientId;
            include 'config.php';
            $vue = $root . RENDEZVOUS_VIEW_PATH . 'viewInserted.php';
            if (DEBUG) echo "ControllerRendezVous : rdvCreated : vue = $vue";
            require $vue;
        }

        public static function rdvVaccinUsagePerCentre() {
            $request = "SELECT centre.label AS centre, vaccin.label AS vaccin, COUNT(vaccin_id) AS utilisé FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id GROUP BY centre_id, vaccin_id";
            $results = ModelRendezVous::getMany($request);
            include 'config.php';
            $vue = $root . RENDEZVOUS_VIEW_PATH . 'viewInnovation.php';
            if (DEBUG) echo "ControllerRendezVous : rdvVaccinUsagePerCentre : vue = $vue";
            require ($vue);
        }

        public static function rdvVaccinatedPerCentre() {
            $request = "SELECT centre.id, centre.label AS centre, COUNT(patient_id) AS vacciné FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id AND injection = doses GROUP BY centre.label";
            $results = ModelRendezVous::getMany($request);
            include 'config.php';
            $vue = $root . RENDEZVOUS_VIEW_PATH . 'viewInnovation.php';
            if (DEBUG) echo "ControllerRendezVous : rdvVaccinatedPerCentre : vue = $vue";
            require ($vue);
        }

        public static function rdvToVaccinatePerVaccinPerCentre() {
            $request = "SELECT centre.label AS centre, vaccin.label as vaccin, COUNT(patient_id) AS à_vacciner FROM rendezvous, centre, vaccin WHERE centre_id = centre.id AND vaccin_id = vaccin.id AND injection < doses AND patient_id NOT IN (SELECT DISTINCT patient_id FROM rendezvous, vaccin WHERE injection >= doses AND vaccin_id = vaccin.id) GROUP BY centre.label, vaccin.label";
            $results = ModelRendezVous::getMany($request);
            include 'config.php';
            $vue = $root . RENDEZVOUS_VIEW_PATH . 'viewInnovation.php';
            if (DEBUG) echo "ControllerRendezVous : rdvToVaccinatePerVaccinPerCentre : vue = $vue";
            require ($vue);
        }
    }
?>
<!-- fin ControllerRendezVous -->

