import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import { PageProps } from '@/types';



export default function Progress({ auth }: PageProps) {
    
   return (
    <AuthenticatedLayout 
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Progress</h2>}
    >
        <Head title="Progress" />
        <h1>Progress</h1>
    </AuthenticatedLayout>

   ) 

}