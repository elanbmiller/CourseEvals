package ProjectBackend;
import java.io.File;
import java.io.IOException;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;

public class ParserMain {
	
	public static void main(String args[]) throws IOException {

	      //Loading an existing document
	      parse("src/CourseEvalPDF/CSE222Evaluation2.pdf");

	 }
	
	public static void parse(String filePath) throws IOException {
		
		  //parsing variables
		  String textFlagStart;
		  String textFlagEnd; 
		  String stringExtract = "";
		  int startIndex = 0;
		  int endIndex = 0;
		  
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
		  textFlagStart = "Engineering Spring 2018 Course Evaluation Report for";
		  textFlagEnd = "WashU Spring 2018 Course Evaluations";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      courseTitle = stringExtract;
	      
	      //extract syllabus accuracy information
	      textFlagStart = "In retrospect, the syllabus was an accurate reflection of how the course was actually\n" + "taught.";
	      textFlagEnd = "The course matched the course catalog description.";
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
	      
	      //extract overall professor quality
	      textFlagStart = "Overall rating for teaching quality of";
	      textFlagEnd = "\nRating Scale Responses for";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] profSet = stringExtract.split("\n");
	      profName = profSet[0];
	      String[] profMeanSet = profSet[3].split(" ");
	      profQualityMean = Double.parseDouble(profMeanSet[1]);
	      
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
	      textBookMean = Double.parseDouble(textbookSet[0]);
	      
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
	      examRelevanceMean = Double.parseDouble(examRelevanceSet[0]);
	      
	      //extract examTime difficulty
		  textFlagStart = "Adequate time was given to complete exams.";
		  textFlagEnd = "\nYour grades to this point accurately reflect your understanding of the material.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] examTimeMeanSet = stringExtract.split(" ");
	      examTimeMean = Double.parseDouble(examTimeMeanSet[0]);
	      
	      //extract fairGradeMean
		  textFlagStart = "Your grades to this point accurately reflect your understanding of the material.";
		  textFlagEnd = "\nThe grading system was consistent and equitable.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] fairGradeSet = stringExtract.split(" ");
	      fairGradeMean = Double.parseDouble(fairGradeSet[0]);
	      
	      //extract gradeConsistenMean
		  textFlagStart = "The grading system was consistent and equitable.";
		  textFlagEnd = "\n1. Exams reflected material taught.";
	      startIndex = text.indexOf(textFlagStart);
	      startIndex = startIndex + textFlagStart.length() + 1;
	      endIndex = text.indexOf(textFlagEnd);
	      stringExtract = text.substring(startIndex, endIndex);
	      String[] gradeConsistentSet = stringExtract.split(" ");
	      gradeConsistentMean = Double.parseDouble(gradeConsistentSet[0]);
	      
	      
	      
	      System.out.println(text);
	      //System.out.println(courseTitle + syllabusAccuracyMean + approximateResponseCount + descriptionAccuracyMean + profName + profQualityMean + courseQualityMean + textBookMean);
	      //Closing the document
	      document.close();
	      
//		  Double examTimeMean;
//		  Double fairGradeMean;
//		  Double gradeConsistenMean;
//		  Double gradeAggregate;

	      
	}
}

