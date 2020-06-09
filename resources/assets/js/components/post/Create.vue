<template>
  <div class="content-row">
    <h2 class="content-row-title">Create</h2>
    <div class="row">
      <form novalidate="" role="form" class="form-horizontal" @submit.prevent="storeData">
        <div class="form-group">
          <label class="col-md-2 control-label">Title</label>
          <div class="col-md-10">
            <input type="text" required="" placeholder="Title" class="form-control" v-model="data.title">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="description">Featured Image</label>
          <div class="col-md-10">
            <input type="file" id="file" ref="file" @change="handleFileUpload()">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="description">Content</label>
          <div class="col-md-10">
            <vue-editor useCustomImageHandler :editorOptions="editorSettings" @image-added="handleImageAdded" v-model="data.content"></vue-editor>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="description">Categories</label>
          <div class="col-md-10">
            <multiselect v-model="data.categories_objects" :options="options" :multiple="true" :close-on-select="false" :clear-on-select="false" :preserve-search="true" placeholder="Pick some" label="name" track-by="name" :preselect-first="true" />
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
  import { VueEditor, Quill } from 'vue2-editor'
  import ImageResize from '../../plugins/quill-fix-error/image-resize.min.js'
  import Multiselect from 'vue-multiselect'

  Quill.register('modules/imageResize', ImageResize)
  export default{
    components: {
      VueEditor, Multiselect
    },
    data(){
      return{
        data: {title: '', content: "", categories_objects: [], categories: [], file: null},
        options: [],
        editorSettings: {
          modules: {
            imageResize: {}
          }
        }
      }
    },
    mounted(){
      this.$store.dispatch('category/LIST').then(response=>{
        this.options = response;
      });
    },
    methods: {
        handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
        // An example of using FormData
        // NOTE: Your key could be different such as:
        // formData.append('file', file)
        
        var formData = new FormData();
        formData.append("image", file);
   
        axios({
          url: "http://localhost:280/jacad/public/api/v1/admin/medias",
          method: "POST",
          data: formData
        })
          .then(result => {
            let url = result.data.url; // Get url from response
            Editor.insertEmbed(cursorLocation, "image", url);
            resetUploader();
          });
      },
      handleFileUpload(){
        this.data.file = this.$refs.file.files[0];
      },
      storeData(){
        this.data.categories = this.data.categories_objects.map(a => a.id);
        this.$store.dispatch('post/STORE', this.data).then(response=>{
          this.data = {title: '', content: "", categories_objects: [], categories: [], file: null};
          this.$refs.file.value = "";
        });
      }
    }
  }
</script>