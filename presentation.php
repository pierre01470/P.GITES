<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/Blason73-Savoie.svg/164px-Blason73-Savoie.svg.png">
    <title>Projet gîte</title>
</head>

<body>
    <div id="popup"></div>
    <header>
        <section class="content">


            <form action="#" method="post">
                <div class="formReach">

                    <label class="case" for="place">Destination:</label>
                    <input type="text" id="place" name="place">
                    <label class="case" for="arrive">Arrivée:</label>
                    <input type="date" id="start" name="start">
                    <label class="case" for="departure">Départ:</label>
                    <input type="date" id="leave" name="leave">
                    <div class="button">
                        <a class="neon" href="#">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <button type="submit">Rechercher</button>
                    </div>
                </div>
            </form>
        </section>
    </header>
    <main>
        <?php
        require_once "connect.php";
        require_once "classes/LodgeManager.php";
        require_once "classes/class.lodge.php";

        /* ---------------------- RECUPERATION LISTE DONNEE BDD --------------------- */
        $manager = new LodgeManager($db);
        $lodge = $manager->getListid(57);//a recuperer plus tard en get
        ?>
        <section class="produit">
            <div class="affiche">
                <h3><?= $lodge->getLodgename(); ?></h3>
                <div class="display-container"></div>
                <div class="central">
                    <?php
                    //BOUCLE SLIDER
                    foreach (unserialize($lodge->getImage()) as $image) {
                        echo '<img class="mySlides" src="' . $image . '" alt="" width="500px" height="350px">';
                    } ?>
                
                <div class="w3-center">
                    <div class="w3-section">
                        <button class="w3-button w3-light-grey" onclick="plusDivs(-1)">❮ Prev</button>
                        <button class="w3-button w3-light-grey" onclick="plusDivs(1)">Next ❯</button>
                    </div>
                    <button class="w3-button demo" onclick="currentDiv(1)">1</button>
                    <button class="w3-button demo" onclick="currentDiv(2)">2</button>
                    <button class="w3-button demo" onclick="currentDiv(3)">3</button>
                    <button class="w3-button demo" onclick="currentDiv(4)">4</button>
                </div>
            </div>
                </div>

            <div class="reservation">
                <a class="price">Prix:<?php
                                        $calculprice = $lodge->getPrice() * 7;
                                        echo $lodge->getPrice() . '€/ jours<br>';
                                        echo $calculprice . '€/ semaine'; ?></a>
                <div class="calendrier"><img src="https://jcchauvel.files.wordpress.com/2017/03/calendrier-ouvert.png"></div>
                <div class="form-reservation">
                    <form action="" method="post">
                        <div>
                            <label class="case-rese" for="arrival">Arrivée:</label>
                            <input type="date" name="arrival" id="start">
                        </div>
                        <div>
                            <label class="case-rese" for="departure">Départ:</label>
                            <input type="date" name="departure" id="leave">
                        </div>
                        <div>
                            <label class="case-rese" for="firstname">Prénom:</label>
                            <input type="text" name="firstname" id="prenom">
                        </div>
                        <div>
                            <label class="case-rese" for="lastname">Nom</label>
                            <input type="text" name="lastname" id="nom">
                        </div>
                        <div class="resEmail">
                            <label class="case-rese" for="email">E-Mail</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="button">
                            <a class="neon" href="#">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <button id="bookingBtn" name="bookingBtn" type="submit">Reserver</button>
                        </div>
                        <?php
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $finaleprice = 'nbrjour reserver * prix journalier';
                        $nomdugite = '<?= $lodge->getLodgename(); ?>';
                        $send = "Bonjour $firstname $lastname vous vous appretez à reserver le gite $nomdugite pour un prix de $finaleprice";

                        $dest = $email;
                        $sujet = "Reservation Gite !";
                        $message = $send;
                        $header = "From: $dest";
                        mail($dest, $sujet, $message, $header);
                        ?>
                    </form>
                </div>
            </div>

        </section>
        <section class="description">
            <h2>Description:</h2>
            <div class="listDescri">
                <ul>
                    <li>Nom: <?= $lodge->getLodgename(); ?></li>
                    <li>Localisation: <?= $lodge->getLocation(); ?></li>
                    <li>Nombre de couchage: <?= $lodge->getBedroom(); ?></li>
                    <li>Nombre de sallle de bain: <?= $lodge->getBathroom(); ?></li>
                    <li> Prix: <?= $lodge->getPrice(); ?> Euros</li>
                    <li>Disponibilité: </li>
                </ul>
            </div>
            <script>
                var slideIndex = 1;
                showDivs(slideIndex);

                function plusDivs(n) {
                    showDivs(slideIndex += n);
                }

                function currentDiv(n) {
                    showDivs(slideIndex = n);
                }

                function showDivs(n) {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("demo");
                    if (n > x.length) {
                        slideIndex = 1
                    }
                    if (n < 1) {
                        slideIndex = x.length
                    }
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" w3-red", "");
                    }
                    x[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " w3-red";
                }
                var myIndex = 0;
                carousel();

                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    myIndex++;
                    if (myIndex > x.length) {
                        myIndex = 1
                    }
                    x[myIndex - 1].style.display = "block";
                    setTimeout(carousel, 6000);
                }
            </script>

        </section>
    </main>
    <footer>
        <div>Réseaux</div>
        <div>Copyright</div>
        <div>Contact</div>
    </footer>
</body>

</html>