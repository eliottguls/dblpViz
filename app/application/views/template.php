<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>DBLP VIZ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

    header {
      width: 100%;
      height: 5vh;
      background-color: #343a40;
      color: #fff;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    p{
      color: #fff;
    }

    body {
        background-color: grey;
        color: #fff;
    }

    h2 {
        text-align: center;
    }

    .btn-primary {
        background-color: #718096;
        border-color: #2d3748;
    }

    h3 {
        text-align: center;
        margin-top: 50px;
    }

    footer {
        height: 5vh;
        width:100%;
    }

    table {
        margin: 50px 0px;
    }
    
  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
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
  
  <main>
  <div class="container">
    <div class="py-5">
      <?php $this->load->view($content);?>
    </div>
  </div>
  </main>

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
