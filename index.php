<?php
	
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');

	$conn = mysqli_connect('localhost','root','password','databasename');

	if(!isset($_GET['q']) || !isset($_GET['type']) )
	{
		$detail = 'missing parameters, excepted parameter q and parameter type';
		echo '{"detail": "'.$detail.'"}';
	}
	else
	{
		handle($_GET['q'],$_GET['type']);
	}

	 function handle($q, $type) 
	 {
            switch($type) 
            {
                case 'name':
                        getRecordFromName(strtolower($q));
                        break;
                case 'id':
                        getRecordFromAccountId($q);
                        break;
                case 'txid':
                        break;
                default:
                        $this->error('Unhandled type');
                        break;
            }
      }

      function getRecordFromName($name) {
      		global $conn;
      		$query = "SELECT * from user where stellar_address='".$name."'";
      		$res = mysqli_query($conn,$query);
            if(mysqli_num_rows($res) == 0 ) 
            { 
				error('No record found', 404);
                return false; 
            }
            $data = mysqli_fetch_array($res);
            displayRecord(json_decode(json_encode($data)));
      }

      function getRecordFromAccountId($account_id) {
      		global $conn;
      		$query = "SELECT * from user where account_id='".$account_id."'";
      		$res = mysqli_query($conn,$query);
            if(mysqli_num_rows($res) == 0 ) 
            { 
				error('No record found', 404);
                return false; 
            }
            $data = mysqli_fetch_array($res);
            displayRecord(json_decode(json_encode($data)));
      }

      function displayRecord($record) 
      {
            if( $record->memo != '' ) {
                    echo '{'
                            .'"stellar_address":"'.$record->stellar_address.'",'
                            .'"account_id":"'.$record->account_id.'",'
                            .'"memo":"'.$record->memo.'",'
                            .'"memo_type":"'.$record->memo_type.'"'
                         .'}';
            } else {
                    echo '{'
                            .'"stellar_address":"'.$record->stellar_address.'",'
                            .'"account_id":"'.$record->account_id.'"'
                         .'}';
            }
      }

      function error($detail,$code=400) {
            http_response_code($code);
            echo '{"detail": "'.$detail.'"}';
      }


?>

