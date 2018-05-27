<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="main.js"></script>
</head>
<body>
<div class="">
    <form action="" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table>
            <tr>
                <td colspan=2>
                    Đăng ký thành viên
                </td>
            </tr>
            <tr>
                <td>
                    Email:
                </td>
                <td>
                    <input type="email" name="email" id="email">
                    <p>{{ $errors->first('email') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Password:
                </td>
                <td>
                    <input type="password" name="pass" id="pass">
                    <p>{{ $errors->first('pass') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Họ tên:
                </td>
                <td>
                    <input type="text" name="hoten" id="hoten">
                    <p>{{ $errors->first('hoten') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Giới tính:
                </td>
                <td>
                    <input type="text" name="gt" id="gt">
                </td>
            </tr>
            <tr>
                <td>
                    Tuổi:
                </td>
                <td>
                    <input type="number" name="tuoi" id="tuoi">
                    <p>{{ $errors->first('tuoi') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Địa chỉ:
                </td>
                <td>
                    <input type="text" name="diachi" id="diachi">
                    <p>{{ $errors->first('diachi') }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    Thu nhập:
                </td>
                <td>
                    <input type="number" name="thunhap" id="thunhap">
                    <p>{{ $errors->first('thunhap') }}</p>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <button type="submit">
                        Đăng ký
                    </button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>