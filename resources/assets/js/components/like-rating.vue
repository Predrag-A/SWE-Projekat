<template>  
  <div class="row">
    <span class="green-text">{{this.positive}}</span>
    <!-- DEFAULTNI -->
    <span v-if="status == 'default'">      
      <a href="JavaScript:void(0)" @click="like"><i class="material-icons grey-text text-lighten-3">thumb_up</i></a>
      <a href="JavaScript:void(0)" @click="dislike"><i class="material-icons grey-text text-lighten-3">thumb_down</i></a>
    </span>

    <!-- POZITIVAN RATING -->
    <span v-if="status == 'like'">
      <a href="JavaScript:void(0)" @click="cancel"><i class="material-icons green-text">thumb_up</i></a>
      <a href="JavaScript:void(0)" @click="dislike"><i class="material-icons grey-text text-lighten-3">thumb_down</i></a>
    </span>

    <!-- NEGATIVAN RATING -->
    <span v-if="status == 'dislike'">
      <a href="JavaScript:void(0)" @click="like"><i class="material-icons grey-text text-lighten-3">thumb_up</i></a>
      <a href="JavaScript:void(0)" @click="cancel"><i class="material-icons red-text">thumb_down</i></a>
    </span>

    <!-- READ ONLY -->
    <span v-if="status == 'readonly'">
      <span><i class="material-icons green-text">thumb_up</i></span>
      <span><i class="material-icons red-text">thumb_down</i></span>
    </span>  
    <span class="red-text">{{this.negative}}</span>
  </div>
</template>
<script>
export default {
  props: {
    user_id: {
      required: true,
    },
    negative_ratings:{
      type: Number,
      required: true
    },
    positive_ratings:{
      type: Number,
      required: true
    },
    readonly: {
      type: Boolean,
      default: false
    }
  },
  data: function() {
    return {
      status: "default",
      data:{
        gradeduser_id: -1,
      },
      positive: 0,
      negative: 0,
    }
  },
  created(){
    if(this.readonly == true){
      this.status = "readonly"
    }
    else{       
      axios.get('/api/osoba_status/' + this.user_id)
                    .then(({data}) => {
                        this.status = data.status;                       
                    })                  
    }    
    this.data.gradeduser_id = this.user_id 
    this.positive = this.positive_ratings
    this.negative = this.negative_ratings  
  },
  methods:{

    like(){
      const t = this
      axios.post('/api/osoba_like', t.data).then(({data}) => {
                  if(data == 1){
                    t.positive++;
                    if(t.status == "dislike"){
                      t.negative--;
                    }
                    t.status = "like"
                  }
              })       
    },
    dislike(){
      const t = this
      axios.post('/api/osoba_dislike', t.data).then(({data}) => {
                  if(data == 1){
                    t.negative++;
                    if(t.status == "like"){
                      t.positive--;
                    }
                    this.status = "dislike"
                  }
              }) 
    },
    cancel(){
      const t = this
      axios.post('/api/osoba_cancel', t.data).then(({data}) => {
                  if(data == 1){
                    if(t.status == "like"){
                      t.positive--;
                    }
                    if(t.status == "dislike"){
                      t.negative--;
                    }                    
                    this.status = "default"
                  }
              }) 
    }
  }   
}
</script>