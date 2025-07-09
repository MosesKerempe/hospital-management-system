<?php
$page_title = "Modern HMS - Home";
include '../../includes/header.php';
include '../../includes/nav.php';
?>

<div class="hero-section">
  <div class="hero-message">Welcome to Modern Hospital Management System</div>

  <div class="carousel">
    <div class="slide fade">
      <img src="../../assets/images/slide1.jpg" alt="Slide 1">
    </div>
    <div class="slide fade">
      <img src="../../assets/images/slide2.jpg" alt="Slide 2">
    </div>
    <div class="slide fade">
      <img src="../../assets/images/slide3.jpg" alt="Slide 3">
    </div>
    <div class="slide fade">
      <img src="../../assets/images/slide4.jpg" alt="Slide 4">
    </div>
  </div>
</div>

<?php include '../../includes/footer.php'; ?>

<!-- JavaScript for Slide -->
<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("slide");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1; }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 4000); // 4 seconds per slide
}
</script>
