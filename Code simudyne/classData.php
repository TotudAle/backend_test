<?php

	// Show errors and warnings
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);

	define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');


/**
*
* Here you will find the class Data. One instance will correspond to one row in our Excel file
* with the same attributes as in the file. This class will be used by every others in this project.
* Each attribute corresponds to one cell on the row of our file.
*
**/

	class Data
	{
		private $_agentBreed,
				$_policyID,
				$_age,
				$_socialGrade,
				$_paymentAtPurchase,
				$_attributeBrand,
				$_attributePrice,
				$_attributePromotion,
				$_autoRenew,
				$_inertiaForSwitch;


		/**
		* Constructor of the class Data
		*
		* @param string  $ag agent breed of the data
		* @param integer $pId policy ID of the data
		* @param integer $age age of the data
		* @param integer $sg social grade of the data
		* @param integer $pap payment at purchase of the data
		* @param float	 $attB attribute brand of the data
		* @param float	 $attPrice attribute price of the data
		* @param float	 $attPromo attribute promotions of the data
		* @param bool	 $ar auto renew of the data
		* @param integer $ifs inertia for switch of the data
		*
		* @return void
		*/
		
		public function __construct($ag,$pId,$age,$sg,$pap,$attB,$attPrice,$attPromo,$ar,$ifs)
		{
			// Check the types of the parameters -> couldn't handle the floats yet because of the PHPExcel object that i have to analyse more
			if (!is_string($ag) || !is_int((int)$pId) || !is_int((int)$sg) || !is_int((int)$pap) || !is_int((int)$ar) || !is_int((int)$ifs))
			{
				exit("ERROR : wrong types in order to instanciate the data" . EOL);
			}
			$this->_agentBreed=$ag;
			$this->_policyID=$pId;
			$this->_age=$age;
			$this->_socialGrade=$sg;
			$this->_paymentAtPurchase=$pap;
			$this->_attributeBrand=$attB;
			$this->_attributePrice=$attPrice;
			$this->_attributePromotion=$attPromo;
			$this->_autoRenew=$ar;
			$this->_inertiaForSwitch=$ifs;

		}

		
		/**
		* Return the agent breed of the data
		*
		* @return string
		*/
		
		public function getAgentBreed()
		{
			return $this->_agentBreed;
		}
		
		
		/**
		* Return the policy ID of the data
		*
		* @return integer
		*/
		
		public function getPolicyID()
		{
			return $this->_policyID;
		}
		
		
		/**
		* Return the age of the data
		*
		* @return integer
		*/
		
		public function getAge()
		{
			return $this->_age;
		}
		
		
		/**
		* Return the social grade of the data
		*
		* @return integer
		*/
		
		public function getSocialGrade()
		{
			return $this->_socialGrade;
		}
		
		
		/**
		* Return the payment at purchase of the data
		*
		* @return integer
		*/
		
		public function getPaymentAtPurchase()
		{
			return $this->_paymentAtPurchase;
		}
		
		
		/**
		* Return the brand attribute of the data
		*
		* @return float
		*/
		
		public function getAttributeBrand()
		{
			return $this->_attributeBrand;
		}
		
		
		/**
		* Return the price attribute of the data
		*
		* @return float
		*/
		public function getAttributePrice()
		{
			return $this->_attributePrice;
		}		
		
		
		/**
		* Return the promotion attribute of the data
		*
		* @return float
		*/
		public function getAttributePromotion()
		{
			return $this->_attributePromotion;
		}		
		
		
		/**
		* Return wether the data has auto renew or not
		*
		* @return bool
		*/
		
		public function getAutoRenew()
		{
			return $this->_autoRenew;
		}
		
		
		/**
		* Return the inertia for switch of the data
		*
		* @return integer
		*/
		
		public function getInertiaForSwitch()
		{
			return $this->_inertiaForSwitch;
		}
		
		
		
		/**
		* Change the age of the data
		*
		* @param integer $age the new age that we want to give to the data
		*
		* @return void
		*/
		
		public function setAge($age)
		{
			// check the type of the parameter $age
			if (!is_int((int)$age))
			{
				exit("ERROR : wrong types passed to method setAge()" . EOL);
			}
			$this->_age=$age;
		}
		
		
		
		/**
		* Change the agent breed of the data
		*
		* @param string $agent the new agent breed that we want to give to the data
		*
		* @return void
		*/
		
		public function setAgentBreed($agentBreed)
		{
			if (!is_string($agentBreed))
			{
				exit("ERROR : wrong types passed to method setAgentBreed()" . EOL);
			}
			$this->_agentBreed=$agentBreed;
		}
		
		

		/**
		* Return the calculated affinity of the data
		*
		* @details	The affinity is calculated by the equation : Payment_at_Purchase/Attribute_Price + (2 * Attribute_Promotions * Inertia_for_Switch)
		*
		* @return void
		*/
		
		public function getAffinity()
		{
			return ($this->_paymentAtPurchase/$this->_attributePrice+(2*$this->_attributePromotion*$this->_inertiaForSwitch));
		}
		

	}