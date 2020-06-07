<template>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
                <li class="list-group-item"><router-link :to="'/'"><i class="glyphicon glyphicon-home"></i>Home </router-link></li>
                <li>
                  <a href="#demo3" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-edit"></i>Post  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo3">
                    <router-link :to="'/post'" class="list-group-item">Index</router-link>
                    <router-link :to="'/post/create'" class="list-group-item">Create</router-link>
                  </div>
                </li>
                <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th"></i>Category  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo4">
                    <router-link :to="'/category'" class="list-group-item">Index</router-link>
                    <router-link :to="'/category/create'" class="list-group-item">Create</router-link>
                  </div>
                </li>
              </ul>
          </div>
</template>
<script>
  export default{
    data(){
      return {

      }
    }
  }
</script>