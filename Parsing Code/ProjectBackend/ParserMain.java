package ProjectBackend;
import java.io.File;
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;

import com.mysql.cj.jdbc.MysqlDataSource;
import com.mysql.cj.xdevapi.Statement;

public class ParserMain {
	
	public static void main(String args[]) throws IOException, SQLException {
			
	      //Loading an existing document
		  //getRemoteConnection();
	      
	      File directory= new File("src/CourseEvalPDF/mems_course_evals");
		  Connection mySql = getRemoteConnection();
		  //parse("src/CourseEvalPdf/jce.pdf", mySql);
	      for (File file : directory.listFiles())
	      {
	    	  parse("src/CourseEvalPDF/mems_course_evals/" +file.getName(), mySql);
	    	  
	      }

	 }
	
	private static Connection getRemoteConnection() throws SQLException {
		MysqlDataSource dataSource = new MysqlDataSource();
		dataSource.setUser("elanbmiller");
		dataSource.setPassword("19lqsym-sdr-MISTER94");
		dataSource.setServerName("retsim-rds-mysql.cjiazomxbsqn.us-east-1.rds.amazonaws.com");
		dataSource.setDatabaseName("courseEvalsDB");
		Connection conn = dataSource.getConnection();
		return conn;
	 }
	
	public static void parse(String filePath, Connection mySql) throws IOException, SQLException {
		
		  //parsing variables
		  String textFlagStart;
		  String textFlagEnd; 
		  String textFlagEnd2;
		  String stringExtract = "";
		  String stringExtract2 = "";
		  int startIndex = 0;
		  int endIndex = 0;
		  int endIndex2 = 0;
		  
		  //eval variables
		  String courseTitle;
		  double syllabusAccuracyMean;
		  int approximateResponseCount;
		  double descriptionAccuracyMean;
		  String profName;
		  Double profQualityMean;
		  Double courseQualityMean;
		  Double textBookMean;
		  Double applicationMean;
		  Double examRelevanceMean;
		  Double examTimeMean;
		  Double fairGradeMean;
		  Double gradeConsistentMean;
		  Double gradeAggregate;
		  
		  //Loading an existing document
	      File file = new File(filePath);
	      PDDocument document = PDDocument.load(file);
	      
	      //Instantiate PDFTextStripper class
	      PDFTextStripper pdfStripper = new PDFTextStripper();

	      //Retrieving text from PDF document
	      String text = pdfStripper.getText(document);
	      
	      //extract title using flags
		  textFlagStart = "SP2018.E37";
		  textFlagEnd = "\nWashU Spring 2018 Course Evaluations";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] titleParts = stringExtract.split(" \\(");
	      courseTitle = titleParts[0];
	      courseTitle = courseTitle.replaceAll("\n", "");
		  System.out.println(courseTitle + ": " + file.getName());

	      
	      //extract syllabus accuracy information
	      textFlagStart = "In retrospect, the syllabus was an accurate reflection of how the course was actually\n" + "taught.";
	      textFlagEnd = "The course matched the course catalog description.";
	      textFlagEnd2 = "/n";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] syllabusNumSet = stringExtract.split(" ");
	      syllabusAccuracyMean = Double.parseDouble(syllabusNumSet[0]);
	      approximateResponseCount = Integer.parseInt(syllabusNumSet[2]);
	      
	      
	      //extract description accuracy information
	      textFlagStart = "The course matched the course catalog description.";
	      textFlagEnd = "\n1. In retrospect, the syllabus";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] descriptionNumSet = stringExtract.split(" ");
	      descriptionAccuracyMean = Double.parseDouble(descriptionNumSet[0]);
	      
	      if(courseTitle.equals("ESE.141.01 - Introductory Robotics")) {
	    	  profQualityMean = 0.0;
	    	  profName = "None";
	      }
	      else {
	    	  textFlagStart = "Overall rating for teaching quality of";
	    	  textFlagEnd = "\nRating Scale Responses for";
	    	  startIndex = text.indexOf(textFlagStart);
	    	  startIndex = startIndex + textFlagStart.length() + 1;
	    	  endIndex = text.indexOf(textFlagEnd);
	    	  stringExtract = text.substring(startIndex, endIndex);
	          String[] profSet = stringExtract.split("\n");
	          profName = profSet[0].substring(0, profSet[0].length() - 1);
	      	  String[] profMeanSet = profSet[3].split(" ");
	      	  profQualityMean = Double.parseDouble(profMeanSet[1]);
	      }

	      
	      //extract overall rating of course content
	      textFlagStart = "Overall rating of course content.";
	      textFlagEnd = "\nTextbooks/readings complemented the lectures.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] courseRatingSet = stringExtract.split("\n");
	      String[] courseMeanSet = courseRatingSet[2].split(" ");
	      courseQualityMean = Double.parseDouble(courseMeanSet[1]);
	      
	      //extract Textbook/readings were useful
		  textFlagStart = "Textbooks/readings were useful.";
		  textFlagEnd = "\nAssigned homeworks were helpful and relevant to the course.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] textbookSet = stringExtract.split(" ");
	      if(textbookSet[0].equals("N/A")){
	    	  textBookMean = 0.0;
	      }
	      else {
		      textBookMean = Double.parseDouble(textbookSet[0]);
	      }
	      
	      //extract real-world applications
		  textFlagStart = "The course material drew upon real world applications.";
		  textFlagEnd = "\n1. Textbooks/readings complemented the lectures.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] applicationSet = stringExtract.split(" ");
	      applicationMean = Double.parseDouble(applicationSet[0]);
	      
	      //extract exam relevance to material
		  textFlagStart = "Exams reflected material taught.";
		  textFlagEnd = "\nAdequate time was given to complete exams.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] examRelevanceSet = stringExtract.split(" ");
	      if(examRelevanceSet[0].equals("N/A")){
	    	  examRelevanceMean = 0.0;
	      }
	      else {
		      examRelevanceMean = Double.parseDouble(examRelevanceSet[0]);
	      }
	      
	      //extract examTime difficulty
		  textFlagStart = "Adequate time was given to complete exams.";
		  textFlagEnd = "\nYour grades to this point accurately reflect your understanding of the material.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] examTimeMeanSet = stringExtract.split(" ");
	      if(examTimeMeanSet[0].equals("N/A")){
	    	  examTimeMean = 0.0;
	      }
	      else {
		      examTimeMean = Double.parseDouble(examTimeMeanSet[0]);
	      }
	      
	      //extract fairGradeMean
		  textFlagStart = "Your grades to this point accurately reflect your understanding of the material.";
		  textFlagEnd = "\nThe grading system was consistent and equitable.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] fairGradeSet = stringExtract.split(" ");
	      //fairGradeMean = Double.parseDouble(fairGradeSet[0]);
	      if(fairGradeSet[0].equals("N/A")){
	    	  fairGradeMean = 0.0;
	      }
	      else {
		      fairGradeMean = Double.parseDouble(fairGradeSet[0]);
	      }
	      
	      //extract gradeConsistenMean
		  textFlagStart = "The grading system was consistent and equitable.";
		  textFlagEnd = "\n1. Exams reflected material taught.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] gradeConsistentSet = stringExtract.split(" ");
	      gradeConsistentMean = Double.parseDouble(gradeConsistentSet[0]);
	      
	      //calculate gradeAggregate
	      double gradesSum = examTimeMean + examRelevanceMean + fairGradeMean + gradeConsistentMean;
	      gradeAggregate = gradesSum / 4;
	      
//		  System.out.println("courseTitle:          " + courseTitle);
//		  System.out.println("syllabusAccuracy:     " + syllabusAccuracyMean);
//		  System.out.println("approximateResponseCount: " + approximateResponseCount);
//		  System.out.println("descriptionAccuracy:  " + descriptionAccuracyMean);
//		  System.out.println("profName:             " + profName);
//		  System.out.println("profQuality:          " + profQualityMean);
//		  System.out.println("courseQuality:        " + courseQualityMean);
//		  System.out.println("textBook:             " + textBookMean);
//		  System.out.println("worldApplication:     " + applicationMean);
//		  System.out.println("examRelevance:        " + examRelevanceMean);
//		  System.out.println("examTime:             " + examTimeMean);
//		  System.out.println("fairGrade:            " + fairGradeMean);
//		  System.out.println("gradeConsistent:      " + gradeConsistentMean);
//		  System.out.println("gradeAggregate:       " + gradeAggregate);
		  
		  //create SQL query here
		  String queryFields = "INSERT INTO courses(courseTitle, syllabusAccuracy, responseCount, descriptionAccuracy, profName, profQuality, courseQuality, textBook, worldApplication, examRelevance, examTime, fairGrade, gradeConsistent, gradeAggregate)";
		  String queryValues = " VALUES('" + courseTitle + "', " + syllabusAccuracyMean + ", " + approximateResponseCount + ", " + descriptionAccuracyMean + ", '" + profName + "', " + profQualityMean+ ", " + courseQualityMean + ", " + textBookMean + ", " + applicationMean + ", " + examRelevanceMean + ", " + examTimeMean + ", " + fairGradeMean + ", " + gradeConsistentMean + ", " +  gradeAggregate + ");";
		  String finalQuery = queryFields + queryValues;
		  java.sql.Statement stmt = mySql.createStatement();
		  System.out.println(finalQuery);
		  int rs = stmt.executeUpdate(finalQuery);
		  
		  //System.out.println(text);
		  
	      //System.out.println(courseTitle + syllabusAccuracyMean + approximateResponseCount + descriptionAccuracyMean + profName + profQualityMean + courseQualityMean + textBookMean);
	      //Closing the document
	      document.close();

	      
	}
}

