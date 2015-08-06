<?php
class FileUtilsComponent extends Component
{
	/*
	$arquivo = "nomedoarquivo.inc.php";
	echo $arquivo . "<br/>";
	echo "<pre>";
	print_r(GetFileParts($arquivo));
	echo "</pre>";

	nomedoarquivo.inc.php
	Array
	(
		[name] => nomedoarquivo.inc
		[ext] => php
	)
	*/

	public function getFileParts($p_file_name)
	{
		$tmp = explode(".", $p_file_name);
		$ext = array_pop($tmp);
		$fil = substr($p_file_name, 0, ((strlen($ext)+1) * -1));
		$r = array();
		$r["name"] = $fil;
		$r["ext"]  = $ext;
		return $r;
	}
}