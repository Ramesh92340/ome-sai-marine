<?php
include 'db.connection/db_connection.php'; // Adjust path if needed
include 'header.php';
include 'navbar.php';
?>

<style>
  .gallery-container {
    width: 100%;
  }

  .gallery-item {
    margin-bottom: 20px;
  }

  /* Filter Buttons */
  .filter-btn {
    border: none;
    background: #eef2f7;
    padding: 8px 20px;
    border-radius: 5px;
    margin: 5px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: 500;
    color: #444;
  }

  .filter-btn.active,
  .filter-btn:hover {
    background: #B6DFFF;
    color: black;
  }

  /* Image/Video Card Styling */
  .media-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    background: #f8f9fa;
    height: 250px;
    /* Base height */
  }

  .media-card img,
  .media-card video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  .media-card:hover img {
    transform: scale(1.1);
  }

  /* Play Icon for Videos Overlay */
  .video-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 30px;
    color: white;
    opacity: 0.8;
    pointer-events: none;
  }
</style>

<main id="main">


  <section class="services-header-section py-5">
    <div class="container" data-aos="fade-up">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-2 col-lg-4 d-none d-md-block text-md-end pe-md-5">
          <div class="services-icon-box">
            <img src="assets/img/marine/serices_kit.png" alt="Icon" class="img-fluid" style="width: 100px;">
          </div>
        </div>

        <div class="col-md-6 col-lg-8">
          <h2 class="services-main-title">Our Gallery</h2>
          <p class="services-main-desc"> Our gallery features a wide range of completed and ongoing projects, including tugboats, cargo barges, flat top pontoons, ferry vessels, ship repairs, blasting & painting works, and infrastructure activities at our Kakinada shipyard.

          </p>
          <div class="mt-4">
            <a  href="https://wa.me/9444021209?text=I'm%20interested%20in%20your%20marine%20services" target="_blank" class="  about-btn">Get In Touch</a>

          </div>
        </div>
      </div>
    </div>
  </section>





  



  <section class="gallery-section pb-5">
    <div class="container">

      <div class="row mb-4">
        <div class="col-12 text-center" id="filters">
          <button class="filter-btn active" data-filter="*">All</button>
          <?php
          // Changed "ORDER BY category_name ASC" to "ORDER BY id ASC"
          // This puts the most recently created categories at the end of the list
          $cat_query = "SELECT * FROM categories_table ORDER BY id ASC";
          $cat_result = $conn->query($cat_query);

          while ($cat = $cat_result->fetch_assoc()) {
            // Create a slug for the filter (e.g., "shipbuilding")
            $filter_slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat['category_name']));
            echo '<button class="filter-btn" data-filter=".' . $filter_slug . '">' . $cat['category_name'] . '</button>';
          }
          ?>
        </div>
      </div>

      <div class="row gallery-container" id="gallery-grid">
        <?php
        $media_query = "SELECT m.*, c.category_name 
                                FROM media_table m 
                                LEFT JOIN categories_table c ON m.category_id = c.id 
                                ORDER BY m.id DESC";
        $media_result = $conn->query($media_query);

        while ($row = $media_result->fetch_assoc()) {
          $filter_class = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $row['category_name']));
          $file_path = "admin/uploads/gallery/" . $row['file_path'];

          // Logic to vary heights for "Masonry" effect
          $card_height = (rand(1, 3) == 1) ? '350px' : '250px';
        ?>
          <div class="col-lg-4 col-md-6 col-12 gallery-item <?php echo $filter_class; ?>">
            <div class="media-card shadow-sm" style="height: <?php echo $card_height; ?>;">
              <?php if ($row['media_type'] == 'image'): ?>
                <a href="<?php echo $file_path; ?>" class="glightbox">
                  <img src="<?php echo $file_path; ?>" alt="<?php echo $row['title']; ?>">
                </a>
              <?php else: ?>
                <a href="<?php echo $file_path; ?>" class="glightbox">
                  <video muted loop onmouseover="this.play()" onmouseout="this.pause(); this.currentTime=0;">
                    <source src="<?php echo $file_path; ?>" type="video/mp4">
                  </video>
                  <div class="video-overlay"><i class="fas fa-play-circle"></i></div>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

<script>
  $(document).ready(function() {
    // Initialize Isotope Grid
    var $grid = $('#gallery-grid').isotope({
      itemSelector: '.gallery-item',
      layoutMode: 'masonry'
    });

    // Filter items on button click
    $('#filters').on('click', 'button', function() {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({
        filter: filterValue
      });

      // Update active class
      $('.filter-btn').removeClass('active');
      $(this).addClass('active');
    });
  });
</script>

<?php include 'footer.php'; ?>