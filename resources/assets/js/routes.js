import { home } from './routes/home';
import { customer } from './routes/customer';
import { mentor } from './routes/mentor';
import { tag } from './routes/tag';
import { blog } from './routes/blog';
import { internship } from './routes/internship';
import { talks } from './routes/talks';
import { visit } from './routes/visit';
import { academy } from './routes/academy';
import { academy_period } from './routes/academy-period';
import { ask_career } from './routes/ask-career';
import { mentoring } from './routes/mentoring';
import { job } from './routes/job';
import { job_application } from './routes/job-application';
import { student_ambassador } from './routes/student-ambassador';

export const routes = [
    ...home,
    ...customer,
    ...mentor, 
    ...tag,
    ...blog,
    ...internship,
    ...talks,
    ...visit,
    ...academy,
    ...academy_period,
    ...ask_career,
    ...mentoring,
    ...job,
    ...job_application,
    ...student_ambassador
];

