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

.b-sidebar > .b-sidebar-header {
  display: none;
  background-color:#6059c1;
}
.b-sidebar > .b-sidebar-body {
    background-color:#6059c1 ;
}
</style>