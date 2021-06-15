<template>
<div>

  <div>
    <b-carousel
        id="carousel-fade"
        style="text-shadow: 0px 0px 2px #000"
        fade
        img-width="1024"
        img-height="480"
        img-max-width="1024"
        img-max-height="480"
      >
        <b-carousel-slide v-for="(item,index) of items"
          caption=""
          :img-src="item.imagem"
          :img-alt="item.titulo"
          :key="index"
        ></b-carousel-slide>
        </b-carousel>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      accessKey: "6V8sZsHjrXaYUXZNwbpcOzshDOBN7-IwjfArx09BHdI",
      url: "https://api.unsplash.com/collections/72903167/photos?",
      username: "fNeri",
    };
  },
  methods: {
    fetchClubFotos() {
      fetch(this.url + `client_id=${this.accessKey}`)
        .then((response) => response.json())
        .then((json) => {
          this.filtro(json);
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
    filtro(json) {
      this.items = json.map((item) => {
        var i = new Object();
        i.imagem = item.urls.full
        i.descricao = item.description;
        i.titulo = item.alt_description.toUpperCase();
        return i;
      });
      console.log(this.items);
    },
  },
  mounted() {
    this.fetchClubFotos();
  },
};
</script>

<style>
</style>