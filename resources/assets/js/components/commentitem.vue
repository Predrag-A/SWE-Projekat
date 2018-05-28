<template>
    <li class="collection-item">
      
        <!-- Defaultni prikaz -->
        <div v-show="state === 'default'">
            
            {{comment.content}}<br>
            <small>{{comment.user.first_name}} {{comment.user.last_name}}<span>&bull;</span> {{comment.updated_at}}</small>
            
            <a href="JavaScript:void(0)" v-if="editable" @click="state = 'editing'" class="secondary-content"><i class="material-icons">edit</i></a>
        </div>

        <!-- Prikaz kada se komentar edituje -->
        <div v-show="state === 'editing'">
            <div class="input-field">     
                 
                <textarea v-model="data.content"                        
                        class="materialize-textarea"
                        id ="textarea_edit">
                </textarea>                 
                <label for="textarea_edit" class="active">Izmeni komentar</label>             
            </div>
            <div>
                <button @click="saveEdit" class = "btn waves-light">Snimi</button>
                <button @click="resetEdit" class = "btn white blue-text text-darken-4 aves-light">Poništi</button>     
                <a href="JavaScript:void(0)" @click="deleteComment" class="secondary-content red-text">Obriši</a>
            </div>
        </div>

    </li>
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