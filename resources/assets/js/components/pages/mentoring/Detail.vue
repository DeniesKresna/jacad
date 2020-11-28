<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-12">
                <h4>ID. #{{ data.id }}</h4>
                <b>Spesific Topic: </b> {{ data.spesific_topic }} <br>
                <b>Date: </b> {{ data.date }} <br>
                <b>Time: </b> {{ data.time }} <br>
                <b>Duration: </b> {{ data.duration }} <br>
                <b>Jobhun Info: </b> {{ data.jobhun_info }}
            </div>
            <div class="col-md-12">
                <h4>Ask Career</h4>
                <b>Name: </b> {{ data.ask_career.name }} <br>
                <b>Schedule: </b> {{ data.ask_career.schedule }} <br>
                <b>Price: </b> {{ data.ask_career.price }} <br>
                <b>Mentor: </b> {{ data.ask_career.mentor.name }}   
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
                this.$store.dispatch('mentoring/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                });
            }
        }
    }
</script>