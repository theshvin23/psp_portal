<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/navbar.php'; ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Update Password</h5>

          <?php if (!empty($error)): ?>
            <p class="text-danger small"><?php echo htmlspecialchars($error); ?></p>
          <?php endif; ?>
          <?php if (!empty($success)): ?>
            <p class="text-success small"><?php echo htmlspecialchars($success); ?></p>
          <?php endif; ?>

          <form method="POST" action="index.php?action=change_password" novalidate>
            <div class="mb-3">
              <label class="form-label">Old Password</label>
              <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" name="new_password" class="form-control" required minlength="6">
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php?action=profile" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
