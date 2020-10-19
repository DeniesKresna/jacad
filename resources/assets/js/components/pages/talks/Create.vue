<template>
     <create-talks
        title="Talks" 
        category="Jobhun Talks"
        module="blog/STORE" 
        :disabled="true" />
</template>

<script>
    import CreateTalks from '../../forms/blog/Create.vue';
    
    export default {
        components: {
            CreateTalks
        }
    }
</script>