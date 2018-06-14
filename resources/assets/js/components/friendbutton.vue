<template>
  <div class="row">   

    <div class="center">

      <!-- AKO NISU PRIJATELJI, STATUS 0 -->
      <div v-show="status == 0">
        <button class="btn-small waves-effect waves-light green tooltipped" @click="add_friend" data-position="top" data-tooltip="Dodaj za prijatelja"><i class="fas fa-user-plus"></i></button>
      </div>
      
      <!-- AKO JESU PRIJATELJI, STATUS 1 -->   
      <div v-show="status == 1">        
        <button class="btn-small waves-effect waves-light red tooltipped" @click="delete_friend" data-position="bottom" data-tooltip="Izbaci iz prijatelja"><i class="fas fa-user-minus"></i></button>
      </div>

      <!-- AKO JE KORISNIKU STIGAO ZAHTEV, STATUS 2 -->
      <div v-show="status == 2">
        <button class="btn-small waves-effect waves-light tooltipped" @click="accept_friend" data-position="top" data-tooltip="Prihvati zahtev"><i class="fas fa-user-check"></i></button> 
        &nbsp;
        <button v-if="cancelvisible" class="btn-small waves-effect waves-light orange tooltipped" @click="delete_friend" data-position="bottom" data-tooltip="Otkaži zahtev"><i class="fas fa-user-times"></i></button>   
      </div>  
      
      <!-- AKO JE KORISNIK POSLAO ZAHTEV, STATUS 3 -->
      <div v-show="status == 3">
        <button class="btn-small waves-effect waves-light orange tooltipped" @click="delete_friend" data-position="bottom" data-tooltip="Otkaži zahtev"><i class="fas fa-user-times"></i></button>
      </div>
      
      
    </div>

  </div>
</template>

<script>
export default {

  props: {
    userid: {
      requred: false,
    },    
    statusinput: {
      required: false,
    },
    cancelvisible: {
      type: Boolean,
      required:false, 
      default: true,     
    }
  },
  data: function() {
    return {
      status: '',      
      data:{
        user_id: -1,
      },
    }
  },   
  mounted(){
    
    this.status = this.statusinput
    this.data.user_id = this.userid;
  },

  methods: {
    add_friend() {

      const t = this;      
      axios.post('/api/dodaj_prijatelja', t.data).then(({data}) => {
                  if(data == 1){
                    this.status = 3;
                  }
              }) 
    },

    accept_friend() {

      const t = this;      
      axios.post('/api/prihvati_prijatelja', t.data).then(({data}) => {
                  if(data == 1){
                    this.status = 1;
                  }
              }) 
    },

    delete_friend() {
      const t = this;      
      axios.post('/api/obrisi_prijatelja', t.data).then(({data}) => {
                  if(data == 1){                    
                    this.status = 0;   
                  }
              }) 
    }

  }

}
</script>
