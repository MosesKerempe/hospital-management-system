<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let slides = document.getElementsByClassName("slide");
  for (let i = 0; i < slides.length; i++) {
    (slides[i] as HTMLElement).style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) { slideIndex = 1; }
  (slides[slideIndex - 1] as HTMLElement).style.display = "block";
  setTimeout(showSlides, 3000); // Change image every 3 seconds
}
</script>
