<template>
  <div>

    <!-- ZAHTEVI ZA PRIJATELJE -->
    <div v-if="this.requests != undefined && this.requests.length > 0" class="row">
      
        <h6 class="blue-grey-text text-lighten-2">Zahtevi:</h6>
        <ul v-for="user in requestData" v-bind:key="user.id" class="collection">        
            
            <li class="collection-item avatar">

              <!-- SLIKA -->
              <img class="circle" :src="'/storage/avatars/' + user.user_img"> 

              <!-- PODACI -->
              <a :href="'/korisnici/' + user.id" class="blue-text text-darken-2 title"><b>{{user.first_name}} {{user.last_name}}</b></a>
              
              <!-- DUGME -->          
              <span class="secondary-content hide-on-small-only">
                <friendbutton :userid="user.id" :statusinput="2"></friendbutton>
              </span>

            </li>
        </ul>

        <div class="row center">
          <div class="divider"></div>
        </div>
        <div class="row">
          <h6 class="blue-grey-text text-lighten-2 col s12">Prijatelji:</h6>
        </div>
    </div>

    <!-- LISTA PRIJATELJA -->
    <div class="row">      
      <div v-if="this.userData.length == 0" class="row center blue-grey-text text-lighten-2">
        <h4>Lista prijatelja je prazna</h4>
      </div>
      <div v-for="user in paginatedData" v-bind:key="user.id" class="col s12 m6">
        <div class="row">
          <!-- SLIKA -->
          <img class="circle left" style="width:50px" :src="'/storage/avatars/' + user.user_img"> 

          <!-- PODACI -->  
          <p>
            <a :href="'/korisnici/' + user.id" class="blue-text text-darken-2 title"><b>{{user.first_name}} {{user.last_name}}</b></a>
          </p>                   
        </div>
      </div>
    </div>
    
    <div class="row center">
      <button :disabled="pageNumber === 0" @click="prevPage" class="btn-flat waves-effect waves-teal">
          <i class="material-icons right">arrow_back_ios</i>
      </button>
      {{this.pageNumber + 1}}
      <button :disabled="pageNumber >= pageCount" @click="nextPage" class="btn-flat waves-effect waves-teal">
          <i class="material-icons right">arrow_forward_ios</i>
      </button>
    </div>    
  </div>
</template>

<script>
import friendbutton from './friendbutton'
export default {
  props: {
    users: {
      type: Array,
      required: true,
    },
    size:{
      type: Number,
      required:false,
      default:10,
    },
    requests: {
      type: Array,
      required: false,
    }
  },
  components:{
    friendbutton,
  },
  data: function() {
    return {
      pageNumber: 0,
      requestData: [],
      userData: [],
    }
  },
  methods: {
    nextPage(){
      this.pageNumber++;
    },
    prevPage(){
      this.pageNumber--;
    }
  },
  created(){
    this.requestData = this.requests;
    this.userData = this.users;
  },
  computed:{
    pageCount(){
      let l = this.userData.length,
          s = this.size;
      return Math.floor(l/s);
    },
    paginatedData(){
      const start = this.pageNumber * this.size,
            end = start + this.size;
      return this.userData
               .slice(start, end);
    }
  },
}
</script>
