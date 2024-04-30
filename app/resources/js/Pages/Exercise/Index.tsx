import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Index() {

    const { data, setData, post, processing, errors } = useForm({
        'type': ''
      })
      

    const handleClick = (e) => {
        setData('type', e.target.value)
    } 

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/exercise/' + data['type'] + '/settings/');
    }
    return (
    <div>
        <form onSubmit={handleSubmit}>
            <div>
                <PrimaryButton className="p-5 m-2" type="button" name="practice" value="practice" onClick={handleClick}>practice</PrimaryButton>
                <PrimaryButton className="p-5 m-2" type="button" name="quiz" value="quiz" onClick={handleClick}>quiz</PrimaryButton>
                <PrimaryButton className="p-5 m-2" type="button" name="exam" value="exam" onClick={handleClick}>exam</PrimaryButton>
                <PrimaryButton className="p-5 m-2" type="button" name="assestment" value="assestment" onClick={handleClick}>assestment</PrimaryButton>
                </div>
            <PrimaryButton className="p-5 m-2" type="submit" value="Select" onClick={handleSubmit}>select</PrimaryButton>

            
        </form>

    </div>
    )
}