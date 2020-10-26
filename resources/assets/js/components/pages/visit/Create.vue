<template>
     <create 
        title="Create Visit" 
        category="Jobhun Visit"
        menu="Program" 
        :disabled="true" />
</template>

<script>
    import Create from '../../forms/blog/Create.vue';
    
    export default {
        components: {
            Create
        }
    }
</script>