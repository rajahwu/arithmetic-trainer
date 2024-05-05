import React from 'react';
import { useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";

export default function Settings({ auth, settings }: PageProps) {
  const { data, setData, post, processing } = useForm({
    'problem_count': '',
    'problem_levels': [],
    'problem_branches': [],
    'problem_types': [],
    'exercise_type': settings.exercise_type,
    'exercise_category': settings.exercise_category
  });

  const { exercise_type, exercise_category, problem_levels, problem_branches, problem_types } = settings;

  const handleChange = (e) => {
    const { name, value, checked } = e.target;
  
    // Check if data[name] is an array, initialize as empty array if not
    const newData = Array.isArray(data[name]) ? [...data[name]] : [];
  
    if (checked) {
      newData.push(value);
    } else {
      const index = newData.indexOf(value);
      if (index !== -1) {
        newData.splice(index, 1);
      }
    }
  
    setData(name, newData);
  };
  
  const handleSubmit = (e) => {
    e.preventDefault();
    post('/exercise/create/' + exercise_type + '/' + exercise_category);
  };

  return (
    <AuthenticatedLayout 
      user={auth.user}
      header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise: Define Practice</h2>}
    >
      <form onSubmit={handleSubmit}>
        <fieldset>
          <TextInput
            type="number"
            name="problem_count"
            value={data.problem_count}
            onChange={(e) => setData('problem_count', e.target.value)}
            />
        </fieldset>
        <fieldset>
          {problem_levels.map(level => (
            <label key={level.id}>
              <input
                type="checkbox"
                name="problem_levels"
                value={level.id}
                checked={data.problem_levels.includes(level.title)}
                onChange={handleChange}
                />
              {level.title}
            </label>
          ))}
        </fieldset>
        <fieldset>
          {problem_branches.map(branch => (
            <label key={branch.id}>
              <input
                type="checkbox"
                name="problem_branches"
                value={branch.id}
                checked={data.problem_branches.includes(branch.title)}
                onChange={handleChange}
                />
              {branch.title}
            </label>
          ))}
        </fieldset>
        <fieldset>
          {problem_types.map(type => (
            <label key={type.id}>
              <input
                type="checkbox"
                name="problem_types"
                value={type.id}
                checked={data.problem_types.includes(type.title)}
                onChange={handleChange}
                />
              {type.title}
            </label>
          ))}
        </fieldset>
        <PrimaryButton type="submit" disabled={processing}>
          Continue
        </PrimaryButton>
      </form>
    </AuthenticatedLayout>
  );
}
