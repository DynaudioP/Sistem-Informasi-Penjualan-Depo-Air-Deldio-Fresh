<?php
require "function/function.php";
$con = connect();

if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $response = loginAdmin($username, $password);

    if ($response["status"] == "error") {
        echo '
        <script>
        Swal.fire("SweetAlert2 is working!");
        </script>
        ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="library/dselect.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer type="text/javascript"
        src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script defer type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <title>Login</title>

</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url("images/wp2.jpg") no-repeat;
        background-size: cover;
        background-position: center;
    }

    .wrapper {
        width: 420px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(9px);
        color: #fff;
        border-radius: 12px;
        padding: 30px 40px;
    }

    .wrapper h1 {
        font-size: 36px;
        text-align: center;
    }

    .wrapper .input-box {
        position: relative;
        width: 100%;
        height: 50px;

        margin: 30px 0;
    }

    .input-box input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .input-box input::placeholder {
        color: #fff;
    }

    .input-box i {
        position: absolute;
        right: 20px;
        top: 30%;
        transform: translate(-50%);
        font-size: 20px;

    }

    .wrapper .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
    }

    .remember-forgot label input {
        accent-color: #fff;
        margin-right: 3px;

    }

    .remember-forgot a {
        color: #fff;
        text-decoration: none;

    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }

    .wrapper .btn {
        width: 100%;
        height: 45px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
    }

    .wrapper .register-link {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;

    }

    .register-link p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .register-link p a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="wrapper">
        <form method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username"
                    value="<?php echo @htmlspecialchars($username); ?>" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password"
                    value="<?php echo @htmlspecialchars($password); ?>" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">

            </div>
            <button type="submit" name="submit" class="btn">Login</button>

        </form>
    </div>
    <!-- <div class="wrap-box-login container-fluid d-flex justify-content-center align-items-center min-vh-100">
        <div class="row box-area wrapper mx-2">
            <form method="POST" autocomplete="off "class="box-login col d-flex flex-column justify-content-center">
                <h3 class="align-self-center">Login</h3>
                <label for="">Username</label>
                <input type="text" placeholder="Username" name="username" class="form-control form-control-sm" value="">
                <label for="">Password</label>
                <input type="text" placeholder="Password" name="password" class="form-control form-control-sm" value="">
                <button type="submit" name="submit">Submit</button>
            </form>
            <div class="box-left-login col"></div>
            <div class="box-right-login col">
                <form action="" method="POST" autocomplete="off">
                <h3>Login</h3>
                <label for="">Username</label>
                <input type="text" name="username" value="">
                <label for="">Password</label>
                <input type="text" name="password" value="">
                <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div> -->

</body>

</html>