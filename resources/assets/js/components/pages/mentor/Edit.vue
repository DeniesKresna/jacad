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
                        <vue-editor 
                            useCustomImageHandler 
                            :editorOptions="editorSettings" 
                            @image-added="handleImageAdded" 
                            v-model="data.description">
                        </vue-editor>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button class="btn btn-info" type="submit">Create</button>
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
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                }
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
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                // An example of using FormData
                // NOTE: Your key could be different such as:
                // formData.append('file', file)
                
                let formData = new FormData();

                formData.append("image", file);
                
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