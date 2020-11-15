<template>
    <div class="content-row">
        <h2 class="content-row-title">Create</h2>
        <form 
            novalidate="" 
            role="form" 
            class="form-horizontal" 
            @submit.prevent="storeData">
            <div class="form-group">
                <label class="col-md-2 control-label">Name</label>
                <div class="col-md-10">
                    <input 
                        type="text" 
                        required="" 
                        placeholder="Name" 
                        class="form-control" 
                        v-model="data.name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button class="btn btn-info" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                search: '',
                data:{
                    name:''
                }
            }
        },
        methods: {
            storeData(){
                this.$store.dispatch('tag/STORE', this.data).then(response => {
                    this.data = { 
                        name: '' 
                    };
                });
            }
        }
    }
</script>