<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <h3 class="navbar-brand mb-0" href="#">Titulo Creativo^10</h3>

  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"> <a class="nav-link" href="index.php">Home</a> </li>

      <li class="nav-item"> <a class="nav-link" href="informacion.php">Informacion</a> </li>
    </ul>
    <span class="navbar-text">
      <a class="btn btn-outline-warning my-2 my-sm-0" href="vista-vendedores.php">Vendedores</a>
<?php if(isset($_SESSION["datos"])){echo '<a class="btn btn-outline-danger my-2 my-sm-0" href="index.php?out=1">log-out</a>'; }?>
    </span>
  </div>
</nav>
</header>
