<?php
    require 'includes/func.inc.php';
    pageHeader("Home");
?>
<body>
    

    <!-- Navigation -->
    <?php
        include_once 'includes/navbar.inc.php';
    ?>


    <div class="container-fluid">
        <div class="text-center">
            <h2 class="wlcm-heading">Welcome To FaceClone!</h2>
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

                <h5>Don't have an account yet? Register!</h5>



                <form action="">

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Location">
                    </div>

                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="input-group pt-3">
                        <button class="btn btn-success">Login</button>
                    </div>


                </form>



                

            </div>

            
            

        </div>

        <small class="float-right pr-4">FaceClone - Made by M.Umar</small>
    </div>
    
    




    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>