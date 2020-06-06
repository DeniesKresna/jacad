<template>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>
                <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
                <li>
                  <a href="#demo3" class="list-group-item " data-toggle="collapse">Post  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo3">
                    <router-link :to="'/post'" class="list-group-item">Index</router-link>
                    <router-link :to="'/post/create'" class="list-group-item">Create</router-link>
                  </div>
                </li>
                <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse">Category  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo4">
                    <router-link :to="'/category'" class="list-group-item">Index</router-link>
                    <router-link :to="'/category/create'" class="list-group-item">Create</router-link>
                  </div>
                </li>
                <li>
                  <a href="#demo3" class="list-group-item " data-toggle="collapse">Item 3  <span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo3">
                    <a href="#SubMenu1" class="list-group-item" data-toggle="collapse">Subitem 1  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <div class="collapse list-group-submenu" id="SubMenu1">
                      <a href="#" class="list-group-item">Subitem 1 a</a>
                      <a href="#" class="list-group-item">Subitem 2 b</a>
                      <a href="#SubSubMenu1" class="list-group-item" data-toggle="collapse">Subitem 3 c <span class="glyphicon glyphicon-chevron-right"></span></a>
                      <div class="collapse list-group-submenu list-group-submenu-1" id="SubSubMenu1">
                        <a href="#" class="list-group-item">Sub sub item 1</a>
                        <a href="#" class="list-group-item">Sub sub item 2</a>
                      </div>
                      <a href="#" class="list-group-item">Subitem 4 d</a>
                    </div>
                    <a href="javascript:;" class="list-group-item">Subitem 2</a>
                    <a href="javascript:;" class="list-group-item">Subitem 3</a>
                  </div>
                </li>
                <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse">Item 4  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <li class="collapse" id="demo4">
                      <a href="" class="list-group-item">Subitem 1</a>
                      <a href="" class="list-group-item">Subitem 2</a>
                      <a href="" class="list-group-item">Subitem 3</a>
                    </li>
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