<?php
require '../models/Database.php';
require '../models/Patients.php';

$errors = [];
$addSuccess = 0; // Valeur à 0 qui correspond à un false pour le JS
$deleteSuccess = 0;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST["deletePatient"])) {
        $patientProfilObj = new Patients();
        $patientProfilObj->deletePatient($_POST["deletePatient"]);
        $deleteSuccess = true;
    }

    if (isset($_POST["submit"]) && count($errors) == 0) {

        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $birthdate = $_POST["birthdate"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];

        $patientsObj = new Patients();
        $patientsObj->addPatient($lastname, $firstname, $birthdate, $phoneNumber, $email);
        $addSuccess = true;
    }

    if (isset($_POST["modify"]) && count($errors) == 0) {
        $lastname = $_POST["lastname"];
        $firstname = $_POST["firstname"];
        $birthdate = $_POST["birthdate"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $id = $_POST["id"];

        $modifyPatientObj = new Patients();
        $modifyPatientObj->modifyPatient($lastname, $firstname, $birthdate, $phoneNumber, $email, $id);
        $addSuccess = true;

        $patientProfilArray = $modifyPatientObj->getOnePatient($id);
    }
}

$listPatientsObj = new Patients();

// on crée les variables page, limit et start pour définir la page sur laquelle nous nous trouvons, la limite de patients à afficher et à partir de quelle ligne.
$page = (!empty($_GET['page']) ? abs(htmlspecialchars($_GET['page'])) : 1); // on utilise une ternaire pour définir la valeur de page selon la présence du get
$limit = 5; // on souhaite afficher 5 patients par page
$start = ($page - 1) * $limit; // on définit la valeur de $start via un simple calcul

// nous allons compter le total de patients dans notre base, avec un intval pour être sure d'avoir un integer
$nbPatients = intval(count($listPatientsObj->getAllPatients()));
// on definit le nombre de page via la fonction ceil qui arrondit à l'entier supérieur
$pagesMax = ceil($nbPatients / $limit);

// Il nous reste plus qu'a recupérer nos patients via notre méthode
$listPatientsArray = $listPatientsObj->getSomePatients($start, $limit);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET["idPatient"])) {
        $patientProfilObj = new Patients();
        $patientProfilArray = $patientProfilObj->getOnePatient($_GET["idPatient"]);
    }

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $listPatientsObj = new Patients();
        $listPatientsArray = $listPatientsObj->searchPatients($_GET['search']);

        // Modification de la pagination en fonction de la recherche
        $nbPatients = intval(count($listPatientsArray));
        $pagesMax = ceil($nbPatients / $limit);
    }
}
