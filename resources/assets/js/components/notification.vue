<template>
  <li v-if="this.visible">

    <!-- HEADER AKO NIJE PROCITANA -->
    <div v-if="!this.status" class="collapsible-header" @click="changeStatus" style="display:block">      
      <i class="material-icons">expand_more</i><span><b>{{this.notification.title}}</b></span>
      <span class="right">{{this.customTime()}}</span>
    </div>

    <!-- HEADER AKO JE PROCITANA -->
    <div v-else class="collapsible-header grey lighten-3" style="display:block"> 
      <i class="material-icons">expand_more</i>{{this.notification.title}}    
      <span class="right">{{this.customTime()}}</span>  
    </div>

    <!-- TELO -->
    <div class="collapsible-body grey lighten-4">

      <div class="row">
        <b><a :href="'/korisnici/' + this.sender.id">{{this.sender.first_name}} {{this.sender.last_name}}</a></b> | {{this.sender.email}}
        <a href="JavaScript:void(0)" @click="deleteNotification" class="secondary-content red-text right">Obriši</a>
      </div>
      
      <div class="divider row"></div>

      <div class="row" v-html="this.notification.body"></div>

    </div>

  </li>
</template>

<script>
export default {
  props: {
    notification: {
      type: Object,
      required: true,
    },
    sender: {
      type:Object,
      required: true      
    },
  },
  data: function() {
    return {
      status: 0,
      visible: true,
      data:{
        notification_id: "",
      },
    }
  },
  created(){
    this.status = this.notification.status
    this.data.notification_id = this.notification.id
  },
  methods: {
    changeStatus(){
      const t = this
      axios.post('/api/notifikacija_read', t.data).then(({data}) => {
                if(data == 1){                   
                  this.status = 1
                }
            })           
    },
    deleteNotification(){      
      const t = this
      axios.post('/api/notifikacija_delete', t.data).then(({data}) => {
                if(data == 1){       
                  this.visible = false
                  M.toast({html:'Notifikacija obrisana', classes:'red lighten-3'});
                }
            }) 
    },
    customTime() {
        var temp = this.notification.created_at.split(" ");
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
