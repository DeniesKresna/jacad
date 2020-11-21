import { home } from './routes/home';
import { tag } from './routes/tag';
import { blog } from './routes/blog';
import { internship } from './routes/internship';
import { talks } from './routes/talks';
import { visit } from './routes/visit';
import { job } from './routes/job';
import { job_application } from './routes/job-application';
import { academy } from './routes/academy';
import { academy_registrant } from './routes/academy-registrant';
import { student_ambassador } from './routes/student-ambassador';

export const routes = [
    ...home,
    ...tag,
    ...blog,
    ...internship,
    ...talks,
    ...visit,
    ...job,
    ...job_application,
    ...academy,
    ...academy_registrant,
    ...student_ambassador
];

