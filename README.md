# Phiếu 04 - PDO CRUD bảng `categories`

Dự án này là bài tập thực hành PDO thực hiện CRUD cơ bản trên bảng `categories`.

## Hướng dẫn cài đặt
1. Import cơ sở dữ liệu:
   Mở phpMyAdmin, import nội dung của file `schema.sql` hoặc chạy lệnh SQL trực tiếp.
   ```bash
   mysql -u root -p < schema.sql
   ```
2. Cấu hình CSDL:
   Đảm bảo đang sử dụng XAMPP (hoặc tương tự) với:
   - Database: `minishop_cse485`
   - User: `root`
   - Password: (trống)

3. Lệnh kiểm tra:
   Sau khi import, chạy câu truy vấn sau trong SQL để xem dữ liệu mẫu có hiển thị đủ 3 mục hay chưa:
   ```sql
   SELECT COUNT(*) FROM categories;
   ```

4. Truy cập:
   Mở thư mục `cse485-ms-04` trên localhost thông qua trình duyệt, file mặc định được gọi sẽ là `index.php`.