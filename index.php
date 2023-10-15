<?php

  require_once "./config/config.php";
  if(!$conn){
    die("Connection failed " . mysqli_connect_error());
  }

  $contacts = $conn->query("SELECT * FROM contacts");
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Contact Us - Support Service</title>
    <style>
        /* Add some simple animations */
        body {
            background-color: #f5f5f5;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
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
            background-color: #d0d0d0;
            border: none;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #7c7b7b;
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
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-12">
                <h1 class="text-center mb-4">Contact Us</h1>
                <form enctype="multipart/form-data" action="./result/result.php" method="POST" ">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                      <label for="tel" class="form-label">Phone Number</label>
                      <input type="number" class="form-control" id="tel" name="tel" required>
                    </div>
                      
                      
                      <div class="mb-3">
                        <label class="form-check-label d-block">Contact Method</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="contact_email" name="contact_method" value="Email" required>
                            <label for="contact_email" class="form-check-label">Email</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="contact_phone" name="contact_method" value="Phone" required>
                            <label for="contact_phone" class="form-check-label">Phone</label>
                        </div>
                        
                    </div>


                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" name="priority" required>
                            <option value="" disabled selected>Select priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">Attach File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label d-block">Do you agree with our rules?</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="option1" name="agreement" value="yes">
                            <label for="option1" class="form-check-label">Yes I agree.</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="../all_results/all_results.php" class="btn btn-primary">See All Results</a>
                    </div>
                </form>
          </div>
        </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>