<?php

require '../controllers/appointments-controller.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Hôpital La Manu</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1><i class="far fa-calendar-alt"></i> Liste des rendez-vous</h1>
            </div>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th class="text-center">Date du rdv</th>
                            <th class="text-center">Heure du rdv</th>
                            <th class="text-center">Modifier</th>
                            <th class="text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listAppointmentsArray as $appointments) { ?>
                            <tr>
                                <td id="<?= $appointments['id'] ?>-lastname"><?= $appointments['lastname'] ?></td>
                                <td id="<?= $appointments['id'] ?>-firstname"><?= $appointments['firstname'] ?></td>
                                <td class="text-center" id="<?= $appointments['id'] ?>-date"><?= strftime('%d-%m-%Y', strtotime($appointments['dateHour'])) ?></td>
                                <td class="text-center"><?= strftime('%H:%M', strtotime($appointments['dateHour'])) ?></td>
                                <td class="text-center"><a href="modifier-rendezvous.php?idAppointment=<?= $appointments['id'] ?>" role="button"><i class="far fa-edit"></i></a></td>
                                <td class="text-center"><i class="bi bi-trash text-danger deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-appointment-id="<?= $appointments['id'] ?>"></i></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- -------------- -->
            <!--  UNIQUE MODALE -->
            <!-- -------------- -->
            <div class="modal fade" id="deleteModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Suppression d'un rendez-vous</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>Suppression du rdv de <b><span id="textAppointment"></span></b></p>
                            <p>Le <i><span id="dateAppointment"></span></i></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="" method="POST">
                                <input type="hidden" id="appointmentId" name="appointmentId">
                                <button id="deleteAppointment" name="deleteAppointment" type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -------------- -->
            <!--  UNIQUE MODALE -->
            <!-- -------------- -->


            <div class="card-body text-center">
            <button type="reset" class="btn btn-outline-secondary" onclick="javascript:history.back()">retour</button>
                <a href="ajout-rendezvous.php" role="button" class="btn btn-outline-dark"> + Ajouter un rdv</a>
            </div>
            
            <div class="text-center homebtn mb-2">
                <a href="../index.php" class="btn btn-lg btn-dark"><i class="fas fa-home"></i> Accueil</a>
            </div>

        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Mise en place de la swal pour indiquer que le rdv a été supprimé
        if (<?= $deleteSuccess ?>) {
            Swal.fire({
                icon: 'success',
                text: 'Le rdv a bien été supprimé !',
                confirmButtonColor: '#000'
            })
        };

        // mise en place d'un array regroupant tous les boutons de la classe .deletebtn
        const trashButtonsArray = document.querySelectorAll('.deletebtn')

        // on ajoute un écouteur d'événement sur chaque bouton au click
        trashButtonsArray.forEach(element => {
            element.addEventListener('click', function() {
                // on recupere la valeur du data pour l'inserer dans la value du button correspondant
                document.getElementById('deleteAppointment').value = this.dataset.appointmentId
                // on recupere la valeur des id contenant les nom et prenoms pour l'insérer dans la div
                document.getElementById('textAppointment').innerHTML = document.getElementById(this.dataset.appointmentId + '-lastname').innerText + ' ' + document.getElementById(this.dataset.appointmentId + '-firstname').innerText
                document.getElementById('dateAppointment').innerHTML = document.getElementById(this.dataset.appointmentId + '-date').innerText
            })
        });
    </script>

</body>

</html>