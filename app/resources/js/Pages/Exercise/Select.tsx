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
        selected: {
            type: '',
            category: ''
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
            <div>
                <form onSubmit={handleSubmit}>
                    <div>
                        <div>
                            <p className="m-2 uppercase">Practice</p>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('practice,standard')}>
                                Standard Practice
                            </PrimaryButton>
                        </div>
                        <div>
                            <p className="m-2 uppercase">Assessments</p>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('assessment,quiz')}>
                                Quiz
                            </PrimaryButton>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('assessment,evaluation')}>
                                Evaluation
                            </PrimaryButton>
                            <PrimaryButton className="p-5 m-2" type="button" onClick={() => handleClick('assessment,exam')}>
                                Exam
                            </PrimaryButton>
                        </div>
                        <PrimaryButton className="p-5 m-2" type="submit">
                            Select
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
