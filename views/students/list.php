<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/navbar.php'; ?>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Grade Management</h5>
    <a href="index.php?action=student_add" class="btn btn-primary btn-sm">New Student</a>
  </div>

  <?php if (isset($_GET['msg'])): ?>
    <?php
      $msgs = [
          'added'   => 'Record added.',
          'updated' => 'Record updated.',
          'deleted' => 'Record deleted.',
      ];
    ?>
    <p class="text-success small"><?php echo htmlspecialchars($msgs[$_GET['msg']] ?? ''); ?></p>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered align-middle bg-white">
      <thead class="table-light">
        <tr>
          <th>No.</th><th>Name</th><th>NRIC</th><th>Program</th><th>Marks</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($students)): ?>
          <tr><td colspan="6" class="text-center text-muted">No student records yet.</td></tr>
        <?php else: ?>
          <?php foreach ($students as $i => $s): ?>
            <tr>
              <td><?php echo $i + 1; ?></td>
              <td><?php echo htmlspecialchars($s['name']); ?></td>
              <td><?php echo htmlspecialchars($s['ic']); ?></td>
              <td><?php echo htmlspecialchars($s['program']); ?></td>
              <td><?php echo htmlspecialchars($s['marks']); ?></td>
              <td>
                <a href="index.php?action=student_edit&id=<?php echo urlencode($s['id']); ?>"
                   class="btn btn-sm btn-warning btn-action">Edit</a>
                <a href="index.php?action=student_delete&id=<?php echo urlencode($s['id']); ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Delete this student record?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
