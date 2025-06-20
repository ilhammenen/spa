<?php
include "header.php";
include "connection.php";
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- nak bagi elok dengan mobile-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="contact.css">
</head>
<body>
  
    <section class="section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                  <br> 
                    <h1 class="display-4 fw-bold mb-4">Get In Touch</h1>
                    <p class="lead mb-0">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="p-5">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-map-marker-alt fa-2x text-white"></i>
          </div>
          <h4 class="fw-bold mb-3">Visit Our Office</h4>
          <p class="fw-bold mb-0">UTeM Main Campus<br>Jalan Hang Tuah Jaya, 76100 Durian Tunggal, Melaka</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-phone fa-2x text-white"></i>
          </div>
          <h4 class="fw-bold mb-3">Call Us</h4>
          <p class="text-muted fw-bold mb-0">
            <a href="tel:+06-270 1000" class="text-muted">+60 6-270 1000</a>
          </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-envelope fa-2x text-white"></i>
          </div>
          <h4 class="fw-bold mb-3">Email Us</h4>
          <p class="text-muted mb-0">
            <a href="mailto:info@utem.edu.my" class="text-muted">canselori@utem.edu.my</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="text-center p-5 bg-light" style="opacity:0.9">
  <div class="container " >
    <h3 class="fw-bold mb-4">
      <i class="fas fa-paper-plane me-2 text-primary"></i>Find Us Here
    </h3>

    <div class="row justify-content-center mb-5" >
      <div class="col-lg-8">
        <div class="map-container">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15929.64762111328!2d102.3185415!3d2.3138024!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d1e46c6eaa869b%3A0xb8935957e3536888!2sUniversiti%20Teknikal%20Malaysia%20Melaka!5e0!3m2!1sen!2smy!4v1717319012345!5m2!1sen!2smy" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6 text-start">
        <div class="business-hours-card p-3 bg-white shadow rounded">
          <h4 class="fw-bold mb-4">
            <i class="fas fa-clock me-2 text-primary"></i>Business Hours
          </h4>
          <div class="row g-2">
            <div class="col-7"><strong>Monday - Friday:</strong></div>
            <div class="col-5 text-end">9:00 AM - 6:00 PM</div>
            <div class="col-7"><strong>Sunday & Saturday:</strong></div>
            <div class="col-5 text-end text-muted-warning text-danger">Closed</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            
      
            
         
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            submitBtn.disabled = true;
            
            setTimeout(() => {
                alert('Thank you for your message! We\'ll get back to you soon.');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll
        window.addEventListener('scroll', () => {
            const cards = document.querySelectorAll('.contact-card');
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                const cardVisible = 150;
                
                if (cardTop < window.innerHeight - cardVisible) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        });

        // Initialize cards with hidden state
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.contact-card');
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';
            });
        });
    </script>
<?php include 
"footer.php"; 
?>