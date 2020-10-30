
<header >
<nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
    
      <div id="logo">
    <img src="3il.png" alt="LOGO 3IL" style="width:20% ;" />
    
    </div>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item">
           <a class="nav-link" href="reservation.php?jeton=<?=$_SESSION['jeton']?>">RESERVATIONS</a>
        </li>
        <li class="nav-item mr-5">
           <a class="nav-link" href="salles.php?jeton=<?=$_SESSION['jeton']?>">SALLES</a>
        </li>
           <li class="nav-item mr-2 ml-5"> <a class="nav-link" href="PageInformation.php"><i class="fa fa-home" style="font-size:24px;"></i></a></li>
           <li class="nav-item">
           <a class="nav-link" href="index.php"><i class="fa fa-sign-out" aria-hidden="true" style="font-size:24px;"></i></a>
        </li>
        </ul>
      
    </div>
</nav>
</header>
  

