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
        <div style="padding-left:5px">{{ pontoTuristico.name }}</div>
        <div class="km">{{distancias[index]}} km</div>
      </div>
      <div
        class="containerInformacao"
        v-if="
          classeClicada == index + pontoTuristico.name && mostraClasse == true
        "
        @click="goElementos(pontoTuristico)"
      >
        <div class="texto">{{ pontoTuristico.description }}</div>
        <img class="imagem" :src="pontoTuristico.photos[0].url" alt="" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: "http://ec2-3-93-44-66.compute-1.amazonaws.com:8080/api/attractions",
      pontosTuristicos: {},
      mostraClasse: false,
      classeClicada: {},
      distancias:[]
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
      this.geolocalizacao()
    },
    geolocalizacao() {
      if ("geolocation" in navigator) {
        console.log(
          navigator.geolocation.getCurrentPosition(
            (position) => {
              this.pontosTuristicos.forEach((ponto) => {
                var distancia = this.getDistanceFromLatLonInKm(
                  {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                  },
                  { lat: ponto.coordinates.lat, lng:ponto.coordinates.lng }
                );

                var d = distancia / 1000;
                 d = d.toFixed(1);
                console.log(d)
                this.distancias.push(d)
              });
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
    goElementos(pontoTuristico) {
      var obj = pontoTuristico
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
  justify-content: space-between;
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
.km {
  font-size: 12px;
  display: flex;
}
</style>
