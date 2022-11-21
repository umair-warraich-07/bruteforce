<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <style>
    body {
        margin: 0;
        font-family: "Lato", sans-serif;
        background-color: #ff8080;
    }

    .container-fluid {
        margin-left: 250px;

    }

    .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #ffb3b3;
        position: fixed;
        height: 100%;
        overflow: auto;
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #ffb3b3;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #ff4d4d;
        color: white;
    }

    div.content {
        margin-left: 200px;
        padding: 1px 16px;
        height: 1000px;
    }

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="#">
            <img src="logo.png" alt="logo" style="width:100px; height:40px;">
        </a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Uniten Info System Version: 1.0</a>
            </li>
        </ul>
    </nav>


    <div class="sidebar">
        <a class="active" href="#home">Student</a>
        <a href="#news">Academic regulations</a>
        <a href="#contact">Advising</a>
        <a href="#about">Advisor Meeting</a>
        <a href="#about">Apply to Graduate</a>
        <a href="#about">Bio Data</a>
        <a href="#about">Cancelled Classes</a>
        <a href="#about">Class Notices</a>
        <a href="#about">Current Classes</a>
        <a href="#about">Exams</a>
        <a href="#about">ITS</a>
        <a href="#about">Ledger Balance</a>
        <a href="#about">Next of Kin</a>

    </div>


    <div class="container-fluid">

        <h3>Welcome to Uniten Info System</h3>
        <p>Please click on the menu items on the left.</p>
        <p>If you would like to send feedback to Uniten please use i-Recommend</p>
    </div>

</body>

</html>