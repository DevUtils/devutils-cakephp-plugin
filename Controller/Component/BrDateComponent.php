<?php
class BrDateComponent extends Component
{
	private $brMonths = array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

	public function fromSql($p_sql_date)
	{
		try
		{
			$temp1 = explode(' ', $p_sql_date);
			$temp2 = explode('-', $temp1[0]);
			$result = sprintf('%s/%s/%s', $temp2[2], $temp2[1], $temp2[0]);
			if (count($temp1) > 1)
			{
				$result = $result . ' ' . $temp1[1];
			}
			return $result;
		}
		catch(Exception $e)
		{
			return $p_sql_date;
		}
	}

	private function brDateToArray($p_br_date)
	{
		$result = array();
		try
		{
			$temp1 = explode(' ', $p_br_date);
			$temp2 = explode('/', $temp1[0]);

			$result = array($temp2[0], $temp2[1], $temp2[2]);

			if (count($temp1) > 1)
			{
				$result = array_merge($result, explode(':', $temp1[1]));
			}
			return $result;
		}
		catch(Exception $e)
		{
			return array();
		}
	}

	private function enDateToArray($p_en_date)
	{
		$result = array();
		try
		{
			$temp1 = explode(' ', $p_en_date);
			$temp2 = explode('-', $temp1[0]);

			$result = array($temp2[0], $temp2[1], $temp2[2]);

			if (count($temp1) > 1)
			{
				$result = array_merge($result, explode(':', $temp1[1]));
			}
			return $result;
		}
		catch(Exception $e)
		{
			return array();
		}
	}

	public function toSql($p_br_date)
	{
		try
		{
			$temp1 = explode(' ', $p_br_date);
			$temp2 = explode('/', $temp1[0]);
			$result = sprintf('%s-%s-%s', $temp2[2], $temp2[1], $temp2[0]);
			if (count($temp1) > 1)
			{
				$result = $result . ' ' . $temp1[1];
			}
			return $result;
		}
		catch(Exception $e)
		{
			return $p_br_date;
		}
	}

	public function longDate($p_br_en_date = null)
	{
		if (empty($p_br_en_date))
		{
			return sprintf('%s de %s de %s', date('d'), $this->brMonths[date('m')-1], date('Y'));
		}
		else
		{
			if (strpos($p_br_en_date, '/'))
			{
				$br_date_array = $this->brDateToArray($p_br_en_date);
				return sprintf('%s de %s de %s', $br_date_array[0], $this->brMonths[$br_date_array[1]-1], $br_date_array[2]);
			}
			else if (strpos($p_br_en_date, '-'))
			{
				$en_date_array = $this->enDateToArray($p_br_en_date);
				return sprintf('%s de %s de %s', $en_date_array[2], $this->brMonths[$en_date_array[1]-1], $en_date_array[0]);
			}
			else
			{
				return $p_br_en_date;
			}
		}
	}

	public function date()
	{
		return date('d/m/Y');
	}

	public function time()
	{
		return date('H:m:s');
	}

	public function dateTime()
	{
		return date('d/m/Y H:m:s');
	}

	public function sqlDate($br_date = null)
	{
		if (empty($br_date))
		{
			return date('Y-m-d');
		}
		else
		{
			$tmp_array = $this->brDateToArray($br_date);
			$result = sprintf('%s-%s-%s', $tmp_array[2], $tmp_array[1], $tmp_array[0]);
			return $result;
		}
	}

	public function sqlDateTime($br_date = null)
	{
		if (empty($br_date))
		{
			return date('Y-m-d h:m:s');
		}
		else
		{
			$tmp_array = $this->brDateToArray($br_date);
			$result = sprintf('%s-%s-%s', $tmp_array[2], $tmp_array[1], $tmp_array[0]);
			if (count($tmp_array) > 3)
			{
				$result = $result . ' ' . sprintf('%s:%s:%s', $tmp_array[3], $tmp_array[4], $tmp_array[5]);
			}
			else
			{
				$result = $result . ' 00:00:00';
			}
			return $result;
		}
	}
}