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
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Disease</th>
                    <th>Allergy</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody id="prescription-table-body">
                <!-- Data will be filled by JS -->
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../includes/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    fetch('/MODERN_HMS/backend/routes/get_prescriptions.php')
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const tbody = document.getElementById('prescription-table-body');
                data.data.forEach((row, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${row.DoctorName}</td>
                        <td>${row.FirstName} ${row.LastName}</td>
                        <td>${row.AppointmentDate}</td>
                        <td>${row.AppointmentTime}</td>
                        <td>${row.Disease}</td>
                        <td>${row.Allergy}</td>
                        <td>${row.Prescription}</td>
                    `;
                    tbody.appendChild(tr);
                });
            }
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
}
.styled-table th {
    background-color: #2f3e9e;
    color: #fff;
}
.styled-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
