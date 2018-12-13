<template>
  <div class="zigtkerst">

    <div v-bind:class="{ active: codePage }" class="codepagevisuals">
      <div class="codepagebg"></div>
      <div class="santa"></div>
      <div class="whiteblock"></div>
      <div class="top"></div>
      <div class="bottom"></div>
    </div> 

    <div v-bind:class="{ active: !codePage }" class="otherspagesbg">
    </div>

    <div class="overlay" v-bind:class="{ active: loading }">
      <div class='snowflake'>
        <div class='spindle'></div>
        <div class='spindle'></div>
        <div class='spindle'></div>
        <div class='spindle'></div>
        <div class='spindle'></div>
        <div class='spindle'></div>
      </div>
    </div>

    <section class="hero is-fullheight">
      <div class="hero-head">
        <header class="navbar">
          <div class="container">
            <div class="navbar-brand">
                <img src="dist/assets/logo.svg" alt="Logo">
            </div>
          </div>
        </header>
      </div>

      <div v-bind:class="{ active: codePage }" id="codepage" class="hero-body">
        <div class="container">
          <div class="columns is-centered m-t-lg">
            <div class="column is-half">
              <p>Beste klant / relatie,</p>
              <br>
              <p>Dit jaar hebben we besloten om namens onze klanten en relaties een donatie te doen aan een aantal door ons gekozen goede doelen.</p>
              <br>
              <p>Op de kerstkaart die je van ons hebt ontvangen staat een code. Vul je unieke code hieronder in en laat weten welk goed doel jullie zouden willen steunen. ZIGT zorgt er vervolgens voor dat dit goede doel een donatie ontvangt van €50,-.</p>
              <br>
              <p>Let op: je kunt je code uiterlijk tot 31 december invoeren!</p>
              <div class="m-t-lg m-b-lg">
                <div class="columns is-mobile is-1 is-variable">
                  <div class="column has-text-centered">
                    <form>
                      <input class="code" ref="codeOne" v-on:keyup.enter="$event.target.nextElementSibling.focus()" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeOne" pattern="[0-9]*">
                      <input class="code" ref="codeTwo" v-on:keyup.enter="$event.target.nextElementSibling.focus()" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeTwo" pattern="[0-9]*">
                      <input class="code" ref="codeThree" v-on:keyup.enter="$event.target.nextElementSibling.focus()" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeThree" pattern="[0-9]*">
                      <input class="code" ref="codeFour" v-on:keyup.enter="$event.target.nextElementSibling.focus()" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeFour" pattern="[0-9]*">
                      <input class="code" ref="codeFive" v-on:keyup.enter="$event.target.nextElementSibling.focus()" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeFive" pattern="[0-9]*">
                      <input class="code" ref="codeSix" autocomplete="off" type="tel" v-on:input="checkCode" :maxlength="max" v-model="codeSix" pattern="[0-9]*">
                    </form>
                  </div>
                </div>
              </div>
              <div ref="error" v-bind:class="{ 'active': isError, 'is-danger': isErrorWrongCode, 'is-info': isErrorCodeUsed }" class="notification">
                <button @click="deleteCodeIsWrongBox()" class="delete"></button>
                <strong v-text="notificationText"></strong>
              </div>
            </div>
          </div>
        </div>
      </div>
 
      <div v-bind:class="{ active: votePage }" id="votepage" class="hero-body m-b-lg">
        <div class="container">
          <div class="columns is-centered">
            <div class="column is-half">
              <div class="column has-text-centered">
                <p class="title">Beste {{nameUser}},<br>
                <br>
                Om jou en je collega’s te bedanken voor de mooie samenwerking afgelopen jaar willen we graag iets teruggeven in de vorm van een donatie aan een goed doel. Wij hebben drie goede doelen geselecteerd:</p>
              </div>
            </div>
          </div>
          <div class="columns is-centered m-t-lg">
            <div class="column is-three-quarters">
              <div class="columns is-variable is-8">
                <div class="column votecolumn">
                  <div class="column is-paddingless">
                    <figure class="m-b-lg">
                      <img class="imagecharity" src="dist/assets/mamas.png">
                    </figure>
                  </div>
                  <p>Er gebeurt iets heel bijzonders in Zuid-Afrika. Gewone, lokale vrouwen zien de extreme armoede waar vooral kinderen de dupe van worden en zorgen voor opvang, scholing, medicatie én liefde. Alles wat nodig is om een kind gezond en kansrijk groot te laten worden. Samen vormen de MAMAS de Beweging van Hoop die Zuid-Afrika structureel van onderaf verandert. Verspreid over 50 indrukwekkende projecten in Zuid-Afrika, bereiken de MAMAS nu al meer dan 50.000 kinderen. Kinderfonds MAMAS steunt hen. Want MAMA POWER werkt!</p>
                  <a @click="giveVoteOptionOne()" class="button is-primary m-t-lg m-b-md">Doneer €50,-</a>
                </div> 
                <div class="column votecolumn">
                  <div class="column is-paddingless">
                    <figure class="m-b-lg">
                      <img class="imagecharity" src="dist/assets/liliane.png">
                    </figure>
                  </div>
                  <p>Wist u dat 9 van de 10 kinderen met een handicap niet naar school gaat? Veel hè? Vaak is schoolgeld of zoiets simpels als een toegankelijk toilet het grootste struikelblok. Voor 120 euro kunnen wij een kind een jaar lang helpen, bijvoorbeeld door schoolgeld te betalen. Helpt u mee? Elke euro maakt verschil.</p>
                  <a @click="giveVoteOptionTwo()" class="button is-primary m-t-lg m-b-md">Doneer €50,-</a>
                </div>
                <div class="column votecolumn">
                  <div class="column is-paddingless">
                    <figure class="m-b-lg">
                      <img class="imagecharity" src="dist/assets/aap.png">
                    </figure>
                  </div>
                  <p>Jaarlijks krijgen vele door mensen mishandelde en verwaarloosde apen en exotische zoogdieren een nieuw leven bij Stichting AAP. De dieren die bij AAP binnenkomen zijn er vaak slecht aan toe en hebben deskundige en liefdevolle zorg nodig: eten, een schoon verblijf, medische zorg en vooral veel aandacht. Wij helpen de dieren weer dier te kunnen worden. Zo krijgen zij de tweede kans geven die ze zo verdienen. </p>
                  <a @click="giveVoteOptionThree()" class="button is-primary m-t-lg m-b-md">Doneer €50,-</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-bind:class="{ active: finalPage }" id="finalpage" class="hero-body m-b-xl">
        <div class="container">
          <div class="columns is-centered">
            <div class="column is-three-quarters">
              <div class="columns">
                <div class="column has-text-centered">
                  <figure>
                  <img class="imagecharity" :src="this.charityImg" alt="charity" />
                  </figure>
                </div>
                <div class="column is-three-quarters">
                  <p>Bedankt voor je donatie aan {{this.isCharity}}.<br>
                  Begin januari laten we jullie weten hoeveel er gestort is naar elk goed doel.</p>
                </div>
              </div>
              <div class="columns">
                <div class="column is-full endblock m-t-lg">
                  <b class="end">Namens de goede doelen en het hele ZIGT team wensen wij jullie fijne feestdagen en een succesvol 2019!</b>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="social">
        <a href="https://www.facebook.com/MediabureauZIGT" target="_blank" rel="noopener noreferrer"><img src="dist/assets/F_icon.svg"></a>
        <a href="https://twitter.com/MediabureauZIGT" target="_blank" rel="noopener noreferrer"><img src="dist/assets/Twitter_Bird.svg"></a>
        <a href="https://www.instagram.com/mediabureauzigt/" target="_blank" rel="noopener noreferrer"><img src="dist/assets/insta.svg"></a>
      </div>

      <div class="zigtstudio">
        Door <a href="https://zigtstudio.nl/" target="_blank" rel="noopener noreferrer">ZIGT Studio</a>
      </div>
    </section>
  </div>
</template>

<script>
  import 'es6-promise/auto'
  import axios from 'axios'

  export default {
    name: 'app',
    data: function() {
      return {
        max: 1,
        loading: false,
        codeOne: '',
        codeTwo: '',
        codeThree: '',
        codeFour: '',
        codeFive: '',
        codeSix: '',
        entireCode: '',
        isError: false,
        isErrorWrongCode: false,
        isErrorCodeUsed: false,
        notificationText: '',
        codeIsCorrect: false,
        codePage: true,
        votePage: false,
        finalPage: false,
        nameUser: '',
        hasVoted: false,
        isCharity: '',
        charityImg: null
      }
    },
    watch: {
      codeOne: function (val) {
        if (val != '') {
          this.$refs.codeTwo.focus();
        }
      },
      codeTwo: function (val) {
        if (val != '') {
          this.$refs.codeThree.focus();
        }
      },
      codeThree: function (val) {
        if (val != '') {
          this.$refs.codeFour.focus();
        }
      },
      codeFour: function (val) {
        if (val != '') {
          this.$refs.codeFive.focus();
        }
      },
      codeFive: function (val) {
        if (val != '') {
          this.$refs.codeSix.focus();
        }
      }
    },
    methods: {
      checkCode() {

          if (this.codeOne && this.codeTwo && this.codeThree && this.codeFour && this.codeFive && this.codeSix) {

            this.loading = true;

            this.entireCode = this.codeOne + this.codeTwo + this.codeThree + this.codeFour + this.codeFive + this.codeSix;
            axios.get(`./checkCode.php?code=${this.entireCode}&timestamp=${new Date().getTime()}`)
            .then((response)  =>  {
              this.loading = false;
              if(response.data.code == 200) {
                if(response.data.data.voted == 1) {
                  this.codeUsed(true);
                } else {
                  this.isError = false;
                  this.codePage = false;
                  this.votePage = true;
                  this.nameUser = response.data.data.name;

                  this.$refs.codeOne.blur();
                  this.$refs.codeTwo.blur();
                  this.$refs.codeThree.blur();
                  this.$refs.codeFour.blur();
                  this.$refs.codeFive.blur();
                  this.$refs.codeSix.blur();

                  window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                  });
                }
              } else if(response.data.code == 404) {
                this.codeWrong(true);
              } else {
                this.somethingWrong(true);
              }
            }, (error)  =>  {
              console.log(error);
              this.loading = false;
            })
          }
      },
      somethingWrong(boolean) {
        if (boolean == true) {
          this.isError = true;
          this.notificationText = 'Oeps, er ging iets verkeerd. Probeer het later opnieuw.';
          this.isErrorWrongCode = true;
          this.isErrorCodeUsed = false;
        } else {
          this.isError = false;
          this.notificationText = '';
        }        
      },
      codeWrong(boolean) {
        if (boolean == true) {
          this.isError = true;
          this.notificationText = 'Deze code is verkeerd.';
          this.isErrorWrongCode = true;
          this.isErrorCodeUsed = false;
        } else {
          this.isError = false;
          this.notificationText = '';
        }
      },
      codeUsed(boolean) {
        if (boolean == true) {
          this.isError = true;
          this.notificationText = 'Deze code is al gebruikt.';
          this.isErrorCodeUsed = true;
          this.isErrorWrongCode = false;
        } else {
          this.isError = false;
          this.notificationText = '';
        }
      },
      deleteCodeIsWrongBox() {
        this.codeWrong(false);
      },
      deleteCodeIsAlreadyUsed() {
        this.codeUsed(false);
      },
      giveVoteOptionOne() {
          this.loading = true;
          axios.get(`./voteCode.php?code=${this.entireCode}&charity=1&timestamp=${new Date().getTime()}`)
          .then((response)  =>  {
            this.loading = false;
            if (response.data.code == 200) {
              this.isCharity = 'Kinderfonds MAMAS';
              this.charityImg = "dist/assets/mamas.png";

              this.finalPageAction();
            }
          }, (error)  =>  {
            console.log(error);
            this.loading = false;
          })
      },
      giveVoteOptionTwo() {
          this.loading = true;
          axios.get(`./voteCode.php?code=${this.entireCode}&charity=2&timestamp=${new Date().getTime()}`)
          .then((response)  =>  {
            this.loading = false;
            if (response.data.code == 200) {
              this.isCharity = 'Liliane Fonds';
              this.charityImg = "dist/assets/liliane.png";         

              this.finalPageAction();
            }
          }, (error)  =>  {
            console.log(error);
            this.loading = false;
          })
      },
      giveVoteOptionThree() {
          this.loading = true;
          axios.get(`./voteCode.php?code=${this.entireCode}&charity=3&timestamp=${new Date().getTime()}`)
          .then((response)  =>  {
            this.loading = false;
            if (response.data.code == 200) {
              this.isCharity = 'Stichting AAP';
              this.charityImg = "dist/assets/aap.png";          

              this.finalPageAction();
            }
          }, (error)  =>  {
            console.log(error);
            this.loading = false;
          })
      },
      finalPageAction() {
        this.votePage = false;
        this.finalPage = true;
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });   
      }
    }
  }
</script>
