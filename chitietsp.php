<?php
    $idsp=$_GET['idsp'];
    $rows=mysqli_query($link,"Select * from sanpham where idsp=$idsp");
    while($row=mysqli_fetch_array($rows))
    {
?>
    <div class="chitietsp">
        <div class="chitietsp-in">
            <div class="content">
                <div class="zoom-small-image">
                    <a href = 'img/uploads/<?php echo $row['hinhanh']; ?>' width = "300" height = "300" class='cloud-zoom' id='zoom1'
                    rel="adjustX: 10, adjustY: -4">
                        <img  src="img/uploads/<?php echo $row['hinhanh'] ?>" width="250" height="250" title="Optional title display" />
                    </a>
                    
                </div>
                <!-- End : zoom -->
                
                <div class="giasp">
                    <ul>
                        <p><?php echo $row['tensp']; ?></p>
                        <li><span><b>Giá: 
                            <font color="red">
                                <?php echo number_format(($row['gia']*((100-$row['khuyenmai1'])/100)),0,",",".");?>
                            
                        </b></font></span></li>
                        <li>Tình Trạng
                            <?php
                                $dem = $row['soluong'] - $row['daban'];
                                if($dem>0)
                                    echo "Số sản phẩm còn (".$dem.")";
                                else
                                    echo "Hết hàng";
                            ?>
                        </li>
                        <form action="index.php?content=cart&action=add&idsp=<?php echo$row['idsp']; ?>" method="post">
                            <li>Số lượng mua: <input type="text" name="soluongmua" size="1" value="1"/></li>
                            <li>
                                <?php
                                if($dem <=0)
                                    echo "<a href='index.php?content=hethang'></a>";
                                else
                                {
                                ?>
                                <input type="submit" value="Cho vào giỏ" name="chovaogio" class="inputmuahang" />
                                <?php } ?>
                            </li>
                        </form>
                    </ul>
                </div>
                <!-- End : Giá sản phẩm -->
                
            </div>
            <!--End: Content -->
            
            <div class="tinhnang">
                <div class="tieudetinhnang">
                    <ul class="tabs">
                        <li><a href="#tab1">Tính năng</a></li>
                        <li><a href="#tab2" >Bình luận</a></li>
                    </ul>
                </div>
                <!-- End : Tiêu đề tính năng -->
                
                <div id="tab1">
                    <?php echo $row['chitiet']; ?>
                </div>  
            </div>
            <!-- Trang HTML của bạn -->
            
            <div class="hienthibinhluan">
            <?php
                // Kết nối đến cơ sở dữ liệu
                $conn=mysqli_connect("localhost","root","")
                    or die("Cannot connect to the database");
                    mysqli_select_db($conn,"booknowcsdl")
                    or die("Cannot connect to the database");
                    mysqli_query($conn,"SET NAMES 'UTF8'");

                // Truy vấn dữ liệu từ cơ sở dữ liệu
                $result = $conn->query("SELECT * FROM comments where idsp = $idsp ORDER BY created_at DESC"); 

                // Hiển thị bình luận
                while ($row = $result->fetch_assoc()) {
                    // echo "<p><a>" . $row['name'] . ":</a> " . $row['comment'] . " <em>(" . $row['created_at'] . ")</em></p><br>";

                    // Phòng ngự
                    echo '<p><a href="' . htmlspecialchars($row['website'], ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . ':</a><br> ' . htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8') . ' <br><em>(' . $row['created_at'] . ')</em></p><br>';

                }

            // Đóng kết nối
                $conn->close();
            ?>
            </div>
             <form action="xulybl.php" method="post" class="comment-form" onsubmit="return validateForm()">
                <label for="name">Tên:</label>
                <input type="text" name="name" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" required><br>

                <label for="website">Website:</label>
                <input type="url" name="website" id="websiteInput"><br>
                
                <div id="websiteError" style="color: red;"></div>

                <label for="comment">Bình luận:</label>
                <textarea name="comment" id="commentArea" rows="4" required></textarea><br>
                <div id="commentError" style="color: red;"></div>

                <input type="hidden" id="username" name="idsp" value="<?= $idsp ?>" required>

                <input type="submit" value="Gửi bình luận">
            </form>

        </div>
        <!-- End : Chi tiết sản phẩm -in -->
        
    </div>
    <!-- End: Chi ti?t s?n ph?m -->
    <script>
        document.getElementById("commentArea").addEventListener("input", function() {
            document.getElementById("commentError").style.display = "none";
            document.getElementById("commentArea").style.border = "1px solid #ccc";
        });

        function isValidComment(comment){
            var specialCharacters = /<script>|<iframe>|<embed>|<applet>|<object>|<style>|<link>/i;
            if (specialCharacters.test(comment)) {
                return false;
            }else{
                return true;
            }
        }

        // Hàm xử lý khi ô input được thay đổi
        document.getElementById("websiteInput").addEventListener("input", function() {
            document.getElementById("websiteError").style.display = "none";
            document.getElementById("websiteInput").style.border = "1px solid #ccc";
        });
        
        // Hàm kiểm tra định dạng URL
        function isValidURL(url) {
            // Kiểm tra định dạng URL bằng biểu thức chính quy hoặc các phương pháp kiểm tra khác
            // Trong ví dụ này, sử dụng biểu thức chính quy đơn giản
            var urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
            return urlRegex.test(url);
        }

        
        // Hàm xử lý khi form được gửi
        function validateForm() {
            var websiteInput = document.getElementById("websiteInput").value;
            var comment = document.getElementById("commentArea").value;

            if (!isValidComment(comment)) {
                // Hiển thị thông báo lỗi trên trang
                document.getElementById("commentError").style.display = "inline";
                document.getElementById("commentError").innerHTML = "Bình luận không hợp lệ";
                document.getElementById("commentArea").style.border = "1px solid #ff0000"; // Đặt viền màu đỏ
                return false;
            }


            if (!isValidURL(websiteInput)) {
                // Hiển thị thông báo lỗi trên trang
                document.getElementById("websiteError").style.display = "inline";
                document.getElementById("websiteError").innerHTML = "Website không hợp lệ";
                document.getElementById("websiteInput").style.border = "1px solid #ff0000"; // Đặt viền màu đỏ
                return false;
            }

            return true;
        }

        
    </script>

    <?php } ?>
    


