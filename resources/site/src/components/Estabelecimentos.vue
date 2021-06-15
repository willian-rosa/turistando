<template>
  <div class="bodyRotas">
    <br />
    <div
      v-for="(pontoTuristico, index) of pontosTuristicos"
      :key="index + pontoTuristico.name"
    >
      <div
        class="titulo"
        @click="abrirClasse($event)"
        :id="index + pontoTuristico.name"
      >
        {{pontoTuristico.name}}
      </div>

      <div
        v-if="
          classeClicada == index + pontoTuristico.name && mostraClasse == true
        "
      >
        <!-- <div class="checkbox">
          
        </div> -->
        <div>
          <div class="lista">
            <div class="imagem">
        <img class="imagem" :src="pontoTuristico.photos.url" alt="" />
            </div>
            <div>
              <div class="texto">{{ pontoTuristico.description }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      url: "https://webhook.site/f1af49a7-f782-4c4f-a266-ec5e45cfd844",
      pontosTuristicos: {},
      mostraClasse: false,
      classeClicada: {},
    };
  },
  methods: {
    fetchApi() {
      fetch(this.url)
        .then((response) => response.json())
        .then((json) => {
          this.filtro(json.data);
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
    filtro(json) {
      this.pontosTuristicos = json;
    },
    abrirClasse(evento) {
      if (this.classeClicada == evento.target.id) {
        this.mostraClasse = !this.mostraClasse;
      } else {
        this.mostraClasse = true;
        this.classeClicada = evento.target.id;
      }
    },
  },
  mounted() {
    this.fetchApi();
  },
};
</script>

<style scoped>
.bodyRotas {
  padding-left: 10vw;
  padding-right: 10vw;
}
.titulo {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #dcdcdc;
  color: #6059c1;
  border: 2px solid #6059c1;
  border-radius: 12px;
  height: 50px;
  font-size: 20px;
  margin-top: 2px;
}
.checkbox {
  color: #6059c1;
  margin-left: 20px;
}
.lista {
  list-style: none;
  display: flex;
  padding: 5px;
}
.texto{
  margin-left: 5px;
}
.imagem {
  border-radius: 20%;
  height: 150px;
  width: 150px;
  max-width: 150px;
  max-height: 150px;
}
</style>
