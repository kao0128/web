<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>輔仁大學管理學院租借教室</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon"
        href="https://upload.wikimedia.org/wikipedia/zh/thumb/4/43/Fu_Jen_Catholic_University_College_of_Management_seal.svg/1200px-Fu_Jen_Catholic_University_College_of_Management_seal.svg.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

    <style>
        header {
            height: 80vh;
            background-image: url('./assets/IMG_8256.JPG');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .header-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .header-content img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        h1 {
            font-size: 3rem;
            margin: 0;
        }

        .vertical-nav {
            display: flex;
            flex-direction: column;

            padding: 30px;
            width: 300px;

        }

        .vertical-nav a {
            text-decoration: none;
            color: #070c2c;
            padding: 20px;
            margin: 15px 0;
            background-color: #e9ecef;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }

        .vertical-nav a:hover {
            background-color: #ced4da;
        }

        
    </style>
</head>

<body class="bg-dark text-white">

    <main class="flex-shrink-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand "><img
                        src="https://upload.wikimedia.org/wikipedia/zh/thumb/4/43/Fu_Jen_Catholic_University_College_of_Management_seal.svg/1200px-Fu_Jen_Catholic_University_College_of_Management_seal.svg.png"
                        style="width:50px"> 輔仁管理學院 管理者
                </a>

            </div>
        </nav>

        <header>
            <div class="header-content">
                <a><img src="https://photo.s3.com.tw/look/Upload/BlogArticleImages/22806/20240517103139910_700_0_80.jpg"
                        alt="Profile Image"></a>
                <h1 class="fw-bolder">金采源</h1>
                <h4>管理學院</h4>
                <p>管理權限者</p>
            </div>
        </header>

        <div class="d-flex">
            <div class="vertical-nav">
                <a href="./管理者登入介面.php">公告</a>
                <a href="./管理教室租借.php">管理教室租借</a>
                <a href="./管理學期區間.php">管理學期區間</a>
                <a href="./管理教師權限.php">管理教師權限</a>
                <a href="./管理預約記錄.php">管理預約記錄</a>
                <a href="./首頁.html">登出</a>

            </div>

            <div class="form-container">
                <?php include 'manage_teachers.php'; ?>
            </div>
</body>

</html>