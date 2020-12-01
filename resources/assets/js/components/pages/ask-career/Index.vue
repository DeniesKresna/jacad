<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Ask Career</h2>
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
                <router-link :to="'/ask-career/create'">
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
                                <th>Mentor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ index + (result.from) }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.mentor.name }}</td>
                                <td>
                                    <router-link :to="`/ask-career/${item.id}`">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link>
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
                    <p>Belum ada ask career</p>
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
                let stringQuery = `page=${page}&search=${this.search}`;
                
                this.$store.dispatch('ask_career/INDEX', stringQuery).then(response => {
                    this.result = response;
                });
            },

            destroyData(ask_career) {
                if (confirm(`Apakah anda yakin ingin menghapus ask career : ${ask_career.name} ?`)) {
                    this.$store.dispatch('ask_career/DESTROY', ask_career.id).then(response => {
                        this.getResults(this.result.current_page);
                    });;
                }   
            }
        }
    }
</script>