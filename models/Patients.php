<?php

class Patients extends Database
{
    /**
     * Add new patient in patients table
     *
     * @param string $lastname : lastname user ...
     * @param string $firstname
     * @param string $birthdate
     * @param string $phoneNumber
     * @param string $email
     * @return void
     */
    public function addPatient(string $lastname, string $firstname, string $birthdate, string $phoneNumber, string $email): void
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES(:lastname, :firstname, :birthdate, :phone, :mail)");
        $req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $req->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $req->bindValue(':phone', $phoneNumber, PDO::PARAM_STR);
        $req->bindValue(':mail', $email, PDO::PARAM_STR);
        $req->execute();
    }

    public function searchPatients($search): array
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("SELECT * FROM `patients` WHERE `lastname` LIKE :search OR `firstname` LIKE :search ORDER BY `id` DESC");
        $req->bindValue(':search', "$search%", PDO::PARAM_STR);
        $req->execute();
        $searchArray = $req->fetchAll();
        return $searchArray;
    }


    /**
     * get All patients in table patients
     *
     * @return array
     */
    public function getAllPatients(): array
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `patients` ORDER BY `id` DESC";
        $queryAllPatients = $bdd->query($query);
        $allPatientsArray = $queryAllPatients->fetchAll();
        return $allPatientsArray;
    }

    public function getOnePatient(string $idPatient): array
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `patients` WHERE `id` = :idPatient";
        $queryOnePatient = $bdd->prepare($query);
        $queryOnePatient->bindValue(':idPatient', $idPatient, PDO::PARAM_STR);
        $queryOnePatient->execute();
        $onePatientArray = $queryOnePatient->fetch();
        return $onePatientArray;
    }

    public function modifyPatient($lastname, $firstname, $birthdate, $phoneNumber, $email, $id): void
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("UPDATE `patients` SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id");
        $req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $req->bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
        $req->bindValue(':phone', $phoneNumber, PDO::PARAM_STR);
        $req->bindValue(':mail', $email, PDO::PARAM_STR);
        $req->bindvalue(':id', $id, PDO::PARAM_STR);
        $req->execute();
    }

    public function deletePatient($idPatient): void
    {
        $bdd = $this->connectDatabase();
        $query = 'DELETE FROM `patients` WHERE `id` = :idPatient';
        $queryOnePatient = $bdd->prepare($query);
        $queryOnePatient->bindValue(':idPatient', $idPatient, PDO::PARAM_STR);
        $queryOnePatient->execute();
    }

    /**
     * Méthode permettant d'obtenir la liste des patients selon un intervale
     *
     * @param string $start indique quelle rangées nous commencons
     * @param string $limit indique combien de patients nous souhaitons afficher
     * @return array
     */
    public function getSomePatients(string $start, string $limit): array
    {
        $bdd = $this->connectDatabase();

        // Nous stockons ici notre requête pour permettre d'obtenir tous nos patients
        $query = 'SELECT * FROM `patients`  ORDER BY `id` DESC LIMIT :limit OFFSET :start';

        // Nous preparons notre requête à l'aide de la méthode prepare
        $getSomePatientsQuery = $bdd->prepare($query);

        // Nous lions par la suite les valeurs à l'aide de bindValue
        $getSomePatientsQuery->bindValue(':start', $start, PDO::PARAM_INT);
        $getSomePatientsQuery->bindValue(':limit', $limit, PDO::PARAM_INT);

        // le classique execute
        $getSomePatientsQuery->execute();

        // puis le fetchAll
        return $getSomePatientsQuery->fetchAll();
    }
}
