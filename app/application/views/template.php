<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>DBLP VIZ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f2f2f2;
    }
    h1 {
      color: #007bff;
      text-align: center;
    }
    footer {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="py-5">
      <h1>DBLP VIZ</h1>
      <?php $this->load->view($content);?>
    </div>
        <strong>&copy;2022</strong>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
