<?php
include 'includes/db.php';
// Public page, no session required for viewing (but needed for proper header)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Doctors - HealthyLife Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    
<?php include 'includes/header.php'; ?>

<div class="container" style="padding: 3rem 1.5rem;">
    <div class="text-center mb-4">
        <h2 style="color: var(--primary);">Meet Our Specialists</h2>
        <p>Expert care from top medical professionals.</p>
    </div>

    <!-- Search/Filter Placeholder -->
    <div class="card mb-4">
        <div class="grid-3" style="grid-template-columns: 1fr 1fr auto; gap: 1rem; margin: 0; align-items:end;">
            <div class="form-group" style="margin:0;">
                <label class="form-label">Search by Name</label>
                <input type="text" class="form-control" placeholder="Dr. Name">
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label">Specialization</label>
                <select class="form-control">
                    <option>All Specializations</option>
                    <option>Cardiology</option>
                    <option>Dermatology</option>
                </select>
            </div>
            <button class="btn btn-primary">Search</button>
        </div>
    </div>

    <div class="grid-3">
        <?php
        $sql = "SELECT d.*, u.first_name, u.last_name, u.gender 
                FROM doctors d 
                JOIN users u ON d.user_id = u.user_id 
                WHERE u.status = 'active'";
        $res = $conn->query($sql);
        
        while($doc = $res->fetch_assoc()):
            $img = ($doc['gender'] == 'female') ? 
                   "https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" : 
                   "https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg"; // Placeholder
        ?>
        <div class="card text-center">
            <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto 1.5rem; border: 3px solid var(--primary);">
                <img src="<?php echo $img; ?>" alt="Doctor" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <h3>Dr. <?php echo $doc['first_name'] . ' ' . $doc['last_name']; ?></h3>
            <span class="badge badge-info mb-4" style="display:inline-block; margin-bottom: 1rem;"><?php echo $doc['specialization']; ?></span>
            
            <p><?php echo $doc['bio'] ?? 'Experienced specialist committed to patient care.'; ?></p>
            
            <div style="margin-top: 1.5rem;">
                <a href="<?php echo isset($_SESSION['user_id']) ? 'patient/appointments.php' : 'login.php'; ?>" class="btn btn-primary">
                    Book Appointment
                </a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
