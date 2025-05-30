<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <style>
    .navbar {
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .navbar-brand {
      font-weight: 600;
      font-size: 1.5rem;
    }
    .nav-link {
      font-weight: 500;
      padding: 0.5rem 1rem;
      margin: 0 0.25rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }
    .nav-link:hover, .nav-link.active {
      background-color: rgba(13, 110, 253, 0.1);
    }
    .search-btn {
      border-radius: 0.5rem;
      padding: 0.5rem 1.5rem;
    }
  </style>
</head>
<body>
  <header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
      <div class="container">
        <a class="navbar-brand text-primary" href="<?=$_SERVER['SCRIPT_NAME'];?>">Articles</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0 text-center">
            <li class="nav-item">
            <a class="nav-link" href="<?= dirname($_SERVER['SCRIPT_NAME']) ?>/hello/Victor">Hello</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/create">Create Article</a>
            </li>
          </ul>
          <form class="d-flex justify-content-center">
            <button class="btn btn-outline-primary search-btn" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container">