<template>
  <div class="eventmap" :id="mapName"></div>
</template>
<script>
export default {
  name: 'eventmap',
  props: {
    lat:{
      required: true,
      type: Number
    },
    long:{
      required: true,
      type: Number
    },
    name: {
        required: true,
    }
  },
  data: function () {
    return {
      coords: new google.maps.LatLng(this.lat,this.long),       
      mapName: 'event' + this.name + '-map', //za id mape
    }
  },
  mounted: function () {
    var element = document.getElementById(this.mapName)
    var options = {
        zoom: 17,
        maxZoom: 17,
        minZoom: 14,
        draggable: false,
        center: this.coords
    }
    var map = new google.maps.Map(element, options);

  }
};
</script>
<style scoped>
.eventmap {
  width: 100%;
  height: 400px;
  margin: 0 auto;
  background: gray;
}
</style>