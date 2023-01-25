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
      <section>
        <div class="grid">
        <div> <img src="" alt="" class="billede single_billede" /> </div>
        <div class="enkeltVaerktekst">
        <h2 class="titel single_overskrift"></h2>
        <p class="beskrivelse single_beskrivelse"></p>
        <p class="str"></p>
        <p class="pris"></p>
        <button class="forspørgsel single_forspørgsel" onclick="sendForespoergsel()">SEND FORESPØRGSEL</button>
        </div>
        </div>
      </section>
</article>

</main>
<script>
    let enkeltVaerk;
/* console.log("ID", id); */
document.addEventListener("DOMContentLoaded", hentVaerk);

async function hentVaerk() {
  const respons = await fetch('https://www.karolinethomasen.dk/kea/eksamen/wp-json/wp/v2/vaerk/<?php echo get_the_ID()?>');
  enkeltVaerk = await respons.json();
  console.log(enkeltVaerk);
  visVaerk();
}

function visVaerk() {
  console.log("hi");
  document.querySelector(".billede").src = enkeltVaerk.billede.guid;
  document.querySelector("h2").textContent = enkeltVaerk.titel;
  document.querySelector(".beskrivelse").textContent = enkeltVaerk.beskrivelse;
  document.querySelector(".str").textContent = enkeltVaerk.str;
  document.querySelector(".pris").textContent = "Pris " + enkeltVaerk.pris + " Kr.";
	document.querySelector(".tilbage_bt").addEventListener("click", sendTilbage);
}
function sendForespoergsel() {
  location.href = "https://www.karolinethomasen.dk/kea/eksamen/send-foresporgsel";

}
	
function sendTilbage(){
history.back();	
}

</script>
	<?php get_footer(); ?>
