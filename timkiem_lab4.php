<?php
if (isset($_GET['timkiem'])) {
    $tim = $_GET['timkiem'];
    switch ($_GET['gia']) {
        case "1":
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ? AND (gia BETWEEN '0' AND '50000')";
            break;
        case "2":
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ? AND (gia BETWEEN '50000' AND '100000')";
            break;
        case "3":
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ? AND (gia BETWEEN '100000' AND '200000')";
            break;
        case "4":
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ? AND (gia BETWEEN '200000' AND '500000')";
            break;
        case "5":
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ? AND (gia >= '500000')";
            break;
        default:
            $sql = "SELECT * FROM sanpham WHERE tensp LIKE ?";
            break;
    }

    $stmt = mysqli_prepare($link, $sql);
    $tim2 = '%' . $tim . '%';

    if ($stmt) {        
        mysqli_stmt_bind_param($stmt, "s", $tim2);
        mysqli_stmt_execute($stmt);
        $rows = mysqli_stmt_get_result($stmt);
        $tong = mysqli_num_rows($rows);
        ?>
        <div class="sanpham">
                                            <!-- <?php echo $tim ?> -->
        <h2> Từ Khóa <font color="yellow"><b id="searchMessage"></b></font>: Có <?php echo $tong ?> kết quả</h2>
            <!-- <script>
                    var query = (new URLSearchParams(window.location.search)).get("timkiem");
                    document.getElementById("searchMessage").innerHTML = query;
            </script> -->

            <!-- Phòng ngự -->
            <script>
                    var query = (new URLSearchParams(window.location.search)).get("timkiem");
                    document.getElementById("searchMessage").innerHTML = encodeURIComponent(query);
            </script>
            <?php
           
            if ($tong > 0) {
                echo '<div class="sanphamcon">';
                while ($row = mysqli_fetch_array($rows)) {
                    ?>
                    <div class="dienthoai">
                        <?php
                        if ($row['khuyenmai1'] > 0) {
                            ?>
                            <div class="moi"><h3><?php echo $row['khuyenmai1'] . '%'; ?></h3></div>
                            <?php
                        }
                        ?>
                        <a href="chitietsp.php"><img src="img/uploads/<?php echo $row['hinhanh']; ?>"/></a>
                        <p><a href="#"><?php echo $row['tensp']; ?></a></p>
                        <h4><?php echo number_format(($row['gia'] * ((100 - $row['khuyenmai1']) / 100)), 0, ",", "."); ?></h4>
                        <div class="button">
                            <ul>
                                <li>
                                    <h1><a href="index.php?content=chitietsp&idsp=<?php echo $row['idsp'] ?>"
                                           class="chitiet">
                                            <button>Chi tiết</button>
                                        </a></h1>
                                </li>
                                <li>
                                    <h5><a href="index.php?content=cart&action=add&idsp=<?php echo $row['idsp'] ?>">
                                            <button>Cho vào giỏ</button>
                                        </a></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
    } else {
        echo "Error in preparing the statement.";
    }
}
?>
