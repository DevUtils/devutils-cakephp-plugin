<?php
class UrlComponent extends Component
{
	protected $url_original;
	protected $url_trim;
	protected $url_array;
	protected $url_section_count;

	function initialize(Controller $controller)
	{
		$here = $controller->request->here;
		$this->url_original = rtrim($here, '/');
		$this->url_trim     = trim($here, '/');
		$this->url_array    = explode('/', $this->url_trim);
		$this->url_section_count = count($this->url_array);
	}
	
	public function here($p_compare = null)
	{
		if (isset($p_compare))
		{
			return $this->url_original;
		}
		$temp1 = strtolower($this->url_original);
		$temp2 = strtolower(rtrim($p_compare, '/'));
		return ($temp1 == $temp2);
	}

	public function slug($p_compare = null, $p_partial = false)
	{
		$result = str_replace('/', '-', $this->url_trim);
		$result = (empty($result)) ? 'home' : $result;

		if (empty($p_compare))
		{
			return $result;
		}
		else
		{
			if (!$p_partial)
			{
				return (strtolower($result) == strtolower($p_compare));
			}
			else
			{
				return (strpos(strtolower($result), strtolower($p_compare)) !== false);
			}
		}
	}

	public function url($p_url)
	{
		return Router::url($p_url, true);
	}

	private function generateRandom()
	{
		return chr(mt_rand(65,90)) . chr(mt_rand(65,90)) . mt_rand(1000, 9999);
	}

	public function nocache($p_url)
	{
		return Router::url($p_url . '?nc=' . $this->generateRandom(), true);
	}

	public function version($p_url, $p_version = null)
	{
		if (!empty($p_version))
		{
			return (strtolower($p_version) == 'time') ? Router::url($p_url . '?v=' . date('YmdHms'), true) : Router::url($p_url . '?v=' . $p_version, true);
		}
		else
		{
			return Router::url($p_url . '?v=' . $this->generateRandom(), true);
		}
	}

	public function add()
	{
		$url = $this->url_original . '/' . implode('/', func_get_args());
		$result = Router::url($url, true);
		return $result;
	}

	public function count($p_quant = null)
	{
		if ($p_quant === null)
		{
			return $this->url_section_count;
		}
		else
		{
			return $this->url_section_count == $p_quant;
		}
	}

	public function has($p_section, $p_match_all = false)
	{
		$url = $this->here();
		$url = strtolower($url);
		$tmp_array = explode('/', $url);

		if (is_string($p_section))
		{
			$locate = strtolower($p_section);
			return in_array($locate, $tmp_array);
		}

		if (is_array($p_section))
		{
			if (!$p_match_all)
			{
				foreach ($p_section as $key => $section)
				{
					$locate = strtolower($section);
					if (in_array($locate, $tmp_array))
					{
						return true;
					}
				}
				return false;
			}
			else
			{
				$matchs = array();
				foreach ($p_section as $key => $section)
				{
					$locate = strtolower($section);
					if (in_array($locate, $tmp_array))
					{
						if (!in_array($locate, $matchs))
						{
							$matchs[] = $locate;
						}
					}
				}
				return count($matchs) >= count($p_section);
			}
		}
		return false;
	}

	public function level($p_level, $p_compare = null)
	{
		$url = $this->here();
		$url = trim($url, '/');
		$tmp_array = explode('/', $url);
		$use_level = $p_level;
		if (empty($use_level)) { $use_level = 1; }
		if (strtolower($use_level) === 'first') { $use_level = 1; }
		if (strtolower($use_level) === 'last')
		{
			$use_level = count($tmp_array);
		}
		if (!empty($tmp_array[$use_level-1]))
		{
			$result = $tmp_array[$use_level-1];
			return ($p_compare === null) ? $result : (strcasecmp($result, $p_compare) === 0);
		}
		return ($p_compare === null) ? '' : ($p_compare === '');
	}

	public function firstLevel($p_compare = null)
	{
		$result = $this->level(1, $p_compare);
		return $result;
	}

	public function lastLevel($p_compare = null)
	{
		$result = $this->level('last', $p_compare);
		return $result;
	}

	public function auto_javascript($p_prefix = '', $p_max_level = 3)
	{
		App::uses('Folder', 'Utility');
		$url = $this->here();
		$url = strtolower($url);
		$url = trim($url, '/');
		$tmp_array = explode('/', $url);
		$tmp_count = count($tmp_array);
		while($tmp_count > $p_max_level)
		{
			unset($tmp_array[count($tmp_array)-1]);
			$tmp_count = count($tmp_array);
		}
		$url = implode('/', $tmp_array);
		$url = str_replace('/', '-', $url);
		$url = str_replace('_', '-', $url);
		$base = trim($p_prefix, '/');
		$filename = WWW_ROOT . $base . DS . 'js' . DS . $url . '.js';
		$usefile  =  $this->url('/' . $base . '/' . 'js' . '/' . $url . '.js');
		if (file_exists($filename))
		{
			return $this->Html->script($this->url($usefile), array('inline' => false));
		}
		return false;
	}
}