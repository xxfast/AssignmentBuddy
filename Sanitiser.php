<?
	/**
	* Sanitiser.php
	* -----------------
	* An object that can sanitise data, so they are
	* not infectious 
	* @~author : Isuru 
	*/
	class Sanitiser 
	{
		
		function __construct()
		{
		}

		public function sanitise($data)   //eliminating unwanted characters using sanitise function
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;		
		}
	}
?>