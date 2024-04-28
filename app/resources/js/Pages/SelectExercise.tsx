import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";
import { PageProps } from '@/types';


export default function SelectExercise({ auth }: PageProps ) {

    const [values, setValues] = useState({
        'exericise_type': "",
    })

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...value,
            [key]: value,
        }))
    }

    const { data, setData, post, processing, errors } = useForm({
        'exericise_type': ''
      })
      
    function submit(e) {
        e.preventDefault()
        post('/exercise', values)
    }


    return (
        <AuthenticatedLayout 
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Select Exercise</h2>}
        >
            <form onSubmit={submit}>
                <input type="hidden" name="id" value={"1"} />
                <input type="checkbox" checked={data.exercise_type} onChange={e => setData('exercise_type', e.target.checked)} /> Core Arithmitic
                <PrimaryButton type="submit" disabled={processing}>Continue</PrimaryButton>
            </form>
        </AuthenticatedLayout>
    )
}