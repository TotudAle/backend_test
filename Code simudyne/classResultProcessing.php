<?php


/**
*
* Here you will find the class ResultProcessing which is used by the class DataProcessor
* An instance of this class will allow us to save all of the results that comes from a
* processing phase.
* I wanted to imbricate this class into the DataProcessor class or at least to declare it
* as a friend class and put the constructor as private. Indeed, only the class DataProcessor
* should be able to create and use ResultProcessing objects. However, in PHP, class imbrication
* and friend classes are not possible.
*
**/



	class ResultProcessing
	{
		private $_nbBreedCLost,
			    $_nbBreedCWon,
				$_nbBreedCRegained,
				$_nbTotBreedC,
				$_nbTotBreedNC,
				$_nbTotBreed;
			
		/**
		* Constructor of the class ResultProcessing
		*
		* @details Initialize all the attributes to zero
		*
		* @return void
		*/
		public function __construct()
		{
			$this->_nbBreedCLost=0;
			$this->_nbBreedCWon=0;
			$this->_nbBreedCRegained=0;
			$this->_nbTotBreedC=0;
			$this->_nbTotBreedNC=0;
			$this->_nbTotBreed=0;

		}
		
		
		/**
		* Return the number of breed with agent C lost
		*
		* @return integer
		*/
		
		public function getNbBreedCLost()
		{
			return $this->_nbBreedCLost;
		}
		
		
		
		/**
		* Return the number of breed with agent C won
		*
		* @return integer
		*/
		
		public function getNbBreedCWon()
		{
			return $this->_nbBreedCWon;
		}
		
		
		
		/**
		* Return the number of breed with agent C regained
		*
		* @return integer
		*/
		
		public function getNbBreedCRegained()
		{
			return $this->_nbBreedCRegained;
		}
		
		
		
		/**
		* Return the total number of agents
		*
		* @return integer
		*/
		
		public function getNbTotBreed()
		{
			return $this->_nbTotBreed;
		}
		
		
		
		/**
		* Return the total number of breed with agent C
		*
		* @return integer
		*/
		
		public function getNbTotBreedC()
		{
			return $this->_nbTotBreed();
		}
		
		
		
		/**
		* Return the total number of breed with agent NC
		*
		* @return integer
		*/
		
		public function getNbTotBreedNC()
		{
			return $this->_nbTotBreed();
		}
			
		
		
		/**
		* Increment the number of breed with agent C lost
		*
		* @return integer
		*/
		
		public function incrementNbBreedCLost()
		{
			return $this->_nbBreedCLost=$this->_nbBreedCLost+1;
		}	
		
		
		
		/**
		* Increment the number of breed with agent C won
		*
		* @return integer
		*/
		public function incrementNbBreedCWon()
		{
			return $this->_nbBreedCWon=$this->_nbBreedCWon+1;;
		}
		
		
		
		/**
		* Increment the number of breed with agent C regained
		*
		* @return integer
		*/
		public function incrementNbBreedCRegained()
		{
			return $this->_nbBreedCRegained=$this->_nbBreedCRegained+1;
		}
		
		
		
		/**
		* Increment the total number of breed agents
		*
		* @return integer
		*/
		
		public function incrementNbTotBreed()
		{
			return $this->_nbTotBreed=$this->_nbTotBreed+1;
		}
		
		
		
		/**
		* Increment the total number of breed with agent C
		*
		* @return integer
		*/
		public function incrementNbTotBreedC()
		{
			return $this->_nbTotBreedC=$this->_nbTotBreedC+1;
		}
		
		
		
		/**
		* Increment the total number of breed with agent NC
		*
		* @return integer
		*/
		
		public function incrementNbTotBreedNC()
		{
			return $this->_nbTotBreedNC=$this->_nbTotBreedNC+1;
		}

		
		
		/**
		* Reset to 0 all the attributes of an object of class ResultProcessing
		*
		* @return void
		*/

		public function resetResult()
		{
			$this->_nbBreedCLost=0;
			$this->_nbBreedCWon=0;
			$this->_nbBreedCRegained=0;
			$this->_nbTotBreedC=0;
			$this->_nbTotBreedNC=0;
			$this->_nbTotBreed=0;
		}
		
		
		
		/**
		* Print all of the attributes if an object of class ResultProcessing
		*
		* @return void
		*/
		public function printResult()
		{
			echo "<br/>-------------------- RESULTS AT THE END OF THE PROCESS --------------------<br/><br/>";
			echo "Total number of agent breed : ".$this->_nbTotBreed ."<br/>";
			echo "Number of agent breed C : ".$this->_nbTotBreedC ."<br/>";
			echo "Number of agent breed NC : ".$this->_nbTotBreedNC ."<br/>";
			echo "<br/>";
			echo "Number of agent breed C LOST : ".$this->_nbBreedCLost ."<br/>";
			echo "Number of agent breed C WON : ".$this->_nbBreedCWon ."<br/>";
			echo "Number of agent breed C REGAINED : ".$this->_nbBreedCRegained ."<br/>";
			echo "<br/>--------------------------------------------------------------------------------------------------<br/>";
			
		}
	}