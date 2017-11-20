<?php 
class Procedural
{
	protected $CI;
	
	public function __construct()
	{
		$this->pdo = new PDO("mysql:host=localhost;dbname=db_pln", "root", "");
	}
	
	function escape_array($escape)
	{
		foreach ($escape as $key => $value) {
			$escape["$key"] = addslashes($escape["$key"]);
			$escape["$key"] = str_replace("!", "", $escape["$key"]);
		}

		return $escape;
	}
	
	function escape_str(&$escape)
	{
		$escape = addslashes($escape);
		$escape = str_replace("!", "", $escape);

		return $escape;
	}
	
	function pagination($url, $table, $new_query = "", $new_sql = "")
	{
		echo '<div class="row"><div class="col-md-12">
			<ul class="pagination pagination-sm">
				<li ><a style="background: #333; color: white; font-weight: bolder; cursor: default;">Page:: </a></li>';

				$query_row = $this->pdo->query("select * from $table {$new_sql}");

				if($_GET["page"] > 1)
				{
					$prev = $_GET["page"] - 1;

					echo "<li ><a href='$url?page=$prev{$new_query}' style='background: #333; color: white; font-weight: bolder;'>&lArr;</a></li>";
				}

				for($i = 1; $i <= ceil($query_row->rowCount() / 20); $i++)
				{
					if($_GET["page"] == $i)
					{
						echo "<li   class='active'><a href='$url?page=$i{$new_query}'>$i</a></li>";
						
					}
					else
					{
						echo "<li><a href='$url?page=$i{$new_query}'>$i</a></li>";
					}
				}


				if($_GET["page"] * 20 < $query_row->rowCount())
				{
					$next = $_GET["page"] + 1;
					echo "<li ><a href='$url?page=$next{$new_query}' style='background: #333; color: white; font-weight: bolder;'>&rArr;</a></li>";
				}

				echo "<li ><a style='background: #333; color: white; font-weight: bolder; cursor: default;'>Of: " . ceil($query_row->rowCount() / 20) . ", " . "Total {$query_row->rowCount()} Data</a></li>
			</ul>
		 </div></div>";
	}
	
	function table($table, $limit = 20, $new_sql = "")
	{
		
		echo '<div class="row"><div class="table-responsive">
			<table class="table filter_data">
				<thead>
					<tr>';
					
						$query = $this->CI->db->query("select * from $table limit 1");
						
						foreach ($query->result_array() as $key => $value) 
						{
							foreach ($value as $key2 => $value2) 
							{
								echo "<th>" . ucwords(str_replace("_", " ", $key2)) . "</th>";
							}
						}
						
					echo '</tr>
				</thead>
				<tbody>';
				
					if($_GET["page"])
					{
						$mulai = ($_GET["page"] * $limit) - $limit;
					}else 
					{
						$mulai = 0;
					}
					
					$query = $this->CI->db->query("select * from $table {$new_sql} limit $mulai,$limit");
					
					foreach ($query->result() as $key => $value)
					{
						echo "<tr>";
						foreach ($value as $key2 => $value2)
						{
							echo "<td>$value2</td>";
						}
						echo "</tr>";
					}
					
			echo	'</tbody>
			</table>
		</div></div>';
	}
	
	function toggle_edit()
	{
		$query = $this->CI->db->query("select * from tbl_toggle_edit order by id desc limit 1");
		
		return $query->result()[0]->toggle_edit == "true";
	}
	
	function login()
	{
		if($_POST["username"] && $_POST["password"])
		{
			$username = $_POST["username"];
			$password = $_POST["password"];
		}else
		{
			$username = "Username";
			$password = "Password";
		}

		if(isset($_COOKIE["username"]) || isset($_COOKIE["session"]))
		{
			setcookie("username", "", time() - 1, "/");
			setcookie("password", "", time() - 1, "/");
			location("login");
			
		}else if(isset($_POST["username"]) && isset($_POST["password"]))
		{
			$_POST = $this->escape_array($_POST);
			
			$query = $this->CI->db->where("username", $_POST["username"])->where("password", $_POST["password"])->get("tbl_login");

			if($query->num_rows() < 1)
			{
				alert("Kombinasi username atau password salah");
			}else
			{
				setcookie("username", $query->result()[0]->username, "/");
				setcookie("session", $query->result()[0]->session, "/");
				
				if($query->result()[0]->session == "user")
				{
					location("user");
				}else if($query->result()[0]->session == "admin")
				{
					location("admin");
				}
			}
		}

		echo <<<EOD
				<div class="container">
					<div class="">
						<div class="col-md-6 col-md-offset-3">
							<form class="" action="" method="post">

								<div class="form-group">
									<div class="row">
										<div class="col-md-12">
											<h2 class="text-center">Login user dan admin</h2>
										</div>
									</div>
								</div>

								<fieldset>
									<legend>Login Form:</legend>
									<div class="form-group">
										<input class="form-control" type="" name="username" placeholder="Username" maxlength="30" value="$username">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" placeholder="Password" maxlength="30" value="$password">
									</div>

									<input type="hidden" name="table" value="tbl_login">

									<div class="form-group">
										<div class="row">
											<div class="col-md-6">
												<button class="btn btn-primary btn-block" type="submit">
													Login
													<span class="glyphicon glyphicon-log-in"></span>
												</button>
											</div>
											<!--- <div class="col-md-4">
												<button class="btn btn-info btn-block" type="button" data-toggle="modal" data-target="#registerModal">
													Register
													<span class="glyphicon glyphicon-registration-mark"></span>
												</button>
											</div> -->
											<div class="col-md-6">
												<button class="btn btn-warning btn-block" type="reset">
													Reset
													<span class="glyphicon glyphicon-refresh"></span>
												</button>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>

EOD;
	}


	}


 ?>