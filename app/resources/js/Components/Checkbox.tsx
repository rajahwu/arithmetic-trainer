import { InputHTMLAttributes } from 'react';

export default function Checkbox({ className = '', ...props }: InputHTMLAttributes<HTMLInputElement>) {
    return (
        <input
            {...props}
            type="checkbox"
            className={
                'rounded border-gray-300 shadow-sm focus:ring-indigo-500 ' +
                (props.checked ? 'ring-2 ring-offset-2 ring-black bg-black text-black' : '') +
                className
            }
        />
    );
}
