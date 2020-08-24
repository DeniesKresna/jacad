<template>
  <div class="content-row">
    <h2 class="content-row-title">Index</h2>
    <div class="row">
      <div class="col-md-5">
        <input type="text" class="form-control" v-model="search" placeholder="Search then type Enter" @keyup.enter="getResults(1)">
      </div>
      <div class="col-md-5"></div>
      <div class="col-md-2">
        <button type="button" class="btn btn-default btn-block"><router-link :to="'/category/create'">Create</router-link></button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" v-if="result.data.length > 0">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th><th>Name</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item,index) in result.data">
                <td>{{index + (result.from)}}</td><td>{{item.name}}</td><td></td>
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
        this.$store.dispatch('job/INDEX', stringQuery).then(response=>{
          this.result = response;
        });
      }
    }
  }
</script>