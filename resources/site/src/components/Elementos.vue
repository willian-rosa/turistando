<script
  async
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvb87D9piABnnlhDHR3xg8oiSvMq2vE_I&callback=initMap"
></script>
<template>
  <div class="bodyRotas">
    <main>
      <div class="container">
        <div style="margin-bottom:5px;">
          <vue-horizontal
            ref="horizontal"
            class="horizontal"
            :button="false"
            @scroll-debounce="onScrollDebounce"
          >
            <div class="item" v-for="item in items" :key="item.id">
              <div
                class="image"
                :style="{ background: `url(${item.url})` }"
              ></div>
            </div>
          </vue-horizontal>
        </div>
        <div class="header">
          <nav style="justify-content: center;">
            <button
              @click="prev"
              :class="{ active: hasPrev, inactive: !hasPrev }"
            >
              <svg viewBox="0 0 24 24">
                <path
                  d="m9.8 12 5 5a1 1 0 1 1-1.4 1.4l-5.7-5.7a1 1 0 0 1 0-1.4l5.7-5.7a1 1 0 0 1 1.4 1.4l-5 5z"
                />
              </svg>
            </button>
            <button
              @click="next"
              :class="{ active: hasNext, inactive: !hasNext }"
            >
              <svg viewBox="0 0 24 24">
                <path
                  d="m14.3 12.1-5-5a1 1 0 0 1 1.4-1.4l5.7 5.7a1 1 0 0 1 0 1.4l-5.7 5.7a1 1 0 0 1-1.4-1.4l5-5z"
                />
              </svg>
            </button>
          </nav>
        </div>

        <div>
          {{descricao}}
        </div>
        <div style="display:flex;justify-content:center;">

          <GmapMap
            :center="{ lat: atual.lat, lng: atual.lng }"
            :zoom="11"
            style="width:640px; height:360px;"
          >
            <GmapMarker
              v-for="(m, index) in markers "
              :key="index"
              :position="m.position"
              :clickable="true"
              :draggable="true"
              :icon="m.icon"
              @click="center = m.position"
            />
          </GmapMap>
        </div>
      </div>
    </main>
  </div>
</template>

<script>

export default {
  data() {
    return {
      items:[],
      hasPrev: false,
      hasNext: true,
      markers: [],
      atual: {},
      descricao:'',
      destino: { },
      markers: [],
      obj:{},
      url: "http://ec2-3-93-44-66.compute-1.amazonaws.com:8080/api/attractions",
    };
  },
  computed: {},
  methods: {
    prev() {
      this.$refs.horizontal.prev();
    },
    next() {
      this.$refs.horizontal.next();
    },
    onScrollDebounce({ hasPrev, hasNext }) {
      this.hasPrev = hasPrev;
      this.hasNext = hasNext;
    },
    pontos() {
      this.markers = [
        {
          position: this.atual,
          infoText: "<strong>Work</strong>",
          icon: {
            url: require("../assets/to_location.png"),
            scaledSize: { width: 35, height: 35 },
          },
        },
        {
          position: this.destino,
          infoText: "<strong>Home</strong>",
          icon: {
            url: require("../assets/from_location.png"),
            scaledSize: { width: 35, height: 35 },
          },
        },
      ];
    },
     posicaoAtual() {
      navigator.geolocation.getCurrentPosition((position) => {
        this.atual.lat =position.coords.latitude
        this.atual.lng =position.coords.longitude
      });
      this.limparPontos()
      this.pontos()
       setTimeout(this.posicaoAtual, 5000)
    },
    limparPontos(){
      this.markers=[]
    },
    listar(){
      this.obj = JSON.parse(localStorage.getItem("objeto"));
      this.items = this.obj.obj.photos
      this.descricao =  this.obj.obj.description
      this.destino = this.obj.obj.coordinates
      this.posicaoAtual();

    }
    /* fetchApi() {
      fetch(this.url)
        .then((response) => response.json())
        .then((json) => {
          this.items = json.data;
          console.log(json);
        })
        .catch((err) => {
          console.log("error", err);
        });
    }, */
  },
  mounted() {
    this.listar()
    /* this.fetchApi(); */
    
    /* this.initMap(); */
  },
};
</script>

<!-- Content Design -->
<style scoped>
#map {
  height: 500px;
  width: 500px;
  background-color: #d3d3d3;
}
.bodyRotas {
  padding-left: 10vw;
  padding-right: 10vw;
}
.container {
  background-color: #d3d3d3;
  border: solid 2px #6059c1;
  border-radius: 20px;
  padding: 15px;
}
.image {
  background-position: center !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  padding-top: 100%;
  position: relative;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
  background: linear-gradient(
    345deg,
    #00000080 0,
    #00000060 5%,
    #00000040 20%,
    #00000000 50%
  );
}

.overlay .text {
  padding: 12px;
  line-height: 1;
  font-weight: 700;
  font-size: 14px;
  color: white;
}

.content {
  margin-top: 6px;
}

.content h6 {
  font-size: 14px;
  text-transform: capitalize;
  line-height: 1.5;
}

.content p {
  line-height: 1.5;
  font-size: 12px;
  margin-top: 2px;

  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.header {
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

nav {
  display: flex;
  align-items: center;
  justify-content: center;
}

svg {
  width: 24px;
  height: 24px;
  fill: currentColor;
  color: black;
}

button.inactive svg {
  color: #bbb;
}

button {
  padding: 4px;
  border-radius: 100px;
  background-color: #6059c1;
  border: solid;
  margin-left: 20px;
  margin-right: 20px;
}

button:focus {
  outline: none;
}
</style>

<!-- Parent CSS (.container) -->
<style scoped>
main {
  padding: 10px;
}

@media (min-width: 768px) {
  main {
    padding: 48px;
  }
}
</style>

<!-- Responsive Breakpoints -->
<style scoped>
.horizontal {
  --count: 2;
  --gap: 16px;
}

@media (max-width: 640px) {
  .header {
    display: none;
  }
  .bodyRotas {
    padding-left: 0;
    padding-right: 0;
  }
}

@media (max-width: 768px) {
  .header {
    display: none;
  }
  .bodyRotas {
    padding-left: 0;
    padding-right: 0;
  }
}
@media (min-width: 640px) {
  .horizontal {
    --count: 3;
    --gap: 24px;
  }
}
@media (min-width: 768px) {
  .horizontal {
    --count: 4;
  }
}

@media (min-width: 1024px) {
  .horizontal {
    --count: 5;
  }
}

@media (min-width: 1280px) {
  .horizontal {
    --count: 6;
  }
}

.item {
  width: calc((100% - ((var(--count) - 1) * var(--gap))) / var(--count));
  margin-right: var(--gap);
}
</style>
