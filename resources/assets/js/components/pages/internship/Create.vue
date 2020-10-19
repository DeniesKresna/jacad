<template>
    <create-internship 
        title="Internship" 
        category="Jobhun Internship"
        module="blog/STORE" 
        :disabled="true" />
</template>

<script>
    import CreateInternship from '../../forms/blog/Create.vue';
    
    export default {
        components: {
            CreateInternship
        },
        data() {
            return {
                
            }
        }
    }
</script>