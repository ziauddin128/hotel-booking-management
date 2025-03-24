<?php 
  require "inc/config.php";
  require "inc/function.php";

  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require "inc/links.php"; ?>
</head>
<body class="bg-light">

  <!-- top bar -->
  <section class="container-fluid py-2 bg-dark text-white d-flex align-items-center justify-content-between position-sticky top-0 z-2">
    <a href="#" class="h-font text-white fs-3 text-decoration-none">TJ HOTEL</a>
    <a href="logout" class="btn btn-light btn-sm">Logout</a>
  </section>  

  <!-- slide menu -->
  <div class="col-lg-2 bg-dark border-top border-3 border-secondary py-2 py-lg-3 px-2 customSideMenu">
  
    <nav id="nav-bar" class="navbar navbar-expand-lg bg-dark text-white">
        <div class="container-fluid flex-row flex-lg-column align-items-baseline p-0">
            <h4 class="my-0">Admin Panel</h4>
            <button class="navbar-toggler shadow-none navbar-dark" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch w-100" id="adminDropdown">
              <ul class="nav nav-pills flex-column mt-3">
                <li class="nav-item">
                  <a class="nav-link text-white" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                  <button class="btn text-white w-100 d-flex align-items-center justify-content-between px-3 shadow-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#bookingList">
                    <span>Bookings</span>
                    <span><i class="bi bi-caret-down-fill"></i></span>
                  </button>

                  <div class="collapse show px-3 small mb-1" id="bookingList">
                    <ul class="nav nav-pills flex-column rounded border border-secondary">
                      <li class="nav-item">
                        <a class="nav-link text-white" href="new-bookings">New Bookings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="refund-bookings">Refund Bookings</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link text-white" href="bookings-record">Bookings Record</a>
                      </li>
                    </ul>
                  </div>

                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="users">Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="user-queries">User Queries</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="rate-review">Rate & Review</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="rooms">Rooms</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="features-facilities">Features-Facilities</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="carousel">Carousel</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="settings">Settings</a>
                </li>
              </ul>               
            </div>
        </div>
    </nav>

  </div>