var addedCourseList;
var allCourseList;

var courseObjectIdOrder = ["id", "prof", "courseRating", "profRating", "descAccuracy", "hoursHW"];
//this is to make loops work easier, just an array of the row column id's
//will have to be updated when we add more data
//used in populateMainView()


$(document).ready(function(){
	getCourseData();
    populateMainView();
});

//in these, id has to be the unique identifier
function getCourseData() {
	let course1 = {id: "101", prof: "Smith", courseRating: "5", profRating: "6", descAccuracy: "2", hoursHW: "5"};
	let course2 = {id: "102", prof: "Johnson", courseRating: "7", profRating: "6", descAccuracy: "7", hoursHW: "2"};
	let course3 = {id: "103", prof: "Chad", courseRating: "6", profRating: "2", descAccuracy: "6", hoursHW: "9"};
	addedCourseList = [course1, course2, course3];

	let unaddedcourse1 = {id: "104", prof: "Jones", courseRating: "1", profRating: "1", descAccuracy: "7", hoursHW: "2"};
	let unaddedcourse2 = {id: "105", prof: "Borb", courseRating: "6", profRating: "7", descAccuracy: "5", hoursHW: "0"};
	let unaddedcourse3 = {id: "106", prof: "Stan", courseRating: "4", profRating: "6", descAccuracy: "3", hoursHW: "7"};

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

function sortAddedClasses(idToSortBy) {
	if (idToSortBy == "courseRating") {
		addedCourseList.sort(compareCourseRating);
	} else if (idToSortBy == "profRating") {
		addedCourseList.sort(compareProfRating);
	} else if (idToSortBy == "descAccuracy") {
		addedCourseList.sort(compareDescAccuracy)
	} else if (idToSortBy == "hoursHW") {
		addedCourseList.sort(compareHoursHW)
	}
	populateMainView();
}




/**

SORTER HELP FUNCTIONS UNDER HERE

**/

function compareCourseRating(a, b) {
	const CRA = a.courseRating;
	const CRB = b.courseRating;
 	let comparison = 0;

 	if (CRA > CRB) {
 		comparison = 1;
 	} else if (CRA < CRB) {
 		comparison = -1;
 	}
 	return comparison;
}

function compareProfRating(a, b) {
	const CRA = a.profRating;
	const CRB = b.profRating;
 	let comparison = 0;

 	if (CRA > CRB) {
 		comparison = 1;
 	} else if (CRA < CRB) {
 		comparison = -1;
 	}
 	return comparison;
}

function compareDescAccuracy(a, b) {
	const CRA = a.descAccuracy;
	const CRB = b.descAccuracy;
 	let comparison = 0;

 	if (CRA > CRB) {
 		comparison = 1;
 	} else if (CRA < CRB) {
 		comparison = -1;
 	}
 	return comparison;
}

function compareHoursHW(a, b) {
	const CRA = a.hoursHW
	const CRB = b.hoursHW;
 	let comparison = 0;

 	if (CRA > CRB) {
 		comparison = 1;
 	} else if (CRA < CRB) {
 		comparison = -1;
 	}
 	return comparison;
}