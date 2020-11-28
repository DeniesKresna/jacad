<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Job</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    v-model="search" 
                    placeholder="Search then type Enter" 
                    @keyup.enter="getResults(1)">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-if="result.data.length">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Company</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <th>{{ item.company.name }}</th>
                                <td>{{ item.position }}</td>
                                <td v-if="item.verified === 1">Verified</td>
                                <td v-else-if="item.verified === 2">Rejected</td>
                                <td v-else>Pending</td>
                                <td>
                                    <router-link :to="`/job/edit/${item.id}`">
                                        <span class="fa fa-pencil"></span>
                                    </router-link>
                                    <router-link :to="`/job/${item.id}`">
                                        <span class="fa fa-eye"></span>
                                    </router-link>
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

                this.$store.dispatch('job/INDEX', query).then(response => {
                    this.result = response;
                });
            }
        }
    };
</script>