var addedCourseList;
var allCourseList;


$(document).ready(function(){
	getCourseData();
    populateMainView();
});

//in these, course number (just the first thing in the array) has to be the unique identifier
function getCourseData() {
	let course1 = ["101", "Smith", "5", "6", "2", "5"];
	let course2 = ["102", "Johnson", "7", "6", "7", "2"];
	
	let course3 = ["103", "Chad", "6", "2", "6", "10"];
	addedCourseList = [course1, course2, course3];

	let unaddedcourse2 = ["105", "Idk", "5", "6", "2", "5"];
	let unaddedcourse3 = ["106", "Smth", "5", "6", "2", "5"];
	allCourseList = [unaddedcourse3, unaddedcourse2];

	console.log(addedCourseList);
}


/* adds courses from addedCourseList to the main view*/
function populateMainView() {
	emptyAddedCourseList();
	var t = $('#courseTableBody');
	for (i=0; i < addedCourseList
	.length; i++) {
		var tableRow = "<tr>";
		for (j=0; j < addedCourseList[i].length; j++) {
			tableRow += "<td>" + addedCourseList[i][j] + "</td>";
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
			let newItem = "<li class=\"list-group-item\" onclick=\"addClassToList(" + allCourseList[i][0] + ")\" id=\"" + allCourseList[i][0] + "\"> " + 
			allCourseList[i][0] + ", " + allCourseList[i][1] + "</li>";
			//append to ul made in the HTML
			$("#allClassList").append(newItem);
		}
	}
}

function addClassToList(classID) {
	for(i=0; i < allCourseList.length; i++) {
		if (allCourseList[i][0] == classID) {
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

function emptyAddedCourseList() {
 $("#courseTableBody tr").remove(); 
}

function emptyAllCourseList() {
	$("#allClassList li").remove(); 
}
