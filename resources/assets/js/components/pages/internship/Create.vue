<template>
    <create-internship 
        title="Create Internship" 
        category="Jobhun Internship"
        menu="Program"
        :disabled="true" />
</template>

<script>
    import CreateInternship from '../../forms/blog/Create.vue';
    
    export default {
        components: {
            CreateInternship
        }
    }
</script>