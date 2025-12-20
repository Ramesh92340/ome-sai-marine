<?php include 'navbar.php';  ?>


 
<main id="main">

 
 


 
 



 
 


  <section class="about ">
    <div class="container paddinng_container" data-aos="fade-up">

      <div class="row ">
        <div class="d-flex flex-row  ">
          <!-- <a href="#contact"> -->
          <p class="get_in_touch">CONTACT US</p>
          <!-- </a> -->
        </div>

        <div class="col-md-6   poadding_left_div " data-aos="fade-left">
          <h2 class="dr_welcome_text">"Get in Touch with Ome Sai Marine"</h2>
          <p class="inter_font_black">"We’re here to discuss your shipbuilding and marine service needs."</p>

          <div class="row">


            <div class="col-lg-6   col-7">
              <p class="inter_font_black_bold"> <img src="assets/img/marine/envolop.png" class="img-fluid" alt=""> Email</p>
              <p class="inter_font_black contact_line_hight  ">info@omesaishipyard.com</p>
            </div>
            <div class="col-lg-6   col-5">
              <p class="inter_font_black_bold"> <img src="assets/img/marine/telephone.png" class="img-fluid" alt=""> Contact</p>
              <p class="inter_font_black contact_line_hight">+91 94440 21209</p>
              <p class="inter_font_black contact_line_hight"> +91 99081 13999 </p>

            </div>
            <div class="col-12">
              <p class="inter_font_black_bold "> <img src="assets/img/marine/location.png" class="img-fluid" alt=""> Address</p>
              <p class="inter_font_black contact_line_hight">EX BOC Area Warf Road, Anchorage Port Kakinada 533001</p>
            </div>

          </div>
        </div>

        <div class="col-md-6 " data-aos="fade-right">
          <div class="image-overlay-container_welding_man pading_minus_top">
            <div class="image_text_welding_card full_box">
              <h4 class="construction_heading">CONSTRUCTION SITES</h4>

              <p class="inter_font_black_weldig_card">BOC AREA</p>
              <p class="inter_font_black_weldig_card">KAKINADA ANCHORAGE PORT</p>
              <p class="inter_font_black_weldig_card">5 3 3 0 0 1</p>

              <p class="inter_font_black_weldig_card need_mrg_top">MAT TIPOOL</p>
              <p class="inter_font_black_weldig_card">KAKINADA ANCHORAGE PORT ROAD</p>
              <p class="inter_font_black_weldig_card need_mrg_btm">5 3 3 0 0 1</p>

              <p class="inter_font_black_weldig_card need_mrg_top">KOVVUR ROAD</p>
              <p class="inter_font_black_weldig_card need_mrg_btm">KAKINADA - 533001</p>
            </div>
          </div>

        </div>
      </div>
    </div>



    </div>
  </section>












  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        // Responsive breakpoints
        breakpoints: {
          // When window width is <= 768px
          320: {
            slidesPerView: 1,
            spaceBetween: 20
          },
          // When window width is > 768px (Desktop view)
          769: {
            slidesPerView: 4,
            spaceBetween: 40
          }
        }
      });
    });
  </script>














  <!-- Include these scripts at bottom -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>








  <!-- End Contact Section -->

</main><!-- End #main -->


<?php include 'footer.php'; ?>