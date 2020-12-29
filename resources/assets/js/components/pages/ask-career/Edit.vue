<template>
    <div class="content-row">
        <h2 class="content-row-title">Edit Ask Career</h2>
        <form 
            class="form-horizontal"
            role="form"
            @submit.prevent="updateData">
            <div class="form-group">
                <label class="col-md-2 control-label">Name</label>
                <div class="col-md-10">
                    <input 
                        type="text" 
                        placeholder="Name" 
                        class="form-control" 
                        v-model="data.name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Schedule</label>
                <div class="col-md-10">
                    <vue-editor v-model="data.schedule"></vue-editor>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Price</label>
                <div class="col-md-10">
                    <input 
                        type="number"
                        min="0" 
                        placeholder="Price" 
                        class="form-control" 
                        v-model="data.price">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mentor</label>
                <div class="col-md-10">
                    <v-select 
                        placeholder="Pick some"
                        label="name"
                        track-by="id"
                        v-model="picked.mentor" 
                        :options="options.mentors" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script> 
    import { VueEditor } from 'vue2-editor';

    export default {
        components: {
            VueEditor, 
        },
        data() {
            return {
                data: {},
                options: {
                    mentors: []
                },
                picked: {
                    mentor: 0
                }
            }
        },
        mounted() {
            this.$store.dispatch('mentor/LIST').then(response => {
                this.options.mentors= response;
            });
            this.getData();
        },
        methods: {
            getData() {
                this.$store.dispatch('ask_career/SHOW', this.$route.params.id).then(response => {
                    this.data= response;
                    this.picked.mentor= this.data.mentor;
                });
            },
            updateData() {
                if (confirm(`Are you sure want to update ask career: "${this.data.name}"?`)) {
                    this.data.id= this.$route.params.id;
                    this.data.mentor= this.picked.mentor.id;

                    this.$store.dispatch('ask_career/UPDATE', this.data).then(response => {
                        this.getData();
                    });
                }
            }
        }
    }
</script>