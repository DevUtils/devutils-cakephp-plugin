<?php
App::uses('Helper', 'View');

class UrlHelper extends Helper
{
	public $helpers = array('Html');

	protected $url_original;
	protected $url_trim;
	protected $url_array;
	protected $url_section_count;

	public function __construct(View $View, $settings = array())
	{
		parent::__construct($View, $settings);
		$here = $this->request->here;
		$this->url_original = rtrim($here, '/');
		$this->url_trim     = trim($here, '/');
		$this->url_array    = explode('/', $this->url_trim);
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
		if ($p_quant === null)
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
		$tmp_array = explode('/', $url);

		if (is_string($p_section))
		{
			$locate = strtolower($p_section);
			return in_array($locate, $tmp_array);
		}

		if (is_array($p_section))
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
		return false;
	}

	public function level($p_level)
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
			return $tmp_array[$use_level-1];
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
		$tmp_array = explode('/', $url);
		if (!empty($tmp_array[count($tmp_array)-1]))
		{
			return $tmp_array[count($tmp_array)-1];
		}
		return '';
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