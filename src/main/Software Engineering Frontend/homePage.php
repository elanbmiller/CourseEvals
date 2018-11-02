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
   <div class="row">
      <div class="col text-center">
         <h1 class="text-primary">Course Evaluation Explorer</h1>
      </div>
   </div>
   <div class="row">
      <div class="col my-5">
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
            <tbody id="courseTableBody"></tbody>
         </table>
      </div>
   </div>
   <div class="row">
       <div class="col text-center mb-5">
           <button type="button" id="addNewClass" class="btn btn-primary" onclick="addClass()">Expand list</button>
        </div>
    </div>
    <div class="row">
        <div id="hideTable" class="text-center">
           <div class="col-6 text-center">
               <div class="row text-center">
                   <input type="test" class="mb-3" id="searchbar" placeholder="Search for a class or professor" onchange="searchFunction()">
                </div>
            </div>
            <div class="col-6 text-center">
                <div class="row text-center">
                    <ul class="list-group mb-3" id="allClassList"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


