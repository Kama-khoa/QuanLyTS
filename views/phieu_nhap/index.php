<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?model=phieunhap&action=index">Phiếu nhập</a></li>
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
            }, 7000); // 7000 milliseconds = 7 seconds
        </script>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quản lý phiếu nhập</h5>
                <div>
                    <?php if ($_SESSION['role'] == 'NhanVienQuanLy'): ?>
                        <a id="toggleSearch" class="btn btn-secondary">Tìm kiếm</a>
                        <a href="index.php?model=phieunhap&action=create" class="btn btn-primary">Thêm mới</a>
                        <a href="index.php?model=phieunhap&action=export" class="btn btn-success">Xuất excel</a>
                    <?php elseif ($_SESSION['role'] == 'QuanLy'): ?>
                        <a id="toggleSearch" class="btn btn-secondary">Tìm kiếm</a>
                        <a href="index.php?model=phieunhap&action=export" class="btn btn-success">Xuất excel</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="searchForm" class="mb-3" style="display: none;">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="ngayTao" class="mr-2 mb-0" style="white-space: nowrap;">Ngày tạo phiếu:</label>
                            <input type="date" id="ngayTao" class="form-control" placeholder="Ngày tạo phiếu">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="ngayPheDuyet" class="mr-2 mb-0" style="white-space: nowrap;">Ngày phê duyệt:</label>
                            <input type="date" id="ngayPheDuyet" class="form-control" placeholder="Ngày phê duyệt">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="maPhieu" class="mr-2 mb-0" style="white-space: nowrap;">Mã số phiếu:</label>
                            <input type="text" id="maPhieu" class="form-control" placeholder="Mã số phiếu">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="trangThai" class="mr-2 mb-0" style="white-space: nowrap;">Trạng thái:</label>
                            <select id="trangThai" class="form-control">
                                <option value="">--Chọn trạng thái--</option>
                                <option value="DangChoPheDuyet">Đang chờ phê duyệt</option>
                                <option value="DaPheDuyet">Đã phê duyệt</option>
                                <option value="KhongDuyet">Không phê duyệt</option>
                                <option value="DaNhap">Đã nhập tài sản</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light text-black text-center">
                        <tr>
                            <th>Mã số phiếu</th>
                            <th>Ngày tạo phiếu</th>
                            <th>Ngày phê duyệt</th>
                            <th>Ngày nhập tài sản</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($phieuNhap as $phieu): ?>
                            <?php if (($phieu['user_id'] == $_SESSION['user_id'] && $_SESSION['role'] == 'NhanVienQuanLy') || ($_SESSION['role'] == 'QuanLy')): ?>
                                <tr>
                                    <td class="text-center"><?php echo $phieu['phieu_nhap_tai_san_id']; ?></td>
                                    <td class="text-center"><?= date('d/m/Y', strtotime($phieu['ngay_tao'])) ?></td>
                                    <td class="text-center">
                                        <?php if (in_array($phieu['trang_thai'], ['DaPheDuyet', 'DaNhap', 'KhongDuyet'])): ?>
                                            <?= !empty($phieu['ngay_xac_nhan']) ? date('d/m/Y', strtotime($phieu['ngay_xac_nhan'])) : ''; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $phieu['trang_thai'] == 'DaNhap' ? (!empty($phieu['ngay_nhap']) ? date('d/m/Y', strtotime($phieu['ngay_nhap'])) : '') : ''; ?>
                                    </td>
                                    <td class="text-center">
                                        <?= $phieu['trang_thai'] == 'DangChoPheDuyet' ? 'Đang chờ phê duyệt' : ($phieu['trang_thai'] == 'KhongDuyet' ? 'Không phê duyệt' : ($phieu['trang_thai'] == 'DaNhap' ? 'Đã nhập tài sản' : 'Đã phê duyệt')); ?>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="index.php?model=phieunhap&action=show&id=<?php echo $phieu['phieu_nhap_tai_san_id']; ?>" class="btn btn-info btn-sm mx-2">Xem</a>
                                        <?php if ($phieu['trang_thai'] == 'DangChoPheDuyet' && $_SESSION['role'] == 'NhanVienQuanLy'): ?>
                                            <a href="index.php?model=phieunhap&action=edit&id=<?php echo $phieu['phieu_nhap_tai_san_id']; ?>" class="btn btn-warning btn-sm mx-2">Sửa</a>
                                            <?php if ($_SESSION['role'] == 'NhanVienQuanLy'): ?>
                                                <a href="index.php?model=phieunhap&action=delete&id=<?= $phieu['phieu_nhap_tai_san_id']; ?>" onclick="return confirmDelete();" class="btn btn-danger btn-sm mx-2">Xóa</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($phieu['trang_thai'] == 'DaPheDuyet'): ?>
                                            <?php if ($_SESSION['role'] == 'NhanVienQuanLy'): ?>
                                                <a href="index.php?model=phieunhap&action=nhap_tai_san&id=<?php echo $phieu['phieu_nhap_tai_san_id']; ?>" class="btn btn-success btn-sm mx-2">Nhập tài sản</a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'QuanLy' && $phieu['trang_thai'] == 'DangChoPheDuyet'): ?>
                                            <a href="index.php?model=phieunhap&action=xet_duyet&id=<?php echo $phieu['phieu_nhap_tai_san_id']; ?>" class="btn btn-success btn-sm mx-2">Xét duyệt</a>
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
        return new Date(date1).setHours(0,0,0,0) === new Date(date2).setHours(0,0,0,0);
    }

    // Custom filtering function
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var maPhieu = $('#maPhieu').val().toUpperCase();
        var ngayTao = $('#ngayTao').val();
        var ngayPheDuyet = $('#ngayPheDuyet').val();
        var trangThai = $('#trangThai').val();

        var rowMaPhieu = data[0].toUpperCase();
        var rowNgayTao = convertDate(data[1]);
        var rowNgayPheDuyet = convertDate(data[2]);
        var rowTrangThai = data[4];

        if (maPhieu && !rowMaPhieu.includes(maPhieu)) return false;
        if (trangThai) {
            switch (trangThai) {
                case 'DangChoPheDuyet':
                    if (rowTrangThai !== 'Đang chờ phê duyệt') return false;
                    break;
                case 'DaPheDuyet':
                    if (rowTrangThai !== 'Đã phê duyệt') return false;
                    break;
                case 'KhongDuyet':
                    if (rowTrangThai !== 'Không phê duyệt') return false;
                    break;
                case 'DaNhap':
                    if (rowTrangThai !== 'Đã nhập tài sản') return false;
                    break;
            }
        }
        if (ngayTao && !compareDates(ngayTao, rowNgayTao)) return false;
        if (ngayPheDuyet && !compareDates(ngayPheDuyet, rowNgayPheDuyet)) return false;

        return true;
    });

    // Event listeners for search inputs
    $('#maPhieu, #trangThai, #ngayTao, #ngayPheDuyet').on('input change', function() {
        table.draw();
    });

    // Toggle search form visibility
    $('#toggleSearch').on('click', function() {
        $('#searchForm').slideToggle();
    });

    // Confirm delete
    $('body').on('click', 'a[onclick="return confirmDelete();"]', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        if (confirm('Bạn có chắc chắn muốn xóa phiếu nhập này không?')) {
            window.location.href = url;
        }
    });
    
    // $('body').on('click', 'a[onclick="return confirmUpdate();"]', function(e) {
    //     e.preventDefault();
    //     var url = $(this).attr('href');
    //     if (confirm('Bạn có chắc chắn muốn suwar phiếu nhập này không?')) {
    //         window.location.href = url;
    //     }
    // });
    function confirmUpdate() {
        return confirm('Bạn có chắc muốn suwar phiếu này?');
    }
});

// Function to reset search form
function resetSearchForm() {
    $('#maPhieu, #ngayTao, #ngayPheDuyet').val('');
    $('#trangThai').val('');
    $('#dataTable').DataTable().draw();
}

</script>
