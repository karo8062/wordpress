<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();

do_action( 'hestia_before_single_page_wrapper' );

<div class="<?php echo hestia_layout(); ?>">
<main> 
	<article class="single_template">
      <section>
       <img src="" alt="" class="billede" />
        <h2 class="titel"></h2>
        <p class="beskrivelse"></p>
        <p class="str"></p>
        <p class="pris"></p>
        <button class="forspørgsel">SEND FORESPØRGSEL</button>
      </section>
</article>
</main>
<script>
// Søger efter ID
const URLParams = new URLSearchParams(window.location.search);
// Finder vores ID
const id = URLParams.get("id");
console.log({ id });

  const url = `https://www.karolinethomasen.dk/kea/eksamen/wp-json/wp/v2/${id}`;
      const options = {
        headers: {
          "Content-Type": "application/json",
           "x-apikey": "e32135fd3f44",
        },
      }; 

	  let vaerk;

	   async function hentData() {
      const respons = await fetch(url, options);
      vaerk = await respons.json(); 
      console.log("vaerk", vaerk);
      visSingleVaerk();
      }

        function visSingleVaerk() {
          console.log("vaerk");
document.querySelector(".billede").src = vaerk.billede.guid;
document.querySelector("h2").innerHTML = vaerk.title.rendered;
document.querySelector(".beskrivelse").innerHTML = vaerk.beskrivelse;
document.querySelector(".str").innerHTML = vaerk.str;
document.querySelector(".pris").innerHTML = "Pris " + vaerk.pris + " Kr.";
        //tilbage knap:
        document.querySelector("forspørgsel").addEventListener("click", tilbageTilGalleri);
      }
      function tilbageTilGalleri() {
        history.back();
      }

</script>


</div>
	<?php get_footer(); ?>
