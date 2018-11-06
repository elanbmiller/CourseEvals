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
            for (i = 0; i < allCourseList.length; i++) {
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
        var textbookSort = 0;
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
                  titleSort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  titleSort = 0;
                }
                addedCourseList.sort(compareCourseTitle);
            } else if (idToSortBy == "profName") {
                if(nameSort == 0){
                  addedCourseList.sort(compareProfName);
                  addedCourseList.reverse();
                  nameSort = 1;
                }
                else if(nameSort == 1){
                  addedCourseList.sort(compareProfName);
                  namesort = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  addedCourseList.reverse();
                  titleSort = 0;
                }
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
                if(courseQuality == 0){
                  addedCourseList.sort(comparecourseQuality);
                  addedCourseList.reverse();
                  courseQuality = 1;
                }
                else if(courseQuality == 1){
                  addedCourseList.sort(comparecourseQuality);
                  courseQuality = 2;
                }
                else{
                  addedCourseList.sort(compareCourseTitle);
                  courseQuality = 0;
                }
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
