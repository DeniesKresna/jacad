<template>
    <div class="content-row">
        <h2 class="content-row-title">{{ title }}</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control"  
                    placeholder="Search by title or author then type Enter"
                    v-model="search" 
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <router-link :to="this.route+'create'" class="btn btn-default btn-block">Create</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" v-if="result.data.length">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.title }}</td>
                                <td>{{ item.author.name }}</td>
                                <td>
                                    <a :href="item.url" target="_blank">
                                        <span class="fa fa-eye"></span>
                                    </a> &nbsp;
                                    <router-link :to="route+item.id">
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
        props: [
            'title',
            'category',
            'menu',
            'route'
        ],
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
                
                if (this.menu) {
                    query+= `&menu=${this.menu}`;
                }

                if (this.category) {
                    query+= `&category=${this.category}`;
                }

                this.$store.dispatch('blog/INDEX', query).then(response => {
                    this.result = response;
                });
            },
            destroyData(blog) {
                if (confirm(`Are you sure want to delete blog: "${blog.title}"?`)) {
                    this.$store.dispatch('blog/DESTROY', blog.id).then(response => {
                        this.getResults(this.result.current_page);
                    });
                }
            }
        }
    }
</script>