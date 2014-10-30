<?php
App::uses('Helper', 'View');

class MaskHelper extends Helper {

	public function mask($text, $mask)
	{
		$xtext = preg_replace("/[^0-9]/","", $text);
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{
				if(isset($xtext[$k]))
				{
					$maskared .= $xtext[$k++];
				}
			}
			else
			{
				if(isset($mask[$i]))
				{
					$maskared .= $mask[$i];
				}
			}
		}
		return $maskared;
	}

}
