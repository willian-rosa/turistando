<template>
<div>

  <div @click="goElementos($event)">
    <b-carousel
        
        id="carousel-fade"
        style="text-shadow: 0px 0px 2px #000"
        fade
        img-width="1024"
        img-height="480"
        img-max-width="1024"
        img-max-height="480"
      >
        <b-carousel-slide v-for="(item,index) of items "
          caption=""
          :img-src="item.photos[0].url"
          :img-alt="item.name"
          :key="index"
          :id="item.id"
        >
        </b-carousel-slide>
        
        </b-carousel>
        
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      photos:'https://via.placeholder.com/640x480.png/00dd33?text=temporibus',
      url: "http://ec2-3-93-44-66.compute-1.amazonaws.com:8080/api/attractions",

    };
  },
  computed:{
    retornaItem(item){
      return console.log(item)
    }
  },
  methods: {
    goElementos(id){
      var i = this.items.filter(item=>{
        if(item.id == id.path[1].id){
          return item
        }
      })
      i=i[0]
      var obj = i;
      console.log(obj)
      localStorage.setItem(
        "objeto",
        JSON.stringify({obj} )
      );
      this.$router.push('/elementos')
    },
    fetchApi() {
      fetch(this.url)
        .then((response) => response.json())
        .then((json) => {
          json.data = json.data.filter(item=>{
            if(item.photos.length!=0){
              console.log(item.photos.length)
              return item
            }
          })
          this.items = json.data;
          console.log(this.items);
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
  },
  mounted() {
  this.fetchApi()
  },
};
</script>

<style>
</style>