<?php
include_once '../../includes/admin_layout.php';
?>

<style>
    .form-wrapper {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .form-wrapper h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #2f3e9e;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #444;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2196f3;
    }

    .password-msg {
        font-size: 14px;
        margin-top: 6px;
        font-weight: 500;
    }

    .password-match {
        color: green;
    }

    .password-mismatch {
        color: red;
    }

    .btn-submit {
        background: linear-gradient(90deg, #3a0ca3, #2196f3);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: linear-gradient(90deg, #2196f3, #3a0ca3);
    }
</style>

<div class="dashboard-main">
    <div class="form-wrapper">
        <h2>Add Doctor</h2>
        <form action="../../../backend/routes/add_doctor.php" method="POST" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="username">Doctor Name (Username)</label>
                <input type="text" name="username" id="username" required />
            </div>

            <div class="form-group">
                <label for="email">Email </label>
                <input type="email" name="email" id="email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required />
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" required />
                <div id="password-msg" class="password-msg"></div>
            </div>

            <div class="form-group">
                <label for="specialization">Specialization</label>
                <select name="specialization" id="specialization" required>
                    <option value="">-- Select Specialization --</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Neurology">Neurology</option>
                    <option value="Orthopedics">Orthopedics</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Oncology">Oncology</option>
                    <option value="Radiology">Radiology</option>
                    <option value="Urology">Urology</option>
                    <option value="Surgery">Surgery</option>
                    <option value="Psychiatry">Psychiatry</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fee">Consultation Fee (Ksh)</label>
                <input type="number" name="fee" id="fee" step="0.01" min="100" required />
            </div>

            <input type="submit" name="submit_doctor" value="Add Doctor" class="btn-submit" />
        </form>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm_password');
    const message = document.getElementById('password-msg');

    confirmInput.addEventListener('keyup', () => {
        if (passwordInput.value === confirmInput.value) {
            message.textContent = "Passwords matched!";
            message.classList.add("password-match");
            message.classList.remove("password-mismatch");
        } else {
            message.textContent = "Passwords do not match.";
            message.classList.add("password-mismatch");
            message.classList.remove("password-match");
        }
    });

    function validateForm() {
        if (passwordInput.value !== confirmInput.value) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }
</script>

<?php include_once '../../includes/footer.php'; ?>
