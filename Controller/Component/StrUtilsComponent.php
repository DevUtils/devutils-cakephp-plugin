<?php
class StrUtilsComponent extends Component
{
	function initialize(Controller $controller)
	{

	}

	public function right($p_word, $p_count)
	{
		return substr($p_word, ($p_count * -1));
	}

	public function brPluralToSingular($p_word)
	{
		$located = false;
		$regras = array
		(
			'eses' => 'es', 
			'éres' => 'er', 
			'ôres' => 'or', 
			'ões'  => 'ão', 
			'ãos'  => 'ão', 
			'res'  => 'r', 
			'zes'  => 'z', 
			'ais'  => 'al', 
			'ens'  => 'em', 
			'is'   => 'il', 
			's'    => '',
		);

		$result = $p_word;
		foreach ($regras as $pl => $si)
		{
			$str_final = $this->right($p_word, strlen($pl));
			if (mb_strtolower($str_final) == mb_strtolower($pl))
			{
				$suffix = ($str_final == mb_strtoupper($pl)) ? mb_strtoupper($si) : $si;
				$result = substr($p_word, 0, (strlen($p_word) - strlen($pl))) . $suffix;
				$located = true;
				break;
			}
		}
		if (!$located)
		{
			if (strcasecmp($this->right($p_word, 1), 's') === 0)
			{
				$result = rtrim($p_word, 's', 'S');
			}
		}
		return $result;
	}
}