<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Tag</h2>
        <div class="row">
            <div class="col-md-5">
                <input
                    class="form-control" 
                    type="text"  
                    v-model="search" 
                    placeholder="Search then type Enter" 
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <router-link :to="'/tag/create'">
                    <button type="button" class="btn btn-default btn-block">Create</button>
                </router-link>
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
                                <td>{{ index + (result.from) }}</td>
                                <td>{{ item.name }}</td>
                                <td>
                                    <a href="javascript:void(0)" @click="destroyData(item)">
                                        <span class="fa fa-trash-o"></span>
                                    </a> &nbsp;
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
                    <p>Belum ada tag</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data() {
            return{
                search: '',
                result: {
                    data: []
                }
            }
        },
        mounted(){
            this.getResults(1);
        },
        methods: {
            getResults(page=1) {
                let stringQuery = "page="+page+"&search="+this.search;
                
                this.$store.dispatch('tag/INDEX', stringQuery).then(response => {
                    this.result = response;
                });
            },

            destroyData(tag) {
                if (confirm(`Anda yakin ingin menghapus tag : ${tag.name} ?`)) {
                    this.$store.dispatch('tag/DESTROY', tag.id).then(response => {
                        this.getResults(this.result.current_page);
                    });;
                }   
            }
        }
    }
</script>