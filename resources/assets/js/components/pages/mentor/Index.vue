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
                                    <a href="javascript:void(0)" @click="showData(item)">
                                        <span class="fa fa-eye"></span>
                                    </a> &nbsp;
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

        <!-- MODAL -->
        <modal
            name="modal-box"
            height="auto"
            scrollable>
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <h3>{{ mentor.name }}</h3>
                    </div>
                </div>

                <hr>

                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <img :src="mentor.image_url" width="250">     
                            </div>
                            <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" v-model="mentor.name" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <div v-html="mentor.description"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="linkedIn_url">LinkedIn</label>
                                <input class="form-control" id="linkedIn_url" v-model="mentor.linkedIn_url" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="created_at">Created at</label>
                                <input class="form-control" id="created_at" v-model="mentor.created_at" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="updated_at">Updated at</label>
                                <input class="form-control" id="updated_at" v-model="mentor.updated_at" readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-info" @click="$modal.hide('modal-box')">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </modal>
        <!-- MODAL --> 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                mentor: {},
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
            showData(mentor) {
                this.$store.dispatch('mentor/SHOW', mentor.id).then(response => {
                    this.mentor= response;
                    this.$modal.show('modal-box');
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