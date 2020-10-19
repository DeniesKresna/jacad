<template>
    <create-blog 
        title="Blog" 
        module="blog/STORE" />
</template>

<script>
    import CreateBlog from '../../forms/blog/Create.vue';

    export default {
        components: {
            CreateBlog
        }
    }
</script>