<?php 

if($_GET["media"] == "delete")
{
	$query = $this->db->query("delete from $_GET[table] where id=$_GET[id]");
	if($query)
	{
		echo "<script>alert('berhasil menghapus data dengan id $_GET[id]');</script>";
	}else
	{
		echo "<script>alert('gagal menghapus data dengan id $_GET[id]');</script>";
	}
}

 ?>