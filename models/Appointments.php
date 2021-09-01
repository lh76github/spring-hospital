<?php

class Appointments extends Database
{

    public function addAppointment($dateHour, $idPatients)
    {
        $bdd = $this->connectDatabase();
        $req = $bdd->prepare("INSERT INTO `appointments`(dateHour, idPatients) VALUES(:dateHour, :idPatients)");
        $req->bindValue(':dateHour', $dateHour, PDO::PARAM_STR);
        $req->bindValue(':idPatients', $idPatients, PDO::PARAM_STR);
        $req->execute();
    }

    public function getAllAppointments()
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `patients`
        INNER JOIN `appointments` ON `patients`.id = `appointments`.idPatients;";
        $queryAllAppointments = $bdd->query($query);
        $allAppointmentsArray = $queryAllAppointments->fetchAll();
        return $allAppointmentsArray;
    }

    public function getOneAppointment($idAppointment)
    {
        $bdd = $this->connectDatabase();
        $query = "SELECT * FROM `appointments` WHERE `id` = :idAppointment";
        $queryOneAppointment = $bdd->prepare($query);
        $queryOneAppointment->bindValue(':idAppointment', $idAppointment, PDO::PARAM_STR);
        $queryOneAppointment->execute();
        $oneAppointmentArray = $queryOneAppointment->fetch();
        return $oneAppointmentArray;
    }

    public function modifyAppointment($idPatients, $dateHour, $idAppointment)
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
