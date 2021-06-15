<template>
  <div id="navBar">
    <div class="centralizar font">Turistando</div>
    <ul>
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/eventos">Eventos</router-link>
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/pontosTuristicos"
        >Pontos Turísticos</router-link
      >
      <router-link style="padding-right: 5px; padding-left: 5px;text-decoration: underline;" class="centralizar" to="/estabelecimentos"
        >Estabelecimentos & Serviços</router-link
      >
    </ul>
	br
    <div class="centralizar" id="menu">
      <b-button class="bg-transparent border-0" v-b-toggle.sidebar-1
        ><b-icon icon="list" font-scale="2"></b-icon
      ></b-button>
      <b-sidebar id="sidebar-1" title="Turistando" width="250px" text-variant="light" shadow>
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
          <router-link to="/eventos">Eventos</router-link>
          <router-link to="/pontosTuristicos"
            >Pontos Turísticos</router-link
          >
          <router-link to="/estabelecimentos"
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
  color: #fff;
  background-color: #554cce;
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

@media (max-width: 600px) {
  #menu {
    display: flex;
  }
  ul {
    display: none;
  }
}
</style> 