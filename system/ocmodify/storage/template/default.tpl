<!DOCTYPE HTML>
<html>
  <head>
  	<meta http-equiv="content-type" content="text/html" />

  	<title><?php echo $title; ?></title>
    
    <style type="text/css">
    .box {
      margin: 0px auto;
      padding: 20px;
      width: 75%;
    }
    
    .box p {
      margin: 0px;
    }
    
    .alert {
      margin: 10px 0px;
      padding: 20px;
      border-radius: 5px;
      color: white;
    }
    
    .warning {
      background-color: #ff9800;
    }
    
    .error {
      background-color: #f44336;
    }
    
    .success {
      background-color: #4CAF50;
    }
    
    .info {
      background-color: #2196F3;
    }
    </style>
  </head>
  <body>
    <div class="box">
      <?php foreach($messages as $message) { ?>
      <div class="alert <?php echo $message['type']; ?>">
        <p><?php echo $message['text']; ?></p>
      </div>
      <?php } ?>
    </div>
  </body>
</html>