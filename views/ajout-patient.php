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
                <h1><i class="fas fa-hospital-user"></i> Enregistrement du patient</h1>
            </div>
            <form method="POST">
                <div class="m-3">
                    <label for="lastname" class="form-label fw-bold">Nom</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname" placeholder="ex. Dupont" required>
                </div>

                <div class="m-3">
                    <label for="firstname" class="form-label fw-bold">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname" placeholder="ex. Jean" required>
                </div>

                <div class="m-3">
                    <label for="birthdate" class="form-label fw-bold">Date de naissance</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" aria-describedby="birthdate" required>
                </div>

                <div class="m-3">
                    <label for="phoneNumber" class="form-label fw-bold">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" aria-describedby="phoneNumber" maxlength="10" placeholder="ex. 0614XXXXXX" required>
                </div>

                <div class="m-3">
                    <label for="email" class="form-label fw-bold">E-mail</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="email" placeholder="ex. mail@mail.fr" required>
                </div>

                <button type="reset" class="btn btn-outline-secondary ms-3 mb-3" onclick="javascript:history.back()">Annuler</button>
                <button type="submit" name="submit" class="btn btn-dark mb-3">Enregistrer</button>
                <a class="btn btn-outline-dark mb-3" href="liste-patients.php" role="button">Liste des patients</a>
            </form>
        </div>
        <div class="text-center homebtn mt-2">
            <a href="../index.php" class="btn btn-lg btn-dark"><i class="fas fa-home"></i> Accueil</a>
        </div>
    </div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        if (<?= $addSuccess ?>) {
            Swal.fire({
                icon: 'success',
                title: 'Bravo !',
                text: 'Le patient a bien été rajouté !',
                confirmButtonColor: '#000'
            })
        }
    </script>
</body>

</html>