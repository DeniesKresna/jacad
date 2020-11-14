<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-12">
                <h4>ID. #{{ data.id }}</h4>
                <b>Position: </b> {{ data.position }} <br>
                <b>Type: </b> {{ data.type }}
            </div>
            <div class="col-md-12">
                <h4>Company</h4>
                <b>Name: </b> {{ data.company.name }} <br>
                <b>Description:</b> {{ data.company.information }}
            </div>
            <div class="col-md-12">
                <h4>Informasi</h4>
                <b>Location: </b> {{ data.location.name }} <br>
                <b>Work time: </b> {{ data.work_time }} <br>
                <b>Dress style: </b> {{ data.dress_style }} <br>
                <b>Language: </b> {{ data.language }} <br>
                <b>Salary: </b> {{ data.salary }} <br>
                <b>Facility (optional):</b> {{ data.facility ? data.facility : '-'}}
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
            this.getResult();
        },
        methods: {
            getResult() {
                this.$store.dispatch('job_application/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                });
            }
        }
    }
</script>