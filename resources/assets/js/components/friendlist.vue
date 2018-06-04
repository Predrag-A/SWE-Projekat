<template>
  <div>
    <div class="row">
      <div v-for="user in paginatedData" v-bind:key="user.id" class="col s4">
        <div class="card-image">
          <img :src="'/storage/avatars/' + user.user_img">
          <a :href="'/korisnici/' + user.id" class="blue-text text-darken-2"><small>{{user.first_name}} {{user.last_name}}</small></a>
        </div>
      </div>
    </div>
    
    <div class="row center">
      <button :disabled="pageNumber === 0" @click="prevPage" class="btn-small waves-effect waves-light">
          <i class="material-icons right">arrow_back_ios</i>
      </button>
      <button :disabled="pageNumber >= pageCount" @click="nextPage" class="btn-small waves-effect waves-light">
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
