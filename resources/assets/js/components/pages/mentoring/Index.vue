<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Mentoring</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search by ask career, mentor or customer then type Enter"
                    v-model="search"  
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
                                <th>Ask Career</th>
                                <th>Mentor</th>
                                <th>Customer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.ask_career.name }}</td>
                                <td>{{ item.ask_career.mentor.name }}</td>
                                <td>{{ item.customer.name }}</td>
                                <td>
                                    <router-link :to="`/mentoring/${item.id}`">
                                        <span class="fa fa-eye"></span>
                                    </router-link> &nbsp;
                                    <router-link :to="`/mentoring/edit/${item.id}`">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link> &nbsp;
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
            <div v-else>
                <div class="col-md-12">
                    <span>No data yet.</span>
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
                let stringQuery= `page=${page}&search=${this.search}`;
                
                this.$store.dispatch('mentoring/INDEX', stringQuery).then(response => {
                    this.result = response;
                    console.log(response);
                });
            }
        }   
    }
</script>