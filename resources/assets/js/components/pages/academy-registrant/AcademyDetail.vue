<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-12">
                <h4>ID. #{{ data.id}}</h4>
                <b>Name: </b> {{ data.name }} <br>
                <b>Description: </b> <p>{{ data.desc }}</p>
                <b>Price: </b> {{ data.price }} <br>
                <b>SKU: </b> {{ data.sku }} <br>
                <b>Batch: </b> {{ data.batch }}
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
                this.$store.dispatch('academy/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                });
            }
        }
    }
</script>