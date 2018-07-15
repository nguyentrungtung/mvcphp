



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_PATH ?>public/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_PATH ?>public/link/Bootstrap 3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_PATH ?>public/icons/css/fontawesome-all.min.css">

    <script src="<?php echo __SITE_PATH ?>public/link/JQuery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo __SITE_PATH ?>public/link/Bootstrap 3/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="body_m">
        <div class="header">
            NTQ Solution Admin
        </div>
            <div class="main">
                <div class="main__left">
                    <?php
                        if(Session::get("login")==true){
                        echo "<p class='main__left__tit'>"."Xin Chào:".Session::get("user"). "</p>";
                        //echo " <p href='".__SITE_PATH."user/logout'>logout</p>";
                        }else{
                            echo " <a class='main__left__user' href='".__SITE_PATH."user/login'>Login</a>";
                       //echo "Login";
                    }?>
                   

                    <div class="main__left__user">
                        <div class="main__left__user__avatar">
                        <img src="<?php echo __SITE_PATH ?>public/avatar.png" alt="">
                        </div>
                        <div class="main__left__user__ctrl">
                            <p>
                                <i class="fas fa-cog"></i>
                                Update Profile
                            </p>
                            <p>
                                <i class="fas fa-share"></i>

                                <a href="<?php echo __SITE_PATH.'user/logout' ?>" title="">Log Out</a>
                               
                            </p>
                        </div>
                    </div>

                    <ul class="main__left__menu">
                        <li><a href="<?php echo __SITE_PATH.'category/index'; ?>" class="js_menu_catergory"><i class="fas fa-th-large"></i>Catergories</a></li>
                        <li><a href="<?php echo __SITE_PATH.'product/index'; ?>" class="js_menu_product"><i class="fas fa-list-ul"></i>Products</a></li>
                        <li><a href="<?php echo __SITE_PATH.'user/index'; ?>" class="js_menu_user"><i class="fas fa-user-alt"></i>Users</a></li>
                    </ul>
                </div>