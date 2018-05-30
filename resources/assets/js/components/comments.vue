<template>
  <ul class="collection with-header">
    <!-- Dodavanje komentara -->
    <li class="collection-header">
      <div class="input-field">
        <textarea v-model="data.content" id="textarea_add" class="materialize-textarea">          
        </textarea>
        <label for="textarea_add">Dodaj komentar</label>
      </div>
      <div>
        <a href="JavaScript:void(0)" @click="saveComment"><i class="material-icons green-text">add</i></a>
        <a href="JavaScript:void(0)" @click="resetComment" class="secondary-content"><i class="material-icons red-text">clear</i></a>
      </div>
    </li>

    <!-- Prikaz komentara -->    
    <comment v-for="comment in comments"
                :key="comment.id"
                :comment="comment"
                :user="user"
                :eventid="eventid"
                @comment-updated="updateComment($event)"
                @comment-deleted="deleteComment($event)">
    </comment>
    
  </ul>
</template>

<script>
    import comment from './CommentItem'
    export default {
      props: {

        // Prop za korisnika
        user: {
            required: true,
            type: Object,
        },

        // Prop za id eventa zbog cuvanja u bazu
        eventid: {
          required: true,
          type: Number,
        }
      },

      // Dodavanje komponente za pojedinacne komentare
      components: {
        comment
      },
      data: function() {
        return {
          data:{
            content: '',
            eventid: -1,
          },
          comments: []
        }
      },      
      created() {

          // Vraca komentare nakon kreiranja komponente
          this.fetchComments();
          this.data.eventid = this.eventid;
      },
      methods: {

          // Metoda za promenu komenta, prima $event
          updateComment($e) {

              const t = this;
              
              axios.put(`/komentari/${$e.id}`, $e).then(({data}) => {
                  t.comments[t.commentIndex($e.id)].content = data.content;
              })
          },

          // Metoda za brisanje komentara, prima $event
          deleteComment($e) {

              const t = this;

              axios.delete(`/komentari/${$e.id}`, $e)
                  .then(() => {
                      t.comments.splice(t.commentIndex($e.id), 1);
                  })
          },

          // Metoda za snimanje komentare
          saveComment() {
              const t = this;
              axios.post('/komentari', t.data).then(({data}) => {
                  t.comments.unshift(data);
                  t.resetComment();
                  M.toast({html:'Komentar kreiran', classes:'green lighten-3'});
              })             
          },

          // Resetuje sadrzaj u textarea
          resetComment(){
            this.data.content = '';
          },

          // Vraca komentare iz baze podataka AJAX zahtevom
          fetchComments() {
              const t = this;
              axios.get('/komentari/' + this.eventid)
                  .then(({data}) => {
                      t.comments = data;
                  })
          },

          // Vraca indeks komentara unutar niza komentara
          commentIndex(commentId){
              return this.comments.findIndex((element) => {
                return element.id === commentId
              });
          },
      }
    }
</script>