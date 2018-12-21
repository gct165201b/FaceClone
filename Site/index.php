<?php
    require 'includes/func.inc.php';
    get_header("Login");
?>



    <!-- Navigation -->
    <?php
        include_once 'includes/navbar.inc.php';
    ?>


    <div class="container-fluid">
        <div class="text-center">
            <h2 class="mt-12vh">Welcome To FaceClone!</h2>
            <h4><small class="text-secondary">A simple Facebook clone.</small></h4>
        </div>




        <!-- Two Forms for Signing in and Registration. -->


        <div class="row p-4">

            <!-- Coloumn for Sign in form -->
            <div class="col-lg-6">

                <h5>Login to start enjoying unlimited fun!</h5>


                <form action="">

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username">
                    </div>

                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="input-group pt-3">
                        <button class="btn login-btn">Login</button>
                    </div>


                </form>

            </div>



            <!-- Coloumn For Registration Form -->


            <div class="col-lg-6">

                <?php signup_status(); ?>

                <h5>Don't have an account yet? Register!</h5>



                <form action="includes/processes/signup.inc.php" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="location" placeholder="Location">
                    </div>

                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="input-group pt-3">
                        <button type="submit" name="signup" class="btn btn-success">Register</button>
                    </div>


                </form>





            </div>




        </div>

        <small class="float-right pr-4">FaceClone - Made by M.Umar</small>
    </div>




    <?php
        include_once 'includes/footer.inc.php';
    ?>
