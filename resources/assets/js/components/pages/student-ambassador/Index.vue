<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" v-model="search" placeholder="Search then type Enter" @keyup.enter="getResults(1)">
            </div>
            <div class="row">
                <div class="col-md-12" v-if="result.data.length">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-bind:key="index"
                                    v-for="(item, index) in result.data">
                                    <td>{{ (index+1) }}</td>
                                    <td>{{ item.name }}</td>
                                    <td v-if="item.status === 0">
                                        <button @click="accept(item)" class="btn btn-primary">
                                            <span class="fa fa-check"></span>
                                        </button>
                                        <button @click="reject(item)" class="btn btn-danger">
                                            <span class="fa fa-times"></span>
                                        </button>
                                    </td>
                                    <td v-else>
                                        Accepted
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" v-else>
                    no data yet.
                </div>
            </div>
        </div>
    </div> 
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                result: {
                    data: []
                }
            }
        },
        mounted() {
            this.getResults(1);
        },
        methods: {
            getResults(page= 1) {
                let query= `page=${page}&search=${this.search}`;

                this.$store.dispatch('student_ambassador/INDEX', query)
                           .then(response => {
                    this.result = response;
                });
            },
            
            accept(jsa) {
                if (confirm(`Are you sure want to accept: ${jsa.name}?`)) {
                    this.$store.dispatch('student_ambassador/UPDATE', jsa.id)
                               .then(response => {
                        this.getResults(1);

                        alert('Telah di accept oleh user XXXX');
                    });
                }
            },

            reject(jsa) {
                if (confirm(`Are you sure want to reject: ${jsa.name}?`)) {
                    this.$store.dispatch('student_ambassador/DESTROY', jsa.id)
                               .then(response => {
                        this.getResults(this.result.current_page);
                        
                        alert('Telah di reject oleh user XXXX');
                    });
                }
            }
        }   
    }
</script>