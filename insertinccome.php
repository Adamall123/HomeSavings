<?session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "connect.php";
	
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
			}
			else {
				if(isset($_POST['insertincome'])){
					$all_OK = true;
					$fincome = $_POST['fincome'];
					$result = $connection->query("SELECT name FROM incomes_category_assigned_to_users WHERE name='$fincome'");
					if(!$result) throw new Exception($connection->error);
					$amount_of_category_income = $result->num_rows;
					if($amount_of_category_income > 0){
						$all_OK = false;
						echo  "The written category exist in your app!";
					}
					
					if($all_OK){
						if($connection->query("INSERT INTO incomes_category_assigned_to_users VALUES(NULL,'$user_loggedin_id','Youtube')"))
						{
							
						}
					}
				}
				else {
					throw new Exception($connection->error);
				}
				$connection->close();
			}
		
	}
	catch(Exception $e){
		echo '<span style="color:red;">Error server! We are sorry for all inconveniences and please register in another time</span>';
	}