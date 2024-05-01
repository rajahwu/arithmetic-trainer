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
      })
      

    const handleClick = (e) => {
        setData('selected', e.target.value)
    } 

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/exercise/settings/' + data['selected']);
    }
    return (
        <AuthenticatedLayout 
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise</h2>}
        >
    <div>
        <form onSubmit={handleSubmit}>
            <div>
                <div>
                    <p className="m-2 uppercase">practice</p>
                <PrimaryButton className="p-5 m-2" type="button" name="practice" value="practice" onClick={handleClick}>standard</PrimaryButton>
                </div>
                <div>
                    <p className="m-2 uppercase">assestments</p>
                    <PrimaryButton className="p-5 m-2" type="button" name="quiz" value="quiz" onClick={handleClick}>quiz</PrimaryButton>
                    <PrimaryButton className="p-5 m-2" type="button" name="exam" value="exam" onClick={handleClick}>exam</PrimaryButton>
                    <PrimaryButton className="p-5 m-2" type="button" name="evaluation" value="evaluation" onClick={handleClick}>assestment</PrimaryButton>
                </div>
                <PrimaryButton className="p-5 m-2" type="submit" value="Select" onClick={handleSubmit}>select</PrimaryButton>
            </div>

            
        </form>

    </div>
    </AuthenticatedLayout>
    )
}