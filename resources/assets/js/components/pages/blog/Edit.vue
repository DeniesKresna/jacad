<template>
    <edit-blog 
        title="Blog" 
        module="blog/UPDATE" />
</template>

<script>
    import EditBlog from '../../forms/blog/Edit.vue';
    
    export default {
        components: {
            EditBlog
        }
    }
</script>