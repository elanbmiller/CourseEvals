<!DOCTYPE html>
<html lang="en">
<head>
	<!-- I think bootsteap requires these-->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS-->
    <!--Bootstrap stuff-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    <! -- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    	<!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>Course Eval Explorer</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['login_user'])){
    header("Location: index.php");
}
include "home.php";
?>

    <div class="container-fluid mt-5" id="main">
            <!-- Header title -->
            <div class="row">
                <div class="col-10">
                    <h1 class="display-4" id="loggedInHeading">
                        Add some courses!</br>
                        <small class="text-muted" style="font-size:.5em;">Then, click on any of the columns to sort</small>
                    </h1>
                </div>
                <div class="col-2 mt-5">
                        <a class="btn" id="logoutBtn" href="index.php" role="button">Logout</a>
                </div>
            </div>


            <!-- Table showing added courses -->
            <div class="row">
                <div class="col my-5">
                    <!-- comparison table -->
                    <table class="mb-2" id="courseTable">
                        <thead>
                            <th onclick="sortAddedClasses(&quot;courseTitle&quot;)">Course Title</th>
                            <th onclick="sortAddedClasses(&quot;profName&quot;)">Professor Name</th>
                            <th onclick="sortAddedClasses(&quot;syllabusAccuracy&quot;)">Syllabus Accuracy</th>
                            <th onclick="sortAddedClasses(&quot;responseCount&quot;)">Response Count</th>
                            <th onclick="sortAddedClasses(&quot;descriptionAccuracy&quot;)">Description Accuracy</th>
                            <th onclick="sortAddedClasses(&quot;profQuality&quot;)">Professor Quality</th>
                            <th onclick="sortAddedClasses(&quot;courseQuality&quot;)">Course Quality</th>
                            <th onclick="sortAddedClasses(&quot;textbook&quot;)">Textbook</th>
                            <th onclick="sortAddedClasses(&quot;worldApplication&quot;)">World Application</th>
                            <th onclick="sortAddedClasses(&quot;examRelevance&quot;)">Exam Relevance</th>
                            <th onclick="sortAddedClasses(&quot;examTime&quot;)">Exam Time</th>
                            <th onclick="sortAddedClasses(&quot;fairGrade&quot;)">Fair Grade Earned</th>
                            <th onclick="sortAddedClasses(&quot;gradeConsistent&quot;)">Grades Consistent</th>
                            <th onclick="sortAddedClasses(&quot;gradeAggregate&quot;)">Grade Aggregate</th>
                            <th></th>
                        </thead>
                        <tbody id="courseTableBody"></tbody>
                    </table>
                </div>
            </div>


        <!-- spacing -->
        <div class="row my-2"></div>

                <!-- Button to show list of courses to choose from -->
                <div class="row mb-2">
                    <div class="col text-center">
                        <button type="button" id="addNewClass" class="btn btn-primary">Add course</button>
                        <button type="button" id="addAllClasses" class="btn btn-primary">Add all</button>
                        <button type="button" id="removeAllClasses" class="btn btn-primary">Remove all</button>
                    </div>
                </div>


                <!-- Search bar -->
                <div class="row justify-content-center mt-3">
                    <div class="col-6 text-center">
                        <div id="hideTable">
                            <!-- Search form -->
                            <div class="row">
                                <div class="col-1 pt-2">
                                    <i class="fa fa-search" id="searchIcon"></i>
                                </div>
                                <div class="col-11">
                                    <input class="form-control glyphicon glyphicon-search" id="searchbar" type="text" placeholder="Search by class or professor"
                                        aria-label="Search">
                                </div>
                            </div>
                            <ul class="list-group mt-5 mb-5" id="allClassList"></ul>
                        </div>
                    </div>
                </div>


        </div>
</body>
</html>
