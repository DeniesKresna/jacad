<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Academy Period</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    v-model="search" 
                    placeholder="Search then type Enter" 
                    @keyup.enter="getResults(1)">
            </div>
            <div class="col-md-2">
                <v-select 
                    placeholder="-- Select status --"
                    label="name"
                    track-by="code"
                    v-model="active" 
                    :options="[{code: 1, name: 'Active'}, {code: 0, name: 'Not Active'}]" 
                    @input="getResults(1)"/>
            </div>
            <div class="col-md-2">
                <router-link :to="'academy-period/create'" class="btn btn-default btn-block">Create</router-link>
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
                                <th>Period</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.academy_class.name }}</td>
                                <td>{{ item.period }}</td>
                                <td v-if="item.active === 0">Not active</td>
                                <td v-else>Active</td>
                                <td>
                                    <a href="javascript:void(0)" @click="activate(item)">
                                        <span v-if="item.active === 0" class="fa fa-toggle-off"></span>
                                        <span v-else class="fa fa-toggle-on"></span>
                                    </a> &nbsp;
                                    <router-link :to="`/academy-period/${item.id}`">
                                        <span class="fa fa-pencil-square-o"></span>
                                    </router-link> &nbsp;
                                    <a href="javascript:void(0)" @click="destroyData(item)">
                                        <span class="fa fa-trash"></span>
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
                    <p>Belum ada Academy Period</p>
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
                active: null,
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
                let stringQuery= `page=${page}`;

                if (this.active) {
                    stringQuery+= `&active=${this.active.code}`;
                } else {
                    stringQuery+= `&search=${this.search}`;
                }

                this.$store.dispatch('academy_period/INDEX', stringQuery).then(response => {
                    this.result= response;
                });
            },
            activate(academy_period) {
                academy_period.activate= true;

                this.$store.dispatch('academy_period/UPDATE', academy_period).then(response => {
                    this.getResults(1);
                });
            },
            destroyData(academy_period) {
                this.$store.dispatch('academy_period/DESTROY', academy_period).then(response => {
                    this.getResults(1);
                });
            }
        }
    }
</script>