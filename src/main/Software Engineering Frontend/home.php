<?php
	include "../inc/dbinfo.inc";

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /*
Print data to console
*/
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }


  /*
Returns all rows in the database
*/

function getAllRows ($connection) {
    $allRowData = array();
    $result = mysqli_query($connection, "SELECT * FROM courses"); 
    while($query_data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $allRowData[] = $query_data;
    }
    return $allRowData;
}
  
  $allRowData = getAllRows($connection);
  $JSAllRowData = json_encode($allRowData);

  mysqli_close($connection);



?>

<script type="text/javascript">

var AllRowData_JS = <?php echo $JSAllRowData; ?>;

var addedCourseList = [];
var allCourseList = [];

var courseObjectIdOrder = ["courseTitle", "profName", "syllabusAccuracy", "responseCount", "descriptionAccuracy", "profQuality", "courseQuality", "textBook", "worldApplication", "examRelevance", "examTime", "fairGrade", "gradeConsistent", "gradeAggregate"];
//this is to make loops work easier, just an array of the row column id's
//will have to be updated when we add more data
//used in populateMainView()


$(document).ready(function(){
	getCourseData();
	populateMainView();
});

//in these, id has to be the unique identifier
//will need to change first when we get the database involved
function getCourseData() {
	
	//push all row objects to array
	for (i = 0; i < AllRowData_JS.length; i++) {
		allCourseList.push(AllRowData_JS[i]);
	}
}


/* adds courses from addedCourseList to the main view*/
function populateMainView() {
	emptyAddedCourseListInView();
	//sortAddedClasses("profRating");
	var t = $('#courseTableBody');
	for (i=0; i < addedCourseList.length; i++) { //loop through added courses
		var tableRow = "<tr>";
		for (j=0; j < courseObjectIdOrder.length; j++) { //add data points to new td
			tableRow += "<td>" + addedCourseList[i][courseObjectIdOrder[j]] + "</td>";
		}

	//add the remove button
	tableRow += "<td> <button onclick=\"removeAddedCourse(" + addedCourseList[i]["courseTitle"] + ")\">remove</button> </td>" //course title is acting as unique id here


	tableRow += "</tr>"
	t.append(tableRow);
	}

}

/*called by add class button*/
function addClass() {
	var addClass = $('#addNewClass'); //button
	//making this function as a toggle
	if ($(addClass).html() == "Hide list") {  //hide list
		$(addClass).html("Expand list");
		document.getElementById("hideTable").style.display = "none";
	} else { //show classes to add
		emptyAllCourseList();
		document.getElementById("hideTable").style.display = "block";
		$(addClass).html("Hide list");
		for(i=0; i < allCourseList.length; i++) {
			//create list item
			let newItem = "<li class=\"list-group-item\" onclick=\"addClassToList(" + allCourseList[i][courseObjectIdOrder[0]] + ")\" id=\"" + allCourseList[i][courseObjectIdOrder[0]] + "\"> " + 
			allCourseList[i][courseObjectIdOrder[0]] + ", " + allCourseList[i][courseObjectIdOrder[1]] + "</li>";
			//append to ul made in the HTML
			$("#allClassList").append(newItem);
		}
	}
}

function showCoursesToAdd() {
	emptyAllCourseList();
	for(i=0; i < allCourseList.length; i++) {
			//create list item
			let newItem = "<li class=\"list-group-item\" onclick=\"addClassToList(&quot;" + allCourseList[i][courseObjectIdOrder[0]] + "&quot;)\" id=\"" + allCourseList[i][courseObjectIdOrder[0]] + "\"> " + 
			allCourseList[i][courseObjectIdOrder[0]] + ", " + allCourseList[i][courseObjectIdOrder[1]] + "</li>";
			//append to ul made in the HTML
			$("#allClassList").append(newItem);
		}
	}

	function addClassToList(classID) {
		console.log("addedCourseList is " + addedCourseList);
		console.log("id to add is" + JSON.stringify(classID));
		for(i=0; i < allCourseList.length; i++) {
			console.log(i + " iteration")
			if (allCourseList[i][courseObjectIdOrder[0]] == JSON.stringify(classID)) {
				console.log("found match, is:");
				console.log(allCourseList[i]);
				addedCourseList.push(allCourseList[i]);
				console.log("addedCourseList is, after push before remove: ")
				console.log(addedCourseList);
				allCourseList.splice(i,1);
				$('#addNewClass').html("Add course");
				$('#hideTable').hidden = true;
				emptyAllCourseList();
			//setup();
			//return;
		}
	}
	populateMainView();
}

function emptyAddedCourseListInView() {
	$("#courseTableBody tr").remove(); 
}

function emptyAllCourseList() {
	$("#allClassList li").remove(); 
}

function searchFunction() {
	console.log("We are going to search for " + $('#searchbar').val());
	var searchString = $('#searchbar').val();
	for (i = 0; i < allCourseList.length; i++) { //loop through unadded courses
		if (allCourseList[i]["courseTitle"].toLowerCase().includes(searchString.toLowerCase()) || allCourseList[i]["profName"].toLowerCase().includes(searchString.toLowerCase())) {
			//if course title or prof name contain the search string (not case-sensitive)
			console.log("found a match");
			var foundCourse = allCourseList[i];
			allCourseList.splice(i, 1); //remove foundCourse
			allCourseList.unshift(foundCourse); //add it back at the beginning
		}
	}
	console.log("finished search");
	showCoursesToAdd();
}

function removeAddedCourse(courseTitle) {
	console.log(courseTitle);
	var courseToRemove = null;
	for (i = 0; i < addedCourseList.length; i++) {
		if (addedCourseList[i]["courseTitle"] == courseTitle) {
			courseToRemove = addedCourseList[i];
			addedCourseList.splice(i, 1); //remove from visible course list
		}
	}

	//shitty error handling
	if (courseToRemove == null) {
		console.log("error in removeAddedCourse()");
		return;
	}

	allCourseList.push(courseToRemove);
	populateMainView();


}

function sortAddedClasses(idToSortBy) {
	//I could have done a switch statement but I thought of that too late
	if (idToSortBy == "courseTitle") {
		addedCourseList.sort(compareCourseTitle);
	} else if (idToSortBy == "profName") {
		addedCourseList.sort(compareProfName);
	} else if (idToSortBy == "syllabusAccuracy") {
		addedCourseList.sort(compareSyllabusAccuracy)
	} else if (idToSortBy == "responseCount") {
		addedCourseList.sort(compareResponseCount)
	} else if (idToSortBy == "descriptionAccuracy") {
		addedCourseList.sort(compareDescriptionAccuracy)
	} else if (idToSortBy == "profQuality") {
		addedCourseList.sort(compareProfQuality)
	} else if (idToSortBy == "courseQuality") {
		addedCourseList.sort(comparecourseQuality)
	} else if (idToSortBy == "textbook") {
		addedCourseList.sort(compareTextbook)
	} else if (idToSortBy == "worldApplication") {
		addedCourseList.sort(compareWorldApplication)
	} else if (idToSortBy == "examRelevance") {
		addedCourseList.sort(compareExamRelevance)
	} else if (idToSortBy == "examTime") {
		addedCourseList.sort(compareExamTime)
	} else if (idToSortBy == "fairGrade") {
		addedCourseList.sort(compareFairGrade)
	} else if (idToSortBy == "gradeConsistent") {
		addedCourseList.sort(compareGradeConsistent)
	} else if (idToSortBy == "gradeAggregate") {
		addedCourseList.sort(compareGradeAggregate)
	}
	populateMainView();
}


/**

SORTER HELP FUNCTIONS UNDER HERE

**/

function compareCourseTitle(a, b) {
	const CRA = a.courseTitle;
	const CRB = b.courseTitle;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareProfName(a, b) {
	const CRA = a.profName;
	const CRB = b.profName;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareSyllabusAccuracy(a, b) {
	const CRA = a.syllabusAccuracy;
	const CRB = b.syllabusAccuracy;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareResponseCount(a, b) {
	const CRA = a.responseCount;
	const CRB = b.responseCount;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
} 

function compareDescriptionAccuracy(a, b) {
	const CRA = a.descriptionAccuracy;
	const CRB = b.descriptionAccuracy;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareProfQuality(a, b) {
	const CRA = a.profQuality;
	const CRB = b.profQuality;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function comparecourseQuality(a, b) {
	const CRA = a.courseQuality;
	const CRB = b.courseQuality;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareTextbook(a, b) {
	const CRA = a.textBook;
	const CRB = b.textBook;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}
function compareWorldApplication(a, b) {
	const CRA = a.worldApplication;
	const CRB = b.worldApplication;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareExamRelevance(a, b) {
	const CRA = a.examRelevance;
	const CRB = b.examRelevance;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareExamTime(a, b) {
	const CRA = a.examTime;
	const CRB = b.examTime;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareFairGrade(a, b) {
	const CRA = a.fairGrade;
	const CRB = b.fairGrade;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareGradeConsistent(a, b) {
	const CRA = a.gradeConsistent;
	const CRB = b.gradeConsistent;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

function compareGradeAggregate(a, b) {
	const CRA = a.gradeAggregate;
	const CRB = b.gradeAggregate;
	let comparison = 0;

	if (CRA > CRB) {
		comparison = 1;
	} else if (CRA < CRB) {
		comparison = -1;
	}
	return comparison;
}

/*
holy shit that's a lot of functions. But I'm in too deep to change it.
*/

</script>

