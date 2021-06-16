<template>
  <div id="app">
    <NavBar></NavBar>
    <router-view></router-view>
  </div>
</template>

<script>
import NavBar from "./components/NavBar";

export default {
  name: 'App',
  components:{NavBar}
}
</script>

<style >
body{
  font-family: 'Roboto', sans-serif;
  margin: 0px;
}
.b-sidebar{
      width: 250px;
    background: rgb(2,0,36);
    background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(96,89,193,1) 72%, rgba(44,174,179,1) 100%);
}
/* .b-sidebar > .b-sidebar-header {
  display: none;
  background-color:#6059c1;
}
.b-sidebar > .b-sidebar-body {
    background-color:#6059c1 ;
} */
#sidebar-1___title__{
  font-family: 'Pacifico', cursive; 
  font-size:30px;
  color: black;
  font-weight: normal;
  
}
</style>