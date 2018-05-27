<template>
  <div>
    <!-- Dodavanje komentara -->
    <div class="row">
      <h2>Komentari</h2>
      <textarea v-model="data.content"
      placeholder="Dodaj komentar">

      </textarea>
      <div>
        <button @click="saveComment">Save</button>
        <button @click="resetComment">Cancel</button>
      </div>
    </div>

    <div class="divider"></div>

    <!-- Prikaz komentara -->
    <div>
        <comment v-for="comment in comments"
                    :key="comment.id"
                    :comment="comment"
                    :user="user"
                    :eventid="eventid"
                    @comment-updated="updateComment($event)"
                    @comment-deleted="deleteComment($event)">
        </comment>
    </div>
  </div>
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