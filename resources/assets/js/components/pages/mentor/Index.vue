<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Mentor</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    v-model="search" 
                    placeholder="Search mentor by name then type Enter" 
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <router-link :to="'/mentor/create'" class="btn btn-default btn-block">Create</router-link>
            </div>
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
                                <td>
                                    <router-link :to="`/mentor/${item.id}`">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link> &nbsp;
                                    <a href="javascript:void(0)" @click="destroyData(item)">
                                        <span class="fa fa-trash-o"></span>
                                    </a>
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
                
                this.$store.dispatch('mentor/INDEX', stringQuery).then(response => {
                    this.result = response;
                });
            },
            destroyData(mentor) {
                if (confirm(`Apakah anda yakin ingin menghapus mentor : ${mentor.name} ?`)) {
                    this.$store.dispatch('mentor/DESTROY', mentor.id).then(response => {
                        this.getResults(this.result.current_page);
                    });
                }
            }
        }
    }
</script>