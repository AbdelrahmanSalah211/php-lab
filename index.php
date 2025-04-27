<?php

require "vendor/autoload.php";

$obj = new MySQLHandler("items");

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$start = ($page - 1) * $limit;

$search = isset($_POST['search']) ? $_POST['search'] : '';
$records = $obj->get_data([], $start, $limit, $search);
$total_records = $obj->get_total_records($search);
$total_pages = ceil($total_records / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glasses</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      width: 80%;
      display: flex;
      flex-direction: column;
      justify-self: center;
      align-items: center;
    }

    h2 {
      text-align: center;
      color:  #4CAF50;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      
    }

    th, td {
      text-align: center;
      padding: 15px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    img {
      border-radius: 8px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 4px;
    }

    button:hover {
      background-color: #45a049;
    }

    a {
      text-decoration: none;
    }
  </style>
</head>
<body>

<h2>Available Glasses</h2>

<form method="POST" action="">
  <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by product name">
  <button type="submit">Search</button>
  <button type="submit" name="search" value="">Show All</button>
</form>

<table cellpadding="10" cellspacing="0">
  <thead>
    <tr>
      <th>Image</th>
      <th>Name</th>
      <th>Details</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($records as $record): ?>
      <tr>
        <td>
          <img src="./images/<?php echo htmlspecialchars($record->Photo); ?>" alt="Item Image" width="100px">
        </td>
        <td><?php echo htmlspecialchars($record->product_name); ?></td>
        <td>
          <a href="details.php?id=<?php echo $record->id; ?>">
            <button>View Details</button>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div>
  <?php if ($page > 1): ?>
    <a href="?page=<?php echo $page - 1; ?>"><button>Previous</button></a>
  <?php else: ?>
    <button disabled>Previous</button>
  <?php endif; ?>

  <span>Page <?php echo $page; ?> of <?php echo $total_pages; ?></span>

  <?php if ($page < $total_pages): ?>
    <a href="?page=<?php echo $page + 1; ?>"><button>Next</button></a>
  <?php else: ?>
    <button disabled>Next</button>
  <?php endif; ?>
</div>

</body>
</html>
