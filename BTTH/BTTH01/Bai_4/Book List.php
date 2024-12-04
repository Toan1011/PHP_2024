<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
</head>
<body>
<h2>Book List</h2>
<?php
$books = getAllBooks(); // Assume this function fetches books from the database
echo "<ul>";
foreach ($books as $book) {
    echo "<li>" . htmlspecialchars($book['Title']) . " - " . htmlspecialchars($book['Genre']) . " (" .
        htmlspecialchars($book['PublishedYear']) . ")</li>";
}
echo "</ul>";
?>
</body>
</html>