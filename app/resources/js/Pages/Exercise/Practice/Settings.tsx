import React from 'react';
import { useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";

export default function Settings({ auth, selected, categories }: PageProps) {
  const { data, setData, post, processing } = useForm({
    'problem_count': '',
    'categories': [],
  });
  
  const handleChange = (e) => {
    const { name, value, checked } = e.target;
    if (checked) {
      setData('categories', [...data.categories, value]);
    } else {
      setData('categories', data.categories.filter(cat => cat !== value));
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    post('/exercise/create/' + selected);
  };

  return (
    <AuthenticatedLayout 
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise: Define Practice</h2>}
    >
      <form onSubmit={handleSubmit}>
        <TextInput
          type="number"
          name="problem_count"
          value={data.problem_count}
          onChange={(e) => setData('problem_count', e.target.value)}
        />
        {categories.map(category => (
          <label key={category.id}>
            <input
              type="checkbox"
              name="category"
              value={category.title}
              checked={data.categories.includes(category.title)}
              onChange={handleChange}
            />
            {category.title}
          </label>
        ))}
        <PrimaryButton type="submit" disabled={processing}>
          Continue
        </PrimaryButton>
      </form>
    </AuthenticatedLayout>
  );
}
