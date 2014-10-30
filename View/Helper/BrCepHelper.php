<?php
App::uses('Helper', 'View');

class BrCepHelper extends Helper {

	public $helpers = array('DevUtils.Mask');

	public function mask($cep, $use_dot_separator = false)
	{
		$value = sprintf('%08s', $cep);
		$mask = ($use_dot_separator) ? '##.###-###' : '#####-###';
		return $this->Mask->mask($value, $mask);
	}
}