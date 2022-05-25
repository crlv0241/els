<?php

    require_once "../../db/connecttion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMATHS | Library</title>
    <link rel="stylesheet" href="./css/main.css">
    <?php require_once "../../cdn.php" ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  

    <style>
        .container-wave {
        position: relative;
        background: #2c3e50;
        height: 15vh;
        }

        .wave {
        position: absolute;
        height: 100px;
        width: 100%;
        background: #2c3e50;
        bottom: 0;
        overflow: hidden;
    }

        .wave::before, .wave::after {
        content: "";
        display: block;
        position: absolute;
        border-radius: 100% 50%;
        }

        .wave::before {
        width: 55%;
        height: 109%;
        background-color: #fff;
        right: -1.5%;
        top: 60%;
        }
        .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   


        @media (max-width:700px ){
            .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   
        }

  
/* 
        .dataTables_filter input {
            padding: .375rem .75rem !important;
            font-size: 1rem;
            position: relative;
            font-weight: 400;
            line-height: 1.5 ;
            width: 300px !important;
            border-radius: 4px;    
            text-align: left !important;
            background: white;
        } */

        #employee_data_paginate{
            max-width: 300px;
        }
        thead{display:none;}

        #employee_data_info{ display:none;}
        #employee_data_filter{
            margin-top: 2rem;
        }
        #employee_data_length{
            display: none;
        }

        #employee_data tr{
            width: 250px !important;
            display: block;
        }

        #employee_data tr td{
            display: block;
        }

        #employee_data{
            display: flex !important;
            max-width: 300px;
        }

        #employee_data_wrapper{
            max-width: 300px;
        }


        .section-title {
            position: relative;
        }
        .section-title h2 {
            color: #1d2025;
            position: relative;
            margin: 0;
            font-size: 24px;
        }
        @media (min-width: 768px) {
            .section-title h2 {
                font-size: 28px;
            }
        }
        @media (min-width: 992px) {
            .section-title h2 {
                font-size: 34px;
            }
        }
        .section-title.title-ex1 h2 {
            padding-bottom: 20px;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2 {
                padding-bottom: 30px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2 {
                padding-bottom: 40px;
            }
        }
        .section-title.title-ex1 h2:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 12px;
            width: 110px;
            height: 1px;
            background-color: #d6dbe2;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2:before {
                bottom: 17px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2:before {
                bottom: 25px;
            }
        }
        .section-title.title-ex1 h2:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 12px;
            width: 40px;
            height: 1px;
            background-color: #0cc652;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2:after {
                bottom: 17px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2:after {
                bottom: 25px;
            }
        }
        .section-title.title-ex1.text-center h2:before {
            left: 50%;
            transform: translateX(-50%);
        }
        .section-title.title-ex1.text-center h2:after {
            left: 50%;
            transform: translateX(-50%);
        }
        .section-title.title-ex1.text-right h2:before {
            left: auto;
            right: 0;
        }
        .section-title.title-ex1.text-right h2:after {
            left: auto;
            right: 0;
        }
        .section-title.title-ex1 p {
            font-family: "Montserrat", sans-serif;
            color: #8b8e93;
            font-size: 14px;
            font-weight: 300;
        }


        .price-card {
            background: #f5f5f6;
            padding: 40px 35px;
            position: relative;
            border-radius: 2px;
            overflow: hidden;
        }
        .price-card:before {
            position: absolute;
            content: "";
            top: 0;
            right: -35px;
            width: 88px;
            height: 88px;
            background-image: url("https://www.freeiconspng.com/uploads/open-book-icon-free-books-and-education-13.png");

            opacity: 0.2;
            border-radius: 8px;
            transform: rotate(45deg);
        }
        .price-card:after {
            position: absolute;
            content: "";
            top: 30px;
            right: -35px;
            width: 88px;
            height: 88px;
            opacity: 0.2;
            border-radius: 8px;
            transform: rotate(45deg);
            background-image: url("https://www.freeiconspng.com/uploads/open-book-icon-free-books-and-education-13.png");

        }
        .price-card h2 {
            font-size: 26px;
            font-weight: 600;
        }
        .price-card .btn {
            font-size: 11px;
            border-radius: 100px;
            padding: 0 25px;
            border: 0;
            color: #fff;
            float: right;
        }
        .price-card .btn.btn-primary {
            border: 0 !important;
        }
        .price-card.featured {
            background: #fff;
            border: 1px solid #ebebeb;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .price-card:hover .btn {
            background: #0cc652;
            border-color: #0cc652;
        }
        p.price span {
            display: inline-block;
            padding: 45px 15px 50px;
            padding-right: 0;
            font-size: 50px;
            font-weight: 600;
            color: #0cc652;
            position: relative;
        }
        p.price span:before {
            position: absolute;
            content: "$";
            font-size: 16px;
            top: 25px;
            font-weight: 300;
            left: 0;
        }
        .pricing-offers {
            padding: 0 0 10px;
        }
        .pricing-offers li {
            padding: 0 0 16px;
            line-height: 18px;
        }
        ul li {
            list-style-type: none;
        }
        .btn.btn-mid {
            height: 40px;
            line-height: 40px;
            padding: 0 20px;
        }
    </style>
</head>
<body>
        <?php require_once "./components/nav.php" ?>    
        <section class="container-wave"  style="display:flex ; align-items:flex-end">
            <div class="container" style="display:flex ; align-items:flex-end">

                <h2 class="h1" style="color:white; z-index:20">General Mariano Alvalez Technical High School Library</h2>
            </div>
            <div class="wave" style="display:flex; align-items:flex-end">
            </div>  
        </section>

        <?php 
            $stm = $PDO -> prepare("SELECT * FROM tbl_items");
            $stm -> execute();
            $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container">
        <div class="col-lg-6">
            <div class="input-group mt-3 ">
                <input type="text" class="form-control" placeholder="Search title, author, genre" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>

        <div id="catalog-result" class="mt-4">
            <section class="pricing-section">
                <div class="container">
                    <!-- RESULTS  -->
                    <div class="row">
                    <?php foreach($res as $i): ?>

                        <div class="col-12 mt-4">
                            <div class="price-card ">
                                <h2><?php echo $i['title'] ?></h2>
                                <p><?php echo $i['category'] ?></p>
                                <ul class="pricing-offers">
                                    <li>Author:<?php echo $i['author'] ?></li>
                                    <li>Publisher:<?php echo $i['publisher'] ?></li>
                                    <li>Publication Year:<?php echo $i['date'] ?> </li>
            
                                    <li>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i['id'] ?>" >
                                                Description
                                            </button>
                                            </h2>
                                            <div id="collapseOne<?php echo $i['id'] ?>" class="accordion-collapse collapsed collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <?php echo $i['description'] ?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>      
                                    </li>
                                </ul>
                                <a href="#" class="btn btn-primary btn-mid">Request</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        </div>

        </div>

        <script>  

	    </script>  
</body>

</html>