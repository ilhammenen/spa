      </div> <!--text-center -->
    </div> <!-- container -->
  </div> <!--  logincard -->

<footer class="footer text-white text-center py-3" style="background: linear-gradient(90deg, rgb(12, 27, 61) 0%, rgb(2, 15, 131) 100%);">
  <p class="mb-0">&copy; 2025 Muhammad Ilham. All rights reserved.</p>
  <p class="mb-0">Sistem Pemantauan Aset</p>
</footer>

<div class="semi-circle-bg1"></div>
<div class="semi-circle-bg"></div>



  <script src="js/java.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const links = document.querySelectorAll("#navbarSupportedContent .nav-link");
      const currentPage = window.location.pathname.split("/").pop();
      links.forEach(link => {
        const linkPage = link.getAttribute("href").split("/").pop();

        if (linkPage === currentPage) {
          link.classList.add("active-orange");
        } else {
          link.classList.remove("active-orange");
        }

        link.addEventListener("click", () => {
          links.forEach(l => l.classList.remove("active-orange"));
          link.classList.add("active-orange");
        });
      });
    });

document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("togglePasswordBtn");
  const passwordInput = document.getElementById("password");
  const icon = document.getElementById("togglePasswordIcon");

  toggleBtn.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("bi-eye-fill");
      icon.classList.add("bi-eye-slash-fill");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("bi-eye-slash-fill");
      icon.classList.add("bi-eye-fill");
    }
  });
});

</script>
  

</body>

</html>
