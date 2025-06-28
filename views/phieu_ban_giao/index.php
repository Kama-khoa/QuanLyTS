<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="index.php?model=phieubangiao&action=index">Bàn giao tài sản</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <?php if (isset($_SESSION['message'])): ?>
        <div id="alert-message" class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
        <script>
            setTimeout(function () {
                var alert = document.getElementById('alert-message');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(function () {
                        alert.style.display = 'none';
                    }, 150);
                }
            }, 2000);
        </script>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quản lý phiếu bàn giao tài sản</h5>
                <div>
                    <a id="toggleSearch" class="btn btn-secondary">Tìm kiếm</a>
                    <?php if ($_SESSION['role'] == 'NhanVien'): ?>
                        <a href="index.php?model=phieubangiao&action=create" class="btn btn-primary">Tạo yêu cầu</a>
                    <?php endif; ?>
                    <a href="index.php?model=phieubangiao&action=export" class="btn btn-success">Xuất excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="searchForm" class="mb-3" style="display: none;">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label for="ngayTaoPhieuBatDau" class="form-label">Ngày tạo phiếu từ:</label>
                        <input type="date" name="ngayTaoPhieuBatDau" id="ngayTaoPhieuBatDau" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayTaoPhieuKetThuc" class="form-label">Ngày tạo phiếu đến:</label>
                        <input type="date" name="ngayTaoPhieuKetThuc" id="ngayTaoPhieuKetThuc" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayKiemTraBatDau" class="form-label">Ngày kiểm tra từ:</label>
                        <input type="date" name="ngayKiemTraBatDau" id="ngayKiemTraBatDau" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayKiemTraKetThuc" class="form-label">Ngày kiểm tra đến:</label>
                        <input type="date" name="ngayKiemTraKetThuc" id="ngayKiemTraKetThuc" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3 mb-2">
                        <label for="ngayPheDuyetBatDau" class="form-label">Ngày phê duyệt từ:</label>
                        <input type="date" name="ngayPheDuyetBatDau" id="ngayPheDuyetBatDau" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayPheDuyetKetThuc" class="form-label">Ngày phê duyệt đến:</label>
                        <input type="date" name="ngayPheDuyetKetThuc" id="ngayPheDuyetKetThuc" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayBanGiaoBatDau" class="form-label">Ngày bàn giao từ:</label>
                        <input type="date" name="ngayBanGiaoBatDau" id="ngayBanGiaoBatDau" class="form-control">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="ngayBanGiaoKetThuc" class="form-label">Ngày bàn giao đến:</label>
                        <input type="date" name="ngayBanGiaoKetThuc" id="ngayBanGiaoKetThuc" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3 mb-2">
                        <label for="trangThai" class="form-label">Trạng thái:</label>
                        <select name="trangThai" id="trangThai" class="form-control ">
                            <option value="">Tất cả</option>
                            <option value="Đã gửi">Đã gửi</option>
                            <option value="Đã kiểm tra">Đã kiểm tra</option>
                            <option value="Đang chờ phê duyệt">Đang chờ phê duyệt</option>
                            <option value="Đã phê duyệt">Đã phê duyệt</option>
                            <option value="Đã giao">Đã giao</option>
                            <option value="Không duyệt">Không duyệt</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-center mt-4">
                        <button type="button" id="resetButton" class="btn btn-secondary">Đặt lại</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light text-black text-center">
                        <tr>
                            <th>Mã số phiếu</th>
                            <th>Ngày tạo phiếu</th>
                            <th>Ngày kiểm tra</th>
                            <th>Ngày phê duyệt</th>
                            <th>Ngày bàn giao</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($phieuBanGiao as $phieu): ?>
                            <?php if (($phieu['user_nhan_id'] == $_SESSION['user_id'] && $_SESSION['role']=='NhanVien')
                              || ($phieu['user_ban_giao_id'] == $_SESSION['user_id'] && $_SESSION['role']=='NhanVienQuanLy')
                              || ($phieu['user_ban_giao_id'] == '' && $_SESSION['role']=='NhanVienQuanLy')
                              ||($_SESSION['role']=='QuanLy'&& ($phieu['trang_thai']=='DaBanGiao'||$phieu['trang_thai']=='DangChoPheDuyet'||$phieu['trang_thai']=='KhongDuyet'||$phieu['trang_thai']=='DaPheDuyet'))): ?>
                                <tr>
                                    <td class="text-center"><?php echo $phieu['phieu_ban_giao_id']; ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($phieu['ngay_gui'])) ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_kiem_tra']) ? date('d/m/Y', strtotime($phieu['ngay_kiem_tra'])) : ''; ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_duyet']) ? date('d/m/Y', strtotime($phieu['ngay_duyet'])) : ''; ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_ban_giao']) ? date('d/m/Y', strtotime($phieu['ngay_ban_giao'])) : ''; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $statusClass = '';
                                        switch ($phieu['trang_thai']) {
                                            case 'DaGui':
                                                echo 'Đã gửi';
                                                break;
                                            case 'DaKiemTra':
                                                echo 'Đã kiểm tra';
                                                break;
                                            case 'DangChoPheDuyet':
                                                echo 'Đang chờ phê duyệt';
                                                break;
                                            case 'DaPheDuyet':
                                                echo 'Đã phê duyệt';
                                                break;
                                            case 'DaGiao':
                                                echo 'Đã giao';
                                                break;
                                            case 'KhongDuyet':
                                                echo 'Không duyệt';
                                                break;
                                           
                                        }
                                        ?>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="index.php?model=phieubangiao&action=show&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-info btn-sm mx-2">Xem</a>
                                        <?php if ($_SESSION['role'] == 'NhanVien' && $phieu['trang_thai'] == 'DaGui'): ?>
                                            <a href="index.php?model=phieubangiao&action=edit&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-warning btn-sm mx-2">Sửa</a>
                                            <a href="index.php?model=phieubangiao&action=delete&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-danger btn-sm mx-2" onclick="return confirm('Bạn có chắc chắn muốn xóa phiếu này không?');">Xóa</a>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'QuanLy' && $phieu['trang_thai'] == 'DangChoPheDuyet'): ?>
                                            <a href="index.php?model=phieubangiao&action=xet_duyet&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-primary btn-sm mx-2">Xét duyệt</a>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'NhanVienQuanLy' && $phieu['trang_thai'] == 'DaGui'): ?>
                                            <a href="index.php?model=phieubangiao&action=kiem_tra&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-primary btn-sm mx-2">Tạo phiếu</a>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'NhanVienQuanLy' && $phieu['trang_thai'] == 'DaPheDuyet'): ?>
                                            <a href="index.php?model=phieubangiao&action=ban_giao&id=<?php echo $phieu['phieu_ban_giao_id']; ?>" class="btn btn-primary btn-sm mx-2">Bàn giao</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var table = $('#dataTable').DataTable({
        dom: 'rtip',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Vietnamese.json"
        }
    });

    // Hàm chuyển đổi định dạng ngày từ dd/mm/yyyy sang yyyy-mm-dd
    function convertDate(dateString) {
        if (!dateString) return null;
        var parts = dateString.split("/");
        return parts[2] + "-" + parts[1] + "-" + parts[0];
    }

    // Hàm so sánh ngày
    function compareDates(date1, date2) {
        if (!date1 || !date2) return true;
        return new Date(date1).setHours(0,0,0,0) <= new Date(date2).setHours(0,0,0,0);
    }

    // Custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var ngayTaoPhieuBatDau = $('#ngayTaoPhieuBatDau').val();
        var ngayTaoPhieuKetThuc = $('#ngayTaoPhieuKetThuc').val();
        var ngayKiemTraBatDau = $('#ngayKiemTraBatDau').val();
        var ngayKiemTraKetThuc = $('#ngayKiemTraKetThuc').val();
        var ngayPheDuyetBatDau = $('#ngayPheDuyetBatDau').val();
        var ngayPheDuyetKetThuc = $('#ngayPheDuyetKetThuc').val();
        var ngayBanGiaoBatDau = $('#ngayBanGiaoBatDau').val();
        var ngayBanGiaoKetThuc = $('#ngayBanGiaoKetThuc').val();
        var trangThai = $('#trangThai').val();

        var rowNgayTaoPhieu = convertDate(data[1]);
        var rowNgayKiemTra = convertDate(data[2]);
        var rowNgayPheDuyet = convertDate(data[3]);
        var rowNgayBanGiao = convertDate(data[4]);
        var rowTrangThai = data[5];

        if (ngayTaoPhieuBatDau && !compareDates(ngayTaoPhieuBatDau, rowNgayTaoPhieu)) return false;
        if (ngayTaoPhieuKetThuc && !compareDates(rowNgayTaoPhieu, ngayTaoPhieuKetThuc)) return false;
        
        if (ngayKiemTraBatDau && !compareDates(ngayKiemTraBatDau, rowNgayKiemTra)) return false;
        if (ngayKiemTraKetThuc && !compareDates(rowNgayKiemTra, ngayKiemTraKetThuc)) return false;
        
        if (ngayPheDuyetBatDau && !compareDates(ngayPheDuyetBatDau, rowNgayPheDuyet)) return false;
        if (ngayPheDuyetKetThuc && !compareDates(rowNgayPheDuyet, ngayPheDuyetKetThuc)) return false;
        
        if (ngayBanGiaoBatDau && !compareDates(ngayBanGiaoBatDau, rowNgayBanGiao)) return false;
        if (ngayBanGiaoKetThuc && !compareDates(rowNgayBanGiao, ngayBanGiaoKetThuc)) return false;

        if (trangThai && !rowTrangThai.includes(trangThai)) return false;

        return true;
    });

    // Event listeners for search inputs
    $('#ngayTaoPhieuBatDau, #ngayTaoPhieuKetThuc, #ngayKiemTraBatDau, #ngayKiemTraKetThuc, #ngayPheDuyetBatDau, #ngayPheDuyetKetThuc, #ngayBanGiaoBatDau, #ngayBanGiaoKetThuc, #trangThai').on('change', function() {
        table.draw();
    });

    // Toggle search form visibility
    $('#toggleSearch').on('click', function() {
        $('#searchForm').slideToggle();
    });

    // Reset search form
    $('#resetButton').on('click', function() {
        $('#ngayTaoPhieuBatDau, #ngayTaoPhieuKetThuc, #ngayKiemTraBatDau, #ngayKiemTraKetThuc, #ngayPheDuyetBatDau, #ngayPheDuyetKetThuc, #ngayBanGiaoBatDau, #ngayBanGiaoKetThuc').val('');
        $('#trangThai').val('');
        table.draw();
    });

    
});
</script>