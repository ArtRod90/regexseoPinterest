<nav class="navbar navbar-expand-lg fixed-top bg-dark " >
  <div class="container-fluid">
  <a class="navbar-brand" href="/">
            <img  src="/build/img/regexseo.webp" alt="Logo" width="100" height="24" class="d-inline-block align-text-top">
            Pinterest            
    </a>
    <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
     
    
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <?php 
        if (isset($_SESSION['imagen'])) {
         
      if ($_SESSION['imagen'] === null || $_SESSION['imagen'] === "" ) {
        
      }else{
          ?>
      <img id="Havatar" src="<?php echo s($_SESSION['imagen']) ?>" class="rounded-circle" alt="avatar">
      <?php 
      }
    }
    if(isset($_SESSION['privilegios'])){

   
    if($_SESSION["privilegios"] === "1" || $_SESSION["privilegios"] === "2"){
      ?>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/admin">Administrator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li> -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if($_SESSION["privilegios"] === "1"){ 
              echo "Administrator";
          }elseif ($_SESSION["privilegios"] === "2") {
            echo "Editor"; 
          }?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/admin/home">Home</a></li>
            <?php if ($_SESSION["privilegios"] === "1") {
              ?>
              <li><a class="dropdown-item" href="/admin/publisher">Manage publishers</a></li>
              <?php
            } ?>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/admin/fotos">All photos</a></li>
            <li><a class="dropdown-item" href="/admin/usuarios">All users</a></li>
            <li><a class="dropdown-item" href="/admin/ban"">Banned users</a></li>
          </ul>
        </li>
       <?php }  }?>
      </ul> 
      <div id="botonesH" class="d-flex flex-wrap align-items-center" >
        <a class="nav-item  text-light me-3 username" href="/perfil"><?php
        if (isset($_SESSION["email"])) {
          echo s($_SESSION["email"] );
        }else {
          echo s("USER@MAIL.COM" );
        }
         ?></a>
        <a href="/favoritas" class="btn btn-outline-light d-flex  align-items-center me-3" id="favorito">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
</svg> FAVORITES</a>
        <a href="/upload" class="btn btn-outline-secondary me-3" >UPLOAD</a>
        <a href="/logout" class="btn btn-outline-danger" >LOGOUT</a>
      </div>
    </div>
  </div>
</nav>
<!-- <div class="div-oculto"></div> -->


   