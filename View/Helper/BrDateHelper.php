<?php
App::uses('Helper', 'View');

class BrDateHelper extends Helper
{
	public function fromSql($p_sql_date)
	{
		try
		{
			$temp1 = explode(' ', $p_sql_date);
			$temp2 = explode('-', $temp1[0]);
			$result = sprintf('%s/%s/%s', $temp2[2], $temp2[1], $temp2[0]);
			if (count($temp1) > 1)
			{
				$result .= ' ' . $temp1[1];
			}
			return $result;
		}
		catch(Exception $e)
		{
			return $p_sql_date;
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
				$result .= ' ' . $temp1[1];
			}
			return $result;
		}
		catch(Exception $e)
		{
			return $p_br_date;
		}
	}

	public function brDate()
	{
		return date('d/m/Y');
	}

	public function brDateTime()
	{
		return date('d/m/Y H:m:s');
	}

	public function sqlDate()
	{
		return date('Y-m-d');
	}

	public function sqlDateTime()
	{
		return date('Y-m-d H:m:s');
	}
}