<template>
    <div class="content-row">
        <h2 class="content-row-title">{{ title }}</h2>
        <form 
            class="form-horizontal" 
            role="form" 
            @submit.prevent="storeData">
            <div class="form-group">
                <label class="col-md-2 control-label">Title</label>
                <div class="col-md-10">
                    <input 
                        type="text" 
                        placeholder="Title" 
                        class="form-control" 
                        v-model="data.title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Featured Image</label>
                <div class="col-md-10">
                    <input 
                        type="file" 
                        ref="file" 
                        @change="handleFileUpload()">
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
                <label class="col-md-2 control-label">Category</label>
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
                <label class="col-md-2 control-label">Tags</label>
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
                    <button class="btn btn-info" type="submit">Create</button>
                </div>
            </div>
        </form>
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
            'category',
            'menu',
            'disabled'
        ],
        data() {
            return {
                data: {
                    title: '', 
                    content: '',
                    category_id: 0,  
                    tags: [], 
                    file: null
                },
                options: {
                    categories: [],
                    tags: []
                },
                picked: {
                    category: null,
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
            let query= '';

            if (this.menu) {
                query= `menu=${this.menu}`;
            }

            if (this.category) {
                query+= `&name=${this.category}`;
            }

            this.$store.dispatch('category/LIST', query).then(response => {
                this.options.categories= response;
                this.picked.category= response[0];
            });
            this.$store.dispatch('tag/LIST').then(response => {
                this.options.tags = response;
            });
        },
        methods: {
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
                this.data.image = this.$refs.file.files[0];
            },
            storeData() {
                this.data.category_id= this.picked.category.id;
                this.data.tags = this.picked.tags.map(tag => tag.id);
                
                this.$store.dispatch('blog/STORE', this.data).then(response => {
                    this.data = {
                        title: '', 
                        content: '',
                        category_id: 0,  
                        tags: [], 
                        file: null
                    };
                    this.picked= {
                        category: null,
                        tags: []
                    }
                    this.$refs.file.value = '';
                });
            }
        }
    }
</script>