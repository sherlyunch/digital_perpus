<!DOCTYPE html>
<html>
<head>
  <title>Login - Perpustakaan Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-header text-center">
            <h4>Login Admin</h4>
          </div>
          <div class="card-body">
            <form method="post" action="<?= base_url('index.php/auth/login') ?>">
              <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if($this->session->flashdata('error')): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '<?= $this->session->flashdata('error'); ?>',
        confirmButtonColor: '#3085d6'
      })
    </script>
  <?php endif; ?>

</body>
</html>