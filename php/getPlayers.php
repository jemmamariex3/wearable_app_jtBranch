<?php
  $conn = 0;

//########################################
//### CONNECT AND DISCONNECT FUNCTIONS ###
//########################################

  function connect()
  {
    global $conn;
    $servername = "localhost";
    $username = "wearteam";
    $password = "w3@r@b!e5";
    $dbname = "wearables";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);

  }

  function disconnect()
  {
    global $conn;
    $conn->close();
  }

//########################################
//### GET LATEST AND ALL GSR FUNCTIONS ###
//########################################

  function getLatestGSRForPlayer($player)
  {
    global $conn;
    $gsr = -1;
    $stmt = $conn->prepare("SELECT data, time FROM gsr_rate_table WHERE ID = ? ORDER BY time DESC LIMIT 1");
    $stmt->bind_param('i', $player);
    if($stmt->execute()) {
      $stmt->bind_result($data, $time);
      while($row = $stmt->fetch())
      {
        $gsr = $data;
      }
    }
    $stmt->close();
    return $gsr;
  }

  function getAllGSRForPlayers()
  {
    global $conn;
    $sql = "SELECT id, data, time FROM gsr_rate_table ORDER BY time DESC";
    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0)
    {
      //output data of each row
      for($i = 1; $row = $result->fetch_assoc(); $i++)
        $array[] = "ID: " . $row["id"] . " - Data: " . $row["data"] . " - Time " . $row["time"]. "<br>";
    }
    else
      echo "0 results " . $conn->error;

    $result->close();
    return $array;
  }

//###############################################
//### GET LATEST AND ALL HEART RATE FUNCTIONS ###
//###############################################

  function getLatestHRForPlayer($player)
  {
    global $conn;
    $hr = -1;
    $stmt = $conn->prepare("SELECT data, time FROM heart_rate_table WHERE ID = ? ORDER BY time DESC LIMIT 1");
    $stmt->bind_param('i', $player);
    if($stmt->execute()) {
      $stmt->bind_result($data, $time);
      while($row = $stmt->fetch())
      {
        $hr = $data;
      }
    }
    $stmt->close();
    return $hr;
  }

  function getAllHRForPlayers()
  {
    global $conn;
    $sql = "SELECT id, data, time FROM heart_rate_table ORDER BY time DESC";
    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0)
    {
      //output data of each row
      for($i = 1; $row = $result->fetch_assoc(); $i++)
        $array[] = "ID: " . $row["id"] . " - Data: " . $row["data"] . " - Time " . $row["time"]. "<br>";
    }
    else
      echo "0 results " . $conn->error;

    $result->close();
    return $array;
  }

//##############################################
//### GET LATEST AND ALL SKIN TEMP FUNCTIONS ###
//##############################################

  function getLatestSkinTempForPlayer($player)
  {
    global $conn;
    $temp = -1;
    $stmt = $conn->prepare("SELECT data, time FROM skin_temp_table WHERE ID = ? ORDER BY time DESC LIMIT 1");
    $stmt->bind_param('i', $player);
    if($stmt->execute()) {
      $stmt->bind_result($data, $time);
      while($row = $stmt->fetch())
      {
        $temp = $data;
      }
    }
    $stmt->close();

    if ($temp != -1)  // convert from Celsius to Fahrenheit
    {
      $temp = $temp * 9 / 5 + 32;
    }
    return $temp;
  }

  function getAllSkinForPlayers()
  {
    global $conn;
    $sql = "SELECT id, data, time FROM skin_temp_table ORDER BY time DESC";
    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0)
    {
      //output data of each row
      for($i = 1; $row = $result->fetch_assoc(); $i++)
        $array[] = "ID: " . $row["id"] . " - Data: " . $row["data"] . " - Time " . $row["time"]. "<br>";
    }
    else
      echo "0 results " . $conn->error;

    $result->close();
    return $array;
  }

  function getPlayerAddresses()
  {
    global $conn;
    $sql = "SELECT time, ip FROM players ORDER BY time ASC";
    $result = $conn->query($sql);
    $array = array();
    if ($result->num_rows > 0)
    {
      //output data of each row
      for($i = 1; $row = $result->fetch_assoc(); $i++)
        $array[] = $row["time"] . " : " . $row["ip"];
    }
    else
      echo "0 results " . $conn->error;

    $result->close();
    return $array;
  }

  function getMyIpAddress()
  {
    global $conn;
    $myIp = $_SERVER['REMOTE_ADDR'];
    return $myIp;
  }

  function getLatestALForPlayer($player)
  {
    global $conn;
    $al = -1;
    $stmt = $conn->prepare("SELECT data, time FROM ambient_light_table WHERE ID = ? ORDER BY time DESC LIMIT 1");
    $stmt->bind_param('i', $player);
    if($stmt->execute()) {
      $stmt->bind_result($data, $time);
      while($row = $stmt->fetch())
      {
        $al = $data;
      }
    }
    $stmt->close();

    return $al;
  }

  function getLatestACForPlayer($player)
  {
    global $conn;
    $ac = -1;
    $stmt = $conn->prepare("SELECT dataX, dataY, dataZ, time FROM accelerometer_table WHERE ID = ? ORDER BY time DESC LIMIT 1");
    $stmt->bind_param('i', $player);
    if($stmt->execute()) {
      $stmt->bind_result($dataX, $dataY, $dataZ, $time);
      while($row = $stmt->fetch())
      {
        $ac = "X: " . $dataX . " Y: " . $dataY . " Z: " . $dataZ;
      }
    }
    $stmt->close();

    return $ac;

  }

//######### MAIN code of web service#########

  connect(); // to DB


  $func    = isset($_REQUEST['func']) ? mysqli_real_escape_string($conn, $_REQUEST['func']) : "";
  $player  = isset($_REQUEST['player']) ? mysqli_real_escape_string($conn, $_REQUEST['player']) : 0;

  error_log("func is $func and player is $players");

  $response = 0;

  switch($func) {
    case 'gsr' :
      $response = getLatestGSRForPlayer($player); break;
    case 'hr' :
      $response = getLatestHRForPlayer($player); break;
    case 'skintemp' :
      $response = getLatestSkinTempForPlayer($player); break;
    case 'al' :
      $response = getLatestALForplayer($player); break;
    case 'ac' :
      $response = getLatestACForplayer($player); break;
    case 'allHR' :
      $response = getAllHRForPlayers(); break;
    case 'allSkin' :
      $response = getAllSkinForPlayers(); break;
    case 'allGSR' :
      $response = getAllGSRForPlayers(); break;
    case 'getPlayers' :
      $response = getPlayerAddresses(); break;
    case 'getMyIp' :
      $response = getMyIpAddress(); break;
    default :
      break; // and do nothing else, as the response JSON will be default (0)
  }

  header('Content-Type: application/json; charset=utf-8');
  $responseJSON = json_encode($response);

  echo $responseJSON;

  disconnect(); // from DB
?>
