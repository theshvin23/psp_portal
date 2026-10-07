<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/navbar.php'; ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h5 class="card-title mb-4">My Profile</h5>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger small"><?php echo htmlspecialchars($error); ?></div>
          <?php endif; ?>

          <?php if (!empty($success)): ?>
            <div class="alert alert-success small"><?php echo htmlspecialchars($success); ?></div>
          <?php endif; ?>

          <div class="d-flex align-items-center mb-4">
            <div class="profile-image-container me-3">
              <?php $profileImage = !empty($currentStudent['profile_picture']) ? 'assets/uploads/' . htmlspecialchars($currentStudent['profile_picture']) : 'https://via.placeholder.com/120x120?text=Profile'; ?>
              <img src="<?php echo $profileImage; ?>" alt="Profile picture" class="profile-image img-thumbnail">
            </div>
            <div>
              <p class="mb-1"><strong>Name:</strong> <?php echo htmlspecialchars($currentStudent['name']); ?></p>
              <p class="mb-1"><strong>NRIC:</strong> <?php echo htmlspecialchars($currentStudent['ic']); ?></p>
              <p class="mb-0"><strong>Program:</strong> <?php echo htmlspecialchars($currentStudent['program']); ?></p>
            </div>
          </div>

          <form method="POST" enctype="multipart/form-data" class="mb-3">
            <div class="mb-3">
              <label for="profile_picture" class="form-label">Upload Profile Picture</label>
              <input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/jpeg, image/webp" class="form-control form-control-sm">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Upload Picture</button>
            <a href="index.php?action=change_password" class="btn btn-outline-primary btn-sm">Change Password</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
