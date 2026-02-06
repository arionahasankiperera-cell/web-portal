<?php
/**
 * Home Page - HealthyLife Hospital
 * SEO-optimized public landing page
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';
require_once __DIR__ . '/includes/functions.php';

initSession();

$page_title = "HealthyLife Hospital - Quality Healthcare in Colombo, Sri Lanka";
$page_description = "HealthyLife Hospital offers world-class medical services in Colombo, Sri Lanka. 24/7 emergency care, specialist consultations, and modern medical facilities.";
$page_keywords = "hospital colombo, healthcare sri lanka, medical services, emergency care, specialist doctors";

include __DIR__ . '/includes/header.php';

// Get featured doctors
try {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM doctors WHERE status = 'available' LIMIT 3");
    $featured_doctors = $stmt->fetchAll();
} catch (Exception $e) {
    $featured_doctors = [];
}
?>

<!-- Hero Section -->
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content container">
        <div class="hero-text">
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 1rem;">
            </div>
            <h1>Welcome to HealthyLife Hospital</h1>
            <p>Your Health, Our Priority - Providing Quality Healthcare in Colombo, Sri Lanka</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="<?php echo APP_URL; ?>patient/book_appointment.php" class="btn btn-primary btn-lg">Book Appointment</a>
                <a href="<?php echo APP_URL; ?>login.php" class="btn btn-outline btn-lg">Sign In</a>
                <a href="<?php echo APP_URL; ?>public/services.php" class="btn btn-outline btn-lg">Our Services</a>
            </div>
        </div>
        <div class="hero-image" style="display: flex; justify-content: center;">
            <div class="glass-panel" style="padding: 1rem; border-radius: var(--radius-lg); text-align: center; overflow: hidden;">
                <img src="<?php echo APP_URL; ?>assets/images/hospital_exterior.jpg" alt="HealthyLife Hospital Facilities" style="border-radius: var(--radius-md); max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats -->
<section class="container mt-4 mb-4">
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <span>👨‍⚕️</span>
            </div>
            <div class="stat-details">
                <h3>50+</h3>
                <p>Expert Doctors</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon green">
                <span>🏥</span>
            </div>
            <div class="stat-details">
                <h3>24/7</h3>
                <p>Emergency Care</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon orange">
                <span>⭐</span>
            </div>
            <div class="stat-details">
                <h3>10,000+</h3>
                <p>Happy Patients</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon purple">
                <span>🔬</span>
            </div>
            <div class="stat-details">
                <h3>15+</h3>
                <p>Specializations</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="container mb-4">
    <h2 class="text-center mb-3">Our Medical Services</h2>
    <div class="grid grid-3">
        <article class="card">
            <h3>🫀 Cardiology</h3>
            <p>Advanced heart care with state-of-the-art diagnostic and treatment facilities.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#cardiology" class="btn btn-primary">Learn More</a>
        </article>
        
        <article class="card">
            <h3>👶 Pediatrics</h3>
            <p>Comprehensive child healthcare from newborn to adolescence.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#pediatrics" class="btn btn-primary">Learn More</a>
        </article>
        
        <article class="card">
            <h3>🦴 Orthopedics</h3>
            <p>Expert treatment for bone, joint, and musculoskeletal conditions.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#orthopedics" class="btn btn-primary">Learn More</a>
        </article>
        
        <article class="card">
            <h3>🧠 Neurology</h3>
            <p>Specialized care for brain, spine, and nervous system disorders.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#neurology" class="btn btn-primary">Learn More</a>
        </article>
        
        <article class="card">
            <h3>🚑 Emergency Care</h3>
            <p>24/7 emergency services with rapid response team.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#emergency" class="btn btn-primary">Learn More</a>
        </article>
        
        <article class="card">
            <h3>🩺 General Medicine</h3>
            <p>Complete primary care and health screenings.</p>
            <a href="<?php echo APP_URL; ?>public/services.php#general" class="btn btn-primary">Learn More</a>
        </article>
    </div>
</section>

<!-- Emergency Care Highlight -->
<section class="container mb-4">
    <div class="card p-0 overflow-hidden" style="display: flex; flex-direction: row; flex-wrap: wrap; box-shadow: var(--shadow-lg);">
        <div style="flex: 1; min-width: 300px; max-height: 400px; overflow: hidden;">
            <img src="<?php echo APP_URL; ?>assets/images/emergency_sign.jpg" alt="24/7 Emergency Care" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div style="flex: 1; min-width: 300px; padding: var(--spacing-lg); display: flex; flex-direction: column; justify-content: center; background: linear-gradient(135deg, #fff, #f8f9fa);">
            <h2 style="color: var(--danger-red); margin-bottom: var(--spacing-sm);">🚨 24/7 Emergency Services</h2>
            <p style="font-size: 1.1rem; margin-bottom: var(--spacing-md);">When every second counts, you can count on us. Our emergency department is fully equipped and staffed by expert trauma specialists around the clock.</p>
            <ul style="list-style: none; padding: 0; margin-bottom: var(--spacing-md);">
                <li style="margin-bottom: 0.5rem;">✅ State-of-the-art Trauma Center</li>
                <li style="margin-bottom: 0.5rem;">✅ Fast-track Triage System</li>
                <li style="margin-bottom: 0.5rem;">✅ Advanced Life Support Ambulances</li>
            </ul>
            <a href="tel:+94112345678" class="btn btn-danger btn-lg" style="align-self: flex-start; background-color: var(--danger-red);">Call Emergency Now</a>
        </div>
    </div>
</section>

<!-- Featured Doctors -->
<?php if (!empty($featured_doctors)): ?>
<section class="container mb-4">
    <h2 class="text-center mb-3">Meet Our Specialists</h2>
    <div class="grid grid-3">
        <?php foreach ($featured_doctors as $doctor): ?>
        <article class="card text-center">
            <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-blue), var(--primary-green)); margin: 0 auto var(--spacing-sm); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                👨‍⚕️
            </div>
            <h3>Dr. <?php echo e($doctor['first_name'] . ' ' . $doctor['last_name']); ?></h3>
            <p><strong><?php echo e($doctor['specialization']); ?></strong></p>
            <p><?php echo e($doctor['qualification']); ?></p>
            <p class="text-muted"><?php echo $doctor['experience_years']; ?> years experience</p>
        </article>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-3">
        <a href="<?php echo APP_URL; ?>public/doctors.php" class="btn btn-primary">View All Doctors</a>
    </div>
</section>
<?php endif; ?>

<!-- Why Choose Us -->
<section class="container mb-4">
    <h2 class="text-center mb-3">Why Choose HealthyLife Hospital?</h2>
    <div class="grid grid-2">
        <div class="card">
            <h4>✅ Expert Medical Team</h4>
            <p>Our team consists of highly qualified doctors and healthcare professionals with years of experience in their respective fields.</p>
        </div>
        
        <div class="card">
            <h4>🏥 Advanced Facilities</h4>
            <p>Equipped with the latest medical technology and modern infrastructure to provide the best care possible.</p>
        </div>
        
        <div class="card">
            <h4>⏰ 24/7 Availability</h4>
            <p>Round-the-clock emergency services and support to ensure you get help whenever you need it.</p>
        </div>
        
        <div class="card">
            <h4>💰 Affordable Care</h4>
            <p>Quality healthcare at competitive prices with various payment options and insurance support.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue)); color: white; padding: var(--spacing-xl) 0; margin-top: var(--spacing-xl);">
    <div class="container text-center">
        <h2>Ready to Take Care of Your Health?</h2>
        <p style="font-size: 1.25rem; margin-bottom: var(--spacing-lg); color: #000;">Book an appointment with our specialists today</p>
        <a href="<?php echo isLoggedIn() ? APP_URL . 'patient/book_appointment.php' : APP_URL . 'login.php'; ?>" class="btn btn-success btn-lg">
            Book Appointment Now
        </a>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
