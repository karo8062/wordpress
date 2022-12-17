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

<main> 
	<article class="single_template">
      <section>
       <img src="" alt="" class="billede" />
        <h2 class="titel single_overskrift"></h2>
        <p class="beskrivelse"></p>
        <p class="str"></p>
        <p class="pris"></p>
        <button class="forspørgsel" onclick="sendForespoergsel()">SEND FORESPØRGSEL</button>
      </section>
</article>

</main>
<script>
/* const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get("titel");
console.log(id);

const endpoint = "https://www.karolinethomasen.dk/kea/eksamen/wp-json/wp/v2/vaerk/" + id;
const options = {
      headers: {
    //  "Content-Type": "application/json",
     "x-apikey": "e32135fd3f44",
    },
    };  */

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
}
function sendForespoergsel() {

  location.href = "https://www.karolinethomasen.dk/kea/eksamen/send-foresporgsel";
}

</script>
	<?php get_footer(); ?>
