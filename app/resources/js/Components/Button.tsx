import { ButtonHTMLAttributes } from 'react';


export default function Button({ className = '', disabled, children, ...props }: ButtonHTMLAttributes<HTMLButtonElement>) {
    return (
        <ul className=""> 
            <li className="justify-center">
                <p className="">{props.buttonValue}</p>
                <button 
                    {...props}
                    className={`text-white justify-self-center bg-[var(--primary-color)] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 ${
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