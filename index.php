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
                <h1><i class="fas fa-hospital"></i> Hôpital La Manu</h1>
            </div>
            <div class="card-body text-center">
                <a href="views/ajout-patient.php" class="btn btn-dark btn-lg">Ajouter un patient</a>
            </div>
            <div class="card-body text-center">
                <a href="views/liste-patients.php" class="btn btn-outline-dark btn-lg">Liste des patients</a>
            </div>
            <hr>
            <div class="card-body text-center">
                <a href="views/ajout-rendezvous.php" class="btn btn-dark btn-lg">Ajouter un rdv</a>
            </div>
            <div class="card-body text-center">
                <a href="views/liste-rendez-vous.php" class="btn btn-outline-dark btn-lg">Liste des rdv</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>