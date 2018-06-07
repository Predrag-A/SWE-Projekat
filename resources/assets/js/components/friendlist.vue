<template>
  <div>
    <div class="row">
      <div v-if="this.users.length == 0" class="row center blue-grey-text text-lighten-2">
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
    search:{
      type: Boolean,
      required:false,
      default:false,
    }
  },
  data: function() {
    return {
      pageNumber: 0,
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
  computed:{
    pageCount(){
      let l = this.users.length,
          s = this.size;
      return Math.floor(l/s);
    },
    paginatedData(){
      const start = this.pageNumber * this.size,
            end = start + this.size;
      return this.users
               .slice(start, end);
    }
  },
}
</script>
