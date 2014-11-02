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
		$this->url_array    = $array = explode('/', $this->url_trim);
		$this->url_section_count = count($this->url_array);
	}
	
	public function here($p_compare = null)
	{
		if (empty($p_compare))
		{
			return $this->url_original;
		}
		$temp1 = strtolower($this->url_original);
		$temp2 = strtolower(rtrim($p_compare, '/'));
		return ($temp1 == $temp2);
	}

	public function slug($p_compare = null)
	{
		$result = str_replace('/', '-', $this->url_trim);
		$result = (empty($result)) ? 'home' : $result;

		if (empty($p_compare))
		{
			return $result;
		}
		else
		{
			return (strtolower($result) == strtolower($p_compare));
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
		if ($p_quant == null)
		{
			return $this->url_section_count;
		}
		else
		{
			return $this->url_section_count == $p_quant;
		}
	}

	public function has($p_section)
	{
		$url = $this->here();
		$url = strtolower($url);
		$array = explode('/', $url);

		if (is_string($p_section))
		{
			$locate = strtolower($p_section);
			return in_array($locate, $array);
		}

		if (is_array($p_section))
		{
			foreach ($p_section as $key => $section)
			{
				$locate = strtolower($section);
				if (in_array($locate, $array))
				{
					return true;
				}
			}
			return false;
		}
	}

	public function level($p_level)
	{
		$url = $this->here();
		$url = trim($url, '/');
		$array = explode('/', $url);
		$use_level = $p_level;
		if (empty($use_level)) { $use_level = 1; }
		if (strtolower($use_level) === 'first') { $use_level = 1; }
		if (strtolower($use_level) === 'last')
		{
			$use_level = count($array);
		}
		if (!empty($array[$use_level-1]))
		{
			return $array[$use_level-1];
		}
		return '';
	}

	public function firstLevel()
	{
		return $this->level(1);
	}

	public function lastLevel()
	{
		$url = $this->here();
		$array = explode('/', $url);
		if (!empty($array[count($array)-1]))
		{
			return $array[count($array)-1];
		}
		return '';
	}
}