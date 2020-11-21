<template>
    <div class="content-row">
        <h2 class="content-row-title">Academy Edit</h2>
        <div class="row">
            <form
                class="form-horizontal" 
                role="form"
                @submit.prevent="updateData">
                <div class="form-group">
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-10">
                        <input 
                            class="form-control"
                            type="text" 
                            placeholder="Name"  
                            v-model="data.name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Featured Image</label>
                    <div class="col-md-10">
                        <span v-if="data.image_url">
                            <img :src="data.image_url" width="300">
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
                    <label class="col-md-2 control-label">Description</label>
                    <div class="col-md-10">
                        <vue-editor 
                            useCustomImageHandler 
                            :editorOptions="editorSettings" 
                            @image-added="handleImageAdded" 
                            v-model="data.desc">
                        </vue-editor>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Category</label>
                    <div class="col-md-10">
                        <input 
                            class="form-control"
                            type="text" 
                            disabled
                            v-model="data.category">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Price</label>
                    <div class="col-md-10">
                        <input 
                            class="form-control"
                            type="number"
                            v-model="data.price"
                            min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">SKU</label>
                    <div class="col-md-10">
                        <input 
                            class="form-control"
                            type="text"
                            placeholder="SKU"
                            v-model="data.sku">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Batch</label>
                    <div class="col-md-10">
                        <input 
                            class="form-control"
                            type="number"
                            v-model="data.batch"
                            min="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="description">Tags</label>
                    <div class="col-md-10">
                        <multiselect 
                            placeholder="Pick some" 
                            label="name" 
                            track-by="id" 
                            v-model="picked.tags" 
                            :options="options.tags" 
                            :multiple="true" 
                            :close-on-select="false" 
                            :clear-on-select="false" 
                            :preserve-search="true" 
                            :preselect-first="true" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button class="btn btn-info" type="submit">Update</button>
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
                    tags: [],
                },
                picked: {
                    tags: []
                },
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                }
            }
        },
        mounted() { 
            this.$store.dispatch('tag/LIST').then(response => {
                this.options.tags = response;
            });
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('academy/SHOW', this.$route.params.id).then(response => {                    
                    this.data = response;
                    this.picked.tags= response.tags;
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
                this.data.file = this.$refs.file.files[0];
            },
            updateData() {
                this.data.tags = this.picked.tags.map(tag => tag.id);
                
                this.$store.dispatch('academy/UPDATE', this.data).then(response => {
                    this.getData();
                });
            }
        }
    }
</script>