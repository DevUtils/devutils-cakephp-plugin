<?php
App::uses('Helper', 'View');

class StrUtilsHelper extends Helper
{
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

	public function fullNestedList($list)
	{
		if ($list === null)
		{
			return '';
		}
		$result = '<ul>';
		foreach ($list as $key => $value)
		{
			if (!is_array($value))
			{
				if ((string)$key != '0')
				{
					$result .= sprintf('<li>%s: %s</li>', $key, $value);
				}
				else
				{
					$result .= sprintf('<li>%s</li>', $value);
				}
			}
			else
			{
				$result .= sprintf('<li>%s:%s</li>', $key, $this->fullNestedList($value));
			}
		}
		$result .= '</ul>';
		return $result;
	}

	public function splitFileName($p_filename)
	{
		$tmp = explode(".", $file_name);
		$ext = array_pop($tmp);
		$fil = substr($file_name, 0, ((strlen($ext)+1) * -1));
		$r = array();
		$r["name"] = $fil;
		$r["ext"]  = $ext;
		return $r;
	}

}