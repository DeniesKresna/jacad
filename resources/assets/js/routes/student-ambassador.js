import StudentAmbassadorOpening from '../components/pages/student-ambassador/Opening.vue';
import StudentAmbassadorIndex from '../components/pages/student-ambassador/Index.vue';

export const student_ambassador= [
    {
        name: 'StudentAmbassadorOpening',
        path: '/student-ambassador/opening',
        component: StudentAmbassadorOpening
    },
    {
        name: 'StudentAmbassadorIndex',
        path: '/student-ambassador',
        component: StudentAmbassadorIndex
    }
];

export default student_ambassador;