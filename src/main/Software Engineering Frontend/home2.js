var addedCourseList;
var allCourseList;

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
	let course1 = {courseTitle: "101", profName: "Smith", syllabusAccuracy: "5", responseCount: "6", descriptionAccuracy: "2", profQuality: "5", courseQuality: "2", textBook: "3", 
	worldApplication: "4", examRelevance: "5", examTime: "7", fairGrade: "2", gradeConsistent: "8", gradeAggregate: "6"};

	let course2 = {courseTitle: "102", profName: "Johnson", syllabusAccuracy: "8", responseCount: "9", descriptionAccuracy: "2", profQuality: "5", courseQuality: "2", textBook: "3", 
	worldApplication: "5", examRelevance: "3", examTime: "0", fairGrade: "3", gradeConsistent: "9", gradeAggregate: "6"};

	let course3 = {courseTitle: "103", profName: "Chad", syllabusAccuracy: "5", responseCount: "7", descriptionAccuracy: "3", profQuality: "0", courseQuality: "3", textBook: "6", 
	worldApplication: "7", examRelevance: "7", examTime: "0", fairGrade: "4", gradeConsistent: "9", gradeAggregate: "2"};

	let unaddedcourse1 = {courseTitle: "104", profName: "Borb", syllabusAccuracy: "5", responseCount: "7", descriptionAccuracy: "3", profQuality: "0", courseQuality: "3", textBook: "6", 
	worldApplication: "7", examRelevance: "7", examTime: "0", fairGrade: "2", gradeConsistent: "9", gradeAggregate: "2"};

	let unaddedcourse2 = {courseTitle: "105", profName: "Birb", syllabusAccuracy: "5", responseCount: "7", descriptionAccuracy: "3", profQuality: "0", courseQuality: "3", textBook: "6", 
	worldApplication: "7", examRelevance: "7", examTime: "0", fairGrade: "2", gradeConsistent: "9", gradeAggregate: "2"};

	let unaddedcourse3 = {courseTitle: "106", profName: "Boooooorb", syllabusAccuracy: "5", responseCount: "7", descriptionAccuracy: "3", profQuality: "0", courseQuality: "3", textBook: "6", 
	worldApplication: "7", examRelevance: "7", examTime: "0", fairGrade: "2", gradeConsistent: "9", gradeAggregate: "2"};

	addedCourseList = [course1, course2, course3];
	allCourseList = [unaddedcourse1, unaddedcourse2, unaddedcourse3];
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
		tableRow += "</tr>"
		t.append(tableRow);
	}
}

/*called by add class button*/
function addClass() {
	var addClass = $('#addNewClass'); //button
	//making this function as a toggle
	if ($(addClass).html() == "Hide class list") {  //hide list
		$(addClass).html("Add class");
		document.getElementById("hideTable").style.display = "none";
	} else { //show classes to add
		emptyAllCourseList();
		document.getElementById("hideTable").style.display = "block";
		$(addClass).html("Hide class list");
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
			let newItem = "<li class=\"list-group-item\" onclick=\"addClassToList(" + allCourseList[i][courseObjectIdOrder[0]] + ")\" id=\"" + allCourseList[i][courseObjectIdOrder[0]] + "\"> " + 
			allCourseList[i][courseObjectIdOrder[0]] + ", " + allCourseList[i][courseObjectIdOrder[1]] + "</li>";
			//append to ul made in the HTML
			$("#allClassList").append(newItem);
		}
}

function addClassToList(classID) {
	for(i=0; i < allCourseList.length; i++) {
		if (allCourseList[i][courseObjectIdOrder[0]] == classID) {
			addedCourseList.push(allCourseList[i]);
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