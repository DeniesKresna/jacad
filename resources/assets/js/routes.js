import { home } from './routes/home';
import { tag } from './routes/tag';
import { blog } from './routes/blog';
import { internship } from './routes/internship';
import { talks } from './routes/talks';
import { visit } from './routes/visit';
import { job } from './routes/job';
import { job_application } from './routes/job-application';
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
    ...student_ambassador
];

