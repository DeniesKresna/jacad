<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-12">
                <h4>ID. #{{ data.job.id }}</h4>
            </div>
            <div class="col-md-6">
                Position: {{ data.job.position }}
            </div>
            <div class="col-md-6">
                Type: {{ data.job.type }}
            </div>
            <div class="col-md-12">
                <h4>Company</h4>
            </div>
            <div class="col-md-6">
                Name: {{ data.company.name }}
            </div>
            <div class="col-md-6">
                Description: {{ data.company.information }}
            </div>
            <div class="col-md-12">
                <h4>Information</h4>
                Location: {{ data.job.location }} <br>
                Waktu Bekerja: {{ data.job.work_time }} <br>
                Gaya berpakaian: {{ data.job.dress_style }} <br>
                Bahasa yang digunakan: {{ data.job.language }} <br>
                Besar gaji: {{ data.job.salary }} <br>
                Fasilitas lain (jika ada): {{ data.job.facility }}
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
            this.getDetail();
        },
        methods: {
            getDetail() {
                this.$store.dispatch('job/SHOW', this.$route.params.id)
                    .then(response => {
                    this.data = response;
                });
            } 
        }
    }
</script>