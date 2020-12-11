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
                <a href="#sbusers" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-user"></i> Users  
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbusers">
                    <a href="#sbadmin" class="list-group-item" data-toggle="collapse">
                        Admin <span class="glyphicon glyphicon-admin"></span>
                    </a>
                    <a href="#sbcustomer" class="list-group-item" data-toggle="collapse">
                        Customer <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbcustomer">
                        <router-link :to="'/customer'" class="list-group-item">Index</router-link>
                    </div>
                    <a href="#sbmentor" class="list-group-item" data-toggle="collapse">
                        Mentor <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbmentor">
                        <router-link :to="'/mentor'" class="list-group-item">Index</router-link>
                        <router-link :to="'/mentor/create'" class="list-group-item">Create</router-link>
                    </div>
                </div>
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
                <a href="#sbservice" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-cloud"></i> Services  
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbservice">
                    <a href="#sbserviceacd" class="list-group-item" data-toggle="collapse">
                        Jobhun Academy <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbserviceacd">
                        <router-link :to="'/academy/opening'" class="list-group-item">Opening</router-link>
                        <router-link :to="'/academy'" class="list-group-item">Index</router-link>
                        <router-link :to="'/academy/create'" class="list-group-item">Create</router-link>
                        <a href="#sbacdperiod" class="list-group-item " data-toggle="collapse">
                            Academy Period <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                        <div class="collapse list-group-submenu" id="sbacdperiod">
                            <router-link :to="'/academy-period'" class="list-group-item">Index</router-link>
                            <router-link :to="'/academy-period/create'" class="list-group-item">Create</router-link>
                            <router-link :to="'/academy-period/customer'" class="list-group-item">Customers</router-link>
                        </div>
                    </div>
                    <a href="#sbserviceac" class="list-group-item" data-toggle="collapse">
                        Jobhun Ask Career <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbserviceac">
                        <router-link :to="'/ask-career/opening'" class="list-group-item">Opening</router-link>
                        <router-link :to="'/ask-career'" class="list-group-item">Index</router-link>
                        <router-link :to="'/ask-career/create'" class="list-group-item">Create</router-link>
                        <router-link :to="'/mentoring'" class="list-group-item">Mentoring</router-link>
                    </div>
                    <a href="#sbservicech" class="list-group-item" data-toggle="collapse">
                        Jobhun Career Hub <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbservicech">
                        <router-link :to="'/job/opening'" class="list-group-item">Opening</router-link>
                        <router-link :to="'/job'" class="list-group-item">Index</router-link>
                        <router-link :to="'/job-application'" class="list-group-item">Job Application</router-link>
                    </div>
                </div>
            </li>
            <li>
                <a href="#sbprogram" class="list-group-item " data-toggle="collapse">
                    <i class="glyphicon glyphicon-briefcase"></i> Program  
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <div class="collapse" id="sbprogram">
                    <a href="#sbprogramin" class="list-group-item" data-toggle="collapse">
                        Jobhun Internship <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramin">
                        <router-link :to="'/internship'" class="list-group-item">Index</router-link>
                        <router-link :to="'/internship/create'" class="list-group-item">Create</router-link>
                    </div>
                    <a href="#sbprogramtl" class="list-group-item" data-toggle="collapse">
                        Jobhun Talks <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramtl">
                        <router-link :to="'/talks'" class="list-group-item">Index</router-link>
                        <router-link :to="'/talks/create'" class="list-group-item">Create</router-link>
                    </div>
                    <a href="#sbprogramvi" class="list-group-item" data-toggle="collapse">
                        Jobhun Visit <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramvi">
                        <router-link :to="'/visit'" class="list-group-item">Index</router-link>
                        <router-link :to="'/visit/create'" class="list-group-item">Create</router-link>
                    </div>
                    <a href="#sbprogramsa" class="list-group-item" data-toggle="collapse">
                        Jobhun Student Ambassador <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <div class="collapse list-group-submenu" id="sbprogramsa">
                        <router-link :to="'/student-ambassador/opening'" class="list-group-item">Opening</router-link>
                        <router-link :to="'/student-ambassador'" class="list-group-item">Index</router-link>f
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>