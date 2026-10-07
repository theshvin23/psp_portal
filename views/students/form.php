<?php
$isEdit = isset($editStudent);
$formAction = $isEdit
    ? "index.php?action=student_edit&id=" . urlencode($editStudent['id'])
    : "index.php?action=student_add";
include __DIR__ . '/../../includes/header.php';
include __DIR__ . '/../../includes/navbar.php';
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">
            <?php echo $isEdit ? 'Edit Student Record' : 'New Student Record'; ?>
          </h5>

          <?php if (!empty($error)): ?>
            <p class="text-danger small"><?php echo htmlspecialchars($error); ?></p>
          <?php endif; ?>

          <form method="POST" action="<?php echo htmlspecialchars($formAction); ?>" novalidate>
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" required
                     value="<?php echo htmlspecialchars($editStudent['name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">NRIC</label>
              <input type="text" name="ic" class="form-control" required
                     pattern="[0-9]+" title="NRIC must contain numbers only"
                     value="<?php echo htmlspecialchars($editStudent['ic'] ?? ''); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Program</label>
              <input type="text" name="program" class="form-control" required
                     value="<?php echo htmlspecialchars($editStudent['program'] ?? ''); ?>">
            </div>
            <div class="mb-3">
              <label class="form-label">Marks</label>
              <input type="number" step="0.01" min="0" max="100" name="marks" class="form-control" required
                     value="<?php echo htmlspecialchars($editStudent['marks'] ?? ''); ?>">
            </div>
            <button type="submit" class="btn btn-primary">
              <?php echo $isEdit ? 'Save Changes' : 'Save'; ?>
            </button>
            <a href="index.php?action=students" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
