<?php
include 'includes/db.php';
session_start();

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback_type, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $type, $subject, $msg);
    
    if ($stmt->execute()) {
        $message = "Thank you! Your feedback has been received.";
    } else {
        $message = "Error submitting feedback.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - HealthyLife</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container" style="padding: 4rem 1.5rem;">
        <div class="grid-3" style="grid-template-columns: 1fr 1fr; gap: 4rem;">
            <div>
                <h2 style="color: var(--primary);">Get in Touch</h2>
                <p>We are here to help you. Reach out to us for any queries or feedback.</p>
                
                <div class="card mt-4">
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--primary);"></i>
                        <div>
                            <h4>Location</h4>
                            <p>No 123, Main Street, Colombo 03, Sri Lanka</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; align-items: center; margin-bottom: 1.5rem;">
                        <i class="fas fa-phone" style="font-size: 1.5rem; color: var(--primary);"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+94 11 234 5678</p>
                            <p>+94 11 234 5679</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <i class="fas fa-envelope" style="font-size: 1.5rem; color: var(--primary);"></i>
                        <div>
                            <h4>Email</h4>
                            <p>info@healthylife.lk</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Send Us a Message</h3>
                <?php if($message): ?>
                    <div class="badge badge-success mb-4" style="display:block; padding:1rem; text-align:center;"><?php echo $message; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control">
                            <option value="inquiry">General Inquiry</option>
                            <option value="feedback">Feedback</option>
                            <option value="complaint">Complaint</option>
                            <option value="compliment">Compliment</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
