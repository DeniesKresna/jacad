<template>
    <div class="content-row">
        <h2 class="content-row-title">Create Academy Period</h2>
        <form
            class="form-horizontal"
            role="form"
            @submit.prevent="storeData">
            <div class="form-group">
                <label class="col-md-2 control-label">Period</label>
                <div class="col-md-10">
                    <input 
                        type="date" 
                        class="form-control" 
                        v-model="data.period">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Price</label>
                <div class="col-md-10">
                    <input 
                        type="number" 
                        min="0"
                        class="form-control" 
                        v-model="data.price">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Description</label>
                <div class="col-md-10">
                    <textarea 
                        class="form-control"
                        rows="5" 
                        v-model="data.description" >
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Academy</label>
                <div class="col-md-10">
                    <v-select 
                        placeholder="Pick some"
                        label="name"
                        track-by="id"
                        v-model="picked.academy" 
                        :options="options.academies" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Mentors</label>
                <div class="col-md-10">
                    <multiselect 
                        placeholder="Pick some" 
                        label="name" 
                        track-by="id" 
                        v-model="picked.mentors" 
                        :options="options.mentors" 
                        :multiple="true" 
                        :close-on-select="false" 
                        :clear-on-select="false" 
                        :preserve-search="true" 
                        :preselect-first="true" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button class="btn btn-info" type="submit">Create</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        components: {
            Multiselect
        },
        data() {
            return {
                data: {
                    period: '',
                    price: 0,
                    description: '',
                    academy_id: 0,
                    mentors: []
                },
                options: {
                    academies: [],
                    mentors: []
                },
                picked: {
                    academy: null,
                    mentors: []
                }
            }
        },
        mounted() {
            this.$store.dispatch('academy/LIST').then(response => {
                this.options.academies= response;
                this.picked.academy= response[0];
            });
            this.$store.dispatch('mentor/LIST').then(response => {
                this.options.mentors= response;
            });
        },
        methods: {
            storeData() {
                this.data.academy_id= this.picked.academy.id;
                this.data.mentors= this.picked.mentors.map(mentor => mentor.id);

                this.$store.dispatch('academy_period/STORE', this.data).then(response => {
                    this.data= {
                        period: '',
                        price: 0,
                        description: '',
                        academy_id: 0,
                        mentors: []
                    };
                    this.picked= {
                        academy: null,
                        mentors: []
                    }
                });
            }
        }
    }
</script>