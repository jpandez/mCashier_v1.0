<?php

	interface ISubscriberServices{
				public function exists();
				public function getSubscriberDetails(SubscriberInformation $s);
				
				
	}
	
	class SubscriberServiceResponse{
		public $SubscriberDetails;
		public $ResponseCode;
		public $StateObject;
		public $Message;
		public function __construct(){
			$this->SubscriberDetails= new SubscriberInformation();
		}
		
	}
	
	class SubscriberInformation{
		public $ACCOUNT_ID;
		public $NICKNAME;
		public $AUTHORIZED_MOBILE_NUMBER;
		public $ACCOUNT_TYPE;
		public $DATE_REGISTERED;
		public $KYC;
		public $REFERENCE_ACCOUNT;
		public $LANGUAGE_OPTION;
		public $COMPANY;
		public $ACCOUNT_STATUS;
		public $DATE_MODIFIED;
		public $USER_ID;
		public $LOCKED;
		public $DISTRO_CONTROL;
		public $CURRENT_AMOUNT;
		public $RECEIVED_AMOUNT;
		public $CASH_AMOUNT_SEND;
		public $GIVE_AMOUNT_SEND;
		public $BANK_AMOUNT_SEND;
		public $ALLOCATED_AMOUNT;
		public $TRANSFERRED_AMOUNT;
		public $CASH_AMOUNT_RECEIVED;
		public $GIVE_AMOUNT_RECEIVED;
		public $BANK_AMOUNT_RECEIVED;
		public $AIRT_AMOUNT_RECEIVED;
		public $LAST_TRANSACTION;
		//BANK DETAILS
		public $ACCOUNT_NUMBER;
		public $BANK_NAME;
		public $BRANCH_NAME;
		public $BRANCH_CODE;
	
	}

?>