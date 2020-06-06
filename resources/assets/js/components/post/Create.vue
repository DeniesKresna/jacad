<template>
  <div class="content-row">
    <h2 class="content-row-title">Create</h2>
    <div class="row">
      <form novalidate="" role="form" class="form-horizontal" @submit.prevent>
        <div class="form-group">
          <label class="col-md-2 control-label">Title</label>
          <div class="col-md-10">
            <input type="text" required="" placeholder="Title" class="form-control" v-model="data.title">
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-2 control-label" for="description">Content</label>
          <div class="col-md-10">
            <vue-editor useCustomImageHandler :editorOptions="editorSettings" @image-added="handleImageAdded" v-model="htmlForEditor"></vue-editor>
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

  Quill.register('modules/imageResize', ImageResize)
  export default{
    components: {
      VueEditor
    },
    data(){
      return{
        data: {title: ''},
        htmlForEditor: "",
        editorSettings: {
          modules: {
            imageResize: {}
          }
        }
      }
    },
    mounted(){
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
      storeData(){
        this.$store.dispatch('post/STORE', this.data).then(response=>{
          this.data = {title: '', content: ''};
        });
      }
    }
  }
</script>