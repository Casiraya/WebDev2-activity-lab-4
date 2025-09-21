<?php
require_once "../classes/book.php";
$bookobj = new Books();


$book = ["title"=>"", "author"=>"", "genre"=>"", "publicationyear"=>""];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $book["title"] = trim($_POST["title"] ?? "");
    $book["author"] = trim($_POST["author"] ?? "");
    $book["genre"] = trim($_POST["genre"] ?? "");
    $book["publicationyear"] = trim($_POST["publicationyear"] ?? "");

    
    if ($book["title"] === "") {
        $errors["title"] = "Title is required";
    }

    if ($book["author"] === "") {
        $errors["author"] = "Author is required";
    }

    if ($book["genre"] === "") {
        $errors["genre"] = "Please select a genre";
    }

   
    if ($book["publicationyear"] === "") {
        $errors["publicationyear"] = "Publication year is required";
    } elseif (!ctype_digit($book["publicationyear"])) {
        $errors["publicationyear"] = "Publication year must be a number";
    } elseif ((int)$book["publicationyear"] < 1000 || (int)$book["publicationyear"] > (int)date("Y")) {
        $errors["publicationyear"] = "Enter a valid year between 1000 and " . date("Y");
    }

    
    if (empty($errors)) {
        $bookobj->title = $book["title"];
        $bookobj->author = $book["author"];
        $bookobj->genre = $book["genre"];
        $bookobj->publicationyear = $book["publicationyear"];

        if ($bookobj->addbooks()) {
            header("Location: viewbook.php");
            exit;
        } else {
            echo "Failed to add book";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add Book</title>
<style>
  label { display:block; margin-top:8px; }
  .error, span { color: red; margin: 0; }
</style>
</head>
<body>
  <h1>Add Book</h1>
  <form action="" method="post">
    <label for="title">Book title <span>*</span></label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($book["title"]) ?>">
    <p class="error"><?= htmlspecialchars($errors["title"] ?? "") ?></p>

    <label for="author">Author <span>*</span></label>
    <input type="text" name="author" id="author" value="<?= htmlspecialchars($book["author"]) ?>">
    <p class="error"><?= htmlspecialchars($errors["author"] ?? "") ?></p>

    <label for="genre">Genre <span>*</span></label>
    <select name="genre" id="genre">
      <option value="">--SELECT--</option>
      <option value="history" <?= ($book["genre"] === "history") ? "selected" : "" ?>>History</option>
      <option value="science" <?= ($book["genre"] === "science") ? "selected" : "" ?>>Science</option>
      <option value="fiction" <?= ($book["genre"] === "fiction") ? "selected" : "" ?>>Fiction</option>
    </select>
    <p class="error"><?= htmlspecialchars($errors["genre"] ?? "") ?></p>

    <label for="publicationyear">Publication Year <span>*</span></label>
    <?php
      $currentYear = (int)date("Y");
      $earliestYear = 1900;
    ?>
    <select name="publicationyear" id="publicationyear">
      <option value="">--SELECT YEAR--</option>
      <?php for ($y = $currentYear; $y >= $earliestYear; $y--): ?>
        <option value="<?= $y ?>" <?= ($book["publicationyear"] == (string)$y) ? "selected" : "" ?>><?= $y ?></option>
      <?php endfor; ?>
    </select>
    <p class="error"><?= htmlspecialchars($errors["publicationyear"] ?? "") ?></p>

    <br><br>
    <input type="submit" value="Save Book">
  </form>
</body>
</html>
