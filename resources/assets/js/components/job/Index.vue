<template>
    <div class="content-row">
        <div class="row">
            <div class="col-md-5">
                <input type="text" class="form-control" v-model="search" placeholder="Search then type Enter" @keyup.enter="getResults(1)">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12" v-if="result.data.length">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in result.data">
                                <td>{{ item.id }}</td>
                                <td>{{ item.position }}</td>
                                <td>
                                    <router-link :to="`/job/${item.id}`">
                                        <button class="btn btn-blue">Details</button>
                                    </router-link>
                                    <button @click="accept(index)" class="btn btn-primary" v-if="accepted[index]">
                                        Accept
                                    </button>
                                    <button @click="reject" class="btn btn-danger">
                                        Reject
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <paginate
                        :page-count="result.last_page"
                        :click-handler="getResults"
                        :prev-text="'Prev'"
                        :next-text="'Next'"
                        :container-class="'pagination'">
                    </paginate>
                </div>
            </div>
            <div class="col-md-12" v-else>
                no data yet.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                accepted: [],
                result: {
                    data: []
                }
            }
        },
        mounted() {
            this.getResult(1);
        },
        methods: {
            getResult(page= 1) {
                let query= `page=${page}&search=${this.search}`;

                this.$store.dispatch('job/INDEX', query).then(response => {
                    this.result = response;
                    
                    for (let i = 0; i < this.result.data.length; i++) {
                        this.accepted[i]= true;
                    }
                });
            },
            accept(index) {
                Vue.set(this.accepted, index, false);

                alert('Telah di accept oleh user XXXX');
            },
            reject() {
                 alert('Telah di reject oleh user XXXX');
            }
        }
    };
</script>