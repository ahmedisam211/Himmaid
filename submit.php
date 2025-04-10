<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>شارك بمحتوى</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'navbar.php'; ?>

  <main>
    <h2>شارك بمحتوى أرشيفي</h2>
    <form method="POST" enctype="multipart/form-data">
      <label>الاسم:</label><br>
      <input type="text" name="name"><br><br>

      <label>نوع المحتوى:</label><br>
      <select name="content_type">
        <option>قصيدة</option>
        <option>صوت</option>
        <option>فيديو</option>
        <option>صورة</option>
      </select><br><br>

      <label>رفع الملف:</label><br>
      <input type="file" name="file"><br><br>

      <label>ملاحظات:</label><br>
      <textarea name="notes" rows="4"></textarea><br><br>

      <button type="submit">إرسال</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = $_POST['name'];
      $type = $_POST['content_type'];
      $notes = $_POST['notes'];
      $file = $_FILES['file']['name'];

      move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file);

      $stmt = $conn->prepare("INSERT INTO submissions (name, content_type, file_path, notes) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("ssss", $name, $type, $file, $notes);
      $stmt->execute();

      echo "<p>تم الإرسال بنجاح!</p>";
    }
    ?>
  </main>

  <footer>
    <p>&copy; 2025 جميع الحقوق محفوظة</p>
  </footer>
</body>
</html>
