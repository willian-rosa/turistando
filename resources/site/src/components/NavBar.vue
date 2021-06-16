<template>
  <div id="navBar">
    <div class="centralizar font">Turistando</div>
    <ul>
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/">Eventos</router-link>
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/pontosTuristicos"
        >Pontos Turísticos</router-link
      >
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/estabelecimentos"
        >Estabelecimentos & Serviços</router-link
      >
    </ul>
    <div class="centralizar" id="menu">
      <b-button class="bg-transparent border-0" v-b-toggle.sidebar-1
        ><b-icon icon="list" font-scale="2" variant="dark"></b-icon
      ></b-button>
      <b-sidebar id="sidebar-1" title="Turistando" width="250px" text-variant="dark" shadow>
        <div class="centralizar">
          <img
            src="../assets/Laguna_Centro_Historico.jpg"
            alt="Imagem do Centro Histórico"
            width="230"
            height="230"
            max-width="230"
            max-height="230" 
          />
        </div>
        <div style="display: grid; margin-left: 10px">
          <router-link class="sidebar " to="/">Eventos</router-link>
          <router-link class="sidebar " to="/pontosTuristicos"
            >Pontos Turísticos</router-link
          >
          <router-link class="sidebar " to="/estabelecimentos"
            >Estabelecimentos & Serviços</router-link
          >
        </div>
      </b-sidebar>
    </div>
  </div>
</template>

<script>


export default {};
</script>

<style scoped>
.sidebar{
  padding-top: 12px;
  font-size: 24px;
  color: #fff;
}
.font{
  font-family: 'Pacifico', cursive; 
  font-size:30px;
  color: black;
}
a{
  color: black;
}
a:hover{
  text-decoration: none;
  color: #969191;

}
.centralizar {
  display: flex;
  justify-content: center;
  align-items: center;
}
#menu {
  display: none;
}
#navBar {
  display: flex;
  justify-content: space-between;
  background-color: #6059c1;
  color: #fff;
  height: 50px;
  padding-left: 15vw;
  padding-right: 15vw;
}
ul {
  display: flex;
  margin: 0px;
}
ul > li {
  list-style-type: none;
  padding-left: 5px;
  padding-right: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
}
img{
    border-radius: 50%;
    margin: 5px;
}
@media (max-width: 600px) {
  #menu {
    display: flex;
  }
  ul {
    display: none;
  }
}
</style> 