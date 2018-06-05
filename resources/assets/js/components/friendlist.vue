<template>
  <div>
    <div class="row">
      <div v-for="user in paginatedData" v-bind:key="user.id" class="col s4 center">
        <div class="card-image">          
          <a :href="'/korisnici/' + user.id"><img :src="'/storage/avatars/' + user.user_img"></a>
          <small class="blue-text text-darken-2">{{user.first_name}}</small>
        </div>
      </div>
    </div>
    
    <div class="row center">
      <button :disabled="pageNumber === 0" @click="prevPage" class="btn-flat waves-effect waves-teal">
          <i class="material-icons right">arrow_back_ios</i>
      </button>
      &nbsp;
      {{this.pageNumber + 1}}
      &nbsp;
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
      required: true
    },
    size:{
      type: Number,
      required:false,
      default:9,
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
