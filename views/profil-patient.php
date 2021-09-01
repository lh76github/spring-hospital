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
                <h1><i class="fas fa-users"></i> Infos du patient</h1>
            </div>
            <div class="row text-center pt-2">
                <div class="col fw-bold">Nom</div>
                <div class="col fw-bold">Prénom</div>
                <div class="col fw-bold">E-mail</div>
                <div class="col fw-bold">Date de naissance</div>
                <div class="col fw-bold">Téléphone</div>
                <div class="col fw-bold">Supprimer</div>
            </div>
            <hr>

            <?php
            if (isset($_GET["idPatient"]) && !empty($patientProfilArray)) { ?>
                <div class="row text-center">
                    <div class="col"><?= $patientProfilArray['lastname'] ?></div>
                    <div class="col"><?= $patientProfilArray['firstname'] ?></div>
                    <div class="col"><?= $patientProfilArray['mail'] ?></div>
                    <div class="col"><?= $patientProfilArray['birthdate'] ?></div>
                    <div class="col"><?= $patientProfilArray['phone'] ?></div>
                    <div class="col"><i class="bi bi-trash text-danger deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal"></i></div>
                </div>
                <hr>

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
                                <p><b><span id="namePatient"><?= $patientProfilArray['lastname'] . ' ' . $patientProfilArray['firstname'] ?></span></b></p>
                                <p><i><span id="mailPatient"><?= $patientProfilArray['mail'] ?></span></i></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <form action="" method="POST">
                                    <!-- <input type="hidden" id="patientId" name="patientId"> -->
                                    <button id="deletePatient" name="deletePatient" type="submit" class="btn btn-danger" value="<?= $patientProfilArray['id'] ?>">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -------------- -->
                <!--  UNIQUE MODALE -->
                <!-- -------------- -->


            <?php } else { ?>
                <p class="text-center fw-bold text-danger mt-3">Veuillez sélectionner un patient</p>
            <?php } ?>

            <div class="card-body text-center">
                <a class="btn btn-outline-danger" href="modifier-patient.php?idPatient=<?= $patientProfilArray['id'] ?>" role="button">Modifier</a>
                <a href="ajout-patient.php" role="button" class="btn btn-dark">Ajouter un patient</a>
                <a class="btn btn-outline-dark" href="liste-patients.php" role="button">Liste des patients</a>
            </div>

            <div class="text-center homebtn mb-2">
                <a href="../index.php" class="btn btn-lg btn-dark"><i class="fas fa-home"></i> Accueil</a>
            </div>

        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        // Mise en place de la swal pour indiquer que le patient a été supprimé
        if (<?= $deleteSuccess ?>) {
            Swal.fire({
                icon: 'success',
                text: 'La patient a bien été supprimé !',
                confirmButtonColor: '#000'
            })
        };
    </script>

</body>

</html>