import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import Dropdown from "@/Components/Dropdown";

export default function Settings({ auth, selected }: PageProps) {

  const [values, setValues] = useState({
    'problem_count': '',
    'categories': [],
  });

  function handleChange(e) {
    const { name, value, checked } = e.target;
    if (name === 'category') {
      const updatedCategories = checked
        ? [...values.categories, value]
        : values.categories.filter(cat => cat !== value);
      setValues(prevValues => ({
        ...prevValues,
        categories: updatedCategories,
      }));
    } else {
      setValues(prevValues => ({
        ...prevValues,
        [name]: value,
      }));
    }
  }

  const { data, setData, post, processing, errors } = useForm({
    'problem_count': '',
    'categories': [],
  });
  
  function submit(e) {
    e.preventDefault();
    post('/exercise/create/' + selected, values);
  }

  return (
    <AuthenticatedLayout 
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise: Define Practice</h2>}
    >
      <form onSubmit={submit}>
        <TextInput
          type="number"
          name="problem_count"
          value={data.problem_count}
          onChange={e => setData('problem_count', e.target.value)}
        />
        <label>
          <input
            type="checkbox"
            name="category"
            value="core"
            checked={values.categories.includes('core')}
            onChange={handleChange}
          />
          Core Arithmetic
        </label>
        <label>
          <input
            type="checkbox"
            name="category"
            value="intermediate"
            checked={values.categories.includes('intermediate')}
            onChange={handleChange}
          />
          Intermediate Arithmetic
        </label>
        <label>
          <input
            type="checkbox"
            name="category"
            value="advanced"
            checked={values.categories.includes('advanced')}
            onChange={handleChange}
          />
          Advanced Arithmetic
        </label>
        <PrimaryButton type="submit" disabled={processing}>
          Continue
        </PrimaryButton>
      </form>
    </AuthenticatedLayout>
  );
}
