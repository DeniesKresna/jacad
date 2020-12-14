<template>
    <div class="content-row">
        <h2 class="content-row-title">Job Applications</h2>
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
                                <th>Applicant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody 
                            v-bind:key="index"
                            v-for="(item, index) in result.data">
                            <tr>
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.company_name }}</td>
                                <td>{{ item.job_position }}</td>
                                <td>{{ item.applicant_name }}</td>
                                <td>
                                    <router-link :to="`/job-application/job/${item.job_id}`">
                                        <span class="fa fa-briefcase"></span>
                                    </router-link> &nbsp;
                                    <router-link :to="`/job-application/applicant/${item.applicant_id}`">
                                        <span class="fa fa-user"></span>
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
                <p>no data yet.</p>
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

                this.$store.dispatch('job_application/INDEX', query).then(response => {                    
                    this.result= response;
                });
            }
        }
    }
</script>