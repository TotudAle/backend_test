<?php

	include 'classDataProcessor.php';
	
/**
*
* Here you will find the class DataWriter. For this class we implemented the design
* pattern Singleton in order to have only one instance of this class. This instance
* will have the role to store post-processed (or not) data into a new Excel file.
* This class will only get one attribute which will be an instance of itself.
*
**/	
	
	
	
	class DataWriter
	{
		/**
		* @var DataWriter
		* @access private
		* @static
		*/
		
		private static $_instance = null;
	
	
	
		/**
		* Constructor of the class DataWriter
		*
		* @return void
		*/
		
		private function __construct() {}
		
		
		
	    /**
		* Create the unique instance of the class if it doesn't already exists
		*
		* @param void
		* @return DataWriter
		*/
		
		public static function getInstance() {
			
			if(is_null(self::$_instance)) {
				self::$_instance = new DataWriter();  
			}
			return self::$_instance;
			
		}
		
		
		
	    /**
		* Create the unique instance of the class if it doesn't already exists
		*
		* @param array(Data) $dataSet our dataSet that we want to store in a file
		* @param string		 $fname name of the file that will be created (without the extension)
		* @param integer 	 $nbcols number of attribute for a data in our data set
		* @param integer     $nbRows number of data in our data set
		*
		* @return void
		*/
		
		public function writeData($dataSet,$fname,$nbCols,$nbRows)
		{
			// We don't allow the overwritting of a file
			if (file_exists($fname.".xlsx"))
			{
				exit("ERROR : file already exists" . EOL);
			}
			
			// Check if the parameters have the right type
			if (!is_array($dataSet) || !is_string($fname) || !is_int((int)$nbCols) || !is_int((int)$nbRows))
			{
				exit("ERROR : wrong types passed to method writeData()" . EOL);
			}
			
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			
			// Set properties
			$objPHPExcel->getProperties()->setTitle($fname);
			
			// Add the data
			$objPHPExcel->setActiveSheetIndex(0);
			
			
			// First line is the names of the attributes
			$row=1;
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, 'Agent_Breed');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, 'Policy_ID');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, 'Age');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, 'Social_Grade');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, 'Payment_at_Purchase');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, 'Attribute_Brand');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, 'Attribute_Price');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, 'Attribute_Promotions');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, 'Auto_Renew');
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, 'Inertia_for_Switch');
			
			// Just below the names, we write the data into the object PHP Excel
			$row=$row+1;
			for ($i=$row; $i <= $nbRows; $i++) {
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $dataSet[$i-$row]->getAgentBreed());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $dataSet[$i-$row]->getPolicyID());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, $dataSet[$i-$row]->getAge());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $dataSet[$i-$row]->getSocialGrade());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $dataSet[$i-$row]->getPaymentAtPurchase());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $dataSet[$i-$row]->getAttributeBrand());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $dataSet[$i-$row]->getAttributePrice());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, $dataSet[$i-$row]->getAttributePromotion());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, $dataSet[$i-$row]->getAutoRenew());
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $dataSet[$i-$row]->getInertiaForSwitch());
			}
			
			// Save Excel 2007 file with the name $fname
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save($fname.".xlsx");
			
			echo "<br/> The file ".$fname.".xlsx has been generated. <br/>";
			
		}
 
   }