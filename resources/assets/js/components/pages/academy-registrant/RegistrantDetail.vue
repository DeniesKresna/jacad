<template>
    <div class="content-row">
        <div class="content-row">
            <div class="row">
                <div class="col-md-12">
                     <h4>ID. #{{ data.id }}</h4>
                     <b>Name: </b> {{ data.name }} <br>
                     <b>Email: </b> {{ data.email }} <br>
                     <b>Phone: </b> {{ data.phone }} <br>
                </div>
                <div class="col-md-12">
                    <h4>Profile</h4>
                    <b>Description: </b> <p>{{ data.profession }}</p>
                    <b>Domicile: </b> {{ data.domicile }} <br>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {}
            }
        },
         mounted() {
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('academy_registrant/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                    console.log(response);
                });
            }
        }
    }
</script>