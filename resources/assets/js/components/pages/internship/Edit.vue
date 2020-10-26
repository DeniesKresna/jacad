<template>
    <edit-internship 
        title="Edit Internship" 
        :disabled="true" />
</template>

<script>
    import EditInternship from '../../forms/blog/Edit.vue';

    export default {
        components: {
            EditInternship
        }
    }
</script>