<?php
$page_title = "Patient Registration";
include '../../includes/header.php';
include '../../includes/nav.php';
?>

<div class="form-container">
  <h2>Register as a Patient</h2>

  <?php if (isset($_GET['error'])): ?>
    <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
  <?php endif; ?>

  <?php if (isset($_GET['success'])): ?>
    <div class="success"><?php echo htmlspecialchars($_GET['success']); ?></div>
  <?php endif; ?>

  <form action="../../../backend/auth/patient_register.php" method="POST" onsubmit="return validatePasswords()">
    <div class="form-group">
      <label>First Name *</label>
      <input type="text" name="first_name" required>
    </div>

    <div class="form-group">
      <label>Last Name *</label>
      <input type="text" name="last_name" required>
    </div>

    <div class="form-group">
      <label>Gender *</label>
      <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>

    <div class="form-group">
      <label>Email *</label>
      <input type="email" name="email" required>
    </div>

    <div class="form-group">
      <label>Contact *</label>
      <input type="text" name="contact" required>
    </div>

    <div class="form-group">
      <label>Password *</label>
      <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
      <label>Confirm Password *</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      <small id="match-msg" style="font-weight:bold;"></small>
    </div>

    <input type="submit" value="Register">
  </form>

  <p style="text-align: center; margin-top: 15px;">
    Already have an account?
    <a href="patient_login.php">Login here</a>
  </p>
</div>

<script>
function validatePasswords() {
  const pwd = document.getElementById("password").value;
  const confirm = document.getElementById("confirm_password").value;
  const msg = document.getElementById("match-msg");

  if (pwd !== confirm) {
    msg.innerText = "❌ Passwords do not match.";
    msg.style.color = "red";
    return false;
  } else {
    msg.innerText = "✅ Passwords match.";
    msg.style.color = "green";
    return true;
  }
}

document.getElementById("confirm_password").addEventListener("input", validatePasswords);
</script>

<?php include '../../includes/footer.php'; ?>
