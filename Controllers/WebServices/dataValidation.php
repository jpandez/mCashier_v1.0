<?php
	class dataValidation{

		public function CheckAlpha($value = '') {
			// Match only alphanumeric characters, underscores, periods, parentheses, hyphens, and spaces
			$validString = preg_match("/^[a-zA-Z0-9_.() -]+$/", $value) ? true : false;
			return $validString;
		}
		
		public function CheckNumeric($value = '') {
			// Match numeric values including commas and periods
			$validString = preg_match("/^[0-9,.]+$/", $value) ? true : false;
			return $validString;
		}
		
		public function CheckEmail($value = '') {
			// Match a valid email pattern
			$validString = preg_match("/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/", $value) ? true : false;
			return $validString;
		}
			
	}
?>