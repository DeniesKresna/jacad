<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-12">
                <h4>ID. #{{ data.id }}</h4>
                <b>Position: </b> {{ data.position }} <br>
                <b>Sectors: </b>
                <span v-bind:key="index"
                     v-for="(item, index) in data.sectors">
                    {{ item.name }}, 
                </span> <br>
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
        <div class="row" v-if="data.verified === 0">
            <div class="col-md-6">
                <button class="btn btn-default btn-block" @click="verify('yes')">Accept</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-default btn-block" @click="verify('no')">Reject</button>
            </div>
        </div>
        <div class="text-center" v-else>
            <h3 class="text-success" v-if="data.verified === 1">-- VERIFIED --</h3>
            <h3 class="text-danger" v-if="data.verified === 2">-- REJECTED --</h3>
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
                this.$store.dispatch('job/SHOW', this.$route.params.id).then(response => {
                    this.data = response;

                    console.log(response);
                });
            },
            
            verify(status) {
                this.data.id= this.$route.params.id;
                this.data.verify= status;
                
                this.$store.dispatch('job/UPDATE', this.data).then(response => {
                    this.getData();

                    console.log(response);
                });
            }
        }
    }
</script>