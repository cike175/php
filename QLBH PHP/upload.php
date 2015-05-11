<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <script type="text/javascript">
            function goBack(s)
            {
                window.close();
            }
        </script>
        <style type="text/css">
            body{
                background-color: #94CB32;
                color: #fff;
            }
            .error
            {
                font-weight:bold;
                color: #575757;
            }

            .success
            {
                font-weight:bold;
                color:#575757;
            }
        </style>
    </head>

    <body>
        <?php
        $id;
        if (isset($_POST["btnUpload"])) {
            error_reporting(0);
            if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 500000)) {
                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                } else {
                    echo "<strong>Upload: </strong>" . $_FILES["file"]["name"] . "<br />";
                    echo "<strong>Kiểu dữ liệu: </strong>" . $_FILES["file"]["type"] . "<br />";
                    echo "<strong>Kích thước: </strong>" . ($_FILES["file"]["size"] / 1024) . " KB<br />";
                    echo "<strong>File tạm.: </strong>" . $_FILES["file"]["tmp_name"] . "<br /><br />";

                    $targetDir = "images/products/" . $_GET["id"];
                    mkdir($targetDir, 0777);
                    $relativePath = $targetDir . "/" . $_FILES["file"]["name"];
                    if (file_exists($relativePath)) {
                        echo "<div class='error'>" . $_FILES["file"]["name"] . " Đã tồn tại.</div>";
                        echo "<br/>";

                        echo "<a class='btn'href='" . $_SERVER['PHP_SELF'] . "?id=" . $_GET["id"] . "'>Thử lại</a> ";
                        echo "<a class='btn' href='#' onClick='window.close();'>Đóng</a>";
                    } else {
                        move_uploaded_file($_FILES["file"]["tmp_name"], $relativePath);
                        echo "<span class='success'>Upload thành công. Lưu trữ trong: </span><span class='error'>" . $relativePath . "</span><br />";
                        echo "<br/>";

                        echo "<a class='btn' href='#' onClick='goBack(\"" . $relativePath . "\");'>Close</a>";
                    }
                }
            } else {
                echo "File không hợp lệ.";
            }
        } else {
            ?>
            <?php
            if (isset($_GET["id"]))
                $id = $_GET["id"];
            ?>
            <form action="upload.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" name="frmUpload" id="frmUpload">
                <table width="350" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:30px;">
                    <tbody>
                        <tr>
                            <td >Chọn hình:</td>
                            <td><input class="btn" type="file" name="file" id="file"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input class="btn" type="submit" name="btnUpload" id="btnUpload" value="Upload"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php
        }
        ?>
        Các hình ảnh trong thư mục<br/>
        <?php
        $path = "images/products/" . $_GET["id"];
        if (is_dir($path)) {
            $filepath = scandir($path);
            foreach ($filepath as $value) {
                if($value !== "." and $value !== ".."){
                echo $path."/".$value . "<br/>";
                }
            }
        }
        ?>
    </body>
</html>