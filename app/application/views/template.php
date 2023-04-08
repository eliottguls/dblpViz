<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>DBLP VIZ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 50px;
      background-color: #007bff;
      color: #fff;
      z-index: 1;
    }

    p{
      color: #fff;
    }

    
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="/app">DBLP VIZ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!--
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Recherche</a>
          </li>
        </ul>
      </div>
      !-->
    </nav>
  </header>
  
  <div class="container">
    <div class="py-5">
      <?php $this->load->view($content);?>
    </div>
  </div>
  
  <footer class="bg-dark";>
    <div class="container ">
      <div class="row">
        <div class="col-2">
          <p>&copy;2022 DBLP VIZ</p>
        </div> 
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
