<?php
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = md5($_POST['matkhau']);
    $diachi = $_POST['diachi'];

    // Check if the email already exists
    $check_duplicate_query = "SELECT * FROM tbl_dangky WHERE email='$email' OR dienthoai='$dienthoai'";
    $check_duplicate_result = mysqli_query($mysqli, $check_duplicate_query);

	// Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$tenkhachhang || !$email || !$dienthoai || !$matkhau || !$diachi) {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='index.php?quanly=dangky'>Trở lại</a>";
        exit;
    }

	if (mysqli_num_rows($check_duplicate_result) > 0) {
        echo "Email hoặc số điện thoại đã tồn tại. Vui lòng chọn email hoặc số điện thoại khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
	// Validate phone number format
	if (!preg_match('/^\d{10}$/', $dienthoai)) {
		echo "Định dạng số điện thoại không hợp lệ. Vui lòng nhập số điện thoại. <a href='javascript: history.go(-1)'>Trở lại</a>";
		exit;
	}
    

    // Insert the new user into the database
    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang, email, diachi, matkhau, dienthoai) VALUES('$tenkhachhang', '$email', '$diachi', '$matkhau', '$dienthoai')");

    if ($sql_dangky) {
        echo '<p style="color:green">Bạn đã đăng ký thành công</p>';
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['email'] = $email;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
		echo '<script>window.location = "index.php";</script>';
        exit;
    } else {
        echo "Đăng ký thất bại. Vui lòng thử lại. <a href='index.php?quanly=dangky'>Trở lại</a>";
    }
}
?>



<p>Đăng ký thành viên</p>
<style type="text/css">
	table.dangky tr td {
	    padding: 5px;
	}
</style>
<form action="" method="POST">
<table class="dangky" border="1" size="50" style="border-collapse: collapse;">
	<tr>
		<td>Họ và tên</td>
		<td><input type="text" size="50" name="hovaten"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="email" size="50" name="email"></td>
	</tr>
	<tr>
		<td>Điện thoại</td>
		<td><input type="text" size="50" name="dienthoai"></td>
	</tr>
	<tr>
		<td>Địa chỉ</td>
		<td><input type="text" size="50" name="diachi"></td>
	</tr>
	<tr>
		<td>Mật khẩu</td>
		<td><input type="text" size="50" name="matkhau"></td>
	</tr>
	<tr>
		
		<td><input type="submit" name="dangky" value="Đăng ký"></td>
		<td><a href="index.php?quanly=dangnhap">Đăng nhập nếu có tài khoản</a></td>
	</tr>
</table>

</form>