<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">LaurenMazon</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
          if(!isset($_SESSION["id_client"]) && !isset($_COOKIE["id_client"])){
             echo'<li class="nav-item">';
                echo '<a class="nav-link" href="login.php">Vous Connecter</a>';
                echo '</li>';
              }else{

                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="panier.php">';
                echo 'panier';
                echo '</a>';
                echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="insert_livre.php">';
                    echo '+ Livre';
                    echo '</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="insert_auteur.php">';
                    echo '+ Auteur';
                    echo '</a>';
                    echo '</li>';


                
                echo '<a class="nav-link" href="logout.php">Vous Deconnecter</a>';
                
                echo '<a class="nav-link" href="inscription1.php">Mon compte</a>';
             } ?> 
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Nous contacter</a>
          </li>
         
        </ul>
      </div>
    </div>
  </nav>