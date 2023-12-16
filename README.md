# Minh họa hiện thực XSS trên Website của nhóm

## 1. Yêu cầu môi trường
    . PHP
    . MYSQL
    . VS CODE
## 2. Hướng dẫn cài đặt
### Bước 1: Clone code từ GitHub
    https://github.com/DucTai0909/IS335.O11_20520496_20520743_20520909_20522099.git
### Bước 2: Tạo Database, Import dữ liệu
    - Để tạo Database: mở XAMPP Control Panel -> MySQL -> Admin
    - New -> đăt tên Database là 'booknowcsdl' -> Create
    - Vào Database booknowcsdl -> import -> chọn file booknow.sql
    
![Hình ảnh sau khi imort dữ liệu thành công](githubimg/importdatabase.png)
### Bước 3: Vào IDE để chạy chương trình
    Để chạy chương trình nhóm sẽ dùng VS Code. Để chạy chương trình trên VS Code ta cần:
    - Cài đặt các Extensions:
        . **PHP Server** 
        . PHP Debug
        . PHP Intelephense
    - Đảm bảo đã kết nối với Database
![Kết nối với Database](githubimg/connectdatabase.png)
    - Vào file **index.php** -> chuột phải -> PHP Server: Serve project
    ![Giao diện khi truy cập vào Website](githubimg/website_sau_khi_ket_noi.png)