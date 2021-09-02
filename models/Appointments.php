<?php

class Appointments extends Database
{
/**
 * Ajoute un nouveau rendez-vous
 *
 * @param string $dateHour
 * @param string $idPatients
 * @return void
 */
    public function addAppointment(string $dateHour, string $idPatients): void
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("INSERT INTO `appointments`(dateHour, idPatients) VALUES(:dateHour, :idPatients)");
        $req->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
        $req->bindValue(':idPatients', $idPatients, PDO::PARAM_STR);
        $req->execute();
    }

    /**
     * va chercher tous les RDV sous forme de tableau
     *
     * @return array
     */
    public function getAllAppointments(): array
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `patients`
        INNER JOIN `appointments` ON `patients`.id = `appointments`.idPatients;";
        $queryAllAppointments = $bdd->query($query);
        $allAppointmentsArray = $queryAllAppointments->fetchAll();
        return $allAppointmentsArray;
    }

    /**
     * va chercher un RDV selon un ID spécifique (RDV)
     *
     * @param string $idAppointment
     * @return array
     */
    public function getOneAppointment(string $idAppointment): array
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `appointments` WHERE `id` = :idAppointment";
        $queryOneAppointment = $bdd->prepare($query);
        $queryOneAppointment->bindValue(':idAppointment', $idAppointment, PDO::PARAM_STR);
        $queryOneAppointment->execute();
        $oneAppointmentArray = $queryOneAppointment->fetch();
        return $oneAppointmentArray;
    }

    /**
     * Modifier un RDV selon les paramètres spécifiés
     *
     * @param string $idPatients
     * @param string $dateHour
     * @param string $idAppointment
     * @return void
     */
    public function modifyAppointment(string $idPatients, string $dateHour, string $idAppointment): void
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("UPDATE `appointments` SET dateHour = :dateHour, idPatients = :idPatients WHERE id = :id");
        $req->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
        $req->bindValue(':idPatients', $idPatients, PDO::PARAM_INT);
        $req->bindValue(':id', $idAppointment, PDO::PARAM_INT);
        $req->execute();
    }

    public function deleteAppointment($idAppointment)
    {
        $bdd = $this->connectDatabase();
        $query = "DELETE FROM `appointments` WHERE `id` = :idAppointment";
        $queryOnePatient = $bdd->prepare($query);
        $queryOnePatient->bindValue(':idAppointment', $idAppointment, PDO::PARAM_STR);
        $queryOnePatient->execute();
    }
}
