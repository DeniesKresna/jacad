import ApplicationIndex from '../components/pages/job-application/Index.vue';
import JobDetail from '../components/pages/job-application/JobDetail.vue';
import ApplicantDetail from '../components/pages/job-application/ApplicantDetail.vue';

export const job_application= [
    {
        name: 'ApplicationIndex',
        path: '/applications',
        component: ApplicationIndex
    },
    {
        name: 'JobDetail',
        path: '/applications/job/:id',
        component: JobDetail
    },
    {
        name: 'ApplicantDetail',
        path: '/applications/applicant/:id',
        component: ApplicantDetail
    },
];