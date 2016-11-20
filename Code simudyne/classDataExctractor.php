<?php

	include 'classData.php';

	date_default_timezone_set('Europe/London');

	// Include PHPExcel_IOFactory
	require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
	
	
/**
*
* Here you will find the class DataExtractor. For this class we also
* implemented the design pattern Singleton. The single instance of this
* class will have the role to extract Data from a file into a data structure
* This class will only get one attribute which will be an instance of itself.
*
**/	
	
	class DataExtractor
	{

		/**
		* @var DataExtractor
		* @access private
		* @static
		*/
		
		private static $_instance = null;
		

		
		/**
		* Constructor of the class DataExtractor
		*
		* @return void
		*/
		
		private function __construct() {}
		
		
		
	    /**
		* Create the unique instance of the class if it doesn't already exists
		*
		* @param void
		* @return DataExtractor
		*/
		
		public static function getInstance() {
 
			if(is_null(self::$_instance))
			{
				self::$_instance = new DataExtractor();  
			}
			return self::$_instance;
		}
	
	
		
	    /**
		* Extract data from an Excel file and store it into an array of object of class Data
		*
		* @details	The function extract data into an array containing objects of class Data and returns
		* 			this array plus the maximum number of columns and of rows that it had parsed
		*			This method ASSUME THAT THE FILE HAS ONLY DATA IN IT (no text as in the file given)
		*
		* @param string   $fileName the name of the file that we want to extract data from (WITH extension)
		*
		* @return array(DataExtractor, integer, integer) 
		*/
		public function exctractData($fileName)
		{
			if (!is_string($fileName))
			{
				exit("ERROR : wrong types passed to method exctractData()" . EOL);
			}
			// Check whether the file name given exists
			if (!file_exists($fileName))
			{
				exit("ERROR : No such file exists" . EOL);
			}
			
			// Load the excell file into an object :
			$objPHPExcel = PHPExcel_IOFactory::load($fileName);
			
			// Recuperate the first sheet of it where the data is assumed to be.
			$_sheet=$objPHPExcel->getSheet(0);
			
			
			// Recuperate the number of columns assuming that we ONLY have data and NO EQUATIONS into a variable
			$highestColumn = $_sheet->getHighestColumn(); //eg : F
			$_nbMaxColumns=PHPExcel_Cell::columnIndexFromString($highestColumn);
			
			
			// Recuperate the number of rows (including the line 1 where there are the name of the columns) into a variable
			$_nbMaxRows= $_sheet->getHighestRow();
			
			$arrayOfData=[]; // Array that will contain all of our data at the end of this method
			
			$indexLineContainingColumnsNames=1;	// We assumed that the line 1 was containing the names of the attributes of the data
			
			// In the sheet, we suppose that we don't know how data columns are organised but we suppose that we know their name and number.
			// We will go through each columns of the first line and recuperate into variables some of the indexes
			for($col=0; $col<= $_nbMaxColumns; ++$col)
			{
				switch($_sheet->getCellByColumnAndRow($col, $indexLineContainingColumnsNames)->getValue())
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
			if(!isset($indexAgentBreed,$indexPolicyID,$indexAge,$indexSocialGrade,$indexPaymentAtPurhase,$indexAttributeBrand,$indexAttributePrice,$indexAttributePromo,$indexAutoRenew,$indexInertiaForSwitch))
			{
				exit("ERROR : missing column(s) with right name(s)" . EOL);
			}
			
			// If it's ok, we can extract data :
			
			// We will go through all the rows except the first one
			for ($row = 2; $row <= $_nbMaxRows; ++$row) {
				
				// We create a Data object with the information that is required
				$data= new Data ($_sheet->getCellByColumnAndRow($indexAgentBreed, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexPolicyID, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexAge, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexSocialGrade, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexPaymentAtPurhase, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexAttributeBrand, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexAttributePrice, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexAttributePromo, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexAutoRenew, $row)->getValue(),$_sheet->getCellByColumnAndRow($indexInertiaForSwitch, $row)->getValue());
				
				// We append this data to the array
				array_push($arrayOfData, $data);
			}
			// We return the array containing all the data
			return array($arrayOfData,$_nbMaxColumns,$_nbMaxRows);
		}
	}