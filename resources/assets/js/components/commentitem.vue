<template>
    <div>
      
      <!-- Defaultni prikaz -->
      <div v-show="state === 'default'">
          <div>
              <p>{{comment.content}}</p>
              <button v-if="editable" @click="state = 'editing'">Izmeni</button>         
              <button v-if="editable" @click="deleteComment">Obriši</button>
          </div>
          <div>
              <p>{{comment.user.first_name}} {{comment.user.last_name}} 
                <span>&bull;</span> <small>{{comment.created_at}}</small></p>
          </div>
      </div>

      <!-- Prikaz kada se komentar edituje -->
      <div v-show="state === 'editing'">
          <div>
              <h3>Update Comment</h3>
          </div>
          <textarea v-model="data.content"
                    placeholder="Update comment"
                    class="border">
          </textarea>
          <div>
              <button @click="saveEdit">Snimi</button>
              <button @click="resetEdit">Poništi</button>     
          </div>
      </div>

    </div>
</template>
<script>
    export default {
      
        props: {
            // Prop za komentar
            comment: {
                required: true,
                type: Object,
            },
            // Prop za korisnika
            user: {
                required: true,
                type: Object,
            },
            // Prop za event
            eventid: {
              required: true,
              type: Number
            }
        },
        data: function() {
            return {
              // Status koji govori da li se komentar menja
              state: 'default',
              data: {
                content: this.comment.content,
              }
          }
        },
        computed: {
            // Provera da li moze da se izmeni komentar
            editable() {            
                return this.user.id === this.comment.user_id;
            },
            
        },
        // Funkcije
        methods: {
          
          // Resetovanje forme za edit
          resetEdit() {
              this.state = 'default';
              this.data.content = this.comment.content;
          },
          // Snimanje komentara
          saveEdit(){
              // Emituje se event koji sadrzi id i sadrzaj komentara
              this.state = 'default';
              this.$emit('comment-updated', {
                  'id': this.comment.id,
                  'content': this.data.content,
              });
          },
          // Brisanje, radi isto kao saveEdit
          deleteComment() {
              this.$emit('comment-deleted', {
                  'id': this.comment.id,
              });
          }          
        }
    }
</script>