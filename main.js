window.onload = () => {
 document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger) {
        hamburger.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            hamburger.classList.toggle('active');
        });
    }
});
  document.body.classList.remove("not-loaded");

  //tngok youtube spinner black page tutorial
  const spinnerWrapperEl = document.querySelector('.spinner-wrapper');
  setTimeout(() => {
    spinnerWrapperEl.style.opacity = '0';         
    spinnerWrapperEl.style.pointerEvents = 'none'; 
    spinnerWrapperEl.style.transition = 'opacity 0.1s ease'; 
    setTimeout(() => {
      spinnerWrapperEl.style.display = 'none'; 
    }, 500);
  }, 300);
};
const searchForm = document.getElementById('searchForm');
  const searchBtn = document.getElementById('searchBtn');
  const spinner = document.querySelector('.spinner-wrapper');

  let buttonClicked = false;

  // Track button  bootstrap
  searchBtn.addEventListener('click', function () {
    buttonClicked = true;
  });

  // On form submit
  searchForm.addEventListener('submit', function (e) {
    if (buttonClicked) {
      spinner.classList.add('active'); // show spiner when button was click
    }
    buttonClicked = false; 
  });

  // Navbar scroll effect
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar-custom")
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled")
  } else {
    navbar.classList.remove("scrolled")
  }
})

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault()
    const target = document.querySelector(this.getAttribute("href"))
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      })
    }
  })
})

// Counter animation
function animateCounters() {
  const counters = document.querySelectorAll(".stat-number")
  counters.forEach((counter) => {
    const target = counter.textContent
    const numericTarget = Number.parseInt(target.replace(/[^\d]/g, ""))
    const suffix = target.replace(/[\d]/g, "")
    let current = 0
    const increment = numericTarget / 100
    const timer = setInterval(() => {
      current += increment
      if (current >= numericTarget) {
        counter.textContent = target
        clearInterval(timer)
      } else {
        counter.textContent = Math.floor(current) + suffix
      }
    }, 20)
  })
}

// Trigger counter animation when stats section is visible
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      animateCounters()
      observer.unobserve(entry.target)
    }
  })
})

const statsSection = document.querySelector(".stats-section")
if (statsSection) {
  observer.observe(statsSection)
}

// Add loading animation
window.addEventListener("load", () => {
  document.body.classList.add("loaded")
})

// Enhanced button interactions
document.querySelectorAll(".btn-hero, .btn-outline-hero, .btn-primary-custom").forEach((button) => {
  button.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-3px)"
  })

  button.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0)"
  })
})

// Parallax effect for floating elements
window.addEventListener("scroll", () => {
  const scrolled = window.pageYOffset
  const parallaxElements = document.querySelectorAll(".floating-element")

  parallaxElements.forEach((element, index) => {
    const speed = 0.5 + index * 0.1
    element.style.transform = `translateY(${scrolled * speed}px)`
  })
})

// Feature cards animation on scroll
const featureObserver = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = "1"
        entry.target.style.transform = "translateY(0)"
      }
    })
  },
  {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  },
)

// Initialize feature cards animation
document.addEventListener("DOMContentLoaded", () => {
  const featureCards = document.querySelectorAll(".feature-card")
  featureCards.forEach((card) => {
    card.style.opacity = "0"
    card.style.transform = "translateY(30px)"
    card.style.transition = "opacity 0.6s ease, transform 0.6s ease"
    featureObserver.observe(card)
  })
})
