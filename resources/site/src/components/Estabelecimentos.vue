<template>
  <div class="bodyRotas">
    <br />
    <div
      v-for="(estabelecimento, index) of estabelecimentos"
      :key="index + estabelecimento.name"
    >
      <div
        class="titulo"
        @click="abrirClasse($event)"
        :id="index + estabelecimento.name"
      >
        {{ estabelecimento.name }}
      </div>

      <div
        v-if="
          classeClicada == index + estabelecimento.name && mostraClasse == true
        "
        @click="goElementos(estabelecimento)"
      >
        <!-- <div class="checkbox">
          
        </div> -->
        <div>
          <div class="lista">
            <div class="imagem">
              <img class="imagem" :src="estabelecimento.photos.url" alt="" />
            </div>
            <div>
              <div class="texto">{{ estabelecimento.description }}</div>
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
      url: "http://ec2-3-93-44-66.compute-1.amazonaws.com:8080/api/attractions",
      estabelecimentos: {},
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
      this.estabelecimentos = json;
    },
    abrirClasse(evento) {
      if (this.classeClicada == evento.target.id) {
        this.mostraClasse = !this.mostraClasse;
      } else {
        this.mostraClasse = true;
        this.classeClicada = evento.target.id;
      }
    },
    goElementos(estabelecimento) {
      var obj = estabelecimento
      console.log(obj)
      localStorage.setItem(
        "objeto",
        JSON.stringify({ obj })
      );
      this.$router.push('/elementos')
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
.texto {
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
