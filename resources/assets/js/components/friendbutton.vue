<template>
  <div class="row" v-if="user_id != auth">   

    <div class="center">

      <!-- AKO NISU PRIJATELJI, STATUS 0 -->
      <button v-if="status == 0" class="btn-small waves-effect waves-light" @click="add_friend">Dodaj Za Prijatelja</button>
      
      <!-- AKO JE KORISNIKU STIGAO ZAHTEV, STATUS 2 -->
      <button v-if="status == 2" class="btn-small waves-effect waves-light" @click="accept_friend">Prihvati Zahtev</button>
      
      <!-- AKO JE KORISNIK POSLAO ZAHTEV, STATUS 3 -->
      <button v-if="status == 3" class="btn-small waves-effect waves-light" @click="delete_friend">Obriši Zahtev</button>
      
      <!-- AKO JESU PRIJATELJI, STATUS 1 -->   
      <div v-if="status == 1">        
        <button class="btn-small waves-effect waves-light" @click="delete_friend">Ukloni iz prijatelja</button>
      </div>
    </div>

  </div>
</template>

<script>
export default {

  props: {
    user_id: {
      requred: true,
    },
    auth: {
      required: true,
    },
    status_input: {
      required: true,
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
    
    this.status = this.status_input
    this.data.user_id = this.user_id;
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
                    this.status = 0;                  }
              }) 
    }

  }

}
</script>
