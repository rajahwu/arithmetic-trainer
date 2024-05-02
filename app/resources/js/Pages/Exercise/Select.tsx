import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Select({ auth }) {

    const { data, setData, post, processing, errors } = useForm({
        'selected': ''
    });
      
    const handleClick = (value) => {
        setData('selected', value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/exercise/settings/' + data.selected);
    };

    return (
        <AuthenticatedLayout 
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise</h2>}
        >
            <div>
                <form onSubmit={handleSubmit}>
                    <div>
                        <div>
                            <p className="m-2 uppercase">Practice</p>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('standard')}>
                                Standard Practice
                            </PrimaryButton>
                        </div>
                        <div>
                            <p className="m-2 uppercase">Assessments</p>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('quiz')}>
                                Quiz
                            </PrimaryButton>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('exam')}>
                                Exam
                            </PrimaryButton>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('assessment')}>
                                Assessment
                            </PrimaryButton>
                        </div>
                        <PrimaryButton className="p-5 m-2" type="submit" onClick={handleSubmit}>
                            Select
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
