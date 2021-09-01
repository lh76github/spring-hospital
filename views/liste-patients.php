<?php

require '../controllers/patients-controller.php';

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
                <h1><i class="fas fa-users"></i> Liste des patients</h1>
            </div>

            <!-- -------------------------------- -->
            <!-- Mise en place d'un champs search -->
            <div class="row justify-content-center">
                <form action="" method="GET">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" type="submit">Recherche</button>
                        </div>
                        <input type="text" class="form-control" name="search" placeholder="Saisir un nom de patient">
                    </div>
                </form>
            </div>
            <!-- Mise en place d'un champs search -->
            <!-- -------------------------------- -->

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>E-mail</th>
                            <th class="text-center">Profil</th>
                            <th class="text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listPatientsArray as $patients) { ?>
                            <tr>
                                <td id="<?= $patients['id'] ?>-lastname"><?= $patients['lastname'] ?></td>
                                <td id="<?= $patients['id'] ?>-firstname"><?= $patients['firstname'] ?></td>
                                <td id="<?= $patients['id'] ?>-mail"><?= $patients['mail'] ?></td>
                                <td class="text-center"><a href="profil-patient.php?idPatient=<?= $patients['id'] ?>"><i class="bi bi-person-circle"></i></a></td>
                                <td class="text-center"><i class="bi bi-trash text-danger deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-patient-id="<?= $patients['id'] ?>"></i></td>
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
                            <h5 class="modal-title text-white" id="exampleModalLabel">Suppression d'un patient</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p><b><span id="namePatient"></span></b></p>
                            <p><i><span id="mailPatient"></span></i></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <form action="" method="POST">
                                <!-- <input type="hidden" id="patientId" name="patientId"> -->
                                <button id="deletePatient" name="deletePatient" type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -------------- -->
            <!--  UNIQUE MODALE -->
            <!-- -------------- -->


            <!-- ------------------------------- -->
            <!--  MODULE DE BOUTON DE NAVIGATION -->
            <!-- ------------------------------- -->
            <div class="text-center">
                <!-- mise en place de ternaire pour rajouter les classes active et disabled selon le numéro de la page -->
                <a href="liste-patients?page=<?= $page - 1 ?>" class="btn btn-outline-secondary btn-sm <?= $page > 1 ? '' : 'disabled' ?>"><i class="fas fa-chevron-left"></i></a>
                <?php
                for ($pageNumber = 1; $pageNumber <= $pagesMax; $pageNumber++) { ?>
                    <a href="liste-patients?page=<?= $pageNumber ?>" class="btn btn-outline-secondary btn-sm <?= $pageNumber == $page ? 'active' : '' ?>"><?= $pageNumber ?></a>
                <?php } ?>
                <a href="liste-patients?page=<?= $page + 1 ?>" class="btn btn-outline-secondary btn-sm <?= $page < $pagesMax ? '' : 'disabled' ?>"><i class="fas fa-chevron-right"></i></a>

            </div>
            <!-- ---------------------------------- -->
            <!-- FIN DU MODULE BOUTON DE NAVIGATION -->
            <!-- ---------------------------------- -->


            <div class="card-body text-center">
                <button type="reset" class="btn btn-outline-secondary" onclick="javascript:history.back()">retour</button>
                <a href="ajout-patient.php" role="button" class="btn btn-outline-dark"> + Ajouter un patient</a>
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
        // Mise en place de la swal pour indiquer que le patient a été supprimé
        if (<?= $deleteSuccess ?>) {
            Swal.fire({
                icon: 'success',
                text: 'La patient a bien été supprimé !',
                confirmButtonColor: '#000'
            })
        };

        // mise en place d'un array regroupant tous les boutons de la classe .deletebtn
        const trashButtonsArray = document.querySelectorAll('.deletebtn')

        // on ajoute un écouteur d'événement sur chaque bouton au click
        trashButtonsArray.forEach(element => {
            element.addEventListener('click', function() {
                // on recupere la valeur du data pour l'inserer dans la value du button correspondant
                document.getElementById('deletePatient').value = this.dataset.patientId
                // on recupere la valeur des id contenant les nom et prenoms pour l'insérer dans la div
                document.getElementById('namePatient').innerHTML = document.getElementById(this.dataset.patientId + '-lastname').innerText + ' ' + document.getElementById(this.dataset.patientId + '-firstname').innerText;
                document.getElementById('mailPatient').innerHTML = document.getElementById(this.dataset.patientId + '-mail').innerText

            })
        });
    </script>

</body>

</html>