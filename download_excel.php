<?php error_reporting(0); 
	header("Content-type: application/ms-excel");
	header("Content-Disposition: attachment; filename=$_GET[filename].xls");
	include "koneksi/koneksi.php";
	
	$new_sql = $_GET["new_sql"];
	
	if($_GET["page"] && $_GET["limit"])
	{
		$mulai = ($_GET["page"] * $_GET["limit"]) - $_GET["limit"];
		$query = $pdo->query("select * from $_GET[table] {$new_sql} limit $mulai,$_GET[limit]");
	}else 
	{
		$query = $pdo->query("select * from $_GET[table] {$new_sql}");
	}
    
    $query_header = $pdo->query("select * from $_GET[table] limit 1");
	
	$data_excel_excel = "";							
	while($data_excel = $query_header->fetch(PDO::FETCH_ASSOC)) 
	{
		// print_r($data_excel);
		foreach ($data_excel as $key2 => $value2) 
		{
			$data_excel_excel .= ucwords(str_replace("_", " ", $key2)) . "\t";
		}
			$data_excel_excel .= "\n";
	}
	
	
	while ($data_excel2 = $query->fetch(PDO::FETCH_ASSOC)) {
		foreach ($data_excel2 as $key2 => $value2) {
			$data_excel_excel .= "$value2\t"; 
		}
			$data_excel_excel .= "\n";
	}
	
	echo $data_excel_excel;
     ?>