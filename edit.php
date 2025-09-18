<?php
include 'connection.php';

// Require login
if (empty($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

// Only superadmin/admin
$role = isset($_SESSION['usertype']) ? (int)$_SESSION['usertype'] : 0;
if (!in_array($role, [1, 2], true)) {
    header('Location: userhome.php');
    exit();
}

$email = $_SESSION['email'];

// Fetch dropdown data
function fetchOptions(mysqli $conn, string $sql): array {
    $res = $conn->query($sql);
    $out = [];
    if ($res instanceof mysqli_result) {
        while ($r = $res->fetch_assoc()) { $out[] = $r; }
    }
    return $out;
}
$genders     = fetchOptions($conn, "SELECT id, gender FROM gender ORDER BY id");
$shirts      = fetchOptions($conn, "SELECT id, shirtsize FROM shirt_size ORDER BY id");
$departments = fetchOptions($conn, "SELECT id, departments FROM department ORDER BY id");
$regions     = fetchOptions($conn, "SELECT id, regions FROM region ORDER BY id");
$positions   = fetchOptions($conn, "SELECT id, position, salary FROM position ORDER BY id");

// Load record if editing
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$record = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId FROM info WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $record = $stmt->get_result()->fetch_assoc();
    if (!$record) {
        header('Location: update.php');
        exit();
    }
}

// Handle save (insert or update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pid           = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $first_name    = trim($_POST['first_name'] ?? '');
    $last_name     = trim($_POST['last_name'] ?? '');
    $uemail        = trim($_POST['email'] ?? '');
    $date_started  = $_POST['date_started'] ?? '';
    $genderid      = (int)($_POST['genderid'] ?? 0);
    $shirtsizeid   = (int)($_POST['shirtsizeid'] ?? 0);
    $departmentid  = (int)($_POST['departmentid'] ?? 0);
    $regionId      = (int)($_POST['regionId'] ?? 0);
    $positionId    = (int)($_POST['positionId'] ?? 0);

    if ($pid > 0) {
        $stmt = $conn->prepare("UPDATE info SET first_name=?, last_name=?, email=?, date_started=?, genderid=?, shirtsizeid=?, departmentid=?, regionId=?, positionId=? WHERE id=?");
        $stmt->bind_param("ssssiiiiii", $first_name, $last_name, $uemail, $date_started, $genderid, $shirtsizeid, $departmentid, $regionId, $positionId, $pid);
        $stmt->execute();
    } else {
        // Default new records to usertype 3 (user)
        $defaultRole = 3;
        $stmt = $conn->prepare("INSERT INTO info (first_name, last_name, email, date_started, genderid, shirtsizeid, departmentid, regionId, positionId, usertype) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiiii", $first_name, $last_name, $uemail, $date_started, $genderid, $shirtsizeid, $departmentid, $regionId, $positionId, $defaultRole);
        $stmt->execute();
    }
    header('Location: update.php');
    exit();
}

// Helper to print selected
function sel($a, $b) { return ((string)$a === (string)$b) ? 'selected' : ''; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $id > 0 ? 'Edit' : 'Add' ?> Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    :root{
      --bg: #F0F0F0;
      --card: #D9E9CF;
      --accent: #96A78D;
      --muted: #B6CEB4;
      --text: #2b2b2b;
    }
    html, body { height: 100%; background: var(--bg); color: var(--text); }
    .page-wrap {
      min-height: 100vh;
      padding: 1rem;
      display: block;
    }
    .auth-card {
      width: 100%;
      max-width: 100%;
      background: linear-gradient(180deg, var(--card), var(--muted));
      border: 1px solid rgba(0,0,0,0.05);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      padding: 1.25rem;
    }
    .auth-title { background: var(--accent); color: #fff; font-weight: 700; font-size: 1.1rem; padding: .75rem 1rem; border-radius: 10px; margin-bottom: 1rem; letter-spacing: .5px; display: flex; justify-content: space-between; align-items: center; }
    .btn-accent { background: var(--accent); color: #fff; border: none; border-radius: 10px; }
    .btn-accent:hover { background: #7f8f78; color: #fff; }
    .btn-outline-accent { background: transparent; color: #2b2b2b; border: 2px solid var(--accent); border-radius: 10px; }
    .btn-outline-accent:hover { background: var(--accent); color: #fff; }
    .form-control:focus, .form-select:focus, .btn:focus { box-shadow: 0 0 0 .2rem rgba(150,167,141,.25); }
  </style>
</head>
<body>
  <div class="page-wrap">
    <div class="auth-card">
      <div class="auth-title">
        <span><?= $id > 0 ? 'Edit Information' : 'Add Information' ?></span>
        <div class="d-flex align-items-center gap-2">
          <span class="small">Signed in as <?= htmlspecialchars($email) ?></span>
          <a href="update.php" class="btn btn-outline-accent btn-sm">Back</a>
          <a href="logout.php" class="btn btn-outline-accent btn-sm">Logout</a>
        </div>
      </div>

      <form action="edit.php<?= $id>0 ? '?id='.urlencode((string)$id) : '' ?>" method="POST" class="mt-2">
        <input type="hidden" name="id" value="<?= $id > 0 ? htmlspecialchars((string)$id) : '' ?>">
        <div class="row g-3">
          <div class="col-12 col-md-6 col-lg-4">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required
                   value="<?= htmlspecialchars($record['first_name'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required
                   value="<?= htmlspecialchars($record['last_name'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required
                   value="<?= htmlspecialchars($record['email'] ?? '') ?>">
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <label for="date_started" class="form-label">Date Started</label>
            <input type="date" id="date_started" name="date_started" class="form-control" required
                   value="<?= htmlspecialchars($record['date_started'] ?? '') ?>">
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="genderid" class="form-label">Gender</label>
            <select id="genderid" name="genderid" class="form-select" required>
              <option value="" disabled <?= $record ? '' : 'selected' ?>>Select gender</option>
              <?php foreach ($genders as $r): ?>
                <option value="<?= htmlspecialchars($r['id']) ?>" <?= sel($record['genderid'] ?? '', $r['id']) ?>>
                  <?= htmlspecialchars($r['id'].' = '.$r['gender']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="shirtsizeid" class="form-label">Shirt Size</label>
            <select id="shirtsizeid" name="shirtsizeid" class="form-select" required>
              <option value="" disabled <?= $record ? '' : 'selected' ?>>Select shirt size</option>
              <?php foreach ($shirts as $r): ?>
                <option value="<?= htmlspecialchars($r['id']) ?>" <?= sel($record['shirtsizeid'] ?? '', $r['id']) ?>>
                  <?= htmlspecialchars($r['id'].' = '.$r['shirtsize']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="departmentid" class="form-label">Department</label>
            <select id="departmentid" name="departmentid" class="form-select" required>
              <option value="" disabled <?= $record ? '' : 'selected' ?>>Select department</option>
              <?php foreach ($departments as $r): ?>
                <option value="<?= htmlspecialchars($r['id']) ?>" <?= sel($record['departmentid'] ?? '', $r['id']) ?>>
                  <?= htmlspecialchars($r['id'].' = '.$r['departments']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="regionId" class="form-label">Region</label>
            <select id="regionId" name="regionId" class="form-select" required>
              <option value="" disabled <?= $record ? '' : 'selected' ?>>Select region</option>
              <?php foreach ($regions as $r): ?>
                <option value="<?= htmlspecialchars($r['id']) ?>" <?= sel($record['regionId'] ?? '', $r['id']) ?>>
                  <?= htmlspecialchars($r['id'].' = '.$r['regions']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-12 col-md-6 col-lg-4">
            <label for="positionId" class="form-label">Position</label>
            <select id="positionId" name="positionId" class="form-select" required>
              <option value="" disabled <?= $record ? '' : 'selected' ?>>Select position</option>
              <?php foreach ($positions as $r): ?>
                <option value="<?= htmlspecialchars($r['id']) ?>" <?= sel($record['positionId'] ?? '', $r['id']) ?>>
                  <?= htmlspecialchars($r['id'].' = '.$r['position'].': '.$r['salary']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="d-grid mt-4">
          <button type="submit" class="btn btn-accent btn-lg"><?= $id > 0 ? 'Update' : 'Save' ?></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>