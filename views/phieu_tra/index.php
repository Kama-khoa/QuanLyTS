<div class="container-fluid">
    <div class="row mt-3">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?model=phieutra&action=index">Phiếu trả</a></li>
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
            }, 7000);
        </script>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Quản lý phiếu trả tài sản</h5>
                <div>
                    <a id="toggleSearch" class="btn btn-secondary">Tìm kiếm</a>
                    <?php if ($_SESSION['role'] == 'NhanVien'): ?>
                        <a href="index.php?model=phieutra&action=create" class="btn btn-primary">Thêm mới</a>
                    <?php endif; ?>
                    <!-- <a href="index.php?model=phieutra&action=export" class="btn btn-success">Xuất excel</a> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- <form id="searchForm" class="mb-3" style="display: none;">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="ngayBatDau" class="mr-2 mb-0" style="white-space: nowrap;">Từ ngày:&nbsp;&nbsp;&nbsp;</label>
                            <input type="date" id="ngayBatDau" class="form-control" placeholder="Từ ngày">
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="d-flex align-items-center">
                            <label for="ngayKetThuc" class="mr-2 mb-0" style="white-space: nowrap;">Đến ngày:</label>
                            <input type="date" id="ngayKetThuc" class="form-control" placeholder="Đến ngày">
                        </div>
                    </div>
                </div>
            </form> -->

            <div id="searchForm" class="mb-3">
                        <form action="index.php?model=phieutra&action=search" method="post" class="form-inline">
                            <div class="form-group mr-3">
                                <label for="ngay_tao_tk" class="mr-2">Ngày tạo phiếu</label>
                                <input type="date" class="form-control" id="ngay_tao_tk" name="ngay_tao_tk" placeholder="Ngày tạo phiếu">
                            </div>
                            <div class="form-group mr-3">
                                <label for="ngay_pd_tk" class="mr-2">Ngày phê duyệt</label>
                                <input type="date" class="form-control" id="ngay_pd_tk" name="ngay_pd_tk" placeholder="Ngày phê duyệt phiếu">
                            </div>
                            <button type="submit" class="btn btn-success" name = "btn_tim_kiem">Tìm kiếm</button>
                        </form>
                    </div>
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-light text-black text-center">
                        <tr>
                            <th>Mã số phiếu</th>
                            <th>Ngày gửi</th>
                            <th>Ngày kiểm tra</th>
                            <th>Ngày phê duyệt</th>
                            <th>Ngày trả</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($phieuTra as $phieu): ?>
                                <tr>
                                    <td class="text-center"><?php echo $phieu['phieu_tra_id']; ?></td>
                                    <td class="text-center"><?= date('d-m-Y', strtotime($phieu['ngay_gui'])) ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_kiem_tra']) ? date('d-m-Y', strtotime($phieu['ngay_kiem_tra'])) : ''; ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_duyet']) ? date('d-m-Y', strtotime($phieu['ngay_duyet'])) : ''; ?></td>
                                    <td class="text-center"><?= !empty($phieu['ngay_tra']) ? date('d-m-Y', strtotime($phieu['ngay_tra'])) : ''; ?></td>
                                    <td class="text-center">
                                        <?php
                                        switch ($phieu['trang_thai']) {
                                            case 'DaGui':
                                                echo 'Đã gửi';
                                                break;
                                            case 'DaHuy':
                                                echo 'Đã hủy';
                                                break;
                                            case 'DangChoPheDuyet':
                                                echo 'Đang chờ phê duyệt';
                                                break;
                                            case 'DaPheDuyet':
                                                echo 'Đã phê duyệt';
                                                break;
                                            case 'DaTra':
                                                echo 'Đã trả';
                                                break;
                                            case 'KhongDuyet':
                                                echo 'Không duyệt';
                                                break;
                                            default:
                                                echo $phieu['trang_thai'];
                                        }
                                        ?>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="index.php?model=phieutra&action=show&id=<?php echo $phieu['phieu_tra_id']; ?>" class="btn btn-info btn-sm mx-2">Xem</a>
                                        <?php if ($_SESSION['role'] == 'NhanVien' && $phieu['trang_thai'] == 'DaGui'): ?>
                                            <a href="index.php?model=phieutra&action=edit&id=<?php echo $phieu['phieu_tra_id']; ?>" onclick="return confirmUpdate();" class="btn btn-warning btn-sm mx-2">Sửa</a>
                                        <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'NhanVien' && $phieu['trang_thai'] == 'DaGui'): ?>
                                                <a href="index.php?model=phieutra&action=delete&id=<?= $phieu['phieu_tra_id']; ?>" onclick="return confirmDelete();"
                                                    class="btn btn-danger btn-sm mx-2">Xóa</a>
                                            <?php endif; ?>
                                        <?php if ($_SESSION['role'] == 'QuanLy' && $phieu['trang_thai'] == 'DangChoPheDuyet'): ?>
                                            <a href="index.php?model=phieutra&action=xet_duyet&id=<?php echo $phieu['phieu_tra_id']; ?>" class="btn btn-primary btn-sm mx-2">Xét duyệt</a>
                                        <?php endif; ?>
                                             <?php if ($_SESSION['role'] == 'NhanVienQuanLy' && $phieu['trang_thai'] == 'DaGui'): ?>
                                            <a href="index.php?model=phieutra&action=kiem_tra&id=<?php echo $phieu['phieu_tra_id']; ?>" class="btn btn-primary btn-sm mx-2">Kiểm tra</a>
                                        <?php endif; ?>
                                          <?php if ($_SESSION['role'] == 'NhanVien' && $phieu['trang_thai'] == 'DaPheDuyet'): ?>
                                            <a href="index.php?model=phieutra&action=tra&id=<?php echo $phieu['phieu_tra_id']; ?>" class="btn btn-warning btn-sm mx-2">Trả tài sản</a>
                                        <?php endif; ?>
                                        <?php if ($phieu['trang_thai'] == 'DaPheDuyet' || $phieu['trang_thai'] == 'DaTra' ): ?>
                                              <a href="index.php?model=phieutra&action=xuatphieu&id=<?php echo $phieu['phieu_tra_id']; ?>" class="btn btn-success">Xuất excel</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
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
    });

    document.addEventListener('DOMContentLoaded', function () {
        // function filterTable() {
        //     var ngayBatDau = document.getElementById('ngayBatDau').value;
        //     var ngayKetThuc = document.getElementById('ngayKetThuc').value;

        //     var table = document.getElementById('dataTable');
        //     var rows = table.getElementsByTagName('tr');

        //     for (var i = 1; i < rows.length; i++) {
        //         var cells = rows[i].getElementsByTagName('td');
        //         var ngayGui = cells[1].textContent.trim();

        //         var passNgay = (!ngayBatDau || ngayGui >= ngayBatDau) && (!ngayKetThuc || ngayGui <= ngayKetThuc);

        //         if (passNgay) {
        //             rows[i].style.display = '';
        //         } else {
        //             rows[i].style.display = 'none';
        //         }
        //     }
        // }

        // document.getElementById('ngayBatDau').addEventListener('change', filterTable);
        // document.getElementById('ngayKetThuc').addEventListener('change', filterTable);

        // filterTable();

        var toggleButton = document.getElementById('toggleSearch');
        var searchForm = document.getElementById('searchForm');

        toggleButton.addEventListener('click', function () {
            if (searchForm.style.display === 'none') {
                searchForm.style.display = 'block';
                toggleButton.textContent = 'Ẩn tìm kiếm';
            } else {
                searchForm.style.display = 'none';
                toggleButton.textContent = 'Tìm kiếm';
            }
        });
    });

    function confirmDelete() {
        return confirm('Bạn có chắc muốn xóa phiếu này?');
    }

    function confirmDelete() {
        return confirm('Bạn có chắc muốn suwar phiếu này?');
    }
</script>