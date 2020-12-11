<template>
    <div class="content-row">
        <h2 class="content-row-title">{{ title }}</h2>
        <form
            class="form-horizontal"
            role="form"
            @submit.prevent="storeData">
            <div class="form-group">
                <label class="col-md-2 control-label">Service Name</label>
                <div class="col-md-10">
                    <input 
                        type="text" 
                        placeholder="Title" 
                        class="form-control" 
                        v-model="data.service"
                        disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Content</label>
                <div class="col-md-10">
                    <vue-editor 
                        useCustomImageHandler 
                        :editorOptions="editorSettings" 
                        @image-added="handleImageAdded" 
                        v-model="data.content">
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
</template>

<script>
    import { VueEditor, Quill } from 'vue2-editor';
    import ImageResize from '../../../plugins/quill-fix-error/image-resize.min.js';

    Quill.register('modules/imageResize', ImageResize);

    export default {
        components: {
            VueEditor
        },
        props: [
            'title',
            'service'
        ],
        data() {
            return {
                data: {
                    service: this.service,
                    content: ''
                },
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
            getData() {
                this.$store.dispatch('opening/SHOW', this.service).then(response => {
                    console.log(response);
                    
                    if (response.content) this.data.content= response.content;
                });
            },
            storeData() {
                this.$store.dispatch('opening/STORE', this.data).then(response => {
                    this.getData();
                });
            }
        }
    }
</script>