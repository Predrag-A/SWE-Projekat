<template>
    <div class="container"> <!-- city prop je prop preko koga se salje iz blade.php u vue komponentu neke vrednosti-->
        <!-- Prop mora da postoji u export default-u -->
        Grad:{{city_prop}}
        <ul class="list-group">
            <li class="list-group-item" v-for="(city, index) in cities" :key="index">
                <h3 class="list-group-item-heading">
                    {{city.name}}
                </h3>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cities: [],
        }
    },
    props: {
        city_prop: {
            required: true //samo da mora da se prosledi
        }
    },

    methods: {
        
    },

    //Lifehook
    created() {
        //axios je slicno ajaxu i ovo sa get se zove controler sa ovom rutom da bi se vratili podaci
        //prvo se navodi ruta koja u sebi ima koji kontroler je zaduzen i koja funkcija je zaduzena
        //kada se navede cities, users, itd...
        axios.get('/web/api/cities').then(response => {
            console.log(response);
            this.cities = response.data;
        }).catch(error => {
            console.log(error);
        });
    }
}
</script>

<style scoped>

</style>

