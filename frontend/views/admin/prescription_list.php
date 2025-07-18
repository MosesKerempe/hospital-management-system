<?php include_once '../../includes/admin_layout.php'; ?>

<div class="dashboard-wrapper">
    <?php include_once '../../includes/admin_sidebar.php'; ?>

    <div class="dashboard-main">
        <h2>Prescription List</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Doctor</th>
                    <th>Patient ID</th>
                    <th>Appointment ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Disease</th>
                    <th>Allergy</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody id="prescription-table-body">
                <!-- Filled by JS -->
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    fetch('/MODERN_HMS/backend/routes/get_prescriptions.php')
        .then(res => {
            if (!res.ok) throw new Error("Network response was not ok");
            return res.json();
        })
        .then(data => {
            if (data.status === 'success' && data.data.length > 0) {
                const tbody = document.getElementById('prescription-table-body');
                data.data.forEach((row, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${row.DoctorName}</td>
                        <td>${row.PatientID}</td>
                        <td>${row.AppointmentID}</td>
                        <td>${row.FirstName}</td>
                        <td>${row.LastName}</td>
                        <td>${row.AppointmentDate}</td>
                        <td>${row.AppointmentTime}</td>
                        <td>${row.Disease}</td>
                        <td>${row.Allergy}</td>
                        <td>${row.Prescription.replace(/\n/g, "<br>")}</td>
                    `;
                    tbody.appendChild(tr);
                });
            } else {
                document.getElementById('prescription-table-body').innerHTML = `
                    <tr><td colspan="11">No prescription data available.</td></tr>
                `;
            }
        })
        .catch(err => {
            console.error("Error fetching data:", err);
            document.getElementById('prescription-table-body').innerHTML = `
                <tr><td colspan="11">Failed to load prescription data.</td></tr>
            `;
        });
});
</script>

<style>
.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fff;
}
.styled-table th, .styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
}
.styled-table th {
    background-color: #2f3e9e;
    color: #fff;
}
.styled-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>
