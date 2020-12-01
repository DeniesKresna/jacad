<template>
    <div class="content-row">
        <h2 class="content-row-title">Create Mentor</h2>
        <div class="row">
            <form
                class="form-horizontal"
                role="form"
                @submit.prevent="storeData">
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
                    <label class="col-md-2 control-label">Featured Image</label>
                    <div class="col-md-10">
                        <input 
                            type="file" 
                            id="file" 
                            ref="file" 
                            @change="handleFileUpload()">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Description</label>
                    <div class="col-md-10">
                        <vue-editor v-model="data.description" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">LinkedIn Profile</label>
                    <div class="col-md-10">
                        <input 
                            type="text" 
                            placeholder="LinkedIn Profile" 
                            class="form-control" 
                            v-model="data.linkedIn_url">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button class="btn btn-info" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor';
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            VueEditor, 
            Multiselect
        },
        data() {
            return {
                data: {
                    name: '',
                    description: '<p>Profesi:</p><p>Asal Perusahaan:</p><p>Bidang yang dikuasai:</p<p>Materi yang akan diajar dalam bentuk:</p><p>Latar belakang pendidikan:</p><p>Pengalaman:</p>',
                    linkedIn_url: '',
                    file: null
                }
            }
        },
        methods: {
            handleFileUpload() {
                this.data.file = this.$refs.file.files[0];
            },
            storeData() {
                this.$store.dispatch('mentor/STORE', this.data).then(response => {
                    this.data=  {
                        name: '',
                        description: '',
                        linkedIn_url: '',
                        file: null
                    }
                    this.$refs.file.value = '';
                });
            }
        }
    }
</script>