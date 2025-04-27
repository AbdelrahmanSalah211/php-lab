<?php
require "vendor/autoload.php";

$id = $_GET['id'];
$obj = new MySQLHandler("items");
$record = $obj->get_record_by_id($id, 'id');

if (!$record) {
  echo "Record not found.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>details</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
    }

    img {
      width: 100%;
      max-width: 250px;
      border-radius: 10px;
      display: block;
      margin: 0 auto 20px auto;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    .details {
      margin-top: 20px;
    }

    .details strong {
      display: inline-block;
      width: 100px;
      color: #555;
    }

    button {
      margin-top: 30px;
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    a {
      text-decoration: none;
    }

    .back {
      display: flex;
      justify-content: center;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Product Details</h2>
  <img src="./images/<?php echo htmlspecialchars($record->Photo); ?>" alt="product image">
  <div class="details">
    <p><strong>Name:</strong> <?php echo htmlspecialchars($record->product_name); ?></p>
    <p><strong>Price:</strong> $<?php echo htmlspecialchars($record->list_price); ?></p>
    <p><strong>Rating:</strong> <?php echo htmlspecialchars($record->Rating); ?></p>
    <p><strong>Quantity:</strong> <?php echo htmlspecialchars($record->Units_In_Stock); ?></p>
    <p><strong>Category:</strong> <?php echo htmlspecialchars($record->category); ?></p>
  </div>
  <div class="back">
    <a href="index.php"><button>Back to List</button></a>
  </div>
</div>

</body>
</html>
