<?php
  require_once "../config/config.php";
  require_once '../mail/vendor/autoload.php';
  $settings = require_once '../mail/settings.php';
  require_once '../mail/function.php';

  if(!$conn){
    die("Connection failed " . mysqli_connect_error());
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
  $name = trim($_REQUEST['name']);
  $email = trim($_REQUEST['email']);

  if (isset($_REQUEST['agreement']) && $_REQUEST['agreement']) {
    $agreement = 'yes';
  } else {
      $agreement = 'no';
  }

  $contact_method = trim($_REQUEST['contact_method']);
  $priority = trim($_REQUEST['priority']);
  $message = trim($_REQUEST['message']);
  $phone = trim($_REQUEST['tel']);
  $attachment = $_FILES['file']['name'];
  $upload_dir = '..\files\\';

  move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir.$attachment);

  $query = "INSERT INTO contacts (user_name, email, agreement, contact_method, priority, message, file_name, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssssssss", $name, $email, $agreement, $contact_method, $priority, $message, $attachment, $phone);
  if ($stmt->execute()) {
   
    $stmt->close();
    $body = "<h1>Name: $name</h1>\n" . '<br>' . "Email: $email" . '<br>' . "Phone Number: $phone" . '<br>' . "Message: $message" . '<br>' . "Contact Method: $contact_method" . '<br>' . "Priority: $priority" . '<br>' . "Agreement: $agreement";
        $attachments = [
            $upload_dir . $attachment,
        ];
        send_mail($settings['mail_settings_prod'], ['timurxasanov022@gmail.com'], 'Application', $body, $attachments);
    } else {
        
        echo "Ошибка при выполнении запроса: " . $stmt->error;
    }
}

  $contacts = $conn->query("SELECT * FROM contacts");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Contact Us - Support Service</title>
    <style>
        /* Add some simple animations */
        body {
            background-color: #f5f5f5;
        }
        .container {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            transition: box-shadow 0.3s ease;
        }
        .form-control {
            border: 2px solid #d1d1d1;
            transition: border 0.3s ease;
        }
        .form-control:focus {
            border-color: #80c7e7;
            box-shadow: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary {
            background-color: #80c7e7;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #5ca6c4;
            transition: background-color 0.3s ease;
        }
        .btn-secondary {
            background-color: #f0f0f0;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #d0d0d0;
            transition: background-color 0.3s ease;
        }
        /* Add animation to form elements */
        .form-group {
            transform: scale(1);
            transition: transform 0.3s ease;
        }
        .form-group:focus-within {
            transform: scale(1.02);
            transition: transform 0.3s ease;
        }
        /* Customize the checkboxes and radios */
        .form-check-input:checked + .form-check-label::before {
            border-color: #80c7e7;
            background-color: #80c7e7;
        }
        .form-check-input:checked + .form-check-label::after {
            color: #fff;
        }
        /* Customize the select dropdown */
        .form-select {
            border: 2px solid #d1d1d1;
        }
        .form-select:focus {
            border-color: #80c7e7;
        }
        .text-center{
          margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="alert alert-success" role="alert">
        Your application has been successfully sent!
    </div>
    <div class="container mt-4">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    
                    <h6 class="card-title"><?php echo $name ?></h6>
                    
                    <p class="card-text">Message: <?php echo $message ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Email: <?php echo $email ?></li>
                    <li class="list-group-item">Phone Number: <?php echo $phone ?></li>
                    <li class="list-group-item">Prioriyt: <?php echo $priority ?></li>
                    <li class="list-group-item">File: <?php echo $attachment ?></li>
                </ul>
                <div class="card-body">
                    <a href="../index.php" class="btn btn-primary">Back to Home</a>
                    <a href="../all_results/all_results.php" class="btn btn-primary">See All Results</a>
                </div>
            </div>
        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    </body>
</html>