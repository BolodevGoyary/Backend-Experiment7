<?php
include "db_connect.php";
$search = "";
$stmt = $conn->prepare("SELECT * FROM posts WHERE title LIKE ?");
$searchTerm = "%$search%";
if (isset($_GET["q"])) $searchTerm = "%".$_GET["q"]."%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<body>
<h2>Search Posts</h2>
<form method="GET">
<input type="text" name="q" placeholder="Search title">
<button type="submit">Search</button>
</form>
<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Title</th>
<th>Content</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["title"]; ?></td>
<td><?php echo $row["content"]; ?></td>
</tr>
<?php } ?>
</table>
</body>
</html>