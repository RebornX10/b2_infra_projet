<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?id=1">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?id=1">Home</a>
        </li>
        <?php if (isConnected()) : ?>
          <?php if (isAdmin()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?id=5">Admin</a>
            </li>
          <?php elseif (isUser()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?id=6">Ma page</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <form class="d-flex">
        <?php if (isConnected()) : ?>
          <a class="btn btn-outline-danger" href="index.php?id=4">Logout</a>
        <?php elseif (!isConnected()) : ?>
          <a class="btn btn-outline-success" href="index.php?id=2">Login</a>
          <a class="btn btn-outline-primary" href="index.php?id=3">Register</a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</nav>