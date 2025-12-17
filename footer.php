 <!-- ======= Footer ======= -->
 <footer id="footer">
   <div class="footer-top">
     <div class="container">
       <div class="row row-gap-4 need_padding_footer">

         <div class="col-lg-5 col-md-5 col-12 footer-contact first_footer_logo_div">
           <img src="assets/img/marine/logo.png" alt="Ome Sai Marine" class="img-fluid footer-logo mb-3">
           <p class="footer-description">
             Specialists in shipbuilding, repair, and marine engineering from Kakinada. Delivering reliable, cost-effective, and trusted marine solutions worldwide. Driven by quality, innovation, and a strong technical team. Building ships, serving oceans, and earning client trust.
           </p>
         </div>

         <div class="col-lg-2 col-md-2 col-6 footer-links">
           <h4>Quick Links</h4>
           <ul>
             <li><a href="#">Home</a></li>
             <li><a href="#">About</a></li>
             <li><a href="#">Services</a></li>
             <li><a href="#">Clients</a></li>
             <li><a href="#">Gallery</a></li>
             <li><a href="#">Contact</a></li>
           </ul>
         </div>

         <div class="col-lg-3 col-md-2 col-6 footer-links">
           <h4>Services Highlights</h4>
           <ul>
             <li><a href="#">Tug Construction</a></li>
             <li><a href="#">Cargo Barges</a></li>
             <li><a href="#">Flat Top Pontoon</a></li>
             <li><a href="#">Ship Repairs & Docking</a></li>
           </ul>
         </div>

         <div class="col-lg-2 col-md-3 col-6 footer-links">
           <h4>Connect With Me</h4>
           <ul>
             <li><a href="#">Facebook</a></li>
             <li><a href="#">Instagram</a></li>
             <li><a href="#">X (Twitter)</a></li>
             <li><a href="#">YouTube</a></li>
           </ul>
         </div>

       </div>


       <div class="footer-bottom">
         <div class="container d-md-flex py-4 justify-content-between align-items-center">

           <div class="copyright text-center text-md-start">
             &copy; 2025 <strong><span>Ome sai marine</span></strong> | All Rights Reserved
           </div>

           <div class="credits text-center text-md-end mt-3 mt-md-0 d-flex align-items-center justify-content-center justify-content-md-end">
             <span class="me-2">Designed, Developed & Maintained by</span>
             <img src="assets/img/free_bird/freebird_logo.png" alt="Free Bird" class="agency-logo">
           </div>

         </div>
       </div>
     </div>
   </div>


 </footer>


 <button id="scrollBtn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up "></i></button>

 <script>
   // Function to scroll to the top of the page
   function scrollToTop() {
     window.scrollTo({
       top: 0,
       behavior: 'smooth' // Optional, smooth scrolling animation
     });
   }

   // Show scroll button when scrolling down
   window.onscroll = function() {
     scrollFunction()
   };

   function scrollFunction() {
     if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
       document.getElementById("scrollBtn").style.display = "block";
     } else {
       document.getElementById("scrollBtn").style.display = "none";
     }
   }
 </script>

 <style>
   #scrollBtn {
     display: none;
     position: fixed;
     bottom: 115px;
     right: 25px;
     z-index: 999;
     padding: 9px 15px 9px 15px;
     /* padding: 10px 15px; */
     background-color: #F98122;
     color: white;
     border: none;
     border-radius: 50%;
     cursor: pointer;
   }
 </style>

 <!-- <a href="https://api.whatsapp.com/send?phone= " style="color: #fff;" class="whatsapp-link" target="_blank">
   <i class="fab fa-whatsapp"></i>
 </a> -->


 <div id="preloader"></div>


 <!-- Vendor JS Files -->
 <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
 <script src="assets/vendor/aos/aos.js"></script>
 <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
 <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
 <script src="assets/vendor/php-email-form/validate.js"></script>

 <!-- Template Main JS File -->
 <script src="assets/js/main.js"></script>

 <!-- <script>
   document.addEventListener('DOMContentLoaded', function() {
     var swiper = new Swiper('.mySwiper', {
       pagination: {
         el: '.swiper-pagination',
         clickable: true,
       },
       slidesPerView: 1,
       spaceBetween: 30,
       loop: false,
       autoplay: false,
     });

     // Add event listener to nav-links
     //  document.querySelectorAll('.nav-link').forEach(function(navLink) {
     //    navLink.addEventListener('click', function(event) {

     //      if (!navLink.href.includes('blogs.php')) {
     //        event.preventDefault();
     //        const target = navLink.getAttribute('data-bs-target');
     //        document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
     //          tabPane.classList.remove('active', 'show');
     //        });
     //        document.querySelector(target).classList.add('active', 'show');
     //      }
     //    });
     //  });
   });
 </script> -->


 </body>

 </html>