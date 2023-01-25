<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();
do_action( 'hestia_before_single_page_wrapper' );
?>


<main class="main_single"> 
	<article class="single_template">
		<button class="tilbage_bt">Tilbage</button>
      <section class="grid">

		  <!-- Slideshow -->
	<div class="slideshow-container">
		 
	<!-- Det store viste billede -->
        <div class="stort_img mySlides">
       <img src="" alt="" class="billede single_billede" /> 
		</div>	
		 
	<!-- De næste billeder i slideshow -->
			<div class="img_2 mySlides">
				<img src="" alt="" class="billede_2"/>
			</div>
		
			<div class="img_2 mySlides">
				<img src="" alt="" class="billede_3" /> 		
			</div>
		
			<div class="img_4 mySlides">
				<img src="" alt="" class="billede_4"/> 		
			</div>
		
	 <!-- Next and previous buttons -->
 		 	<div class="pil_tilbage" onclick="plusSlides(-1)">&#10094;</div>
  			<div class="pil_frem" onclick="plusSlides(1)">&#10095;</div>	
	
		  
<div class="dot_container">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
</div>
	 </div> 	  
        <div class="enkeltVaerktekst">
        <h2 class="titel single_overskrift"></h2>
        <p class="beskrivelse single_beskrivelse"></p>
        <p class="str"></p>
        <p class="pris"></p>
        <button class="forspørgsel single_forspørgsel" onclick="sendForespoergsel()">SEND FORESPØRGSEL</button>
        </div>
      </section>
</article>

</main>
<script>
    let enkeltVaerk;
/* console.log("ID", id); */
document.addEventListener("DOMContentLoaded", hentVaerk);

async function hentVaerk() {
  const respons = await fetch('https://www.lauraskovsted.dk/kea/10_eksamen/redesign_eksamen/wp-json/wp/v2/vaerk/<?php echo get_the_ID()?>');
  enkeltVaerk = await respons.json();
  console.log(enkeltVaerk);
  visVaerk();
}

function visVaerk() {
  console.log("hi");
  document.querySelector(".billede").src = enkeltVaerk.billede.guid;
  document.querySelector("h2").textContent = enkeltVaerk.titel;
  document.querySelector(".beskrivelse").textContent = enkeltVaerk.beskrivelse;
  document.querySelector(".str").textContent = "Størrelse: " + enkeltVaerk.str;
  document.querySelector(".pris").textContent = "Pris: " + enkeltVaerk.pris + " Kr.";
document.querySelector(".billede_2").src = enkeltVaerk.billede_2.guid;
document.querySelector(".billede_3").src = enkeltVaerk.billede_3.guid;
	document.querySelector(".billede_4").src = enkeltVaerk.billede_4.guid;
	document.querySelector(".tilbage_bt").addEventListener("click", sendTilbage);
}
function sendForespoergsel() {
  location.href = "https://www.lauraskovsted.dk/kea/10_eksamen/redesign_eksamen/send-foresporgsel";

}
	
/****** Slideshow ******/
let slideIndex = 1;
showSlides(slideIndex);

/****** frem og tilbage knapper ******/
function plusSlides(n) {
  showSlides(slideIndex += n);
}

/****** dots ******/
function currentSlide(n) {
  showSlides(slideIndex = n);
}

/****** det der sker i slideshowet ******/
function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block";  
}
	
	
function sendTilbage(){
history.back();	
}

</script>
	<?php get_footer(); ?>
