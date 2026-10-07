<?php include __DIR__ . '/../../includes/header.php'; ?>
<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-4">PSP Portal Login</h5>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>

          <form method="POST" action="login.php" novalidate>
            <div class="mb-3">
              <label class="form-label">NRIC</label>
              <input type="text" name="ic" class="form-control" required
                     pattern="[0-9]+" title="NRIC must contain numbers only">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
