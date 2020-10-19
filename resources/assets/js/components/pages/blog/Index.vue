<template>
    <table-blog 
        title="Blog"
        route="/blog/" />
</template>

<script>
    import TableBlog from '../../tables/blog/Index.vue';

    export default {
        components: {
            TableBlog
        }
    }
</script>