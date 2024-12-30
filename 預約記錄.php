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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

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

        .table-container {
            margin: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            width: 1000px;
            overflow-x: auto;
        }

        #reservationTable {
            width: 100%;
            font-size: 1.2rem;
        }

        .cancel-button {
            background-color: #4d4748;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .cancel-button:hover {
            background-color: #af1020;
        }
    </style>

</head>

<body class="d-flex flex-column bg-dark ">
    <main class="flex-shrink-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand "><img
                        src="https://upload.wikimedia.org/wikipedia/zh/thumb/4/43/Fu_Jen_Catholic_University_College_of_Management_seal.svg/1200px-Fu_Jen_Catholic_University_College_of_Management_seal.svg.png"
                        style="width:50px"> 輔仁管理學院
                </a>
            </div>
        </nav>

        <header>
            <div class="header-content">
                <a><img src="https://preview.redd.it/230502-le-sserafim-weverse-update-kazuha-v0-i1mhf41k5dxa1.jpg?width=640&crop=smart&auto=webp&s=7e0cce812259e8099ef464a30b6f6e01a29dd5a0"
                        alt="Profile Image"></a>
                <h1 class="fw-bolder">中村一葉</h1>
                <h4>管理學院</h4>
                <p>資訊科教師</p>
            </div>
        </header>

        <div class="d-flex">
            <div class="vertical-nav">
                <a href="./老師登入介面.php">公告</a>
                <a href="./租借教室.php">租借教室</a>
                <a href="./教室介紹.html">教室介紹</a>
                <a href="./預約記錄.php">預約記錄</a>
                <a href="./首頁.html">登出</a>
            </div>


            <div class="form-container">
            <?php include 'reservation_records.php'; ?>
            </div>

    </main>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    

</body>

</html>