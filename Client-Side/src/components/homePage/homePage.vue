<script setup>

</script>

<template>
<div class="container-fluid back-ground">
  <div class="container">
<div class="row">
  <div class="col-3"></div>
  <div class="col">
    <h1 class="fw-bold">How does our website work?</h1>
  </div>
</div>
  <div class="row">
    <div class="col">
      <p class="fw-bold text-light">This website is for helping people how to get there medicines if it is rare in market. Register as a normal user and see pharmacies where can you find this medicine.<br>
        Also you can find medicine that cost more than 500 EGP exist in another user he don't need it any more within it's half price or less. <br>
        If you have medicine costs more than 500 EGP and you don't need it any more you can sell it with it's half price or less. <br>
        We also help Pharmacies to find this medicine to make them available for users register as pharmacy owner and see the Stores that have this medicines. <br>
        You also can register and join as Store owner and show that you have these medicines for pharmacies. <br>
      You can just register as a normal User <router-link to="/register/user" class="headlines">Here </router-link> or as Pharmacy Owner <router-link to="/register/pharmacy" class="headlines">Here</router-link> or as Store Owner <router-link to="/register/store" class="headlines">Here</router-link> and use our website to find medicine or show it for others.
      </p>
    </div>
  </div>

  <div class="row mt-5">
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
         <p class="text-center fw-bold">“Life’s most persistent and urgent question is: What are you doing for others?”</p>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <p class="text-center fw-bold">“Help others and give something back. I guarantee you will discover that while public service improves the lives and the world around you, its greatest reward is the enrichment and new meaning it will bring your own life.”</p>
        </div>
        <div class="carousel-item" data-bs-interval="5000">
          <p class="text-center fw-bold">“Earn your success based on service to others, not at the expense of others.”</p>
        </div>
      </div>
      <button class="carousel-control-prev" hidden type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" hidden type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-4"></div>
    <div class="col">
      <h1 class="fw-bold">Who we are?</h1>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <p class="fw-bold text-light">We are ITI graduates Open source Applications development track and this is our graduation project to achieve sustainable development and help people to get their rare drugs easily</p>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-5"></div>
    <div class="col">
      <h1 class="fw-bold">Our Team</h1>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <div id="carouselExampleCaptions" class="carousel slide container">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container mb-5">
              <div class="row">
                <div class="col-2"></div>
                <div class="col">
                <img src="/images/Mohammed%20Aldghar.jpg" class=" w-75" alt="Mohammed Al-Dghar">
               </div>
             </div>
              <div class="row">
                  <div class="col-3"></div>
                <div class="col">
                 <h1 class="fw-bold"> <a href="https://www.linkedin.com/in/mohammed-aldghar-954748217/" class="text-decoration-none headlines"> Mohammed Al-Dghar </a></h1>
                  <h5 class="fw-bold">Fullstack developer</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container mb-5">
              <div class="row">
                <div class="col-2"></div>
                <div class="col">
                  <img src="/images/Attar.jpg" class=" w-75" alt="Mohammed Al-Attar">
                </div>
              </div>
              <div class="row">
                <div class="col-3"></div>
                <div class="col">
                  <h1 class="fw-bold"> <a href="https://www.linkedin.com/in/mohamed-al-attar-577073193/" class="text-decoration-none headlines"> Mohammed Al-Attar </a></h1>
                  <h5 class="fw-bold">Fullstack developer</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container mb-5">
              <div class="row">
                <div class="col-2"></div>
                <div class="col">
                  <img src="/images/nadaa.jpg" class=" w-75" alt="Nada Mohammed">
                </div>
              </div>
              <div class="row">
                <div class="col-3"></div>
                <div class="col">
                  <h1 class="fw-bold"> <a href="https://www.linkedin.com/in/nada-soliman-71779b279/" class="text-decoration-none headlines"> Nada Mohammed </a></h1>
                  <h5 class="fw-bold">Fullstack developer</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="container mb-5">
              <div class="row">
                <div class="col-2"></div>
                <div class="col">
                  <img src="/images/mayar.jpg" class=" w-75" alt="Mayar Ehab">
                </div>
              </div>
              <div class="row">
                <div class="col-3"></div>
                <div class="col">
                  <h1 class="fw-bold"> <a href="https://www.linkedin.com/in/mayar-darwish-790677263/" class="text-decoration-none headlines"> Mayar Ehab </a></h1>
                  <h5 class="fw-bold">Fullstack developer</h5>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="container mb-5">
              <div class="row">
                <div class="col-2"></div>
                <div class="col">
                  <img src="/images/marina.jpg" class="w-75" alt="Marina Halim">
                </div>
              </div>
              <div class="row">
                <div class="col-3"></div>
                <div class="col">
                  <h1 class="fw-bold"> <a href="https://www.linkedin.com/in/marina-halim-41b387255/" class="text-decoration-none headlines"> Marina Halim </a></h1>
                  <h5 class="fw-bold">Fullstack developer</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

    <div class="row mt-5">
      <div class="col-3"></div>
      <div class="col">
        <h1 class="fw-bold">Instructions you should know</h1>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <ul>
          <li class="headlines fw-bold">Don't take any drug without consulting your doctor</li>
          <li class="headlines fw-bold">Don't search or add prohibited drugs we are not responsible if you do that</li>
          <li class="headlines fw-bold">Make sure that when you take any medicine from another user or pharmacy, it is the medicine you saw on the website</li>
          <li class="headlines fw-bold">Make sure of the expiration date when you take the drug from another user or pharmacy</li>
        </ul>
      </div>
    </div>

  </div>
</div>
</template>

<style scoped>
@font-face {
  font-family: 'body-font';
  src: url("/fonts/MontserratAlternates-Regular.ttf") format("woff2");
  font-weight: normal;
  font-style: normal;
}

.back-ground{
  background-color: #84C7F9;
  color: #163172;
  font-family: 'body-font';
}
.headlines{
  color:#163172;
}
</style>