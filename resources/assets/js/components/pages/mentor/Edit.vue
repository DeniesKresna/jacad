<template>
    <div class="content-row">
        <h2 class="content-row-title">Edit Mentor</h2>
        <div class="row">
            <form
                class="form-horizontal"
                role="form"
                @submit.prevent="updateData">
                <div class="form-group">
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="Name" 
                            class="form-control" 
                            v-model="data.name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Featured Image</label>
                    <div class="col-md-10">
                        <span v-if="data.image_url">
                            <img :src="data.image_url" width="300">
                        </span>
                        <input 
                            type="file" 
                            id="file" 
                            ref="file" 
                            @change="handleFileUpload()">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Description</label>
                    <div class="col-md-10">
                        <vue-editor v-model="data.description" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">LinkedIn Profile</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="LinkedIn Profile" 
                            class="form-control" 
                            v-model="data.linkedIn_url">
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
    import { VueEditor } from 'vue2-editor';
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            VueEditor, 
            Multiselect
        },
        data() {
            return {
                data: {}
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('mentor/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                });
            },
            handleFileUpload() {
                this.data.file = this.$refs.file.files[0];
            },
            updateData() {
                this.data.id= this.$route.params.id;
                this.$store.dispatch('mentor/UPDATE', this.data).then(response => {
                    this.getData();
                });
            }
        }
    }
</script>