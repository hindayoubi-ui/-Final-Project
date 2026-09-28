<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    #products.show {
        display: block !important;
        height: auto !important;
    }
</style>








<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">

    <ul class="nav">

        <!-- Admin Profile -->
        <li class="nav-item nav-profile">

            <a href="#" class="nav-link">

                <div class="nav-profile-text d-flex flex-column">

                    <span class="font-weight-bold mb-2">
                        <?php echo htmlspecialchars($_SESSION['usersname']); ?>
                    </span>

                    <span class="text-secondary text-small">
                        Store Manager
                    </span>

                </div>

                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>

            </a>

        </li>


        <!-- Dashboard -->
        <li class="nav-item">

            <a class="nav-link" href="/HA-homestore/Admin/template/dist/index.php">

                <span class="menu-title">
                    Dashboard
                </span>

                <i class="mdi mdi-home menu-icon"></i>

            </a>

        </li>
        <!-- Home Page -->
        <li class="nav-item">

            <a class="nav-link"
                data-toggle="collapse"
                href="#homeMenu"
                aria-expanded="false"
                aria-controls="homeMenu"
                onclick="$('#homeMenu').collapse('toggle'); return false;">

                <span class="menu-title">Home</span>
                <i class="menu-arrow"></i>
                <i class="bi bi-house-heart menu-icon"></i>

            </a>

            <div class="collapse" id="homeMenu">

                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_hero.php">
                            Hero / Carousel
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/home_intro.php">
                            Home Intro
                        </a>
                    </li>

                </ul>

            </div>

        </li>



        <!-- Products -->
        <li class="nav-item">

            <a class="nav-link"
                href="#products"
                data-toggle="collapse"
                aria-expanded="false"
                aria-controls="products"
                onclick="$('#products').collapse('toggle'); return false;">

                <span class="menu-title">
                    Products
                </span>

                <i class="menu-arrow"></i>

                <i class="bi bi-bag menu-icon"></i>

            </a>


            <!-- Products Sub Menu -->
            <div class="collapse" id="products">

                <ul class="nav flex-column sub-menu">

                    <!-- Admin Products CRUD -->
                    <li class="nav-item">

                        <a class="nav-link"
                            href="/HA-homestore/Admin/products.php">

                            Products CRUD

                        </a>

                    </li>


                    <!-- Admin Categories CRUD -->
                    <li class="nav-item">

                        <a class="nav-link"
                            href="/HA-homestore/Admin/categories.php">

                            Categories

                        </a>

                    </li>


                    <!-- Admin Kitchen Management -->
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_kitchen.php"
                            onclick="event.stopImmediatePropagation();">
                            Kitchen
                        </a>
                    </li>


                    <!-- Admin Furniture Management -->
                    <li class="nav-item">

                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_furniture.php">

                            Furniture

                        </a>

                    </li>


                    <!-- Client Products -->
                    <li class="nav-item">

                        <a class="nav-link"
                            href="/HA-homestore/Client/products.php">

                            Client Products

                        </a>

                    </li>

                </ul>

            </div>

        </li>

        <!-- Users -->

        <li class="nav-item">

            <a class="nav-link"
                href="/HA-homestore/Admin/users.php">

                <span class="menu-title">
                    Users
                </span>

                <i class="bi bi-people menu-icon"></i>

            </a>

        </li>





        <!-- Add Background -->


        <li class="nav-item">

            <a class="nav-link"
                href="/HA-homestore/Admin/add_background.php">

                <span class="menu-title">
                    Add Background
                </span>

                <i class="menu-arrow"></i>

                <i class="bi bi-image menu-icon"></i>

            </a>

            <ul class="nav flex-column sub-menu">

                <!-- Background -->

                <li class="nav-item">

                    <a class="nav-link"
                        href="/HA-homestore/Admin/admin_backgrounds.php">

                        Background

                    </a>

                </li>

            </ul>

        </li>





        <!-- pages -->
        <li class="nav-item">

            <a class="nav-link"
                data-toggle="collapse"
                href="#pagesMenu"
                aria-expanded="false"
                aria-controls="pagesMenu"
                onclick="$('#pagesMenu').collapse('toggle'); return false;">

                <span class="menu-title">Pages</span>
                <i class="menu-arrow"></i>
                <i class="bi bi-file-earmark-text menu-icon"></i>

            </a>

            <div class="collapse" id="pagesMenu">

                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_kitchen_page.php">
                            Kitchen Page
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_furniture_page.php">
                            Furniture Page
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link"
                            href="/HA-homestore/Admin/admin_about.php">
                            About Page
                        </a>
                    </li>

                </ul>
            </div>

        </li>




        <!-- Contact -->
        <!-- <li class="nav-item"> -->

        <!-- /<a class="nav-link" -->
        <!-- href="../Client/contact.php"> -->

        <!-- <span class="menu-title"> Contact </span> -->


        <!-- <i class="bi bi-envelope menu-icon"></i> -->

        <!-- </a> -->

        <!-- </li> -->

        <!-- contact message -->
        <li class="nav-item">
            <a class="nav-link" href="/HA-homestore/Admin/admin_contact.php">
                <span class="menu-title">Contact Messages</span>
                <i class="mdi mdi-email-outline menu-icon"></i>
            </a>
        </li>


        <!-- Cart -->
        <li class="nav-item">

            <a class="nav-link"
                href="../Client/cart.php">

                <span class="menu-title">
                    Cart
                </span>

                <i class="bi bi-cart menu-icon"></i>

            </a>

        </li>

        <!-- orders -->
        <li class="nav-item">
            <a class="nav-link"
                href="/HA-homestore/Admin/admin_orders.php">

                <span class="menu-title">Orders</span>

                <i class="mdi mdi-cart-outline menu-icon"></i>

            </a>
        </li>


        <!-- Logout -->
        <li class="nav-item">

            <a class="nav-link"
                href="/HA-homestore/Admin/logout.php">

                <span class="menu-title">
                    Logout
                </span>

                <i class="bi bi-box-arrow-right menu-icon"></i>

            </a>

        </li>


    </ul>

    </ul>

</nav>