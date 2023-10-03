<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <a href="https://fontawesome.com/v4.7.0/examples/"></a> -->


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>


  <link rel="stylesheet" href="asset/style.css">

  <script src="js/main.js"></script>
  <title>FLEX NUTRI</title>
</head>
<body>

<?php 
  session_start();
  if(!$_SESSION['login'])
  {
    header("Location: index.php");
    exit();

  }
?>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">FLEX NUTRI</a>
      <a class="navbar-brand" href="logout.php" style="float:right;">LOGOUT</a>
    </div>
  </nav>
  <div class="wrapper">
    <div class="sidebar">
      <ul class="list-group">
        <li class="list-group-item" id="home">
          <i class="fa fa-home"></i><span>HOME</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="sell">
          <i class="fa fa-pie-chart" aria-hidden="true"></i><span>INVOICE</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="stock">
          <i class="fa fa-database" aria-hidden="true"></i><span>STOCK</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="pur">
          <i class="fa fa-pie-chart" aria-hidden="true"></i><span>PURCHASE</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="item">
          <i class="fa fa-archive" aria-hidden="true"></i><span>ITEM</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="master">
          <i class="fa fa-archive" aria-hidden="true"></i><span>MASTER</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="vendor">
          <i class="fa fa-user" aria-hidden="true"></i><span>VENDOR</span>
        </li>
        <div class="belowli"></div>
        <li class="list-group-item" id="profit">
          <i class="fa fa-shopping-cart"></i><span>PROFIT</span>
        </li>
        <div class="belowli"></div>
      </ul>
    </div>
    <script>
    $(document).ready(function()
    {
      const headerTab = new HeaderTab();
    });
  </script>