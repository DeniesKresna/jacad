import MentoringIndex from '../components/pages/mentoring/Index.vue';
import MentoringEdit from '../components/pages/mentoring/Edit.vue';
import MentoringDetail from '../components/pages/mentoring/Detail.vue';

export const mentoring= [
    {
        name: 'MentoringIndex',
        path: '/mentoring',
        component: MentoringIndex
    },
    {
        name: 'MentoringEdit',
        path: '/mentoring/edit/:id',
        component: MentoringEdit
    },
    {
        name: 'MentoringDetail',
        path: '/mentoring/:id',
        component: MentoringDetail
    }
];