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
        {{ pontoTuristico.name }}
      </div>
      <div
        class="containerInformacao"
        v-if="
          classeClicada == index + pontoTuristico.name && mostraClasse == true
        "
      >
        <div class="texto">{{ pontoTuristico.description }}</div>
        <img class="imagem" :src="pontoTuristico.photos.url" alt="" />
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
    geolocalizacao() {
      if ("geolocation" in navigator) {
        console.log(
          navigator.geolocation.getCurrentPosition(
            (position) => {
              console.log(position.coords.latitude);
              console.log(position.coords.longitude);
              var distancia = this.getDistanceFromLatLonInKm(
                {
                  lat: position.coords.latitude,
                  lng: position.coords.longitude,
                },
                { lat: -28.495749, lng: -48.761474 }
              );

              console.log(distancia/1000).toFixed(1);
            },
            (error) => {
              console.log(error);
            }
          )
        );
      } else {
        console.log("deu ruim");
      }
    },
    getDistanceFromLatLonInKm(position1, position2) {
      "use strict";
      var deg2rad = function(deg) {
          return deg * (Math.PI / 180);
        },
        R = 6371,
        dLat = deg2rad(position2.lat - position1.lat),
        dLng = deg2rad(position2.lng - position1.lng),
        a =
          Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(deg2rad(position1.lat)) *
            Math.cos(deg2rad(position1.lat)) *
            Math.sin(dLng / 2) *
            Math.sin(dLng / 2),
        c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      return (R * c * 1000).toFixed();
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
    this.geolocalizacao();
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
}
.containerInformacao {
  display: flex;
  justify-content: space-between;
  padding: 5px;
}
.imagem {
  border-radius: 20%;
  height: 150px;
  width: 150px;
  max-width: 150px;
  max-height: 150px;
}
</style>
