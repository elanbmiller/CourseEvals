<html lang="en">
<head>
	<!-- I think bootsteap requires these-->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--CSS-->
    <!--Bootstrap stuff-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css">
    	<!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<title>Course Eval Explorer</title>
</head>
<?php
include('home.php');
?>
<body>
<div class="container-fluid">
    <div class="row text-center">
    <h1 class="text-center">Course Evaluation Explorer</h1>
</div>

<div class="row">
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
</div>

<button type="button" id="addNewClass" class="btn btn-primary" onclick="addClass()">Expand list</button>
</div>


<div id="hideTable">
	<input type="test" id="searchbar" placeholder="Search for a class or professor" onchange="searchFunction()">
	<ul class="list-group" id="allClassList">
		<!--populated in JS-->
	</ul>
</div>

</div>


<!--JS-->

<!--<script src="home2.js"></script>-->
</body>
</html>


