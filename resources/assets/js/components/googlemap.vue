<template>
  <div class="kontenjer">
      <div class="google-map" :id="mapName"> <!-- v-bind id sa propertijem mapName -->
      </div>
  </div>
</template>

<script>
export default {
  name: 'google-map',
  props: {
      name: {
          required: true
      }
  },
  data () { 
    return {
        //defaultCoord: new google.maps.LatLng(this.city_coord.long,this.city_coord.lat),
        defaultCoord: new google.maps.LatLng(44.2792544,20.7451155),
        mapName: this.name + '-map', //za id mape
        cities: []
    }
  },
  methods: {
    //axios je slicno ajaxu i ovo sa get se zove controler sa ovom rutom da bi se vratili podaci
    //prvo se navodi ruta koja u sebi ima koji kontroler je zaduzen i koja funkcija je zaduzena
    //kada se navede cities, users, itd...
      getCities: function() {
          axios.get('/web/api/cities').then(response => {
            this.cities = response.data; //vracaju se svi gradovi
            this.initMap();
            }).catch(error => {
            console.log(error);
        });
      },

      initMap: function() {
          var element = document.getElementById(this.mapName)
          var options = {
              zoom: 7,
              maxZoom: 7,
              minZoom: 7,
              draggable: false,
              center: this.defaultCoord
          }
          var map = new google.maps.Map(element, options);

          if(this.cities != null)
          {
              for(var i = 0; i < this.cities.length; i++)
              {       
                    this.addMarker(map, new google.maps.LatLng(this.cities[i].lat, this.cities[i].long));
              }
          }
      },
      addMarker: function(map, koordinate) {
          var marker = new google.maps.Marker( {
              position: koordinate,
              map: map,
              icon: 'https://cdn2.iconfinder.com/data/icons/city-icons-for-offscreen-magazine/80/cape-town-48.png'
          });
      }
  },

  //Lifehook created
  created() {
    this.getCities();
  } 
};
</script>

<style scoped>
.google-map {
  width: 100%;
  height: 550px;
  margin: 0 auto;
  background: gray;
}
</style>