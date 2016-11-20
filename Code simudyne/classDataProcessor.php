<?php
	
	
	include 'classResultProcessing.php';
	include 'classDataExctractor.php';
	
	
/**
*
* Here you will find the class DataProcessor. This class will have the role to process the data.
* It has a number of years, the brand factor and an object of class ResultProcessing as attributes
*
*
*
* I was wondering about also implementing a design pattern singleton for this class. It would be
* better for reusability I think because if we want another type of processing then we have to define
* a new class.
**/	


	class DataProcessor
	{
		private $_nbYears,
				$_brandFactor,
				$_resultProcess;
				
		
		/**
		* Constructor of the class DataProcessor 
		*
		* @details        Initialize the attributes $_nbYears and $_brandFactor with the values
		*		          passed as parameters and also instanciate an object of the class ResultProcessing
		*
		* @param integer  $nbYears the number of years for which we will process
		* @param float	  $brandFactor the brand factor
		* @return void
		*/
		public function __construct($nbYears,$brandFactor)
		{
			if (!is_int($nbYears) || !is_float($brandFactor))
			{
				exit("ERROR : wrong types passed to instanciate a DataProcessor object" . EOL);
			}
			$this->_nbYears=$nbYears;
			$this->_brandFactor=$brandFactor;
			$this->_resultProcess= new ResultProcessing;
		}
		
		
		
		/**
		* Return the result of the process
		*
		* @return ResultProcessing
		*/
		
		public function getResultProcess()
		{
			return $this->_resultProcess;
		}
		
		
		
		/**
		* Process the data and print the result of the processing phase
		*
		* @param  array(Data) $dataSet our dataSet that we want to process
		*
		* @return void
		*/
		
		public function processing($dataSet)
		{
			//Check if dataSet is an array
			if (!is_array($dataSet))
			{
				exit("ERROR : wrong type passed to method processing()" . EOL);
			}
			$this->_resultProcess->resetResult();
			
			
		    // Start the processing : we will process all the data one by one
			for ($i=0;$i<count($dataSet);$i++)
			{
				$this->_resultProcess->incrementNbTotBreed();
				
				// Save the initial state of the agent breed to be able to compare at the end
				$initialAgentBreed=$dataSet[$i]->getAgentBreed();
				
				// Boolean variable that will check if at least one change occured during the processing phase
				$change=false;
				
				// For eah data we will do the following processing phase :
				for ($j=0;$j<$this->_nbYears;$j++)
				{
					// Increment the age
					$dataSet[$i]->setAge(1+$dataSet[$i]->getAge());
					
					// If the parameter auto renew is equal to 0 we go deeper in the processing
					if($dataSet[$i]->getAutoRenew()==0)
					{
						// Check whether the data has agent breed Breed_C or Breed_NC and apply the corresponding switch method
						if($dataSet[$i]->getAgentBreed()=="Breed_C")
						{
							$resultSwitch=$this->switchToBreedNC($dataSet[$i]);
							if($resultSwitch)
								$change=true;
						}
						else if($dataSet[$i]->getAgentBreed()=="Breed_NC")
						{
							$resultSwitch=$this->switchToBreedC($dataSet[$i]);
							if($resultSwitch)
								$change=true;
						}
					}
				}
				// We compare the final agent breed with the initial one and look at the variable $change to update our result
				if($initialAgentBreed==($dataSet[$i]->getAgentBreed()) && $initialAgentBreed=="Breed_C" && $change== true){
					$this->_resultProcess->incrementNbBreedCRegained();
				}
				else if ($initialAgentBreed=="Breed_C" && ($dataSet[$i]->getAgentBreed())=="Breed_NC"){
					$this->_resultProcess->incrementNbBreedCLost();
				}
				
				else if($initialAgentBreed=="Breed_NC" && ($dataSet[$i]->getAgentBreed())=="Breed_C"){
					$this->_resultProcess->incrementNbBreedCWon();
				}
				
				// We update the total number of breed C ad NC
				if($dataSet[$i]->getAgentBreed()=="Breed_NC")
					$this->_resultProcess->incrementNbTotBreedNC();
				else
					$this->_resultProcess->incrementNbTotBreedC();
			}
			// print the results
			$this->_resultProcess->printResult();
		}
		
		
		
		/**
		* Try to switch the value of an agent breed to "Breed_C"
		*
		* @details This method return true if the switch occured and false otherwise
		*
		* @param  Data  $data our data that we want to try the breed change
		*
		* @return bool
		*/
		
		private function switchToBreedC($data)
		{
			// Check if $data is an object
			if (!is_object($data))
			{
				exit("ERROR : wrong type passed to method switchToBreedC()" . EOL);
			}
			
			
			if($data->getAffinity() < ($data->getSocialGrade() * $data->getAttributeBrand() * $this->_brandFactor))
			{
				$data->setAgentBreed("Breed_C");
				return true;
			}
			return false;
		}
		

		
		/**
		* Try to switch the value of an agent breed to "Breed_NC"
		*
		* @details This method return true if the switch occured and false otherwise
		*
		* @param  Data  $data our data that we want to try the breed change
		*
		* @return bool
		*/
		
		private function switchToBreedNC($data)
		{
			// Check if $data is an object
			if (!is_object($data))
			{
				exit("ERROR : wrong type passed to method switchToBreedNC()" . EOL);
			}
			
			
			if($data->getAffinity() < ($data->getSocialGrade() * $data->getAttributeBrand()))
			{
				$data->setAgentBreed("Breed_NC");
				return true;
			}
			return false;
		}
	}
	
	
	
	
	
	
	
	