<template>
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
        <ul class="list-group panel">
            <li class="list-group-item">
                <i class="glyphicon glyphicon-align-justify"></i> 
                <b>SIDE PANEL</b>
            </li>
            <li class="list-group-item">
                <input type="text" class="form-control search-query" placeholder="Search Something">
            </li>
            <li class="list-group-item">
                <router-link :to="'/'">
                    <i class="glyphicon glyphicon-home"></i> Home 
                </router-link>
            </li>
            <li>
                <a href="#sbpost" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-edit"></i> Blogs 
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbpost">
                    <router-link :to="'/blog'" class="list-group-item">Index</router-link>
                    <router-link :to="'/blog/create'" class="list-group-item">Create</router-link>
                </div>
            </li>
            <li>
                <a href="#sbcategory" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-th"></i> Tags  
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbcategory">
                    <router-link :to="'/tag'" class="list-group-item">Index</router-link>
                    <router-link :to="'/tag/create'" class="list-group-item">Create</router-link>
                </div>
            </li>
            <li>
                <a href="#sbservice" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-cloud"></i>Services  <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <div class="collapse" id="sbservice">
                    <a href="#sbservicech" class="list-group-item" data-toggle="collapse">
                        Jobhun Career Hub
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbservicech">
                        <!--<router-link :to="'/job'" class="list-group-item">Index</router-link>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>-->
                        <router-link :to="'/job/'" class="list-group-item">Index</router-link>
                        <!--<a href="#" class="list-group-item">Create</a>-->
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                    <a href="#sbserviceac" class="list-group-item" data-toggle="collapse">
                        Jobhun Academy
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbserviceac">
                        <a href="#" class="list-group-item">Index</a>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                    <a href="#sbservicetp" class="list-group-item" data-toggle="collapse">
                        Jobhun Talent Pool
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbservicetp">
                        <a href="#" class="list-group-item">Index</a>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                </div>
            </li>
            <li>
                <a href="#sbprogram" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-briefcase"></i>Program  
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbprogram">
                    <a href="#sbprogramin" class="list-group-item" data-toggle="collapse">
                        Jobhun Internship
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramin">
                        <a href="#" class="list-group-item">Index</a>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                    <a href="#sbprogramtl" class="list-group-item" data-toggle="collapse">
                        Jobhun Talks 
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramtl">
                        <a href="#" class="list-group-item">Index</a>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                    <a href="#sbprogramvi" class="list-group-item" data-toggle="collapse">
                        Jobhun Visit
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramvi">
                        <a href="#" class="list-group-item">Index</a>
                        <a href="#" class="list-group-item">Create</a>
                        <a href="#" class="list-group-item">Report</a>
                    </div>
                     <a href="#sbprogramsa" class="list-group-item" data-toggle="collapse">
                        Jobhun Student Ambassador
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramsa">
                        <router-link :to="'/studentAmbassador/'" class="list-group-item">Index</router-link>
                    </div>
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