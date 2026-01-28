<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container hero-content">
        <div class="hero-text">
            <h1>Your Health, <br>Our Priority</h1>
            <p>Experience world-class healthcare with HealthyLife Hospital. We combine advanced medical technology with a compassionate approach to provide the best care for you and your family.</p>
            <div style="margin-top: 2rem; display: flex; gap: 1rem;">
                <a href="register.php" class="btn btn-primary">Book an Appointment</a>
                <a href="services.php" class="btn btn-secondary">Our Services</a>
            </div>
            
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Specialist Doctors</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Emergency Service</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">10k+</span>
                    <span class="stat-label">Happy Patients</span>
                </div>
            </div>
        </div>
        <div class="hero-image">
            <!-- Using a placeholder/illustration for now, ideally an SVG or relevant image -->
            <img src="https://img.freepik.com/free-vector/doctors-concept-illustration_114360-1515.jpg" alt="Doctors Team" style="width: 100%; border-radius: var(--radius-xl); box-shadow: var(--shadow-lg);">
        </div>
    </div>
</section>

<section class="container" style="padding: 4rem 1.5rem;">
    <div class="text-center mb-4">
        <h5 style="color: var(--primary); text-transform: uppercase; letter-spacing: 2px;">Why Choose Us</h5>
        <h2>Comprehensive Healthcare Services</h2>
        <p>We offer a wide range of medical specialties and services under one roof.</p>
    </div>

    <div class="grid-3">
        <div class="card">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;">
                <i class="fas fa-user-md"></i>
            </div>
            <h3>Expert Doctors</h3>
            <p>Our team of highly qualified and experienced doctors ensures you receive the best possible treatment.</p>
        </div>
        
        <div class="card">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;">
                <i class="fas fa-flask"></i>
            </div>
            <h3>Modern Laboratories</h3>
            <p>Equipped with state-of-the-art technology for accurate diagnoses and fast results.</p>
        </div>
        
        <div class="card">
            <div style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;">
                <i class="fas fa-heartbeat"></i>
            </div>
            <h3>Emergency Care</h3>
            <p>24/7 dedicated emergency unit ready to handle critical situations with speed and expertise.</p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
