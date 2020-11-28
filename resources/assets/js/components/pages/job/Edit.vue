<template>
    <div class="content-row">
        <h2 class="content-row-title">Edit Job</h2>
        <div class="row">
            <form
                class="form-horizontal"
                role="form"
                @submit.prevent="updateData">
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Name</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company name" 
                            class="form-control" 
                            v-model="data.company.name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Tagline</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company tagline" 
                            class="form-control" 
                            v-model="data.company.tagline">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Information</label>
                    <div class="col-md-10">
                        <textarea
                            class="form-control"
                            rows="5"
                            placeholder="Company information"
                            v-model="data.company.information">
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Address</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company address" 
                            class="form-control" 
                            v-model="data.company.address">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Logo</label>
                    <div class="col-md-10">
                        <span v-if="data.company.logo_url">
                            <img :src="data.company.logo_url" width="300">
                        </span>
                        <span>
                            <input 
                                type="file" 
                                id="file" 
                                ref="file" 
                                @change="handleFileUpload()">
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Website</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company website" 
                            class="form-control" 
                            v-model="data.company.site_url">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Email</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company email" 
                            class="form-control" 
                            v-model="data.company.email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Phone</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company phone" 
                            class="form-control" 
                            v-model="data.company.phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Company Employee Amount</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Company employee amount" 
                            class="form-control" 
                            v-model="data.company.employee_amount">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Position</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Job position" 
                            class="form-control" 
                            v-model="data.position">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Sectors</label>
                    <div class="col-md-10">
                        <multiselect 
                            placeholder="Pick some" 
                            label="name" 
                            track-by="id" 
                            v-model="picked.sectors" 
                            :options="options.sectors" 
                            :multiple="true" 
                            :close-on-select="false" 
                            :clear-on-select="false" 
                            :preserve-search="true" 
                            :preselect-first="true" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Type</label>
                    <div class="col-md-10">
                        <v-select 
                            placeholder="Pick some"
                            label="name"
                            v-model="picked.type" 
                            :options="['Full Time', 'Part Time', 'Freelance', 'Internship', 'Volunteer']"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Description</label>
                    <div class="col-md-10">
                        <vue-editor 
                            useCustomImageHandler 
                            :editorOptions="editorSettings" 
                            @image-added="handleImageAdded" 
                            v-model="data.job_desc">
                        </vue-editor>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Location</label>
                    <div class="col-md-10">
                        <v-select 
                            placeholder="Pick some"
                            label="name"
                            v-model="picked.location"
                            :options="options.locations"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Work Time</label>
                    <div class="col-md-10">
                        <input 
                            type="text"
                            class="form-control"  
                            placeholder="Job work time" 
                            v-model="data.work_time">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Dress Style</label>
                    <div class="col-md-10">
                        <input 
                            type="text"
                            class="form-control"  
                            placeholder="Job dress style" 
                            v-model="data.dress_style">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Language</label>
                    <div class="col-md-10">
                        <input 
                            type="text"
                            class="form-control"  
                            placeholder="Job language" 
                            v-model="data.language">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Facility</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Job facility" 
                            v-model="data.facility">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Job Salary</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            class="form-control" 
                            placeholder="Job salary" 
                            v-model="data.salary">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">How to send</label>
                    <div class="col-md-10">
                        <textarea 
                            class="form-control"
                            rows="5"
                            placeholder="How to send"
                            v-model="data.how_to_send" >
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Expire In</label>
                    <div class="col-md-10">
                        <input 
                            type="date"
                            class="form-control"
                            v-model="data.expired">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Process Time</label>
                    <div class="col-md-10">
                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Process time"
                            v-model="data.process_time">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jobhun Info</label>
                    <div class="col-md-10">
                        <input 
                            type="text"
                            class="form-control"
                            placeholder="Jobhun info"
                            v-model="data.jobhun_info">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button class="btn btn-info" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { VueEditor, Quill } from 'vue2-editor';
    import ImageResize from '../../../plugins/quill-fix-error/image-resize.min.js';
    import Multiselect from 'vue-multiselect';

    Quill.register('modules/imageResize', ImageResize);

    export default {
        components: {
            VueEditor, 
            Multiselect
        },
        data() {
            return {
                data: {},
                options: {
                    sectors: [],
                    locations: []
                },
                picked: {
                    sectors: [],
                    type: 'Full Time',
                    location: 0
                },
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                }
            }
        },
        mounted() {
            this.$store.dispatch('sector/LIST').then(response => {
                this.options.sectors= response;
            });
            this.$store.dispatch('location/LIST').then(response => {
                this.options.locations= response;
            });
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('job/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                    this.data.expired= this.data.expired.split(' ')[0];
                    this.picked.type= response.type;
                    this.picked.sectors= response.sectors;
                    this.picked.location= response.location;

                    console.log(response);
                });
            },
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                // An example of using FormData
                // NOTE: Your key could be different such as:
                // formData.append('file', file)
                
                let formData = new FormData();

                formData.append('image', file);

                axios({
                    url: `${this.$store.getters.urls.host.jonathan}/${this.$store.getters.urls.api}/admin/medias`,
                    method: 'POST',
                    data: formData
                }).then(result => {
                    let url = result.data.url; // Get url from response

                    Editor.insertEmbed(cursorLocation, 'image', url);
                    resetUploader();
                });
            },
            handleFileUpload() {
                this.data.file= this.$refs.file.files[0];
            },
            updateData() {
                this.data.id= this.$route.params.id;
                this.data.sectors= this.picked.sectors.map(sector => sector.id);
                this.data.location= this.picked.location.id;

                this.$store.dispatch('job/UPDATE', this.data).then(response => {
                    this.getData();
                });
            }
        }
    }
</script>