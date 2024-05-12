import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import Button from '@/Components/Button';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Select({ auth }) {
    const { data, setData, post, processing, errors } = useForm({
        selected: {
            type: '', // (practice | assestment)
            category: '' // (standard | quiz | evaluation | exam)
        }
    });
    
    const handleClick = (value) => {
        const [type, category] = value.split(',');
        setData('selected', { type, category });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/exercise/settings/' + data.selected['type'] + '/' + data.selected['category'], {
            data: {
                selected: data.selected
            }
        });
    };

    return (
        <AuthenticatedLayout 
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise</h2>}
        >
            <div className="">
                <form  onSubmit={handleSubmit}>
                    <div className="flex gap-16">
                        <div>
                            <p className="m-2 uppercase text-white">Practice</p>
                            <Button buttonValue=" Standard" className="p-5 m-2" type="button" onClick={() => handleClick('practice,standard')} />
                        </div> 
                        <div>
                            <p className="m-2 uppercase text-white">Assessments</p>
                                <div className="flex gap-5 items-center">
                                <Button buttonValue="Quiz" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,quiz')} />
                                <Button buttonValue="Eval" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,evaluation')} />
                                <Button buttonValue="Exam" className="p-5 m-2" type="button" onClick={() => handleClick('assessment,exam')} />
                                </div>
                        </div>
                        <PrimaryButton buttonValue="Exam" className="p-5 m-2" type="submit">
                            Select
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
