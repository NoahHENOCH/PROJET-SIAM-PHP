<?php
require_once "../vue/head.php";
require_once "../vue/body.php";
require_once "../db/databaseProject.php";

session_start();

$dbp = new DataBaseProject("../db/projet.sqlite3");
$isAdmin = false;

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $username = $dbp->getUsername($id_user);
    $isAdmin = $dbp->isAdmin($id_user);
    if (!$isAdmin) {
        header("Location: ../index.php");
        exit();
    }
    $dbp->updateDateLastSeen($id_user);
}





?>
<!DOCTYPE html>
<html lang="en">
<?php
    echoHead("Siam - Règles");
?>
<body>
    <?php
        displayBodyElements(true, $isAdmin, $username);
    ?>
    <style>
        .container {
            max-width: 96%;
        }
    </style>
    <div class="container margin20px">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card rounded">
                    <div class="card-header">
                        <h3 class="mb-0">Règles du jeu</h3>
                    </div>
                    <div class="card-body">
                        <embed src="siam.pdf" type="application/pdf" width="100%" height="600px" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
