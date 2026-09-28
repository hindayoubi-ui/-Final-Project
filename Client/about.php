<?php
include "../conn.php";

$sql = "SELECT * FROM about_page";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$about = $result->fetch_assoc();

//var_dump($about);exit;

?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HA Home Store</title>
    <link rel="stylesheet" href="bootstrap.css">
    <script src="bootstrap.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>


<body>

    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top">
        <div class="container">

            <a class="navbar-brand " href="index.php"> HA </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item  border-end">
                        <a class="nav-link " href="index.php"> Home<i class="bi bi-house-heart-fill"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="products.php"> Products <i class="bi bi-bag"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link active" href="about.php"> About <i class="bi bi-info-circle"></i></a>
                    </li>

                    <li class="nav-item  border-end">
                        <a class="nav-link" href="contact.php">Contact <i class="bi bi-envelope"></i></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="cart.php">Cart <i class="bi bi-cart"></i>
                    </li>

                </ul>

            </div>
        </div>
    </nav>



    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    </head>

    <body>

        <!-- About Us Section -->

        <section class="py-5 mt-5">

            <div class="container">

                <div class="row align-items-center g-5">

                    <!-- Image -->

                    <div class="col-lg-6">

                        <img src="images/<?php echo $about['about_image']; ?>"
                            class="img-fluid rounded-3 shadow"
                            alt="HA Home Store">

                    </div>


                    <!-- Text -->

                    <div class="col-lg-6">

                        <h2 class="fw-bold mb-4"> <?php echo htmlspecialchars($about['title']); ?> Our Story <i class="bi bi-info-circle fs-2"></i></h2>


                        <!-- English -->

                        <p class="text-muted"> <?php echo htmlspecialchars($about['english_text']); ?>

                            Welcome to HA Home Store, where comfort meets style.
                            We offer carefully selected furniture and home products
                            designed to make your home beautiful and comfortable.

                        </p>


                        <!-- Arabic  rtl right to left-->

                        <p class="text-muted" dir="rtl"><?php echo htmlspecialchars($about['arabic_text']); ?>

                            أهلاً وسهلاً بكم في HA Home Store، حيث تلتقي الراحة
                            مع الأناقة. نقدم مجموعة مختارة من الأثاث ومنتجات المنزل
                            التي تجعل منزلكم أكثر جمالاً وراحة.

                        </p>


                        <!-- French -->

                        <p class="text-muted"><?php echo htmlspecialchars($about['french_text']); ?>

                            Bienvenue chez HA Home Store, où le confort rencontre
                            le style. Nous proposons une sélection de meubles et
                            de produits pour la maison conçus pour rendre votre
                            espace plus beau et plus confortable.

                        </p>


                        <!-- Quote -->

                        <p class="fw-bold fst-italic">
                            <?php echo htmlspecialchars($about['quote_english']); ?>

                            Your home, your style.
                            <br>

                            <?php echo htmlspecialchars($about['quote_arabic']); ?>

                            منزلكم، أسلوبكم.
                            <br>
                            <?php echo htmlspecialchars($about['quote_french']); ?>

                            Votre maison, votre style.

                        </p>

                    </div>

                </div>

            </div>

        </section>

        <!-- Footer -->
        <footer class="bg-secondary text-dark  w-100 fixed-bottom">
            <div class="container-fluid text-center py-3">
                <!-- Copyright -->
                <p class="text-dark mb-0">
                    &copy; 2026 HA Home Store. All rights reserved.
                </p>

                <i class="bi bi-calendar3"></i>
                <span id="footerdate"></span>

                <span class="mx-2">|</span>

                <i class="bi bi-clock"></i>
                <span id="footertime"></span>

            </div>
        </footer>
        <!-- JavaScript <script> → بيجيب الوقت الحالي وبيحدّثه كل ثانية. krml hek hatet script -->
        <script>
            function updateDateTime() {
                const now = new Date();

                document.getElementById("footerdate").textContent =
                    now.toLocaleDateString();

                document.getElementById("footertime").textContent =
                    now.toLocaleTimeString();

                // toLocaleString() بتعطي التاريخ + الوقت مع بعض.
            }

            updateDateTime();
            setInterval(updateDateTime, 1000);
        </script>















    </body>

</html>