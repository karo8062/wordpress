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
<div class="<?php echo hestia_layout(); ?>">
	
</div>


<main>
<!-- *************FILTRERINGSMENU*********** -->
<h1 class="shop_overskrift">Shop</h1>
<nav id="filtreringsmenu">
    <button data-vaerktype="alle">ALLE VÆRKER</button>
    <button data-vaerktype="Maleri">MALERIER</button>
    <button data-vaerktype="bronzefigurer">BRONZEFIGURER</button>
    <button data-vaerktype="vinpropper">VINPROPPER</button>
</nav>
<!-- Overskrift som vises når man klikker sig ind på de forskellige kategorier -->
<h2 class="filtreringsoverskrift">Alle værker</h2>


<!-- Indholdet kommer ind her -->
    <section id="indholdvaerker"></section>
    <template id="templatevaerker">
      <article>
        <img src="" alt="" class="billede" />
        <h2 class="titel"></h2>
        <p class="beskrivelse"></p>
        <p class="str"></p>
        <p class="pris"></p>
        <button class="læs">LÆS MERE</button>
      </article>
    </template>  
</main>

<script>
// ***************** HENTER DATA ************************
document.addEventListener("DOMContentLoaded", getJson);
// Finder URL til json
siteUrl = "https://www.karolinethomasen.dk/kea/eksamen/wp-json/wp/v2/vaerk?per_page=100"

// Laver en variabel for vores array, hvor vi putter vores json data ind i
let vaerker = [];

// Henter json 
async function getJson() {
// Henter data fra wordpress
const response = await fetch(siteUrl);
// Værker array indeholder nu json data 
vaerker = await response.json();
visVaerker();
}


// ****************** FILTRERING **************************
// Laver konstant der gør at vi får fat i knapperne
const filterKnapper = document.querySelectorAll("nav button");

// Laver en variabel som sættes = alle, så den gennerale indstilling når man kommer ind på siden er at få vist alle værker
let filtrer = "alle";

// // // Laver en konstant til vores h2 - tekstoverskrift 
const overskriftFiltrering = document.querySelector(".filtreringsoverskrift");

// Gør knapperne klikbar, ved brug af en anonym funktion
filterKnapper.forEach((knap) => knap.addEventListener("click", filtrerVaerker));

// Kalder funktion filtrerværker
function filtrerVaerker() {
// Finder værdien der ligger data-attribut. 
filtrer = this.dataset.vaerktype;

// H2 overskrift, skal have samme overskrift som den valgte kategori
overskriftFiltrering.textContent = this.textContent;

// Kalder vis værker på ny
visVaerker();
}


// ******************* LOOPVIEW *****************************
// Konstanter til template 
const temp = document.querySelector("#templatevaerker");
// Konstanter til section 
const container = document.querySelector("#indholdvaerker");

// Lav en funktionen vis værker
function visVaerker() {
// Dette gør at man sletter indholdet igen, når man klikker sig ind på en ny side. 
container.innerHTML ="";

// For hver enkelt værk tager den fat i hver enkel
vaerker.forEach((vaerk) => {
// Laver "if-sætning" for at filtrer mellem den værktype man har valgt. Ellers skal man se "alle"   
if((filtrer == vaerk.vaerktype || filtrer == "alle")){

// Laver klon til indholdet 
const klon = temp.cloneNode(true).content;
// Tilføje indhold til template
klon.querySelector(".billede").src = vaerk.billede.guid;
klon.querySelector("h2").innerHTML = vaerk.title.rendered;
klon.querySelector(".beskrivelse").innerHTML = vaerk.beskrivelse;
klon.querySelector(".str").innerHTML = vaerk.str;
klon.querySelector(".pris").innerHTML = "Pris " + vaerk.pris + " Kr.";
// Lytter efter click på knappen - som siger at der skal ske det der sker i singlevaerk functionen
klon.querySelector(".læs").addEventListener("click", () => visEnkeltVaerk(vaerk));

// Indholdet der kommer ind i sektion
container.appendChild(klon);
}});
}

function visEnkeltVaerk(kunst) {
console.log(kunst);
location.href = kunst.link;
}

</script>
<?php get_footer();



