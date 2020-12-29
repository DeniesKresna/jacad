<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Academy</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search by academy class or creator then type Enter"
                    v-model="search"  
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <router-link :to="'/academy/create'" class="btn btn-default btn-block">Create</router-link>
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
                                <th>Creator</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.creator.name }}</td>
                                <td>
                                    <router-link :to="`/academy/${item.id}`">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link> &nbsp;
                                    <a href="javascript:void(0)" @click="destroyData(item)">
                                        <span class="fa fa-trash-o"></span>
                                    </a> &nbsp;
                                    <a :href="item.url" target="_blank">
                                        <span class="fa fa-eye"></span>
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
                let query= `page=${page}&search=${this.search}`;

                this.$store.dispatch('academy/INDEX', query).then(response => {
                    this.result = response;
                });
            },
            destroyData(academy) {
                if (confirm(`Are you sure want to delete academy: "${academy.name}"?`)) {
                    this.$store.dispatch('academy/DESTROY', academy.id).then(response => {
                        this.getResults(this.result.current_page);
                    });
                }
            }
        }
    }
</script>