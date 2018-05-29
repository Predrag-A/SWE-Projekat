<template>
  <div class="row">    
    
    <div class="center" v-if="loading">
      <div class="preloader-wrapper active">
        <div class="spinner-layer">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="center" v-if="!loading && user_id != auth">

      <!-- AKO NISU PRIJATELJI -->
      <button v-if="status == 0" class="btn-small waves-effect waves-light" @click="add_friend">Dodaj Prijatelja</button>
      
      <!-- AKO JE KORISNIKU STIGAO ZAHTEV -->
      <button v-if="status == 'pending'" class="btn-small waves-effect waves-light" @click="accept_friend">Prihvati Zahtev</button>
      
      <!-- AKO JE KORISNIK POSLAO ZAHTEV -->
      <button v-if="status == 'waiting'" class="btn-small waves-effect waves-light" @click="delete_friend">Obriši Zahtev</button>
      
      <!-- AKO JESU PRIJATELJI -->   
      <div v-if="status == 'friends'">
        <div class="row">
          Prijatelji <i class="material-icons tiny">check</i>
        </div>
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
    }
  },
  data: function() {
    return {
      status: '',
      // Koristi se ako je server spor pa da se prikaze loading dok se ne ucitaju podaci
      loading: true,
      data:{
        user_id: -1,
      },
    }
  },   
  mounted(){
    
    axios.get('/api/proveri_prijateljstvo/' + this.user_id)
                  .then(({data}) => {
                      this.status = data.status;
                      this.loading = false;
                      this.data.user_id = this.user_id;
                  })
  },

  methods: {
    add_friend() {

      const t = this;      
      axios.post('/api/dodaj_prijatelja', t.data).then(({data}) => {
                  if(data == 1){
                    this.status = 'waiting';
                  }
              }) 
    },

    accept_friend() {

      const t = this;      
      axios.post('/api/prihvati_prijatelja', t.data).then(({data}) => {
                  if(data == 1){
                    this.status = 'friends';
                  }
              }) 
    },

    delete_friend() {
      const t = this;      
      axios.post('/api/obrisi_prijatelja', t.data).then(({data}) => {
                  if(data == 1){                    
                    this.status = '0';
                  }
              }) 
    }

  }

}
</script>
