<template>
    <div class="content-row">
        <h2 class="content-row-title">Create Mentor</h2>
        <div class="row">
            <form
                class="form-horizontal"
                role="form"
                @submit.prevent="storeData">
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
                data: {
                    name: '',
                    description: '',
                    file: null
                },
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                }
            }
        },
        methods: {
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
            storeData() {
                this.$store.dispatch('mentor/STORE', this.data).then(response => {
                    this.data=  {
                        name: '',
                        description: '',
                        file: null
                    }
                    this.$refs.file.value = '';
                });
            }
        }
    }
</script>