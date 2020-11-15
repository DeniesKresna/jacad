import JobApplicationIndex from '../components/pages/job-application/Index.vue';
import JobDetail from '../components/pages/job-application/JobDetail.vue';
import ApplicantDetail from '../components/pages/job-application/ApplicantDetail.vue';

export const job_application= [
    {
        name: 'ApplicationIndex',
        path: '/job-application',
        component: JobApplicationIndex
    },
    {
        name: 'JobDetail',
        path: '/job-application/job/:id',
        component: JobDetail
    },
    {
        name: 'ApplicantDetail',
        path: '/job-application/applicant/:id',
        component: ApplicantDetail
    },
];