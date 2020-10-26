<template>
    <table-blog 
        title="Index Blog"
        menu="Blog"
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