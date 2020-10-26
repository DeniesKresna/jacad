<template>
    <edit-talks 
        title="Edit Talks" 
        :disabled="true" />
</template>

<script>
    import EditTalks from '../../forms/blog/Edit.vue';

    export default {
        components: {
            EditTalks
        }
    }
</script>