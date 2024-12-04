<?php
global $db;
if(isset($_GET['action'])){
        $action = $_GET['action'];
    }
    else{
        $action = '';
    }

    $thanhcong = array();
    switch($action){
        case 'add':{
            if(isset($_POST['add_user'])){
                $hoten = $_POST['hoten'];
                $namsinh = $_POST['namsinh'];
                $quequan = $_POST['quequan'];

                if($db->AddData($hoten, $namsinh,$quequan)){
                    $thanhcong[] = 'add_success';
                }
            }
            require_once('View/thanhvien/add_user.php');
            break;
        }

        case 'update':{
            require_once('View/thanhvien/update_user.php');
            break;
        }

        case 'delete': {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']); // Lấy ID từ URL
                require_once('Model/function.php');
                $db = new Database();

                // Xóa dữ liệu trong database
                if ($db->DeleteData($id)) {
                    // Xóa thành công, chuyển hướng về danh sách thành viên
                    header("Location: index.php?controller=thanh-vien&action=list");
                    exit;
                } else {
                    // Thông báo lỗi nếu xóa thất bại
                    echo "<p class='text-center text-danger'>Lỗi: Không thể xóa thành viên!</p>";
                }
            } else {
                echo "<p class='text-center text-danger'>Lỗi: Không tìm thấy ID thành viên!</p>";
            }
            break;
        }

        case 'list': {
            $tblTable = "thanhvien";
            $db->getData($tblTable);  // Lấy dữ liệu từ database
            $data = $db->getAllData($tblTable);  // Đảm bảo dữ liệu trả về là một mảng
            if (empty($data)) {
                echo "Không có dữ liệu để hiển thị";
            }
            require_once('View/thanhvien/list.php');
            break;
        }

        default:{
            require_once('View/thanhvien/list.php');
        }
    }
?>
