<?php 

class Validator extends Laravel\Validator {


	public function check_digits($attribute, $value, $parameters)
	{
		
		if (strlen($value) < 4 || strlen($value) > 16) return false;

        return $value;
		
	}





}
?>