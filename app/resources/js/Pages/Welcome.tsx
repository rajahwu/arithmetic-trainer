import { Link, Head } from '@inertiajs/react';
import { PageProps } from '@/types';

export default function Welcome({ auth, laravelVersion, phpVersion }: PageProps<{ laravelVersion: string, phpVersion: string }>) {
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    return (
        <>
            <Head title="Welcome" />
            <div className="bg-blue-800 text-white"> 
                <div className=" text-blue-500 relative min-h-screen mx-auto selection:bg-[#FF2D20] selection:text-white">
                    <div className="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <div className="text-center text-sm-[rgb(59 130 246)] text-white mx-auto">
                            github linkedin twitter
                    </div>
                        <header className="">
                            <div className="flex justify-center lg:col-start-2">
                                <img id="background" className="absolute opacity-65 mx-auto" src={route('site-title')} />
                            </div>
                            <nav className="flex flex-1 justify-center mx-auto">
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-[#f19a3e] focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Dashboard
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href={route('login')}
                                            className="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text--[#f19a3e] focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            className="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Register
                                        </Link>
                                    </>
                                )}
                            </nav>
                        </header>

                        <main className="mt-6">
                            <div className="grid gap-6 lg:grid-cols-2 lg:gap-8">
                              {/* <h1 className="text-5xl">Arithmitic Trainer</h1> */}
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </>
    );
}
