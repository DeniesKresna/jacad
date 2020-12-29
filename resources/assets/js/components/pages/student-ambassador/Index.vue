<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Student Ambassador</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search student name then type Enter"
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
                                <th>Student</th>
                                <td>Status</td>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.name }}</td>
                                <td v-if="item.status === 0">Pending</td>
                                <td v-else-if="item.status === 1">Accepted</td>
                                <td v-else-if="item.status === 2">Rejected</td>
                                <td v-if="item.status === 0">
                                    <a href="javascript:void(0)" @click="verify(item, 'accept')">
                                        <span class="fa fa-check"></span> 
                                    </a> &nbsp;
                                    <a href="javascript:void(0)" @click="verify(item, 'reject')">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </td>
                                <td v-else>
                                    <router-link :to="''">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link> &nbsp;
                                    <router-link :to="''">
                                        <span class="fa fa-eye"></span>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12" v-else>
                <span>No data yet.</span>
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

                this.$store.dispatch('student_ambassador/INDEX', query).then(response => {
                    this.result = response;
                });
            },
            
            verify(jsa, action) {
                if (confirm(`Are you sure want to ${action} student: "${jsa.name}"?`)) {
                    this.$store.dispatch('student_ambassador/VERIFY', { id: jsa.id, action: action }).then(response => {
                        this.getResults(1);
                    });
                }
            }
        }   
    }
</script>