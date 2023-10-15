<?php

require_once('../config/config.php');

$contacts = $conn->query("SELECT * FROM contacts");
$per_page = 10;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

$offset = ($page - 1) * $per_page;

$total_records = mysqli_num_rows($conn->query("SELECT * FROM contacts"));

$query = "SELECT * FROM contacts LIMIT $offset, $per_page";
$contacts = $conn->query($query);

  

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
    </style>
</head>
<body>

  <div class="container mt-4">
        <div class="row">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Contact Method</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Message</th>
                        <th scope="col">Attach File</th>
                        <th scope="col">Agreement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $con) :?>
                    <tr>
                        <th scope="row"><?php echo $con['id']; ?></th>
                        <td><?php echo $con['user_name']; ?></td>
                        <td><?php echo $con['email']; ?></td>
                        <td><?php echo $con['phone_number']; ?></td> 
                        <td><?php echo $con['contact_method']; ?></td>
                        <td><?php echo $con['priority']; ?></td>
                        <td><?php echo $con['message']; ?></td>
                        <td><a href='../files/<?php echo $con['file_name']; ?>'><?php echo $con['file_name']; ?></a></td> 
                        <td><?php echo $con['agreement']; ?></td>               
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Добавление пагинации -->
            <nav>
                <ul class="pagination">
                    <?php
                    $total_pages = ceil($total_records / $per_page);
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>

            <a href="../index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>