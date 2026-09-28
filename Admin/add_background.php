<?php
session_start();

include("../conn.php");



?>

<?php include(__DIR__ . "/template/common/head2.php"); ?>

<body>

<div class="container-scroller">

    <?php include(__DIR__ . "/template/common/navbar.php"); ?>

    <div class="container-fluid page-body-wrapper">

        <?php include(__DIR__ . "/template/common/sidebar.php"); ?>

        <div class="main-panel">

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-md-8 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <h4 class="card-title">
                                    Add  Background Image
                                </h4>

                                <p class="card-description">
                                    Add a seasonal or other background.
                                </p>


                                <form action="save_background.php"
                                      method="POST"
                                      enctype="multipart/form-data">


                                    <!-- Occasion -->

                                    <div class="form-group">

                                        <label>
                                            Choose Occasion
                                        </label>

                                        <div class="mt-2">


                                            <!-- Fall Season -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Fall Season"
                                                       id="fall"
                                                       required>

                                                <label class="form-check-label"
                                                       for="fall">

                                                    Fall Season

                                                </label>

                                            </div>


                                            <!-- Winter Season -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Winter Season"
                                                       id="winter">

                                                <label class="form-check-label"
                                                       for="winter">

                                                    Winter Season

                                                </label>

                                            </div>


                                            <!-- Spring Season -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Spring Season"
                                                       id="spring">

                                                <label class="form-check-label"
                                                       for="spring">

                                                    Spring Season

                                                </label>

                                            </div>


                                            <!-- Summer Season -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Summer Season"
                                                       id="summer">

                                                <label class="form-check-label"
                                                       for="summer">

                                                    Summer Season

                                                </label>

                                            </div>


                                            <!-- Ramadan -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Ramadan"
                                                       id="ramadan">

                                                <label class="form-check-label"
                                                       for="ramadan">

                                                    Ramadan

                                                </label>

                                            </div>


                                            <!-- Others -->

                                            <div class="form-check">

                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="occasion"
                                                       value="Others"
                                                       id="others">

                                                <label class="form-check-label"
                                                       for="others">

                                                    Others

                                                </label>

                                            </div>


                                        </div>

                                    </div>


                                    <!-- Background Image -->

                                    <div class="form-group">

                                        <label>
                                            Background Image
                                        </label>

                                        <input type="file"
                                               name="background_image"
                                               class="form-control"
                                               accept=".jpg,.jpeg,.png,.webp"
                                               required>

                                    </div>


                                    <!-- Add Button -->

                                    <button type="submit"
                                            class="btn btn-warning">

                                        Add Background

                                    </button>


                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <?php include(__DIR__ . "/template/common/footer.php"); ?>

        </div>

    </div>

</div>


<?php include(__DIR__ . "/template/common/script.php"); ?>

</body>

</html>