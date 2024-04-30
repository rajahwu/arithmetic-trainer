import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Settings({ auth, type }: PageProps) {

  const [values, setValues] = useState({
    'problem_count': '',
    'category': '',
    'type': '',
  });

  function handleChange(e) {
    const key = e.target.id;
    const value = e.target.value;
    setValues(prevValues => ({
      ...prevValues,
      [key]: value,
    }));
  }

  const { data, setData, post, processing, errors } = useForm({
    'problem_count': '',
    'category': '',
    'type': type,
  });
  
  function submit(e) {
    e.preventDefault();
    post('/exercise/' + type + '/create/', values);
  }

  return (
    <AuthenticatedLayout 
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise: Define Practice</h2>}
    >
      <form onSubmit={submit}>
        <TextInput
          type="number"
          name="probem_count"
          value={data.probem_count}
          onChange={e => setData('problem_count', e.target.value)}
        />
        <input
          type="checkbox"
          values={values.category}
          checked={data.category === values.category}
          onChange={e => setData('category', e.target.checked)}
        />
        Core Arithmetic
        <input
          type="checkbox"
          checked={data.category === values.category}
          onChange={e => setData('category', e.target.checked)}
        />
        Intermediate Arithmetic
        <input
          type="checkbox"
          checked={data.category === values.category}
          onChange={e => setData('category', e.target.checked)}
        />
        Advanced Arithmetic
        <PrimaryButton type="submit" disabled={processing}>
          Continue
        </PrimaryButton>
      </form>
    </AuthenticatedLayout>
  );
}
