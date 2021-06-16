<template>
  <div class="bodyRotas">
    <br>
    <Carousel/>
    <br><br>
    <h3 style="color: #6059c1">Mais escolhidos</h3>
    <hr style="background-color: #6059c1" />
    <List/>
    <h3 style="color: #6059c1">Ultimos Adicionados</h3>
    <hr style="background-color: #6059c1" />
    <List/>
    <h3 style="color: #6059c1">Agenda Geral</h3>
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


<style scoped>
li {
  list-style: none;
}
.bodyRotas {
  padding-left: 10vw;
  padding-right: 10vw;
}
.centralizar {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
/* .wrapper{
  max-height: 230px;
  border:1px solid #ddd;
  display:flex;
  overflow-x:auto;
}

.wrapper::-webkit-scrollbar{
  width:0;
}
.wrapper .item{
  min-width: 230px;
  height: 230px;
  line-height:230px;
  text-align:center;
  background-color: #ddd;
  margin-right: 2px;

} */
.item{
  padding: 16px 24px;
  border-radius: 3px;
  background: #f5f5f5;
}
</style>