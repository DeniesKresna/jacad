<template>
    <div class="content-row">
        <h2 class="content-row-title">Edit {{ title }}</h2>
        <div class="row">
            <form
                class="form-horizontal" 
                novalidate="" 
                role="form" 
                @submit.prevent="updateData">
                <div class="form-group">
                    <label class="col-md-2 control-label">Title</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            required="" 
                            placeholder="Title" 
                            class="form-control" 
                            v-model="data.title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="description">Featured Image</label>
                    <div class="col-md-10">
                        <span v-if="data.image_url">
                            <img :src="data.image_url" width="322">
                        </span>
                        <span v-else>
                            <input 
                                type="file" 
                                id="file" 
                                ref="file" 
                                @change="handleFileUpload()">
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="description">Content</label>
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
                    <label class="col-md-2 control-label" for="description">Categories</label>
                    <div class="col-md-10">
                        <v-select 
                            placeholder="Pick some"
                            label="name"
                            track-by="id"
                            v-model="picked.category" 
                            :options="options.categories" 
                            :disabled="disabled" />
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
                        <button class="btn btn-info" type="submit">Submit</button>
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
        props: [
            'title',
            'module',
            'disabled'
        ],
        data() {
            return {
                data: {},
                options: {
                    categories: [],
                    tags: [],
                },
                picked: {
                    category: 0,
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
            this.$store.dispatch('category/LIST').then(response => {
                this.options.categories = response;
            });
            this.$store.dispatch('tag/LIST').then(response => {
                this.options.tags = response;
            });
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('blog/SHOW', this.$route.params.id).then(response => {
                    this.data = response;
                    this.picked.category= response.category;
                    this.picked.tags= response.tags;
                });
            },
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                // An example of using FormData
                // NOTE: Your key could be different such as:
                // formData.append('file', file)
                
                var formData = new FormData();

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
            updateData() {
                this.data.id = this.$route.params.id;
                this.data.category= this.picked.category.id;
                this.data.tags = this.picked.tags.map(tag => tag.id);
                
                this.$store.dispatch(this.module, this.data).then(response => {
                    this.getData();
                });
            }
        }
    }
</script>