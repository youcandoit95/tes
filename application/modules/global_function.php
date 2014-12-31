<?php
	
	function create_digit($digit)
	{
		if (strlen($digit) == 1)
		{
			$new_digit = "00000".$digit;
		}
		
		elseif (strlen($digit) == 2) 
		{
			$new_digit = "0000".$digit;
		}

		elseif (strlen($digit) == 3) 
		{
			$new_digit = "000".$digit;
		}
		
		elseif (strlen($digit) == 4) 
		{
			$new_digit = "00".$digit;
		}
		
		elseif (strlen($digit) == 5) 
		{
			$new_digit = "0".$digit;
		}
		
		else 
		{
			$new_digit = $digit;
		}

		return $new_digit;
	}
?>