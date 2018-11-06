<?php
include "../inc/dbinfo.inc";
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <!-- I think bootsteap requires these-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS-->
    <!--Bootstrap stuff-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <! -- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Course Eval Explorer</title>
</head>


<body id="mainPage" data-spy="scroll" data-target=".navbar">

<?php

        function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
          }

        //start session so we can keep track of session variables
        session_start();
        
        /* Connect to MySQL and select the database. */
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        
        if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

        $db = mysqli_select_db($connection, DB_DATABASE);

        //Source for login stuff: https://www.tutorialspoint.com/php/php_mysql_login.htm
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // username and password sent from form 
            //if it's a login
            if (isset($_POST['loginName']) && strlen($_POST['loginName'])) {
                $isLogin = true;
                $myusername = mysqli_real_escape_string($connection,$_POST['loginName']);
                $mypassword = mysqli_real_escape_string($connection,$_POST['loginPassword']); 
            }
            //if it's a create account
            elseif (isset($_POST['createName']) && strlen($_POST['createName'])){
                $isLogin = false;
                $myusername = htmlentities($_POST['createName']);
                $mypassword = htmlentities($_POST['createPassword']); 
                $dontAct = false;
            }

            else {
                $isLogin = false;
                //don't do anything b/c user isn't submitting a form
                $dontAct = true;   
            }
            
            if ($isLogin==true) {
                $sql = "SELECT * FROM users WHERE username = '$myusername' and passcode = '$mypassword'";
                $result = mysqli_query($connection,$sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
                $count = mysqli_num_rows($result);
            
                // If result matched $myusername and $mypassword, table row must be 1 row
                if($count == 1) {
                    #session_register("myusername");
                    $_SESSION['login_user'] = $myusername;
                    header("location: ../Software Engineering Frontend/homePage.php");
                }
                else {
                    $error = "Your Login Name or Password is invalid";
                }
            }
            //create a new account
            elseif($dontAct==false)  {
                    $sql = "SELECT * FROM users WHERE username = '$myusername'";
                    $result = mysqli_query($connection,$sql);
                    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            
                    $count = mysqli_num_rows($result);
            
                // if this already exists don't accept it
                    if($count != 0) {
                        $error = "Create name already exists -- choose another";
                    }
                    else {
                        register($connection, $myusername, $mypassword);
                    }
            }
        }
?>

    <!-- Navbar for website -> People can navigate with this and 
        see which part of the site they're at -->

    <nav class="navbar navbar-expand-lg fixed-top mb-5" id="mainNav">
        <a class="navbar-brand" href="#main"><strong>WU Reviews</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>


        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link mr-4" href="#ourMission">Our Mission<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-4" href="#createAccount">Create An Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-1" href="#logIn">Log In</a>
                </li>
            </ul>
        </div>


    </nav>

    <!-- Section 1: WU Reviews -->

    <div class="container-fluid d-flex flex-column h-100 mt-5" id="main">

        <!-- Header title -->
        <div class="row mb-5 mt-5">
            <div class="col d-flex flex-column flex-grow">
                <h1 class="display-4" id="mainPageHeading">
                    Tired of struggling to access course reviews? </br>
                    There's a better way
                </h1>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-3"></div>
            <div class="col-6">
                <a href='#ourMission' role="button" class="btn w-100 h-100 btn-circle">
                    <h2 class="display-3 btnCenter">
                        Learn More
                    </h2>
                </a>
            </div>
            <div class="col-3"></div>
        </div>

    </div>


    <!-- Section 2: Our Mission -->

    <div class="container-fluid d-flex flex-column h-100" id="ourMission">

        <!-- Spacing -->
        <div class="row mb-5"></div>

        <div class="row my-5">
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" id="ourFace" src="images/elanCropped2.jpg" alt="Elan" width="200em" height="200em">
            </div>
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" id="ourFace" src="images/sarahCropped.jpg" alt="Sarah" width="200em" height="200em">
            </div>
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" id="ourFace" src="images/evanCropped.jpg" alt="Evan" width="200em" height="200em">
            </div>
        </div>

        <div class="row mb-5 justify-content-center align-self-center">

            <div class="col-8 d-flex flex-column flex-grow p-2" id="studLife">
                <div class="jumbotron-fluid" id="ourMissionJumbotron">
                    <h1 class="display-4" id="shrinkCurrentFirst">We believe in course transparency <i class="fas fa-book-reader" style="margin-left:.5em;"></i></h1>
                    <p class="lead" id="whoWeAre">
                        Hi, We're Elan, Sarah and Evan. After spending countless hours over our time at WashU trying to parse course information,
                        we decided that a simpler site is in order. We created this site in the hopes that students will
                        have an easier time learning about and choosing their courses.
                    </p>
                    <hr class="my-4">
                    <p id="courseSteps">
                        Simply <strong>create</strong> an account, <strong>login</strong>, <strong>search</strong> for courses
                        by title or professor, and <strong>save</strong> a list of courses you're interested in.
                    </p>
                    <a href='#createAccount' role="button" class="btn w-100 h-100 btn-circle" style="border-radius: 0% !important;">
                        <div class="display-4" id="firstCreateAccount">
                            Create An Account
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>




    <div class="container-fluid d-flex flex-column h-100" id="createAccount">

        <div class="row mt-5 justify-content-center align-self-center">

            <div class="col d-flex flex-column flex-grow p-2">

                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Create An Account</h5>
                        <form action="index.php" class="form-signin" method="post">
                            <div class="form-label-group">
                                <input type="email" name="createName" id="inputEmail" class="form-control" placeholder="Email address" required>
                                <label class="text-center" for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="text" name="createPassword" id="inputPassword" class="form-control" placeholder="Password" required>
                                <label class="text-center" for="inputPassword">Password</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" id="createAccountBtn" type="submit">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            

        </div>


    </div>





    <div class="container-fluid d-flex flex-column h-100" id="logIn">
        <div class="row mt-5 justify-content-center align-self-center">
            <div class="col d-flex flex-column flex-grow p-2">

                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Log In</h5>
                        <form action="index.php" class="form-signin" method="post">
                            <div class="form-label-group">
                                <input type="email" name="loginName" id="loginEmail" class="form-control" placeholder="Email address" required>
                                <label class="text-center" for="loginEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="text" name="loginPassword" id="loginPassword" class="form-control" placeholder="Password" required>
                                <label class="text-center" for="loginPassword">Password</label>
                            </div>

                            <button class="btn btn-lg btn-primary btn-block text-uppercase" id="loginBtn" type="submit">Log in</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <script type="text/javascript" src="js/jsStyles.js"></script>

</body>

</html>


<?php
function register($connection, $name, $password) {

    $n = mysqli_real_escape_string($connection, $name);
    $a = mysqli_real_escape_string($connection, $password);
 
    $query = "INSERT INTO `users` (`username`, `passcode`) VALUES ('$n', '$a');";
 
    if(!mysqli_query($connection, $query)){
        //echo("<h1>Error adding employee data.</h1>");
        console_log($n);
        console_log($a);
    } 
    else {
        $_SESSION['login_user'] = $n;
        header("location: ../Software Engineering Frontend/homePage.php");
    }
 }
?>
