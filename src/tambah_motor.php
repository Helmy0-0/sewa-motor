<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Motor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <style>
    body {
      background: linear-gradient(to right, #ece9e6, #ffffff);
      min-height: 100vh;
    }

    .card {
      border-radius: 1rem;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.01);
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary i {
      margin-right: 0.5rem;
    }
  </style>
</head>

<body>
  <main class="container py-5 fade-in">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title mb-4 text-center fw-bold text-dark">Tambah Data Motor</h3>


            <form method="post" action="proses_tambah_motor.php" enctype="multipart/form-data" class="needs-validation" novalidate>
              <div class="mb-3">
                <label class="form-label" for="nama_motor">Nama Motor</label>
                <input type="text" name="nama_motor" id="nama_motor" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label" for="merek">Merek</label>
                <input type="text" name="merek" id="merek" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label" for="tipe">Tipe</label>
                <input type="text" name="tipe" id="tipe" class="form-control" />
              </div>

              <div class="mb-3">
                <label class="form-label" for="harga">Harga (Rp)</label>
                <input type="number" step="0.01" name="harga" id="harga" class="form-control" required />
              </div>

              <div class="mb-3">
                <label class="form-label" for="gambar">Gambar</label>
                <input class="form-control" type="file" name="file" id="file" accept="image/*" required />
              </div>

              <button type="submit" class="btn btn-dark w-100">
                <i class="bi bi-cloud-upload-fill"></i> Simpan
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <script>
    (() => {
      'use strict';
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();
  </script>

  <!-- Bootstrap Icons CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</body>
</html>


