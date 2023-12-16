<!DOCTYPE html>
<html lang="en">
<head>
    <title>XSS Demo</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra xem người dùng đã ấn submit hay chưa
        if(isset($_POST['input'])) {
            // In nội dung của trường input
            echo $_POST['input'];
        } else {
            // Nếu không có giá trị, thông báo cho người dùng
            echo "Vui lòng nhập dữ liệu vào trường input.";
        }
    }
    ?>
    <form action="" method="post">
        <input type="text" name="input">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
