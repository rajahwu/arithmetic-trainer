import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function Guest({ children }: PropsWithChildren) {
    return (
        <div className="bg-blue-700 content min-h-screen flex flex-col sm:justify-center items-center sm:pt-0">
            <div>
                <ApplicationLogo className="" />
            </div>
            <Link 
            href="/"
            className="major-mono-display-regular text-3xl my-5"
            >
                Arithmetic Trainer</Link>
            <div className="border bg-blue-700 text-white w-full sm:max-w-md px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
