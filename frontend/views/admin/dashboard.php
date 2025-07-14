<?php include_once '../../includes/admin_layout.php'; ?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/admin_sidebar.php'; ?>

    <div class="dashboard-main">
        <h2>WELCOME RECEPTIONIST</h2>

        <div class="card-group">
            <div class="card">
                <img src="/MODERN_HMS/public/images/doctor-icon.png" alt="Doctors">
                <h3>Doctor List</h3>
                <a href="doctor_list.php" class="btn">View Doctors</a>
            </div>

            <div class="card">
                <img src="/MODERN_HMS/public/images/patient-icon.png" alt="Patients">
                <h3>Patient List</h3>
                <a href="patient_list.php" class="btn">View Patients</a>
            </div>

            <div class="card">
                <img src="/MODERN_HMS/public/images/appointment-icon.png" alt="Appointments">
                <h3>Appointment Details</h3>
                <a href="appointment_details.php" class="btn">View Appointments</a>
            </div>

            <div class="card">
                <img src="/MODERN_HMS/public/images/prescription-icon.png" alt="Prescriptions">
                <h3>Prescription List</h3>
                <a href="prescription_list.php" class="btn">View Prescriptions</a>
            </div>

            <div class="card">
                <img src="/MODERN_HMS/public/images/manage-icon.png" alt="Manage">
                <h3>Manage Doctors</h3>
                <a href="add_doctor.php" class="btn">Add</a>
                <a href="delete_doctor.php" class="btn" style="margin-left: 10px;">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>
