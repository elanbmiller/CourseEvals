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

        var courseObjectIdOrder = ["id", "courseTitle", "profName", "syllabusAccuracy", "responseCount", "descriptionAccuracy", "profQuality", "courseQuality", "textBook", "worldApplication", "examRelevance", "examTime", "fairGrade", "gradeConsistent", "gradeAggregate"];
        //this is to make loops work easier, just an array of the row column id's
        //will have to be updated when we add more data
        //used in populateMainView()



        $(document).ready(function () {

            //listener for change in search bar
            $('#searchbar').keyup(searchFunction);
            //listener for add new class button click
            $('#addNewClass').click(addClass);
            $('#addAllClasses').click(addAllClassesToView);
            $('#removeAllClasses').click(removeAllClassesFromView);

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
            for (i = 0; i < addedCourseList.length; i++) { //loop through added courses
                var tableRow = "<tr>";
                for (j = 1; j < courseObjectIdOrder.length; j++) { //add data points to new td
                    tableRow += "<td>" + addedCourseList[i][courseObjectIdOrder[j]] + "</td>";
                }

                //add the remove button
                tableRow += "<td> <button onclick=\"removeAddedCourse(" + addedCourseList[i]["id"] + ")\">remove</button> </td>" //course title is acting as unique id here


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
                //emptyAllCourseList();
                document.getElementById("hideTable").style.display = "block";
                $(addClass).html("Hide list");
                //for (i = 0; i < allCourseList.length; i++) {
                    //create list item
                    //console.log("here");
                    //let newItem = "<li class=\'list-group-item\' onclick=\"addClassToList(" + allCourseList[i][courseObjectIdOrder[0]] + ")\">" + allCourseList[i][courseObjectIdOrder[1]] + ", " + allCourseList[i][courseObjectIdOrder[2]] + "</li>";
		    //console.log(newItem);
                    //append to ul made in the HTML
                  //  $("#allClassList").append(newItem);
                    showCoursesToAdd();
                //}
            }
        }

        function showCoursesToAdd() {
            //console.log("show courses called");
            emptyAllCourseList();
            //NOTE: Preventing all courses from showing at once
            maxNumberOfCoursesToShow = 5
            for (i = 0; i < maxNumberOfCoursesToShow; i++) {
                //create list item
                let newItem = "<li class=\"list-group-item\" onclick=\"addClassToList(" + allCourseList[i][courseObjectIdOrder[0]] + ")\">" + allCourseList[i][courseObjectIdOrder[1]] + ", " + allCourseList[i][courseObjectIdOrder[2]] + "</li>";
                //append to ul made in the HTML
                //console.log(newItem);
                $("#allClassList").append(newItem);
            }
            //console.log($('#allClassList'));
        }

        function addClassToList(classID) {
            for (i = 0; i < allCourseList.length; i++) {
                if (String(allCourseList[i][courseObjectIdOrder[0]]) == String(classID)) {
                    addedCourseList.push(allCourseList[i]);
                    allCourseList.splice(i, 1);
                    $('#addNewClass').html("Add course");
                    $('#hideTable').hidden = true;
                    emptyAllCourseList();
                    //setup();
                    //return;
                }
            }
            //populateMainView();
            populateMainView();
            addClass();
        }

        function emptyAddedCourseListInView() {
            $("#courseTableBody tr").remove();
        }

        function emptyAllCourseList() {
            $("#allClassList li").remove();
        }

        function addAllClassesToView() {
             console.log(allCourseList.length);
             var i = 0;
             while(allCourseList[i]) {
             //   console.log(i);
		addClassToList(allCourseList[i]['id']);
                i++;
             }
	}

        function removeAllClassesFromView() {
             var i = 0;
             while(addedCourseList.length != 0) {
                  removeAddedCourse(addedCourseList[0]['id']);
                  i++;
	     }
        }

        function searchFunction() {
            var searchString = $('#searchbar').val();
            for (i = 0; i < allCourseList.length; i++) { //loop through unadded courses
                if (allCourseList[i]["courseTitle"].toLowerCase().includes(searchString.toLowerCase()) || allCourseList[i]["profName"].toLowerCase().includes(searchString.toLowerCase())) {
                    //if course title or prof name contain the search string (not case-sensitive)
                    //console.log("found a match");
                    var foundCourse = allCourseList[i];
                    allCourseList.splice(i, 1); //remove foundCourse
                    allCourseList.unshift(foundCourse); //add it back at the beginning
                }
            }
            //console.log("finished search");
            emptyAllCourseList();
            showCoursesToAdd();
        }

        function removeAddedCourse(courseTitle) {
            console.log(courseTitle);
            var courseToRemove = null;
            for (i = 0; i < addedCourseList.length; i++) {
                if ($.trim(String(addedCourseList[i]["id"])) == $.trim(String(courseTitle))) {
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

        var titleSort = 0;
        var nameSort = 0
        var accuracySort = 0;
        var responseSort = 0;
        var descriptionSort = 0;
        var profSort = 0;
        var qualitySort = 0;
        var textBookSort = 0;
        var applicationSort = 0;
        var relevanceSort = 0;
        var timeSort = 0;
        var gradeSort = 0;
        var consistentSort = 0;
        var aggregateSort = 0;

        function sortAddedClasses(idToSortBy) {
            //I could have done a switch statement but I thought of that too late

            if (idToSortBy == "courseTitle") {
                if(titleSort == 0){
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  titleSort = 1;
                }
                else if(titleSort == 1){
                  addedCourseList.sort(compareCourseTitle)
                  titleSort = 0;
                }
            } else if (idToSortBy == "profName") {
                if(nameSort == 0){
                  console.log("sort ascending")
                  addedCourseList.sort(compareProfName);
                  addedCourseList.reverse();
                  nameSort = 1;
                }
                else if(nameSort == 1){
                  console.log("sort descending")
                  addedCourseList.sort(compareProfName);
                  nameSort = 2;
                }
                else{
                  console.log("sort courseTitle")
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  nameSort = 0;
                }
            } else if (idToSortBy == "syllabusAccuracy") {
                if(accuracySort == 0){
                  addedCourseList.sort(compareSyllabusAccuracy)
                  addedCourseList.reverse();
                  accuracySort = 1;
                }
                else if(accuracySort == 1){
                  addedCourseList.sort(compareSyllabusAccuracy)
                  accuracySort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  accuracySort = 0;
                }
            } else if (idToSortBy == "responseCount") {
                if(responseSort == 0){
                  addedCourseList.sort(compareResponseCount)
                  addedCourseList.reverse();
                  responseSort = 1;
                }
                else if(responseSort == 1){
                  addedCourseList.sort(compareResponseCount)
                  responseSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  responseSort = 0;
                }
            } else if (idToSortBy == "descriptionAccuracy") {
                if(descriptionSort == 0){
                  addedCourseList.sort(compareDescriptionAccuracy)
                  addedCourseList.reverse();
                  descriptionSort = 1;
                }
                else if(descriptionSort == 1){
                  addedCourseList.sort(compareDescriptionAccuracy)
                  descriptionSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  descriptionSort = 0;
                }
            } else if (idToSortBy == "profQuality") {
                if(profSort == 0){
                  addedCourseList.sort(compareProfQuality)
                  addedCourseList.reverse();
                  profSort = 1;
                }
                else if(profSort == 1){
                  addedCourseList.sort(compareProfQuality)
                  profSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  profSort = 0;
                }
            } else if (idToSortBy == "courseQuality") {
                if(qualitySort == 0){
                  addedCourseList.sort(comparecourseQuality);
                  addedCourseList.reverse();
                  qualitySort = 1;
                }
                else if(qualitySort == 1){
                  addedCourseList.sort(comparecourseQuality);
                  qualitySort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  qualitySort = 0;
                }
            } else if (idToSortBy == "textbook") {
                if(textBookSort == 0){
                  addedCourseList.sort(compareTextbook)
                  addedCourseList.reverse();
                  textBookSort = 1;
                }
                else if(textBookSort == 1){
                  addedCourseList.sort(compareTextbook)
                  textBookSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  textBookSort = 0;
                }
            } else if (idToSortBy == "worldApplication") {
                if(applicationSort == 0){
                  addedCourseList.sort(compareWorldApplication)
                  addedCourseList.reverse();
                  applicationSort = 1;
                }
                else if(applicationSort == 1){
                  addedCourseList.sort(compareWorldApplication)
                  applicationSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  applicationSort = 0;
                }
            } else if (idToSortBy == "examRelevance") {
                if(relevanceSort == 0){
                  addedCourseList.sort(compareExamRelevance)
                  addedCourseList.reverse();
                  relevanceSort = 1;
                }
                else if(relevanceSort == 1){
                  addedCourseList.sort(compareExamRelevance)
                  relevanceSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  relevanceSort = 0;
                }
            } else if (idToSortBy == "examTime") {
                if(timeSort == 0){
                  addedCourseList.sort(compareExamTime)
                  addedCourseList.reverse();
                  timeSort = 1;
                }
                else if(timeSort == 1){
                  addedCourseList.sort(compareExamTime)
                  timeSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  timeSort = 0;
                }
            } else if (idToSortBy == "fairGrade") {
                if(gradeSort == 0){
                  addedCourseList.sort(compareFairGrade)
                  addedCourseList.reverse();
                  gradeSort = 1;
                }
                else if(gradeSort == 1){
                  addedCourseList.sort(compareFairGrade)
                  gradeSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  gradeSort = 0;
                }
            } else if (idToSortBy == "gradeConsistent") {
                if(consistentSort == 0){
                  addedCourseList.sort(compareGradeConsistent)
                  addedCourseList.reverse();
                  consistentSort = 1;
                }
                else if(consistentSort == 1){
                  addedCourseList.sort(compareGradeConsistent)
                  consistentSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  consistentSort = 0;
                }
            } else if (idToSortBy == "gradeAggregate") {
                if(aggregateSort == 0){
                  addedCourseList.sort(compareGradeAggregate)
                  addedCourseList.reverse();
                  aggregateSort = 1;
                }
                else if(aggregateSort == 1){
                  addedCourseList.sort(compareGradeAggregate)
                  aggregateSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  aggregateSort = 0;
                }
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
