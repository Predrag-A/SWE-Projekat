<template>
  <li v-if="this.visible">

    <!-- HEADER AKO NIJE PROCITANA -->
    <div class="collapsible-header">      
      <i class="material-icons">expand_more</i><span><b>{{this.request.title}}</b></span>
    </div>

    <!-- TELO -->
    <div class="collapsible-body grey lighten-4">

      <div class="row">
        <b><a :href="'/korisnici/' + this.user.id">{{this.user.first_name}} {{this.user.last_name}}</a></b> | {{this.user.email}}
        <span class="right">{{this.customTime()}}</span>        
      </div>
      
      <div class="divider row"></div>

      <div class="row" v-html="this.request.text"></div>       
      <div class="divider row"></div>     
      <div class="row">
        <div class="input-field">
          <textarea v-model="data.answer" id="textarea_answer" class="materialize-textarea">         
          </textarea>
          <label for="textarea_answer">Dodaj odgovor</label>
        </div>        
      </div>
      <div class="row center">
        <a href="JavaScript:void(0)" @click="sendAnswer" class="btn">Pošalji odgovor</a>
      </div>
    </div>

  </li>
</template>

<script>
export default {
  props: {
    request: {
      type: Object,
      required: true,
    },   
    user: {
      type:Object,
      required: true      
    }, 
  },
  data: function() {
    return {
      visible: true,
      data:{
        answer: "",
        request_id: "",
        user_id: "",
        request_title: "",
        request_body: "",
      },
    }
  },
  created(){
    this.data.user_id = this.user.id
    this.data.request_id = this.request.id
    this.data.request_title = this.request.title
    this.data.request_body = this.request.text
  },
  methods: {

    sendAnswer(){      
      const t = this
      console.log(t.data.user_id + " " + t.data.request_id  + " " + t.data.request_title + " " + t.data.request_body +" " +t.data.answer);
      axios.post('/api/request_answer', t.data).then(({data}) => {
                if(data == 1){       
                  this.visible = false
                  M.toast({html:'Poslat odgovor na zahtev', classes:'green lighten-3'});
                }
                else{
                  this.visible = false
                  M.toast({html:'Zahtev je već izvršen', classes:'red lighten-3'});
                }
            }) 
    },
    customTime() {
        var temp = this.request.created_at.split(" ");
        var pom = temp[0].split("-").reverse(); //pom[1]
        var meseci = ["Januar", "Februar", "Mart", "April", "Maj", "Jun", "Jul", "Avgust", "Septembar", "Oktobar", "Novembar", "Decembar"];
        var datum = pom[0] + ". " + meseci[pom[1]-1] + " " + pom[2];
        var pom = temp[1].split(":");
        datum = datum + ", " + pom[0] + ":" + pom[1];
        return datum;
      },
  }
}
</script>
