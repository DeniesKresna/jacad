<template>
    <div class="content-row">
        <h2 class="content-row-title">Academy Registrants</h2>
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
                                <th>Academy</th>
                                <th>Registrant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody 
                            v-bind:key="index"
                            v-for="(item, index) in result.data">
                            <tr>
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.academy ? item.academy.name : '' }}</td>
                                <td>{{ item.name }}</td>
                                <td>
                                    <router-link :to="`/academy-registrant/academy/${item.academy.id}`">
                                        <span class="fa fa-graduation-cap"></span>
                                    </router-link>
                                     <router-link :to="`/academy-registrant/registrant/${item.id}`">
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

                this.$store.dispatch('academy_registrant/INDEX', query).then(response => {                    
                    this.result= response;
                });
            }
        }
    }
</script>