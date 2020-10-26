<template>
    <edit-visit 
        title="Edit Visit" 
        :disabled="true" />
</template>

<script>
    import EditVisit from '../../forms/blog/Edit.vue';

    export default {
        components: {
            EditVisit
        }    
    }
</script>