-- -- Bảng để lưu thông tin người dùng
-- CREATE TABLE users (
--     user_id INT AUTO_INCREMENT PRIMARY KEY,
--     email VARCHAR(50) NOT NULL UNIQUE,
--     ten VARCHAR(50) NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     role ENUM('NhanVien','Admin','KyThuat') NOT NULL,
--     avatar VARCHAR(255)
-- );
-- -- Bảng để lưu thông tin về loại tài sản
-- CREATE TABLE loai_tai_san (
--     loai_tai_san_id INT AUTO_INCREMENT PRIMARY KEY,
--     ten_loai_tai_san VARCHAR(50) NOT NULL UNIQUE
-- );
-- -- Bảng để lưu thông tin tài sản cố định
-- CREATE TABLE tai_san (
--     tai_san_id INT AUTO_INCREMENT PRIMARY KEY,
--     ten_tai_san VARCHAR(100) NOT NULL,
--     mo_ta TEXT,
--     loai_tai_san_id INT NOT NULL,
--     FOREIGN KEY (loai_tai_san_id) REFERENCES loai_tai_san(loai_tai_san_id)
-- );



-- -- Bảng để lưu thông tin vị trí của tài sản
-- CREATE TABLE vi_tri (
--     vi_tri_id INT AUTO_INCREMENT PRIMARY KEY,
--     ten_vi_tri VARCHAR(100) NOT NULL UNIQUE
-- );



-- -- Bảng để lưu thông tin nhà cung cấp tài sản
-- CREATE TABLE nha_cung_cap (
--     nha_cung_cap_id INT AUTO_INCREMENT PRIMARY KEY,
--     ten_nha_cung_cap VARCHAR(255) NOT NULL UNIQUE,
--     trang_thai BOOLEAN NOT NULL
-- );
-- -- Bảng để lưu thông tin hóa đơn mua hàng
-- CREATE TABLE hoa_don_mua (
--     hoa_don_id INT AUTO_INCREMENT PRIMARY KEY,
--     ngay_mua DATE NOT NULL,
--     tong_gia_tri DECIMAL(15,0) NOT NULL,
--     nha_cung_cap_id INT,
--     FOREIGN KEY (nha_cung_cap_id) REFERENCES nha_cung_cap(nha_cung_cap_id)
-- );

-- -- Bảng chi tiết hóa đơn mua hàng
-- CREATE TABLE chi_tiet_hoa_don_mua (
--     chi_tiet_id INT AUTO_INCREMENT PRIMARY KEY,
--     hoa_don_id INT,
--     tai_san_id INT,
--     so_luong INT NOT NULL,
--     don_gia DECIMAL(15,0) NOT NULL,
--     FOREIGN KEY (hoa_don_id) REFERENCES hoa_don_mua(hoa_don_id) ON DELETE CASCADE,
--     FOREIGN KEY (tai_san_id) REFERENCES tai_san(tai_san_id) ON UPDATE CASCADE
-- );

-- -- Bảng để lưu thông tin hóa đơn thanh lý tài sản
-- CREATE TABLE hoa_don_thanh_ly (
--     hoa_don_id INT AUTO_INCREMENT PRIMARY KEY,
--     ngay_thanh_ly DATE NOT NULL,
--     tong_gia_tri DECIMAL(15,0) NOT NULL
-- );

-- Bảng chi tiết hóa đơn thanh lý tài sản

-- Chi tiết tai san vi tri
CREATE TABLE vi_tri_chi_tiet (
    vi_tri_chi_tiet_id INT PRIMARY KEY AUTO_INCREMENT,    
    vi_tri_id INT,
    so_luong INT,
    chi_tiet_id INT,
    FOREIGN KEY (chi_tiet_id) REFERENCES chi_tiet_hoa_don_mua(chi_tiet_id),
    FOREIGN KEY (vi_tri_id) REFERENCES vi_tri(vi_tri_id)
);

CREATE TABLE chi_tiet_hoa_don_thanh_ly (
    chi_tiet_id INT AUTO_INCREMENT PRIMARY KEY,
    hoa_don_id INT,
    tai_san_id INT,
    so_luong INT NOT NULL,
    gia_thanh_ly DECIMAL(15,0) NOT NULL,
    vi_tri_chi_tiet_id INT,
    FOREIGN KEY (hoa_don_id) REFERENCES hoa_don_thanh_ly(hoa_don_id) ON DELETE CASCADE,
    FOREIGN KEY (tai_san_id) REFERENCES tai_san(tai_san_id) ON UPDATE CASCADE,
    FOREIGN KEY (vi_tri_chi_tiet_id) REFERENCES vi_tri_chi_tiet(vi_tri_chi_tiet_id)
);

-- Bảo trì
CREATE TABLE maintenance_schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    vi_tri_id INT,
    ngay_bat_dau DATE NOT NULL,
    ngay_ket_thuc DATE,
    mo_ta TEXT,
    FOREIGN KEY (vi_tri_id) REFERENCES vi_tri(vi_tri_id)
);
-- Bảng để lưu thông tin khấu hao của tài sản
CREATE TABLE khau_hao (
    khau_hao_id INT AUTO_INCREMENT PRIMARY KEY,
    chi_tiet_id INT,
    thoi_gian_khau_hao INT,
    so_tien DECIMAL(15,0) NOT NULL,
    FOREIGN KEY (chi_tiet_id) REFERENCES chi_tiet_hoa_don_mua(chi_tiet_id) ON UPDATE CASCADE
);
CREATE TABLE tinh_trang (
    tinh_trang_id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT,
    mo_ta_tinh_trang TEXT,
    FOREIGN KEY (schedule_id) REFERENCES maintenance_schedule(schedule_id)
);