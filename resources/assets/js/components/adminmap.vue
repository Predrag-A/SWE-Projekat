<template>
  <div>

    <!-- DEO SA MAPOM -->
    <div class="card">
      <div class="adminmap" :id="mapName"></div>   
      <blockquote class="blue-grey-text text-lighten-2">
      <b>Napomena:</b><br>
      Za dodavanje grada i terena potrebno je na mapi odrediti potrebnu lokaciju grada/terena. Za dodavanje grada je potrebno i odrediti nivo zoom-a tako da je moguće videti veći deo grada. Dati parametri određuju se postavljanjem markera klikom na mapu. Promena pozicije markera se vrši klikom na marker i zatim klikom na novu poziciju.
      </blockquote>   
      <div class="row card-content">   

        <!-- LAT, LONG, ZOOM -->  
        <div class="col s12">
          <div class="input-field col s12 l4">
            <input v-model="data.lat" value=" " disabled id="lat" type="text" name="lat">
            <label for="lat">Geografska Širina</label>
          </div>
          <div class="input-field col s12 l4">
            <input v-model="data.long" value=" " disabled id="long" type="text" name="long"> 
            <label for="long">Geografska Dužina</label>
          </div>
          <div class="input-field col s12 l4">
            <input v-model="data.zoom" disabled id="zoom" type="text" name="zoom">
            <label for="zoom">Zoom</label>
          </div>
        </div>  

        <!-- DODAVANJE GRADA -->
        <div class="col s12 l3">
          <div class="row center"><h6>Dodavanje grada</h6></div>
            <div class="input-field col s12">
              <input v-model="data.name" id="name" type="text">
              <label for="name">Naziv</label>
            </div>            
            <div class="row center hide-on-large-only">
              <button class="btn waves-effect waves-light" @click="addCity" type="submit" name="action">Dodaj grad</button>
            </div>  
        </div>

        <!-- DODAVANJE TERENA -->
        <div class="col s12 l9">
          <div class="row center"><h6>Dodavanje terena</h6></div>
            <div class="input-field col s12 l7">
              <input v-model="data.location" id="location" type="text">
              <label for="location">Lokacija</label>
            </div>            
            <div class="input-field col s12 l5">
              <select v-model="data.city_id">
                <option value="" disabled selected>Izaberite grad</option>   
                <option v-for="city in cities_stored" :key="city.id" :value="city.id">{{city.name}}</option>          
              </select>
              <label>Grad</label>
            </div>
            <div class="row">
              <label class="col s4">
                <input v-model="data.football" type="checkbox" name="football" value="1"/>
                <span>Fudbal</span>
              </label>
              <label class="col s4">
                <input v-model="data.basketball" type="checkbox" name="basketball" value="1"/>
                <span>Košarka</span>
              </label>
              <label class="col s4">
                <input v-model="data.handball" type="checkbox" name="handball" value="1"/>
                <span>Rukomet</span>
              </label>
              <label class="col s4">
                <input v-model="data.tennis" type="checkbox" name="tennis" value="1"/>
                <span>Tenis</span>
              </label>
              <label class="col s4">
                <input v-model="data.futsal" type="checkbox" name="futsal" value="1"/>
                <span>Futsal</span>
              </label>
              <label class="col s4">
                <input v-model="data.volleyball" type="checkbox" name="volleyball" value="1"/>
                <span>Odbojka</span>
              </label>
            </div>            
        </div>
        <div class="row center">          
          <div class="col s12 l3 hide-on-med-and-down">
              <button class="btn waves-effect waves-light" @click="addCity" type="submit" name="action">Dodaj grad</button>
          </div>
          <div class="col s12 l9">
              <button class="btn waves-effect waves-light" @click="addCourt" name="action">Dodaj teren</button>
          </div>
        </div>
      </div>

    </div>

    <!-- DEO ZA BROADCAST -->
    <div class="card">
      <blockquote class="blue-grey-text text-lighten-2">
        <b>Napomena:</b><br>
        Poslato obaveštenje stiže svim registrovanim korisnicima. Koristiti sa pažnjom.
      </blockquote>
      <div class="row card-content">

        <div class="container">
          <!-- NASLOV -->
          <div class="input-field">
            <input v-model="broadcast.title" id="title" type="text">
            <label for="title">Naslov</label>
          </div>
      
          <!-- SADRZAJ -->
          <div class="input-field">
            <textarea v-model="broadcast.body" id="textarea_add" class="materialize-textarea">          
            </textarea>
            <label for="textarea_add">Sadržaj</label>
            
            <a href="JavaScript:void(0)" @click="resetArea" class="secondary-content"><i class="material-icons red-text">clear</i></a>
          </div>

          <div class="center">
            <button class="btn waves-effect waves-light" @click="notify" name="action">Pošalji Obaveštenje <i class="material-icons right">send</i></button>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>
<script>
export default {
  name: 'adminmap',
  props: {
    name: {
        required: true,
    },
    cities: {
        type: Array,
        required: true
    }
  },
  data: function () {
    return {
      defaultCoord: new google.maps.LatLng(44.2792544,20.7451155),     
      mapName: 'event' + this.name + '-map', //za id mape
      marker: "",
      map: "",
      cities_stored: [],
      data:{
        lat: " ",
        long:" ",
        zoom:" ",
        name:"",
        location:"",
        football: false,
        basketball: false,
        handball: false,
        tennis: false,
        futsal: false,
        volleyball: false,
        city_id:"",        
      },
      broadcast:{
        title: "",
        body: ""
      }
    }
  },
  mounted: function () {
    this.initMap()
    this.cities_stored = this.cities 
  },
  methods:{  
    
    // Metoda za dodavanje grada
    addCity() {
      const t = this
      console.log(t.cities_stored)
      if(t.data.name == "" || t.data.name == null){                    
        M.toast({html:'Niste ispravno uneli naziv grada', classes:'red lighten-3'}); 
        return
      }
      if(t.data.lat == " " || t.data.lat == null){                    
        M.toast({html:'Niste uneli koordinate grada', classes:'red lighten-3'}); 
        return
      }
      axios.post('/gradovi', t.data).then(({data}) => {
                if(data){       
                  M.toast({html:"Grad " + t.data.name + " dodat", classes:'green lighten-3'});
                }                
            }) 
    },

    // Metoda za dodavanje terena
    addCourt(){ 
      const t = this
      if(t.data.location == "" || t.data.location == null){                    
        M.toast({html:'Niste ispravno uneli lokaciju terena', classes:'red lighten-3'}); 
        return
      }
      if(t.data.lat == " " || t.data.lat == null){                    
        M.toast({html:'Niste uneli koordinate terena', classes:'red lighten-3'}); 
        return
      }
      if(t.data.city_id == "" || t.data.lat == null){                    
        M.toast({html:'Niste uneli grad', classes:'red lighten-3'}); 
        return
      }
      axios.post('/tereni', t.data).then(({data}) => {
                if(data == 1){       
                  M.toast({html:'Teren dodat', classes:'green lighten-3'});
                }                
            }) 
    },

    // Metoda za slanje obavestenja svima
    notify(){
      const t = this
      if(t.broadcast.title == "" || t.broadcast.title == null){                    
        M.toast({html:'Niste ispravno uneli naslov obaveštenja', classes:'red lighten-3'}); 
        return
      }
      if(t.broadcast.body == "" || t.broadcast.body == null){                    
        M.toast({html:'Niste ispravno uneli telo obaveštenja', classes:'red lighten-3'}); 
        return
      }
      axios.post('/api/broadcast', t.broadcast).then(({data}) => {
                if(data == 1){       
                  M.toast({html:'Obaveštenje poslato', classes:'green lighten-3'});
                }                
            }) 
    },

    // Metoda za resetovanje podataka o obavestenju
    resetArea(){
      this.broadcast.body = "",
      this.broadcast.title = ""
    },

    // Metoda za inicijalizaciju mape
    initMap() {
          const t = this;
          var element = document.getElementById(this.mapName)
          var options = {
              zoom: 7,
              maxZoom: 15,
              minZoom: 7,
              draggable: true,
              mapTypeControl: false,
              fullscreenControl: false,
              disableDoubleClickZoom: true,
              center: this.defaultCoord,
              styles: [{
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#1d2c4d"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#8ec3b9"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#1a3646"
                    }
                  ]
                },
                {
                  "featureType": "administrative.country",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#4b6878"
                    }
                  ]
                },
                {
                  "featureType": "administrative.land_parcel",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#64779e"
                    }
                  ]
                },
                {
                  "featureType": "administrative.province",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#4b6878"
                    }
                  ]
                },
                {
                  "featureType": "landscape.man_made",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#334e87"
                    }
                  ]
                },
                {
                  "featureType": "landscape.natural",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#023e58"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#283d6a"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#6f9ba5"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#1d2c4d"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#023e58"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#3C7680"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#304a7d"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#98a5be"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#1d2c4d"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#2c6675"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry.stroke",
                  "stylers": [
                    {
                      "color": "#255763"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#b0d5ce"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#023e58"
                    }
                  ]
                },
                {
                  "featureType": "transit",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#98a5be"
                    }
                  ]
                },
                {
                  "featureType": "transit",
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#1d2c4d"
                    }
                  ]
                },
                {
                  "featureType": "transit.line",
                  "elementType": "geometry.fill",
                  "stylers": [
                    {
                      "color": "#283d6a"
                    }
                  ]
                },
                {
                  "featureType": "transit.station",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#3a4762"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#0e1626"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#4e6d70"
                    }
                  ]
                }
              ]
          }
          t.map = new google.maps.Map(element, options);
          google.maps.event.addListener(t.map, 'click', function(event){
            t.mapsListener(event);
          })
      },

      // Metoda za map click listener
      mapsListener(event){
        const t = this;
        var latLng = event.latLng;
          t.marker = new google.maps.Marker( {
          position: latLng,
          map: t.map,
        });
        t.map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, clickable: false});
        t.data.lat = latLng.lat();
        t.data.long = latLng.lng();
        t.data.zoom = t.map.getZoom();
        t.marker.addListener('click', t.markerListener);
        google.maps.event.clearListeners(t.map, 'click');
      },
      // Metoda za marker click listener
      markerListener(){
        const t = this;
        t.marker.setMap(null)
        t.map.setOptions({draggable: true, zoomControl: true, scrollwheel: true});
        google.maps.event.addListener(t.map, 'click', function(event){
          t.mapsListener(event);
        })
      }
  }
};
</script>
<style scoped>
.adminmap {
  width: 100%;
  height: 550px;
  margin: 0 auto;
  background: white;
}
</style>