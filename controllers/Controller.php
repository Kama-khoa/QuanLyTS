<?php
include_once 'config/database.php';

class Controller {

    public function __construct() {
    }

    public function index() {
        $content = 'views/welcome.php';
        include('views/layouts/base.php');
        // include('views/welcome.php');
    }

    public function create() {

    }

    public function edit($id) {
        
    }

    public function delete($id) {
        
    }
    public function show($id) {
        
    }
    public function viewedit($id) {}
    public function viewcreate(){}
    public function register() {}
    public function login() {}
    public function logout() {}
    public function profile() {}
    public function export(){}
    public function statistics(){}
    public function forgot_password_request(){}
    public function reset_password(){}
    public function detail($id){}
    public function viewcreatekh($id){}
    public function search() {}
    public function getQuantityInStock(){}
    public function getByLoai(){}
    public function xet_duyet($id){}
    public function nhap_tai_san($id){}
    public function kiem_tra($id){}
    public function exportWord($id){}
}
?>
