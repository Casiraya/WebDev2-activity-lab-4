<?php
require_once "../classes/book.php";
$bookobj = new Books();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View book</title>
</head>
<body>
     <h1>Book list</h1>
     <button><a href="addbook.php">Add Book</a></button>
    <table border="1">
        <tr>
            <th>No.</th>
            <th>title</th>
            <th>author</th>
            <th> Genre</th>
            <th> PublicationYear</th>
        </tr>
        <?php
        foreach($bookobj->viewBooks() as $book){
        ?>
        <tr>
            <td><?= $book["id"] ?></td>
            <td><?= $book["title"]?></td>
            <td><?= $book["author"]?></td>
            <td><?= $book["genre"]?></td>
            <td><?= $book["publicationyear"]?></td>
        </tr>
        <?php
        }
        ?>
        </table>
</body>
</html>