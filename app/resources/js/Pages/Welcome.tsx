import { Link, Head } from '@inertiajs/react';
import { PageProps } from '@/types';
import { FaGithub, FaLinkedin, FaDiscord  } from "react-icons/fa";

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
            <div className="flex flex-col mt-10">
                <header className="">
                    <nav className="flex flex-1 justify-center mx-auto uppercase">
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
                                    className="spline-sans-mono rounded-md px-3 py-2 text-2xl text-[#f19a3e] hover:text-white hover:bg-blue-700 hover:text-3xl ring-1 ring-transparent transition hover:text--[#f19a3e] focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="spline-sans-mono rounded-md px-3 py-2 text-2xl text-[#f19a3e] hover:text-whit ring-1 ring-transparent transition hover:text-black/70 hover:bg-blue-300 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>
                <main className="">
                    <div className="flex justify-center">
                        <img id="background" className="opacity-65 mx-auto" src={route('site-title')} />
                    </div>
                </main>
                <footer className="mono-title text-center text-white mx-auto">
                    <div className="flex gap-5">
                        <a 
                        href="https://github.com/rajahwu"
                        target="_blank"
                        >
                        <FaGithub 
                        color="#f19a3e"
                        size="2rem"
                        className="hover:size-10 hover:bg-blue-300 rounded ease-in-out"
                        />
                        </a>
                        <a
                        href="https://www.linkedin.com/in/vincent-radford-1a9599173/"
                        target="_blank"
                        >
                        <FaLinkedin 
                        color="#f19a3e"
                        size="2rem"
                        className="hover:size-10 hover:bg-blue-300 rounded ease-in-out"
                        />
                        </a>
                        <a 
                        href="https://discord.com/"
                        target="_blank"
                        className="hover:size-10 hover:bg-blue-300 rounded ease-in-out"
                            >
                        <FaDiscord 
                        color="#f19a3e"
                        size="2rem"
                        className="hover:size-10 hover:bg-blue-300 rounded ease-in-out"
                        />
                        </a>
                    </div>
                </footer>
            </div>
        </>
    );
}
