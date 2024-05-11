import { SVGAttributes } from 'react';
import { Head, Link, usePage } from '@inertiajs/react';


export default function ApplicationLogo() {
    const { url } = usePage();
    console.log(url);
    const shouldAnimate = url === '/login';
    const isTransparent = url !== '/login' || url !== '/register';

    return (
        <div className={!isTransparent ? "bg-black backdrop-grayscale mt-3 rounded flex flex-col text-center text-white text-3xl" : ""}>
                <img
                height={!isTransparent ? 50 : 250}
                width={!isTransparent ? 50 : 250}
                src="/images/site-logo"
                className={`border-none object-cover object-fill ${
                    shouldAnimate ? 'animate-spin hover:animate-none ease-in-out' : ''
                }`}
                />
           {!isTransparent && <Link href="/" className="bg-black hover:text-rose-300">
                Arithmetic Trainer
            </Link>}
        </div>
    );
}
