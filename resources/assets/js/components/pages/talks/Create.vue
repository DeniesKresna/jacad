<template>
     <create-talks
        title="Create Talks" 
        category="Jobhun Talks"
        menu="Program"
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