<template>
  <div class="kontenjer">
      <div class="google-map" :id="mapName"> <!-- v-bind id sa propertijem mapName -->
      </div>
      <!-- city prop je prop preko koga se salje iz blade.php u vue komponentu neke vrednosti-->
        <!-- Prop mora da postoji u export default-u -->
        <!-- Grad:{{city_prop}} -->
  </div>
</template>

<script>
export default {
  name: 'google-map',
  props: {
      city_name: String,
      name: {
          required: true
      }
  },
  data () { 
    return {
        //defaultCoord: new google.maps.LatLng(this.city_coord.long,this.city_coord.lat),
        defaultCoord: new google.maps.LatLng(44.0152544,20.7451155),
        mapName: this.name + '-map' //za id mape
    }
  },
  //Lifehook koji poziva funkciju za prikaz mape kada se napravi google-map div
  mounted: function () {
    const element = document.getElementById(this.mapName)
    const options = {
      zoom: 7,
      center: this.defaultCoord
    }
    const map = new google.maps.Map(element, options);
  },

  //Lifehook created
    created() {
        //axios je slicno ajaxu i ovo sa get se zove controler sa ovom rutom da bi se vratili podaci
        //prvo se navodi ruta koja u sebi ima koji kontroler je zaduzen i koja funkcija je zaduzena
        //kada se navede cities, users, itd...
        /*axios.get('/web/api/cities').then(response => {
            console.log(response);
            //this.cities = response.data;
        }).catch(error => {
            console.log(error);
        });*/
    }
};
</script>

<style scoped>
.google-map {
  width: 800px;
  height: 600px;
  margin: 0 auto;
  background: gray;
}
</style>