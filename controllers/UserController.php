<?php
include_once 'config/database.php';
include_once 'models/User.php';

class UserController extends Controller {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function index() {
        $stmt = $this->user->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $content = 'views/users/index.php';
        include('views/layouts/base.php');
    }

    public function create() {
        if ($_POST) {
            $this->user->email = $_POST['email'];
            $this->user->ten = $_POST['ten'];
            $this->user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->user->role = $_POST['role'];
            if ($this->user->create()) {
                $_SESSION['message'] = 'Tạo người dùng mới thành công!';
                $_SESSION['message_type'] = 'success';
                header("Location: index.php?model=user");
            }else {
                $_SESSION['message'] = 'Tạo mới thất bại!';
                $_SESSION['message_type'] = 'danger';
            }
        }
        $content = 'views/users/create.php';
        include('views/layouts/base.php');
    }

    public function edit($id) {
        if ($_POST) {
            
            $user = $this->user->readById($id);
            $this->user->user_id = $id;
            $this->user->email = $_POST['email'];
            $this->user->ten = $_POST['ten'];
            if($_POST['password']!=''){
                $this->user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            }
            $this->user->role = $_POST['role'];
            if ($this->user->update()) {
                // var_dump($_POST['ten']);
                $_SESSION['message'] = 'Sửa người dùng thành công!';
                $_SESSION['message_type'] = 'success';
                header("Location: index.php?model=user");
            }else {
                $_SESSION['message'] = 'Sửa người dùng thất bại!';
                $_SESSION['message_type'] = 'danger';
            }
        }else {
            $user = $this->user->readById($id);
            $content = 'views/users/edit.php';
            include('views/layouts/base.php');
        }
    }

    public function delete($id) {
        if ($this->user->delete($id)) {
            $_SESSION['message'] = 'Xóa thành công!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Xóa thất bại';
            $_SESSION['message_type'] = 'danger';
        }
        header("Location: index.php?model=user");
    }
}
?>
