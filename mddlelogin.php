
 <?php
//grabbing json from frontend
$str_json = file_get_contents('php://input'); 
//decoding json into response array
$response = json_decode($str_json, true); 
//initial setting of variables

$requestType= $response["requestType"];
$username=$response["username"];
$password=$response["password"];


// curl backend 

	//data from json response
	$data = array('requestType' => $requestType, 'username' => $username,'password' =>$password);
	//url to backend
	$url = "https://web.njit.edu/~rn273/CS490/back.php";
	//initialize curl session and return a curl handle
	$ch = curl_init($url);
	//options for a curl transfer
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, true));
	//execute curl session
	$response = curl_exec($ch);
	//close curl session
 $json = json_decode($response, true);
      $role = $json['role'];
      if($json['message'] == "Verified"){
          $arr = array('message' => "Verified", 'role' => $role);
          $data = json_encode($arr);
          echo $data;
      }
      else{
          $arr = array('message' => "Rejected", 'error' => 'Invalid');
          $data = json_encode($arr);
          echo $data;
      }
	curl_close ($ch);
	//return response
	//echo $response;

?>
 
