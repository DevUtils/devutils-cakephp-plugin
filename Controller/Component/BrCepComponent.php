<?php
class BrCepComponent extends Component
{
	public $components = array('DevUtils.Mask');
	
	public function mask($cep, $use_dot_separator = false)
	{
		$value = sprintf('%08s', $cep);
		$mask = ($use_dot_separator) ? '##.###-###' : '#####-###';
		return $this->Mask->mask($value, $mask);
	}
}