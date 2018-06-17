<template>
  <div>
       <div class="input-field col s12 l4">
        <i class="material-icons prefix">location_city</i>
        <select v-model="city_id" @change="populateCourts" name="city" id="city">
          <option value="" disabled selected>Izaberite grad</option>
          <option v-for="city in cities" :key="city.id" :value="city.id">{{city.name}}</option>
        </select>
        <label>Grad</label>
      </div>   
  
      <div class="input-field col s12 l4">
        <i class="material-icons prefix">place</i>
        <select v-model="court_id" @change="populateSports" name="court" id="court">
          <option  value="" disabled selected>Izaberite teren</option>       
          <option v-for="court in courts" :key="court.id" :value="court.id">{{court.location}}</option>
        </select>
        <label>Teren</label>
      </div>  
  
      <div class="input-field col s12 l4">
      <i class="fas fa-futbol prefix fa-sm"></i><select name="sport" id="sport">
          <option value="" disabled selected>Izaberite sport</option> 
          <option v-for="sport in sports" :key="sport.id" :value="sport.id">{{sport.name}}</option>
        </select>
        <label>Sport</label>
      </div>  
  </div>
</template>

<script>
export default {
  props:{
    cities:{
      type: Array,
      required: true
    }    
  },
  data: function() {
    return {
      city_id: 0,
      court_id: 0,
      courts: [],
      sports: [],
      loading: false,
    }
  },  
   watch:{
    loading: function(val){
      if(val == false){
        setTimeout(function(){      
            M.FormSelect.init(document.querySelectorAll('select'), '');        
        }, 200);     
      }
    },
  },
  methods:{
    populateCourts(){
      const t = this;
      
      t.court_id = 0;
      t.courts = [];
      t.sports = [];
      t.getCourts();

    },
    populateSports(){

      const t = this;

      t.getSports();

    },
    getCourts(){
      const t = this;
      t.loading = true;
      axios.get('/api/tereni/' + t.city_id)
          .then(({data}) => {
              t.courts = data;
              t.loading = false;              
          })
    },
    getSports(){
      const t = this;
      t.loading = true;
      axios.get('/api/sportovi/' + t.court_id)
          .then(({data}) => {
              t.sports = data;
              t.loading = false;
          })
    },

  }

}

</script>
