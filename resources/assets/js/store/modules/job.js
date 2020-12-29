import axios from 'axios';

const job= {
    namespaced: true,
    state: {
        jobs: []
    },
    getters: {
        jobs: (state) => {
            return state.jobs;
        }
    }, 
    mutations: {

    },
    actions: {
        INDEX({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/jobs?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        SHOW({ comit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/jobs/${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        UPDATE({ commit }, payload) {
            return new Promise((resolve, reject) => {
                let formData = new FormData();

                //COMPANY
                formData.append('company', JSON.stringify({
                    id: payload.company.id,
                    name: payload.company.name,
                    tagline: payload.company.tagline,
                    information: payload.company.information,
                    address: payload.company.address,
                    site_url: payload.company.site_url,
                    email: payload.company.email,
                    phone: payload.company.phone,
                    employee_amount: payload.company.employee_amount
                }));

                //FILE
                formData.append('company_logo', payload.file);

                //JOB
                formData.append('job', JSON.stringify({
                    position: payload.position,
                    sectors: payload.sectors,
                    type: payload.type,
                    job_desc: payload.job_desc,
                    location: payload.location,
                    work_time: payload.work_time,
                    dress_style: payload.dress_style,
                    language: payload.language,
                    facility: payload.facility,
                    salary: payload.salary,
                    how_to_send: payload.how_to_send,
                    expired: payload.expired,
                    process_time: payload.process_time,
                    jobhun_info: payload.jobhun_info
                }));
                
                axios.post('/admin/jobs/update/' + payload.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    resolve(response.data);
                });
            });
        },
        
        DESTROY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/admin/jobs/${payload}`).then(response => {
                    resolve(response.data)
                });
            })
        },

        VERIFY({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.put(`/admin/jobs/verify/${payload.id}`, `action=${payload.action}`).then(response => {
                    resolve(response.data);
                });
            });
        },

        APPLICANTS({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios.get(`/admin/job-applicants?page_size=10&${payload}`).then(response => {
                    resolve(response.data);
                });
            });
        }
    }
};

export default job;