<template>
  <div class="kontenjer">
        <div class="google-map" :id="mapName"> <!-- v-bind id sa propertijem mapName -->
        </div>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card-panel">        
                        <div class="row">
                            <a :href="createbtnurl" class="btn">Napravi dogadjaj</a>
                        </div>
                        <table class="highlight responsive-table" id="tabela" hidden="true">
                            <thead id="thead">
                                <tr>
                                    <th>Sport:</th>
                                    <th>Vreme:</th>
                                    <th>Lokacija:</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
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
      getCities() {
          axios.get('/web/api/cities').then(response => {
            this.cities = response.data; //vracaju se svi gradovi
            this.initMap();
            }).catch(error => {
            console.log(error);
        });
      },

      initMap() {
          var element = document.getElementById(this.mapName)
          var options = {
              zoom: 7,
              maxZoom: 7,
              minZoom: 7,
              draggable: false,
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

          if(this.cities != null)
          {
              for(var i = 0; i < this.cities.length; i++)
              {       
                    this.addMarker(map, new google.maps.LatLng(this.cities[i].lat, this.cities[i].long), this.cities[i].zoom);
              }
          }
      },
      addMarker(map, koordinate, zoom) {
          var marker = new google.maps.Marker( {
              position: koordinate,
              map: map,
              icon: 'https://i.imgur.com/YWVwzyS.png'
          });
          var self = this;
          marker.addListener('click', function() {
              map.setCenter(koordinate);
              self.smoothZoom(map, zoom, map.getZoom(), true, this);
              setTimeout(function(){marker.setVisible(false);},2000); //da se marker sakrije za 2000ms (dok se zumira ka mapi)
          });
      },
      smoothZoom(map, level, cnt, mode, marker) {
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
                    setTimeout(function(){map.setZoom(cnt);}, 500);
                }
            }
        }
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