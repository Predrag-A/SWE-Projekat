<template>
  <div class="kontenjer">
        <div class="google-map" :id="mapName"> <!-- v-bind id sa propertijem mapName -->
        </div>
        <div v-if="userstatus === 'Suspendovan'" class="fixed-action-btn">
          <a class="btn-floating modal-trigger btn-large tooltipped disabled" data-position="left" data-tooltip="Vaš nalog je suspendovan" href="#eventCreateModal"><i class='material-icons left'>add</i></a>
        </div>
        <div v-else class="fixed-action-btn">
          <a class="btn-floating modal-trigger btn-large tooltipped" data-position="left" data-tooltip="Novi događaj" href="#eventCreateModal"><i class='material-icons left'>add</i></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">    
                        <div class="row" v-show="toggle" id="kartice">
                          <div class="row center blue-grey-text text-lighten-2">
                            <h3 id="naslov">{{trenutniTeren}}</h3>
                          </div>
                          <div class="divider"> </div>
                          <div v-for="(event,index) in pomNiz" :key="index" class="col s6 m4">
                            <div class="card medium col-content z-depth-3" :style="'border: 1px solid ' + event.sport.color">
                              <div class="card-image">
                                <img :src="'img/'+ event.sport.image">
                                <span class="card-title">{{customTime(event.dogadjaj.time)}}</span>
                              </div>
                              <div class="card-content">                                
                                <h6 :class="event.sport.color + '-text'">Pridruženi korisnici:</h6>
                                <span>{{attends[event.dogadjaj.id]}}</span>
                              </div>
                              <div class="card-action center">
                                <a :href="event.url" :class="'card-title ' + event.sport.color + '-text'">Detalji</a>
                              </div>
                            </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {
  name: 'google-map',
  props: { //propovi se prosledjuju u komponentu kao stringovi
      name: {
          required: true
      },
      createbtnurl: {
          required: true
      },
      userstatus: {
        required: true
      }
  },
  data () { 
    return {
        defaultCoord: new google.maps.LatLng(44.2792544,20.7451155),
        mapName: this.name + '-map', //za id mape
        cities: [],
        sports: [],
        cityCourts: [],
        cityMarkers: [],
        courtMarkers: [],
        cityEvents: [],
        toggle: false,
        pomNiz: [],
        attends: [],
        trenutniTeren: {}
    }
  },
  methods: {
    //axios je slicno ajaxu i ovo sa get se zove controler sa ovom rutom da bi se vratili podaci
    //prvo se navodi ruta koja u sebi ima koji kontroler je zaduzen i koja funkcija je zaduzena
    //kada se navede cities, users, itd...
      getCities() {
          axios.get('/web/api/cities').then(response => {
            this.cities = response.data; //vracaju se svi gradovi
            this.initMap();
            }).catch(error => {
            console.log(error);
        });
      },

      getCourts(map, cityid) {
          axios.get('/web/api/citycourts/'+ cityid).then(response => {
            this.cityCourts = response.data; //vracaju se svi gradovi
            if(this.cityCourts.length != 0)
            {
                for(var i = 0; i < this.cityCourts.length; i++)
                {
                    this.addCourtMarker(map, new google.maps.LatLng(this.cityCourts[i].lat, this.cityCourts[i].long), this.cityCourts[i].location, i+1);
                    this.getEvents(i+1);
                }
            }
            }).catch(error => {
            console.log(error);
        });
      },

      getEvents(courtid) {
          var self = this;
          axios.get('/web/api/courtEvents/' + courtid).then(response => {
              response.data.forEach(function(event) {
                  self.cityEvents.push(event);
                  self.getEventAttends(event.id);
              })
          }).catch(error => {
              console.log(error);
          });
      },

      getSports() {
          axios.get('/web/api/sports').then(response => {
              this.sports = response.data;
          }).catch(error => {
              console.log(error);
          });
      },

      getEventAttends(eventid) {        
          axios.get('web/api/eventAttend/' + eventid).then(response => {
              this.attends[eventid] = response.data;              
          }).catch(error => {
              console.log(error);
          });
      },

      addRemoveBackButton(map) {
        var self = this;
        var backButton = document.createElement('a');
        backButton.className = "waves-effect waves-light btn";
        backButton.id = "backButton";
        backButton.innerHTML = "<i class='material-icons left'>arrow_back</i>Nazad";
        backButton.index = 1;
        backButton.addEventListener('click', function() {
            self.smoothZoom(map, 7, 13, false);
            map.setCenter(self.defaultCoord);
            self.cityMarkers.forEach(city => {
              city.setVisible(true);
            });
            self.courtMarkers.forEach(court => {
              court.setVisible(false);
            });
            self.courtMarkers = [];
            self.cityEvents = [];
            self.pomNiz = [];
            self.toggle = false;
            map.controls[google.maps.ControlPosition.LEFT_BOTTOM].clear(); 
          });
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(backButton);
      },

      initMap() {
          var element = document.getElementById(this.mapName)
          var options = {
              zoom: 7,
              maxZoom: 7,
              minZoom: 7,
              draggable: false,
              mapTypeControl: false,
              fullscreenControl: false,
              //gestureHandling: 'greedy', da scroll uvek ublizava
              scrollwheel: false,
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
          var map = new google.maps.Map(element, options);

          if(this.cities.length != 0)
          {
                for(var i = 0; i < this.cities.length; i++)
                {
                    this.addCityMarker(map, new google.maps.LatLng(this.cities[i].lat, this.cities[i].long), this.cities[i].zoom, i+1);
                }
          }
          //var newEvent = document.createElement('a');
          //if(this.userstatus == "Suspendovan"){
          //  newEvent.className = "btn disabled";
          //}
          //else{            
          //  newEvent.className = "btn modal-trigger green accent-3";
          //  newEvent.href = "#eventCreateModal";
          //}
          //newEvent.innerHTML = "<i class='material-icons left'>add</i>Napravi dogadjaj";
          //newEvent.index = 1;
          //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(newEvent);
      },

      addCityMarker(map, koordinate, zoom, i) {
          var marker = new google.maps.Marker( {
              position: koordinate,
              map: map,
              animation: google.maps.Animation.DROP,
              //icon: 'https://cdn3.iconfinder.com/data/icons/iconic-1/32/map_pin_alt-48.png',
              content: i
          });
          this.cityMarkers.push(marker);
          var self = this;
          marker.addListener('click', function() {
              map.setCenter(koordinate);
              self.smoothZoom(map, zoom, map.getZoom(), true);
              self.addRemoveBackButton(map);
              setTimeout(function(){marker.setVisible(false); self.getCourts(map,marker.content);},1800); //da se marker sakrije za 2000ms (dok se zumira ka mapi)
          });
      },

      addCourtMarker(map, koordinate, lokacija, i){
          var marker = new google.maps.Marker( {
              position: koordinate,
              map: map,
              icon: 'https://png.icons8.com/ios/48/d35400/stadium-filled.png',
              content: i, //id terena
              url: "#naslov"
          });

          //marker.setIcon(this.setIconForCourt(this.mostPopularSport(i)));

          this.courtMarkers.push(marker);
          var infoWindow = new google.maps.InfoWindow({
              content: lokacija
          });
          var self = this;
          marker.addListener('click', function() {
              infoWindow.open(map, marker);
              setTimeout(function () { infoWindow.close(); }, 3500);
              var elem = $(marker.url);
              $('html, body').animate({
                scrollTop: elem.offset().top
              }, 1000 );
              self.toggle = true;
              self.pomNiz = [];
              self.trenutniTeren = lokacija.split(',')[0];
              self.cityEvents.forEach(function(event) {
                  if(event.court_id == i){
                      self.pomNiz.push({
                        dogadjaj: event,
                        sport: self.sports[event.sport_id-1],
                        url: self.createbtnurl + "/" + event.id,
                        location: lokacija
                      });
                }
              })
          });
      },

      setIconForCourt(sport) {
        switch(sport) {
            case "Fudbal":
                return 'https://png.icons8.com/android/48/000000/football.png';
                break;
            case "Košarka":
                return 'https://png.icons8.com/ios/48/d35400/basketball-2-filled.png';
                break; 
            case "Rukomet":
                return 'https://png.icons8.com/ios/48/d35400/basketball-2-filled.png';
                break;
            case "Tenis":
                return 'https://png.icons8.com/ios/48/27ae60/tennis-2-filled.png';
                break;
            case "Futsal":
                return 'https://png.icons8.com/ios/48/bdc3c7/football-filled.png';
                break;
            case "Odbojka":
                return 'https://png.icons8.com/ios/48/2980b9/volleyball-2-filled.png';
                break;
            default:
                return 'https://png.icons8.com/color/48/000000/olympic-rings.png';
        }
      },

      /*mostPopularSport(courtid) {
        var eventsOnCourt = [];
        var self = this;
        //console.log(this.cityEvents);
        for(var i=0; i < this.cityEvents.size; i++) //NECE NI FOR
        {
          console.log("upao");
        }
        console.log(this.cityEvents);
        this.cityEvents.forEach(function(event) {  //NECE FOREACH A cityEvents ima elemente
          console.log('uslov', event.court_id == courtid);
          if(event.court_id == courtid) {
            eventsOnCourt.push(event.sport_id);
             
          }
        })
        var popularSport = 0;
        var times = 0;
        self.sports.forEach(function(sport) {
          if(eventsOnCourt.filter(x => x===sport.id).length > times)
          {
            times = eventsOnCourt.filter(x => x===sport.id).length;
            popularSport = sport.name;
          }
        })
        return popularSport;
      },*/

      customTime(time) {
        var temp = time.split(" ");
        var pom = temp[0].split("-").reverse(); //pom[1]
        var meseci = ["Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"];
        var datum = pom[0] + ". " + meseci[pom[1]-1] + " " + pom[2];
        var pom = temp[1].split(":");
        datum = datum + ", " + pom[0] + ":" + pom[1];
        return datum;
      },

      calculateToStart(time, startStop){
        var myVar = {};
        if(startStop){
          myVar = setInterval(myTimer,1000);

          function myTimer(){
            var d = new Date();
            document.getElementById('preostalo').innerHTML = d.toLocaleTimeString();
          }
        }
        else {
          clearInterval(myVar);
        }
      },

      smoothZoom(map, level, cnt, mode) {
          var self = this;
          if(mode)
          {
            if (cnt >= level) {
                return;
            }
            else
            {
                if((map.minZoom + 2) <= cnt)
                {
                    var z = google.maps.event.addListener(map, 'zoom_changed', function(event)
                    {
                        google.maps.event.removeListener(z);
                        map.maxZoom = level+3;
                        map.minZoom = cnt;
                        map.draggable = true;
                        self.smoothZoom(map, level, cnt + 1, true);
                    });
                    setTimeout(function(){map.setZoom(cnt);}, 700);
                }
                else
                {
                    map.setZoom(cnt);
                    self.smoothZoom(map, level, cnt + 1, true);
                }
            }
        }
        else 
        {
            if (cnt < level) {
                return;
            }
            else
            {
                var z = google.maps.event.addListener(map, 'zoom_changed', function(event)
                {
                    google.maps.event.removeListener(z);
                    map.maxZoom = 7;
                    map.minZoom = 7;
                    map.draggable = false;
                    self.smoothZoom(map, level, cnt - 1, false);
                });
                if(map.maxZoom - 2 <= cnt)
                {
                    map.setZoom(cnt);
                }
                else
                {
                    setTimeout(function(){map.setZoom(cnt);}, 600);
                }
            }
        }
      }
  },

  //Lifehook created
  created() {
    this.getCities();
    this.getSports();
  } 
};
</script>

<style scoped>
.google-map {
  width: 100%;
  height: 573px;
  margin: 0 auto;
  background: white;
};
</style>