USE quanlytaisan;

-- Thêm dữ liệu vào bảng loai_tai_san
INSERT INTO loai_tai_san (ten_loai_tai_san) VALUES
('Không xác định'),
('Máy tính và thiết bị viễn thông'),
('Xây dựng, công cụ dụng cụ'),
('Đất đai, nhà xưởng'),
('Phương tiện vận tải'),
('Máy móc, thiết bị sản xuất'),
('Trang thiết bị văn phòng'),
('Thiết bị giảng dạy, nghiên cứu');

-- Thêm dữ liệu vào bảng tai_san
INSERT INTO tai_san (ten_tai_san, mo_ta,  loai_tai_san_id) VALUES
('Máy tính để bàn HP', 'Dùng cho phòng máy tính đại cương', 1), -- Loại tài sản: Máy tính và thiết bị viễn thông (loai_tai_san_id = 1)
('Bảng thông báo điện tử', 'Dùng để thông báo lịch học và thông tin sinh viên', 7), -- Loại tài sản: Trang thiết bị văn phòng (loai_tai_san_id = 7)
('Xe ô tô Toyota Camry', 'Dành cho việc đưa đón giảng viên và khách mời', 5), -- Loại tài sản: Phương tiện vận tải (loai_tai_san_id = 5)
('Máy phát điện công suất lớn', 'Dự phòng khi có sự cố mất điện', 6), -- Loại tài sản: Máy móc, thiết bị sản xuất (loai_tai_san_id = 6)
('Máy chiếu Epson', 'Dùng cho giảng đường lớn', 7),
('Bàn ghế học tập', 'Dành cho sinh viên ngồi học', 7),
('Điều hòa không khí Daikin', 'Cung cấp không khí mát trong các phòng học', 6),
('Thiết bị phòng thí nghiệm hóa học', 'Dành cho các môn thí nghiệm', 8),
('Máy in Laser HP', 'Dùng cho in ấn văn bản quan trọng', 7),
('Bộ bàn ghế phòng họp', 'Dành cho các cuộc họp quan trọng', 7),
('Đồ nội thất phòng ngủ sinh viên', 'Dành cho khu ký túc xá', 3),
('Phần mềm giảng dạy Matlab', 'Dùng cho môn học kỹ thuật', 8),
('Tủ lạnh đựng mẫu sinh học', 'Dành cho viện nghiên cứu sinh học', 6),
('Linh kiện máy tính', 'Dùng cho phòng máy tính', 2),
('Máy quay phim Sony', 'Dành cho việc quay phim giảng dạy', 7),
('Thiết bị thể dục thể thao', 'Dành cho các hoạt động ngoại khóa', 3),
('Máy chiếu 3D', 'Dùng cho các buổi thuyết trình đặc biệt', 7),
('Bộ bài mô hình cơ khí', 'Dành cho viện nghiên cứu kỹ thuật', 6),
('Đèn chiếu sáng hành lang', 'Dành cho sự an toàn của sinh viên', 6),
('Bàn ghế làm việc cho giảng viên', 'Dùng cho các văn phòng khoa học', 7),
('Thiết bị phòng chống cháy nổ', 'Dành cho phòng thí nghiệm hóa học', 5),
('Thiết bị cắt sắt thép', 'Dành cho việc xây dựng cơ sở vật chất', 4),
('Máy mài mòn', 'Dành cho công tác bảo dưỡng thiết bị', 2),
('Bài đại học làm công cụ dạy học', 'Dành cho việc dạy và học', 8),
('Máy tính xách tay MacBook Pro', 'Dành cho các nghiên cứu viên di động', 1),
('Máy phát điện dự phòng', 'Dành cho các sự cố mất điện nhỏ', 6),
('Đèn chiếu sáng sân khấu', 'Dành cho các buổi biểu diễn nghệ thuật', 6),
('Máy lạnh trung tâm', 'Cung cấp không khí lạnh cho các toà nhà chính', 6),
('Phòng thí nghiệm điện tử', 'Dành cho các môn học điện tử', 8),
('Xe đạp đưa đón sinh viên', 'Dành cho sinh viên di chuyển trong khuôn viên trường', 5),
('Thiết bị phòng thí nghiệm sinh học', 'Dành cho các nghiên cứu sinh học', 8),
('Máy chấm công vân tay', 'Dùng để chấm công cho nhân viên và giảng viên', 7),
('Máy bơm nước công nghiệp', 'Dành cho hệ thống cấp nước và chữa cháy', 6),
('Thiết bị học tập cho sinh viên khuyết tật', 'Dành cho sinh viên khuyết tật', 7),
('Máy chiếu PowerPoint', 'Dùng để trình chiếu bài giảng', 7),
('Máy in 3D', 'Dành cho việc in các mô hình thử nghiệm', 7),
('Máy hàn điện tử', 'Dùng cho công tác bảo trì và sửa chữa', 2),
('Thiết bị điều khiển tự động', 'Dành cho các môn học kỹ thuật', 6),
('Bộ ghế sofa phòng chờ', 'Dành cho các khu vực tiếp khách', 3),
('Máy sấy khô hóa chất', 'Dành cho các phòng thí nghiệm hóa học', 6),
('Máy khoan đa năng', 'Dành cho công tác xây dựng và sửa chữa', 3),
('Đồ dùng nội thất phòng giảng đường', 'Dành cho việc tổ chức hội thảo', 7),
('Máy phát sóng Wi-Fi', 'Dùng để cung cấp Internet cho khuôn viên trường', 1),
('Máy cắt CNC', 'Dành cho sản xuất mô hình và các chi tiết cơ khí', 6),
('Thiết bị kiểm tra độ chính xác', 'Dành cho các phòng thí nghiệm chính xác', 6),
('Máy quét mã vạch', 'Dùng cho quản lý kho hàng', 7),
('Máy pha cafe tự động', 'Dành cho sinh viên và giảng viên trong giờ nghỉ', 7),
('Bảng phấn viết bút lông', 'Dùng cho việc giảng dạy và họp hành', 7),
('Máy nghiền đá', 'Dành cho việc xây dựng cơ sở vật chất', 4),
('Máy chiếu laser', 'Dùng cho các buổi thuyết trình chuyên đề', 7),
('Máy xén kim loại CNC', 'Dành cho sản xuất các chi tiết kim loại chính xác', 6),
('Thiết bị kiểm tra an toàn điện', 'Dành cho các phòng thí nghiệm điện', 5),
('Máy làm mát công nghiệp', 'Dành cho các khu vực làm việc nóng', 6),
('Máy in offset', 'Dành cho in ấn sách báo và tài liệu quan trọng', 7),
('Thiết bị đo lường định lượng', 'Dành cho các phòng thí nghiệm lượng tử', 6),
('Bộ giường tủ cho ký túc xá', 'Dành cho sinh viên nội trú', 3);

-- Thêm dữ liệu vào bảng vi_tri
    INSERT INTO vi_tri (ten_vi_tri) VALUES
    ('Kho', 'HTTT'),
    ('Phòng máy tính đại cương', 'CNTT'),
    ('Phòng thông báo', 'KT'),
    ('Bãi đỗ xe', 'Co khi'),
    ('Phòng máy phát điện dự phòng', 'Cong trinh'),
    ('Giảng đường lớn', 'Moi truong-ATGT'),
    ('Phòng học', 'HTTT'),
    ('Phòng thí nghiệm hóa học', 'CNTT'),
    ('Văn phòng khoa học', 'KT'),
    ('Phòng thí nghiệm điện tử', 'Co khi'),
    ('Khuôn viên trường', 'Cong trinh'),
    ('Phòng thể dục thể thao', 'Moi truong-ATGT'),
    ('Phòng họp', 'HTTT'),
    ('Khu ký túc xá', 'CNTT'),
    ('Phòng thí nghiệm sinh học', 'KT'),
    ('Phòng thí nghiệm chính xác', 'Co khi'),
    ('Khu vực hành lang', 'Cong trinh'),
    ('Phòng chờ', 'Moi truong-ATGT'),
    ('Khu vực tổ chức hội thảo', 'HTTT'),
    ('Khu vực Internet', 'CNTT'),
    ('Phòng sản xuất', 'KT'),
    ('Phòng kiểm tra an toàn điện', 'Co khi'),
    ('Khu vực làm việc nóng', 'Cong trinh'),
    ('Phòng in ấn', 'Moi truong-ATGT'),
    ('Phòng thí nghiệm lượng tử', 'HTTT');

-- -- Thêm dữ liệu vào bảng nha_cung_cap
-- INSERT INTO nha_cung_cap (ten_nha_cung_cap,trang_thai) VALUES
-- ('Công ty TNHH ABC', 1),
-- ('Công ty CP XYZ', 1);

-- Thêm dữ liệu vào bảng hoa_don_mua
-- INSERT INTO hoa_don_mua (ngay_mua, tong_gia_tri, nha_cung_cap_id) VALUES
-- ('2023-01-15', 15000000, 1),
-- ('2023-02-20', 20000000, 2);

-- -- Thêm dữ liệu vào bảng chi_tiet_hoa_don_mua
-- INSERT INTO chi_tiet_hoa_don_mua (hoa_don_id, tai_san_id, so_luong, don_gia) VALUES
-- (1, 1, 2, 15000000),  -- Máy tính để bàn HP
-- (1, 2, 3, 12000000),  -- Bảng thông báo điện tử
-- (1, 3, 1, 5000000),   -- Xe ô tô Toyota Camry
-- (1, 4, 1, 10000000),  -- Máy phát điện công suất lớn
-- (1, 5, 2, 8000000),   -- Máy chiếu Epson
-- (1, 6, 5, 3000000),   -- Bàn ghế học tập
-- (1, 7, 4, 7000000),   -- Điều hòa không khí Daikin
-- (1, 8, 3, 9000000),   -- Thiết bị phòng thí nghiệm hóa học
-- (1, 9, 2, 6000000),   -- Máy in Laser HP
-- (1, 10, 1, 4000000),  -- Bộ bàn ghế phòng họp
-- (1, 11, 10, 2000000), -- Đồ nội thất phòng ngủ sinh viên
-- (1, 12, 3, 3000000),  -- Phần mềm giảng dạy Matlab
-- (1, 13, 2, 5000000),  -- Tủ lạnh đựng mẫu sinh học
-- (1, 14, 6, 1500000),  -- Linh kiện máy tính
-- (1, 15, 1, 10000000), -- Máy quay phim Sony
-- (1, 16, 8, 500000),   -- Thiết bị thể dục thể thao
-- (1, 17, 2, 7000000),  -- Máy chiếu 3D
-- (1, 18, 4, 3000000),  -- Bộ bài mô hình cơ khí
-- (1, 19, 5, 2000000),  -- Đèn chiếu sáng hành lang
-- (1, 20, 3, 4000000),  -- Bàn ghế làm việc cho giảng viên
-- (1, 21, 2, 6000000),  -- Thiết bị phòng chống cháy nổ
-- (1, 22, 5, 2500000),  -- Thiết bị cắt sắt thép
-- (1, 23, 3, 3500000),  -- Máy mài mòn
-- (1, 24, 4, 4500000),  -- Bài đại học làm công cụ dạy học
-- (1, 25, 1, 8000000),  -- Máy tính xách tay MacBook Pro
-- (1, 26, 2, 6000000),  -- Máy phát điện dự phòng
-- (1, 27, 1, 5000000),  -- Đèn chiếu sáng sân khấu
-- (1, 28, 3, 3000000),  -- Máy lạnh trung tâm
-- (1, 29, 4, 7000000),  -- Phòng thí nghiệm điện tử
-- (1, 30, 5, 1500000),  -- Xe đạp đưa đón sinh viên
-- (1, 31, 6, 2500000),  -- Thiết bị phòng thí nghiệm sinh học
-- (1, 32, 7, 3500000),  -- Máy chấm công vân tay
-- (1, 33, 8, 4500000),  -- Máy bơm nước công nghiệp
-- (1, 34, 9, 5500000),  -- Thiết bị học tập cho sinh viên khuyết tật
-- (1, 35, 10, 6500000), -- Máy chiếu PowerPoint
-- (1, 36, 1, 7500000),  -- Máy in 3D
-- (1, 37, 2, 8500000),  -- Máy hàn điện tử
-- (1, 38, 3, 9500000),  -- Thiết bị điều khiển tự động
-- (1, 39, 4, 10500000), -- Bộ ghế sofa phòng chờ
-- (1, 40, 5, 11500000), -- Máy sấy khô hóa chất
-- (1, 41, 6, 12500000), -- Máy khoan đa năng
-- (1, 42, 7, 13500000), -- Đồ dùng nội thất phòng giảng đường
-- (1, 43, 8, 14500000), -- Máy phát sóng Wi-Fi
-- (1, 44, 9, 15500000), -- Máy cắt CNC
-- (1, 45, 10, 16500000),-- Thiết bị kiểm tra độ chính xác
-- (1, 46, 1, 17500000), -- Máy quét mã vạch
-- (1, 47, 2, 18500000), -- Máy pha cafe tự động
-- (1, 48, 3, 19500000), -- Bảng phấn viết bút lông
-- (1, 49, 4, 20500000), -- Máy nghiền đá
-- (1, 50, 5, 21500000), -- Máy chiếu laser
-- (1, 51, 6, 22500000), -- Máy xén kim loại CNC
-- (1, 52, 7, 23500000), -- Thiết bị kiểm tra an toàn điện
-- (1, 53, 8, 24500000), -- Máy làm mát công nghiệp
-- (1, 54, 9, 25500000), -- Máy in offset
-- (1, 55, 10, 26500000);-- Thiết bị đo lường định lượng

-- Thêm dữ liệu vào bảng vi_tri_chi_tiet
INSERT INTO vi_tri_chi_tiet (tai_san_id, vi_tri_id, so_luong) VALUES
(1, 1, 5),
(2, 2, 30),
(3, 3, 2);

-- Thêm dữ liệu vào bảng hoa_don_thanh_ly
-- INSERT INTO hoa_don_thanh_ly (ngay_thanh_ly, tong_gia_tri) VALUES
-- ('2023-03-15', 5000000);

-- -- Thêm dữ liệu vào bảng chi_tiet_hoa_don_thanh_ly
-- INSERT INTO chi_tiet_hoa_don_thanh_ly (hoa_don_id, tai_san_id, so_luong, gia_thanh_ly, vi_tri_chi_tiet_id) VALUES
-- (1, 1, 2, 2500000,1);

-- Thêm dữ liệu vào bảng maintenance_schedule
-- INSERT INTO maintenance_schedule (tai_san_id, ngay_bat_dau, ngay_ket_thuc, mo_ta) VALUES
-- (1, '2023-06-01', '2023-06-07', 'Bảo trì máy tính Dell');
