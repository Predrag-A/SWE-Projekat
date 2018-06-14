<template>
    <li class="collection-item">    

        <!-- Kada komentar nije sakriven -->
        <div v-if="seen">
            <a href="JavaScript:void(0)" v-on:click="seen = !seen"><i class="material-icons">expand_less</i></a>

            <!-- Defaultni prikaz -->
            <div v-show="state === 'default'" v-if="seen">            
                
                {{comment.content}}<br>
                <small><a v-bind:href="'/korisnici/' + comment.user.id" class="blue-text text-darken-2">{{comment.user.first_name}} {{comment.user.last_name}}</a> <span>&bull;</span> {{this.customTime()}}</small>
                
                <a href="JavaScript:void(0)" v-if="editable" @click="state = 'editing'" class="secondary-content"><i class="material-icons">edit</i></a>
            </div>

            <!-- Prikaz kada se komentar edituje -->
            <div v-show="state === 'editing'" v-if="seen">
                <div class="input-field">     
                    
                    <textarea v-model="data.content"                        
                            class="materialize-textarea"
                            id ="textarea_edit">
                    </textarea>                 
                    <label for="textarea_edit" class="active">Izmeni komentar</label>             
                </div>
                <div>
                    <button @click="saveEdit" class = "btn-small waves-light">Snimi</button>
                    <button @click="resetEdit" class = "btn-small white blue-text text-darken-4 aves-light">Poništi</button>     
                    <a href="JavaScript:void(0)" @click="deleteComment" class="secondary-content red-text">Obriši</a>
                </div>
            </div>
        </div>

        <!-- Kada je komentar sakriven -->
        <div v-if="!seen">
            <a href="JavaScript:void(0)" v-on:click="seen = !seen"><i class="material-icons">expand_more</i></a>
            <small class="blue-grey-text text-lighten-3"><a :href="'/korisnici/' + comment.user.id" class="blue-grey-text text-lighten-3">{{comment.user.first_name}} {{comment.user.last_name}}</a> <span>&bull;</span> {{this.customTime()}}</small>

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
              seen: true,
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
            },  
            customTime() {
                var temp = this.comment.created_at.split(" ");
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