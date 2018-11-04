<!DOCTYPE html>
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
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Course Eval Explorer</title>
</head>


<body id="mainPage" data-spy="scroll" data-target=".navbar">

    <nav class="navbar navbar-expand-lg fixed-top mb-5" id="mainNav">
        <a class="navbar-brand" href="#"><strong>WU Reviews</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Our Mission<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="#">Log In</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Create An Account</a>
                </li>
            </ul>
        </div>


    </nav>

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
                <a href='#backgroundImgProspective' role="button" class="btn w-100 h-100 btn-circle">
                        <h2 class="display-3 btnCenter">
                            Learn More
                        </h2>
                    </a>
            </div>
            <div class="col-3"></div>
        </div>

    </div>



    <div class="container-fluid d-flex flex-column h-100" id="backgroundImgProspective">

        <!-- Header title -->
        <!-- <div class="row">
            <div class="col">
                <div class="text-center mt-4 mb-3" id="wustlHeading">
                    <h2 class="display-4 text-capitalize" id="wustlHeadingLink">
                        make your mark
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" src="images/prospective1.jpg" alt="Student" width="300em" height="300em">
                <blockquote class="blockquote testimonial">
                    As a Harris Fellow, I participated in The Hague Academy Summer Program!
                </blockquote>
            </div>
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" src="images/prospective2.jpg" alt="Student 2" width="300em" height="300em">
                <blockquote class="blockquote testimonial">
                    This law school has given me unbelievable opportunities!

                </blockquote>
            </div>
            <div class="col-4 text-center">
                <img class="img-fluid rounded-circle" src="images/prospective3.jpg" alt="Student 3" width="300em" height="300em">
                <blockquote class="blockquote testimonial">
                    For my intern training, I learned about banking from a real banker!
                </blockquote>
            </div>
        </div> -->


        <div class="row flex-grow">
            <!-- <div class="col-4 text-center justify-content-center align-self-center">
                <h3>
                    <a href='#' role="button" class="btn btn-outline-light" id="btnApply">
                                    <strong class="display-3 videoDisplay">Videos</strong>
                            </a>
                </h3>
            </div>
            <div class="col-4 text-center justify-content-center align-self-center">
                <h3>
                    <a href='#' role="button" class="btn btn-outline-light" id="btnApply">
                                <strong class="display-3 videoDisplay">Apply Now</strong>
                        </a>
                </h3>
            </div>
            <div class="col-4 text-center justify-content-center align-self-center">
                <h3>
                    <a href='#' role="button" class="btn btn-outline-light" id="btnApply">
                                <strong class="display-3 videoDisplay">Learn More</strong>
                        </a>
                </h3>
            </div> -->
        </div>
    </div>






    <div class="container-fluid d-flex flex-column h-100" id="backgroundImgCurrent">

        <!-- Header title -->
        <div class="row mb-5 justify-content-center align-self-center">

            <div class="col d-flex flex-column flex-grow">
                <!-- <div class="text-center mt-4 mb-3" id="wustlHeading">
                    <h2 class="display-4 text-capitalize" id="wustlHeadingLink">
                        student life
                    </h2>
                </div> -->
            </div>
        </div>

        <div class="row mb-5 justify-content-center align-self-center">

            <div class="col-8 d-flex flex-column flex-grow p-2" id="studLife">
                <!-- <div class="jumbotron-fluid">
                    <h1 class="display-4" id="shrinkCurrentFirst">We have incredible student life</h1>
                    <p class="lead"  id="shrinkCurrent">
                        Students come from throughout the United States and around the world to pursue their legal studies at Washington University
                        School of Law. Each year, Washington University has over 750 students enrolled in its J.D., post-J.D.,
                        and joint degree programs.
                    </p>
                    <hr class="my-4">
                    <p id="shrinkCurrent">
                        The School of Law provides many different services to support students in their academic and professional endeavors
                        <a href='#' class="text-muted calendarP"> 
                                        ...
                                    </a>
                    </p>
                    <a href='#' role="button" class="btn w-100 h-100 btn-circle" style="border-radius: 0% !important;">
                        <div class="display-4" id="shrinkCurrent">
                            Resources
                        </div>
                    </a>
                </div> -->
            </div>
        </div>

    </div>




    <div class="container-fluid d-flex flex-column h-100" id="backgroundImgFaculty">

        <!-- Header title -->
        <!-- <div class="row">
            <div class="col">
                <div class="text-center mt-4 mb-3" id="wustlHeading">
                    <h2 class="display-4 text-capitalize" id="wustlHeadingLink">
                        Faculty
                    </h2>
                </div>
            </div>
        </div> -->

        <div class="row mb-5 justify-content-center align-self-center">

            <div class="col d-flex flex-column flex-grow p-2" id="studLife">
                <!-- <div class="jumbotron-fluid">
                    <h1 class="display-4" id="shrinkCurrentFirst">Looking for resources?</h1>
                    <p class="lead" id="shrinkCurrent">
                        Among Washington University School of Law's greatest strengths is its faculty. They are nationally and internationally recognized
                        experts
                        <a href='#' class="text-muted calendarP"> 
                                                    ...
                                            </a>
                    </p>
                    <hr class="my-4">
                    <p id="shrinkCurrent">
                        Find any faculty related resouces, such as directories and services, right here.
                    </p>
                </div> -->
            </div>
        </div>

        <!-- 
        <table class="table table-responsive mt-5" id="shrinkCurrent">
            <thead>
                <tr>
                    <th scope="col">About the Faculty</th>
                    <th scope="col">Faculty Services</th>
                    <th scope="col">Faculty Directory</th>
                    <th scope="col">Dean's Distinguished Scholars in Residence</th>
                    <th scope="col">Tributes</th>
                    <th scope="col">Speaker Series</th>
                    <th scope="col">Scholarly Events</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href='#'>Faculty Scholarship</a></td>
                    <td><a href='#'>Faculty Services</a></td>
                    <td><a href='#'>Deans</a></td>
                    <td><a href='#'>2016-2017 Scholars</a></td>
                    <td><a href='#'>Neil Bernstein Tribute</a></td>
                    <td><a href='#'>Harris World Law Institute</a></td>
                    <td><a href='#'>Faculty Workshops</a></td>
                </tr>
                <tr>
                    <td colspan="2"><a href='#'>In the News</a></td>
                    <td><a href='#'>Resident and Visiting Faculty</a></td>
                    <td><a href='#'>2015-2016 Scholars</a></td>
                    <td><a href='#'>Kathleen Brickey Tribute</a></td>
                    <td><a href='#'>LIC Speaker Series</a></td>
                    <td><a href='#'>Conferences, Symposiums and Workshops</a></td>
                </tr>
                <tr>
                    <td colspan="2"><a href='#'>Video Collection</a></td>
                    <td colspan="3"><a href='#'>Emeritus Faculty</a></td>
                    <td><a href='#'>Public Interest Law and Policy Speakers</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3"><a href='#'>Adjunct Faculty</a></td>
                    <td colspan="2"><a href='#'>Tyrrell Williams Lecture Series</a></td>
                </tr>
            </tbody>
        </table> -->

    </div>





    <div class="container-fluid d-flex flex-column h-100" id="backgroundImgAlumni">
        <!-- Header title -->
        <div class="row mb-5 justify-content-center align-self-center">
            <div class="col d-flex flex-column flex-grow">
                <!-- <div class="text-center mt-4 mb-3" id="wustlHeading">
                    <h2 class="display-4 text-capitalize" id="wustlHeadingLink">
                        Alumni
                    </h2>
                </div> -->
            </div>
        </div>

        <div class="row mb-5 justify-content-center align-self-center">

            <div class="col-8 d-flex flex-column flex-grow p-2" id="studLife">
                <!-- <div class="jumbotron-fluid">
                    <h1 class="display-4" id="shrinkCurrentFirst">We <i class="fas fa-heart"></i> our alumni</h1>
                    <p class="lead" id="shrinkCurrentWhite">
                        Our alumni are vital to our continued success. Your involvement and continued support ensures that this institution continues
                        providing quality education and resources.
                    </p>
                    <hr class="my-4">
                    <p id="shrinkCurrentWhite">
                        Stay connected and learn about ways to contribute to our success
                        <a href='#' class="text-muted calendarP"> 
                                                    ...
                                    </a>
                    </p>
                    <a href='#backgroundImgAlumni' role="button" class="btn w-100 h-100 btn-circle" style="border-radius: 0% !important;">
                        <div class="display-4" id="shrinkCurrent">
                            Get Connected
                        </div>
                    </a>
                </div> -->
            </div>
        </div>


        <div class="row flex-grow justify-content-center align-self-center">


            <div class="d-flex align-items-end flex-column" style="height: 200px;">
                <!-- <div class="mt-auto p-2 bd-highlight">
                    <a href="#">
                    <i class="fas fa-phone-square" id="shrinkCurrentIcon" style="font-size:7em; color: #8E8D8A;"></i>
                        </a>
                        <a href="#">
                            <i class="fas fa-envelope-square" id="shrinkCurrentIcon" style="font-size:7em;color: #8E8D8A;"></i>
                        </a>
                </div> -->
            </div>


        </div>

    </div>


    <script type="text/javascript" src="js/jsStyles.js"></script>

</body>

</html>