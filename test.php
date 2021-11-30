<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin panel dashboard card design usign html and css - www.pakainfo.com</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
            background: #eee;
            font-family: 'Raleway', sans-serif;
        }

        .main-part {
            width: 80%;
            margin: 0 auto;
            text-align: center;
            padding: 0px 5px;
        }

        .cpanel {
            width: 32%;
            display: inline-block;
            background-color: #34495E;
            color: #fff;
            margin-top: 50px;
        }

        .icon-part i {
            font-size: 30px;
            padding: 10px;
            border: 1px solid #fff;
            border-radius: 50%;
            margin-top: -25px;
            margin-bottom: 10px;
            background-color: #34495E;
        }

        .icon-part p {
            margin: 0px;
            font-size: 20px;
            padding-bottom: 10px;
        }

        .card-content-part {
            background-color: #2F4254;
            padding: 5px 0px;
        }

        .cpanel .card-content-part:hover {
            background-color: #5a5a5a;
            cursor: pointer;
        }

        .card-content-part a {
            color: #fff;
            text-decoration: none;
        }

        .cpanel-green .icon-part,
        .cpanel-green .icon-part i {
            background-color: #16A085;
        }

        .cpanel-green .card-content-part {
            background-color: #149077;
        }

        .cpanel-orange .icon-part,
        .cpanel-orange .icon-part i {
            background-color: #F39C12;
        }

        .cpanel-orange .card-content-part {
            background-color: #DA8C10;
        }

        .cpanel-blue .icon-part,
        .cpanel-blue .icon-part i {
            background-color: #2980B9;
        }

        .cpanel-blue .card-content-part {
            background-color: #2573A6;
        }

        .cpanel-red .icon-part,
        .cpanel-red .icon-part i {
            background-color: #E74C3C;
        }

        .cpanel-red .card-content-part {
            background-color: #CF4436;
        }

        .cpanel-skyblue .icon-part,
        .cpanel-skyblue .icon-part i {
            background-color: #8E44AD;
        }

        .cpanel-skyblue .card-content-part {
            background-color: #803D9B;
        }
    </style>
</head>

<body>
    <div class="main-part">
        <div class="cpanel">
            <div class="icon-part">
                <i class="fa fa-users" aria-hidden="true"></i><br>
                <small>Members</small>
                <p>985</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
        <div class="cpanel cpanel-green">
            <div class="icon-part">
                <i class="fa fa-money" aria-hidden="true"></i><br>
                <small>Account</small>
                <p>$ 452</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
        <div class="cpanel cpanel-orange">
            <div class="icon-part">
                <i class="fa fa-bell" aria-hidden="true"></i><br>
                <small>Alert</small>
                <p>11 New</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
        <div class="cpanel cpanel-blue">
            <div class="icon-part">
                <i class="fa fa-tasks" aria-hidden="true"></i><br>
                <small>Task</small>
                <p>85</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
        <div class="cpanel cpanel-red">
            <div class="icon-part">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i><br>
                <small>Cart</small>
                <p>$ 45</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
        <div class="cpanel cpanel-skyblue">
            <div class="icon-part">
                <i class="fa fa-comments" aria-hidden="true"></i><br>
                <small>Mentions</small>
                <p>104</p>
            </div>
            <div class="card-content-part">
                <a href="#">More Details </a>
            </div>
        </div>
    </div>
</body>