<template>
    <div class="content-row">
        <h2 class="content-row-title">Index Job</h2>
        <div class="row">
            <div class="col-md-5">
                <input 
                    type="text" 
                    class="form-control" 
                    placeholder="Search job by position or company then type Enter"
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
                                <th>Company</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-bind:key="index"
                                v-for="(item, index) in result.data">
                                <td>{{ (index+1) }}</td>
                                <th>{{ item.company.name }}</th>
                                <td>{{ item.position }}</td>
                                <td v-if="item.verified === 1">Verified</td>
                                <td v-else-if="item.verified === 2">Rejected</td>
                                <td v-else>Pending</td>
                                <td>
                                    <template v-if="item.verified === 0">
                                        <a href="javascript:void(0)" @click="verify(item, 'accept')">
                                            <span class="fa fa-check"></span> 
                                        </a> &nbsp;
                                        <a href="javascript:void(0)" @click="verify(item, 'reject')">
                                            <span class="fa fa-times"></span> &nbsp;
                                        </a>
                                    </template>
                                    <a href="javascript:void(0)" @click="showData(item)">
                                        <span class="fa fa-eye"></span>
                                    </a> &nbsp;
                                    <router-link :to="`/job/edit/${item.id}`">
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
            <div class="col-md-12" v-else>
                <span>No data yet.</span>
            </div>
        </div>

        <!-- MODAL -->
        <modal
            name="modal-box"
            width="1200"
            height="auto"
            scrollable>
            <div class="card">
                <div class="card-header">
                    <div class="container">
                        <h3>#NO.{{ job.id }} {{ job.position }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h4>Company</h4>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_name">Name</label>
                                        <input class="form-control" id="company_name" v-model="job.company.name" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_tagline">Tagline</label>
                                        <input class="form-control" id="company_tagline" v-model="job.company.tagline" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_information">Information</label>
                                        <input class="form-control" id="company_information" v-model="job.company.information" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_address">Address</label>
                                        <input class="form-control" id="company_address" v-model="job.company.address" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Logo</label> <br>
                                        <span v-if="job.company.logo_url">
                                            <img :src="job.company.logo_url" width="300">
                                        </span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_website">Website</label>
                                        <input class="form-control" id="company_website" v-model="job.company.website" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_email">Email</label>
                                        <input class="form-control" id="company_email" v-model="job.company.email" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_phone">Phone</label>
                                        <input class="form-control" id="company_phone" v-model="job.company.phone" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="company_employee_amount">Employee Amount</label>
                                        <input class="form-control" id="company_employee_amount" v-model="job.company.employee_amount" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h4>Job</h4>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_position">Position</label>
                                        <input class="form-control" id="job_position" v-model="job.position" readonly>
                                    </div>  
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Sectors</label>
                                        <multiselect
                                            label="name"
                                            track-by="id"
                                            v-model="job.sectors"
                                            :options="job.sectors"
                                            :multiple="true"
                                            disabled />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_type">Type</label>
                                        <input class="form-control" id="job_type" v-model="job.type" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_description">Description</label> <br>
                                        <div v-html="job.job_desc"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_location">Location</label>
                                        <input class="form-control" id="job_location" v-model="job.location.name" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_work_time">Work Time</label>
                                        <input class="form-control" id="job_work_time" v-model="job.work_time" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_dress_style">Dress Style</label>
                                        <input class="form-control" id="job_dress_style" v-model="job.dress_style" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_language">Language</label>
                                        <input class="form-control" id="job_language" v-model="job.language" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_facility">Facility</label>
                                        <input class="form-control" id="job_facility" v-model="job.facility" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_salary">Salary</label>
                                        <input class="form-control" id="job_salary" v-model="job.salary" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_how_to_send">How to send</label>
                                        <textarea
                                            rows="5" 
                                            class="form-control" 
                                            id="job_how_to_send" 
                                            v-model="job.how_to_send"
                                            readonly />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_expired">Expires In</label>
                                        <input class="form-control" id="job_expired" v-model="job.expired" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_process_time">Process Time</label>
                                        <input class="form-control" id="job_process_time" v-model="job.process_time" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="job_jobhun_info">Jobhun Info</label>
                                        <input class="form-control" id="job_jobhun_info" v-model="job.jobhun_info" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
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
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                search: '',
                result: {
                    data: []
                },
                job: {
                    company: {},
                    sectors: [],
                    location: {}
                }
            }
        },
        mounted() {
            this.getResults(1);
        },
        methods: {
            getResults(page= 1) {
                let query= `page=${page}&search=${this.search}`;

                this.$store.dispatch('job/INDEX', query).then(response => {
                    this.result= response;
                });
            },
            showData(job) {
                 this.$store.dispatch('job/SHOW', job.id).then(response => {
                    this.job= response;
                    this.$modal.show('modal-box');
                });
            },
            destroyData(job) {
                if (confirm(`Are you sure want to delete job: "${job.position}"?`)) {
                    this.$store.dispatch('job/DESTROY', job.id).then(response => {
                        this.getResults();
                    });
                }
            },
            verify(job, action) {
                if (confirm(`Are you sure want to ${action} "${job.position}"?`)) {
                    this.$store.dispatch('job/VERIFY', { id: job.id, action: action }).then(response => {
                        this.getResults();
                    });
                }
            }
        }
    };
</script>