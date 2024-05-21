import { ButtonHTMLAttributes } from 'react';


export default function Button({ className = '', disabled, children, ...props }: ButtonHTMLAttributes<HTMLButtonElement>) {
    return (
        <ul className=""> 
            <li className="justify-center">
                <p className="">{props.buttonvalue}</p>
                <button 
                    {...props}
                    className={`text-white border-4 justify-self-center bg-[var(--primary-color)] hover:border-[#b0db43] font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 ${
                        disabled && 'opacity-25'
                    } ` + className
                }
                    disabled={disabled}
                    >
                    {children}
                </button>
            </li>
        </ul>
    );
}