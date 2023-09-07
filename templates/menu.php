<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Mettez ici les balises meta, titre, liens CSS, etc. -->
</head>
<body>
    <!-- Bouton pour activer le menu déroulant en version mobile -->
    <button class="d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">Menu</button>
    <div class="container-fluid px-5 py-5">
        <div class="row">
            <?php if (isset($_SESSION['utilisateurConnecte']) && $_SESSION['utilisateurConnecte'] === true) {
                    echo '<h2>Bonjour '. ucfirst($_SESSION['user_name']) .'</h2>
                    <button class="btn btn-primary" id="btnDeconnexion">Déconnexion</button>';
                        
                }
                ?> 
            <!-- Menu d'onglets Bootstrap -->
            <ul class="nav nav-pills flex-column d-none d-xl-block sidenav col-3 " id="myTabs">
                <h1 class="menu-title pb-5">Menu de navigation</h1>
                <?php
                
                // Vérifier si l'utilisateur est connecté (vous devez mettre en place votre propre logique de connexion)
                $utilisateurConnecte = false;

                // Générer les onglets en fonction de l'état de connexion
                if (isset($_SESSION['utilisateurConnecte']) && $_SESSION['utilisateurConnecte'] === true) {
                    echo '<li class="nav-item py-3">
                            <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">Ma collection</a>
                        </li>
                        <li class="nav-item py-3 ">
                            <a class="nav-link " id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">Market store</a>
                        </li>
                        <li class="nav-item py-3">
                            <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">Collection zone</a>
                        </li>
                        ';
                        
                }
                ?>
                <!-- Onglets communs pour tous les utilisateurs -->
                <li class="nav-item py-3">
                    <a class="nav-link" id="tab4-tab" data-bs-toggle="tab" href="#tab4" role="tab">Inscription</a>
                </li>
                <li class="nav-item py-3">
                    <a class="nav-link" id="tab5-tab" data-bs-toggle="tab" href="#tab5" role="tab">Connexion</a>
                </li>
                <h1 class="menu-title">Guide d'utilisation</h1>
                <li class="nav-item"><a href="#" class="nav-link p-3">FAQ</a></li>
                <li class="nav-item"><a href="#" class="nav-link p-3">Guide d'utilisation</a></li>
                <li class="nav-item"><a href="#" class="nav-link p-3">Mentions légales</a></li>
            </ul>

            <!-- Menu de navigation masqué en version mobile -->
            <div class="collapse bgc w-100 position-fixed h-100 top-0 start-0 z-index-9999 collapsing" id="navMenu">
                <button type="button" class="btn-close" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-label="Fermer"></button>
                <ul class="nav nav-pills flex-column">
                    <li><h1 class="menu-title ">Guide d'utilisation</h1></li>
                    <li class="nav-item py-3">
                        <a class="nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1" role="tab">Ma collection</a>
                    </li>
                    <li class="nav-item py-3">
                        <a class="nav-link" id="tab2-tab" data-bs-toggle="tab" href="#tab2" role="tab">Market store</a>
                    </li>
                    <li class="nav-item py-3">
                        <a class="nav-link" id="tab3-tab" data-bs-toggle="tab" href="#tab3" role="tab">Collection zone</a>
                    </li>
                    <!-- Nouveaux onglets mobiles -->
                    <li class="nav-item py-3">
                        <a class="nav-link" id="tab4-tab" data-bs-toggle="tab" href="#tab4" role="tab">Inscription</a>
                    </li>
                    <li class="nav-item py-3">
                        <a class="nav-link" id="tab5-tab" data-bs-toggle="tab" href="#tab5" role="tab">Connexion</a>
                    </li>
                </ul>
            </div>

            <div class="vr vr-blurry g-0 d-none d-xl-block" style="height: 400px"></div>

            <!-- Contenu des onglets -->
            <div class="tab-content col-xl-8 col-12 " id="myTabsContent">
                <div class="tab-pane fade show active align-items-center" id="tab1" role="tabpanel">
                <?php
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['utilisateurConnecte']) && $_SESSION['utilisateurConnecte'] === true) {
        // Afficher les jaquettes et les boutons "Ajouter un jeu" et "Éditer collection" ici
        include_once($_SERVER['DOCUMENT_ROOT'] . '/templates/collection.php');
    } else {
        // Afficher un message ou rediriger vers la page de connexion
        echo "<p>Vous devez être connecté pour voir votre collection.</p>";
    }
    ?>
                </div>
                <div class="tab-pane fade" id="tab2" role="tabpanel">
                    <h2>Onglet 2</h2>
                    <p class="desc-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia culpa molestiae magnam deleniti inventore impedit neque odit labore magni
                        assumenda, repellat, commodi sint ullam perspiciatis! Animi quibusdam quaerat in voluptate?
                    </p>
                </div>
                <div class="tab-pane fade" id="tab3" role="tabpanel">
                    <h2>Onglet 3</h2>
                    <p class="desc-text">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, aliquid nemo placeat alias, quo numquam voluptates quas similique
                        voluptatum omnis minus est quibusdam velit culpa distinctio iure possimus perspiciatis? Asperiores.
                    </p>
                </div>
                <!-- Nouveaux onglets -->
                <div class="tab-pane fade" id="tab4" role="tabpanel">
                    <h2>Inscription</h2>
                    <p class="desc-text">
                        Veuillez remplir ce formulaire pour pouvoir vous inscrire sur le site!
                    </p>
                    <?php include_once($_SERVER['DOCUMENT_ROOT'] .'/templates/register.php'); ?>
                </div>
                <div class="tab-pane fade" id="tab5" role="tabpanel">
                    <h2>Connexion</h2>
                    <p class="desc-text">
                        <?php include_once($_SERVER['DOCUMENT_ROOT'] .'/templates/formulaire_connexion.php'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion des fichiers JavaScript Bootstrap (jQuery requis) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>
    <script src="/js/app.js"></script>
    <script>
document.getElementById("btnDeconnexion").addEventListener("click", function() {
    // Envoyer une demande au serveur pour détruire la session
    fetch("../inc/deconnexion.php", {
        method: "POST", // Vous pouvez également utiliser la méthode GET
    })
    .then(response => {
        if (response.ok) {
            // Rediriger l'utilisateur vers la page d'accueil ou une autre page après la déconnexion
            window.location.href = "index.php"; // Remplacez "index.php" par l'URL de votre choix
        } else {
            // Gérer les erreurs éventuelles
            console.error("La déconnexion a échoué.");
        }
    })
    .catch(error => {
        console.error("Erreur lors de la déconnexion : " + error);
    });
});
</script>
</body>
</html>
