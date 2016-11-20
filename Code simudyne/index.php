<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Back-end test - DUTOT Alexis</title>

</head>

<body>
<?php
	include 'classDataWriter.php';
	
	// Ask for the brand factor input
	if (!isset($_GET['Actualize']))
	{
		echo'<form method="POST" action="?Actualize">';
		echo ' INPUT :<input type="text" name="BrandFactor"><br/>';
		echo '<input type="submit" value="Send">';
		echo '</form>';
	}
	// if the brand factor is overbounded, we ask again
	else if ($_POST['BrandFactor']<0.1 || $_POST['BrandFactor']>2.9)
	{
		echo 'Input must be between 0.1 and 2.9';
		echo'<form method="POST" action="?Actualize">';
		echo ' INPUT :<input type="text" name="BrandFactor"><br/>';
		echo '<input type="submit" value="Send">';
		echo '</form>';	
	}
	else{
	// We process the data with the brand factor that the user chose
		$vbrandFactor=$_POST['BrandFactor'];
		$extractor= DataExtractor::getInstance();
		$resultExtraction=$extractor->exctractData("AgentTest.xlsx");
		$arrayOfData=$resultExtraction[0];
		$processor= new DataProcessor(15,$vbrandFactor);
		$processor->processing($arrayOfData);
		$writer=DataWriter::getInstance();
		$writer->writeData($arrayOfData,"AgentTestBis",$resultExtraction[1],$resultExtraction[2]);
	}




?>
</body>
</html>
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<?php
	
	/*
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

	date_default_timezone_set('Europe/London');
	*/

	/** Include PHPExcel_IOFactory */
	/*
	require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';


	if (!file_exists("test.xlsx")) {
		exit("No such file exists" . EOL);
	}

	// On va lire le fichier excell
	$objPHPExcel = PHPExcel_IOFactory::load("AgentTest.xlsx");

	$sheet = $objPHPExcel->getSheet(0);

	
	// In the sheet we downloaded, we suppose that we don't know how data columns are organised but we suppose that we know their name.
	// We also suppose that the name of these columns are present on line 1.
	// First, we will find the indexes of the columns that we are interested in.
	
	
	$lineContainingColumnsNames=1;	
	
	//Number of columns that we have in our document
	$highestColumnIndex = 9 ; //PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5
	
	// We will go through each columns of the first line and recuperate into variables some of the indexes
	for($col=0; $col<= $highestColumnIndex; ++$col)
	{
		switch($sheet->getCellByColumnAndRow($col, $lineContainingColumnsNames)->getValue())
		{
			case "Agent_Breed":
				$indexAgentBreed=$col;
				break;
			case "Policy_ID":
				$indexPolicyID=$col;
				break;
			case "Age":
				$indexAge=$col;
				break;
			case "Social_Grade":
				$indexSocialGrade=$col;
				break;
			case "Payment_at_Purchase":
				$indexPaymentAtPurhase=$col;
				break;
			case "Attribute_Brand":
				$indexAttributeBrand=$col;
				break;
			case "Attribute_Price":
				$indexAttributePrice=$col;
				break;	
			case "Attribute_Promotions":
				$indexAttributePromo=$col;
				break;
			case "Auto_Renew":
				$indexAutoRenew=$col;
				break;
			case "Inertia_for_Switch":
				$indexInertiaForSwitch=$col;
				break;
		}	
	}
	
	// We verify that we catched all the indexes that we need for the calculation
	if(isset($indexAgentBreed,$indexPolicyID,$indexAge,$indexSocialGrade,$indexPaymentAtPurhase,$indexAttributeBrand,$indexAttributePrice,$indexAttributePromo,$indexAutoRenew,$indexInertiaForSwitch))
	{
	
		// Now we will be able to process data
		
		// Function that counts the number of row in the excell sheet
		$highestDataRow = 15; //$sheet->getHighestRow();
		
		$nbYears=15;
		
	
	
	
	
	
	
	}
	else{
		echo "ERROR File is not containing the right columns as expected.";
	}
	

	
	
	
	*/
	
	
	
	
	/*
	$highestRow = $sheet->getHighestRow(); // e.g. 10
	$highestColumn = 'A';//$sheet->getHighestColumn(); // e.g 'F'



	echo '<table>' . "\n";
	for ($row = 1; $row <= $highestRow; ++$row) {
	  echo '<tr>' . "\n";

	  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
		echo '<td>' . $sheet->getCellByColumnAndRow($col, $row)->getValue() . '</td>' . "\n";
	  }

	  echo '</tr>' . "\n";
	}
	echo '</table>' . "\n";
	*/

