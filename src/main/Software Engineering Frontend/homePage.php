<html lang="en">
<head>
	<!-- I think bootsteap requires these-->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--CSS-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    	<!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--Bootstrap stuff-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<title>Course Eval Explorer</title>
</head>
<?php
include('home.php');
?>
<body>
<h1>Course Evaluation Explorer</h1>

<!-- comparison table -->
<table id="courseTable">
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
<tbody id="courseTableBody">
</tbody>
</table>
<button type="button" id="addNewClass" class="btn btn-primary" onclick="addClass()">Expand list</button>
<div id="hideTable">
	<input type="test" id="searchbar" placeholder="Search for a class or professor" onchange="searchFunction()">
	<ul class="list-group" id="allClassList">
		<!--populated in JS-->
	</ul>
</div>


<!--JS-->

<!--<script src="home2.js"></script>-->
</body>
</html>
<<<<<<< HEAD:src/main/Software Engineering Frontend/homePage.php
=======

>>>>>>> 20c2eaf8097f44a7bb0edb2ab10bdebdb9401dfe:src/main/Software Engineering Frontend/homePage.php
