<template>
     <create 
        title="Visit" 
        category="Jobhun Visit"
        module="blog/STORE" 
        :disabled="true" />
</template>

<script>
    import Create from '../../forms/blog/Create.vue';
    
    export default {
        components: {
            Create
        },
        data() {
            return {
                
            }
        }
    }
</script>