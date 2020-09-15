<template>
  <div class="content-row">
    <h2 class="content-row-title">Index</h2>
    <div class="row">
      <div class="col-md-5">
        <input type="text" class="form-control" v-model="search" placeholder="Search then type Enter" @keyup.enter="getResults(1)">
      </div>
      <div class="col-md-5"></div>
      <div class="col-md-2">
        <button type="button" class="btn btn-default btn-block"><router-link :to="'/post/create'">Create</router-link></button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" v-if="result.data.length > 0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th><th>Title</th><th>Author</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-bind:key="index"
                  v-for="(item,index) in result.data">
                <td>{{index + (result.from)}}</td><td>{{item.title}}</td><td>{{item.author.name}}</td>
                <td><router-link :to="'/post/' + item.id"><span class="fa fa-pencil-square-o"></span></router-link>&nbsp<a href="javascript:void(0)" @click="destroyData(item.id, item.title)"><span class="fa fa-trash-o"></span></a>&nbsp<a :href="item.url" target="_blank"><span class="fa fa-eye"></span></a></td>
              </tr>
            </tbody>
          </table>
          <paginate
            :page-count="result.last_page"
            :click-handler="getResults"
            :prev-text="'Prev'"
            :next-text="'Next'"
            :container-class="'pagination'">
          </paginate>
        </div>
      </div>
      <div v-else>
        <div class="col-md-12">
          <p>no data yet</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default{
    data(){
      return{
        search: '',
        result: {
          data: []
        }
      }
    },
    mounted(){
      this.getResults(1);
    },
    methods: {
      getResults(page=1){
        let stringQuery = "page="+page+"&search="+this.search;
        this.$store.dispatch('post/INDEX', stringQuery).then(response=>{
          this.result = response;
        });
      },
      destroyData(id, title){
        if(confirm("Are you sure delete post : "+title + " ?")){
          this.$store.dispatch('post/DESTROY', id).then(response=>{
            this.getResults(this.result.current_page);
          });
        }
      }
    }
  }
</script>