
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
</head>
<body>
  <form method="GET">
    <input name="author" placeholder="author" type="text" />
    <input name="name" placeholder="name" type="text" />
    <input name="isbn" placeholder="ISBN" type="text" />
    <button>push me</button>
  </form>
  <h1>Спиок литературы</h1>
  <?php
    error_reporting(0);
    $name = $_GET['name'] || null;
    $isbn = $_GET['isbn'] || null;
    $author = $_GET['author'] || null;
    $isFilters = $name || $isbn || $author;

    $pdo = new PDO("mysql:host=localhost; dbname=global", "filippova", "neto0936");

    $sql = "SELECT * FROM books";
    $hasPrevWhere = false;
    if ($isFilters) {
      $sql = $sql." WHERE ";
    }
    if ($name) {
      $sql = $sql." name like '%$name%'";
      $hasPrevWhere = true;
    }
    if ($isbn) {
      if ($hasPrevWhere) {
        $sql = $sql.' and ';
      }
      $sql = $sql." isbn like '%$isbn%'";
      $hasPrevWhere = true;
    }
    if ($author) {
      if ($hasPrevWhere) {
        $sql = $sql.' and ';
      }
      $sql = $sql." author like '%$author%'";
      $hasPrevWhere = true;
    }
  ?>
<table>
  <thead>
    <th>id</th>
    <th>name</th>
    <th>author</th>
    <th>year</th>
    <th>isbn</th>
    <th>genre</th>
  </thead>
  <tbody>
      <?php
      foreach ($pdo->query($sql) as $row) {
        echo  "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['author']."</td>";
        echo "<td>".$row['year']."</td>";
        echo "<td>".$row['isbn']."</td>";
        echo "<td>".$row['genre']."</td>";
        echo "</tr>";
      }
      ?>
  </tbody>
</table>
</body>
</head>

</html>
