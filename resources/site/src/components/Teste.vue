<template>
  <div>
    <Carousel/>
    <h3 style="color: #6059c1">Mais visitados</h3>
    <hr style="background-color: #6059c1" />
    <List/>
    <h3 style="color: #6059c1">Mais visitados</h3>
    <hr style="background-color: #6059c1" />
    <List/>
    <h3 style="color: #6059c1">Mais visitados</h3>
    <hr style="background-color: #6059c1" />
    <List/>
  </div>
</template>

<script>
import List from "./listas/List.vue";
import Carousel from "./listas/Carousel.vue";

export default {
  components: { List, Carousel },
};
</script>

