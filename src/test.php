<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .row:nth-child(even) {
      background-color: red;
    }
    .row:nth-child(odd) {
      background-color: blue;
    }
    .row:hover {
      color: pink;
    }
  </style>
</head>
<body>
  <?php 
    $con = mysqli_connect("localhost",'','',"store");
    $query = "SELECT * FROM Book_Store";
    if($result = mysqli_query($con, $query)){
      if(mysqli_num_rows($result) > 0){
        echo "<table>";
          echo "<tr>"; 
            echo "<th>BookId</th>";
            echo "<th>Title</th>";
            echo "<th>Category</th>";
            echo "<th>Price</th>";
          echo "<tr>";
          while($row = mysqli_fetch_array($result)){
            echo "<tr class='row'>";
              echo "<td>{$row['BookId']}</td>";
              echo "<td>{$row['Title']}</td>";
              echo "<td>{$row['Category']}</td>";
              echo "<td>{$row['Price']}</td>";
            echo "<tr>";
        echo "</table>";
          }
      }
    }
  ?>
</body>
</html>