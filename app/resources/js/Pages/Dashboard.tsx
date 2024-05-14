import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { PageProps } from '@/types';

export default function Dashboard({ auth, exerciseSessions }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="major-mono-display-regular text-white font-semibold text-2xl leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />
            <h1 className="spline-sans-mono uppercase p-3 text-xl text-[var(--primary-color)]">Practices</h1>
            {exerciseSessions.filter(session => session.type === 'practice').map(session => {
                const {id, title, start_time, is_completed, type } = session;
                return (
                    <>
                    <div className="">
                        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div className="bg-blue-500 my-2 text-white overflow-hidden shadow-sm sm:rounded-lg border-2">
                                <div className="spline-sans-mono  p-6 text-white text-lg uppercase ">
                                    <h2>{title}</h2>
                                    <span>session id: {id}</span>
                                    <span>{start_time}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </>

                )
            })}
        </AuthenticatedLayout>
    );
}
