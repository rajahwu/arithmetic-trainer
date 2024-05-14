import React from 'react';
import { useForm } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { PageProps } from '@/types';
import PrimaryButton from '@/Components/PrimaryButton';
import NumberInput from '@/Components/NumberInput';
import Checkbox from '@/Components/Checkbox';
import CheckboxFieldSet from '@/Components/CheckboxFieldSet';
import NumberProblemsInputFieldSet from '@/Components/NumberProblemsInputFieldSet';
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
    console.log({name, value, checked});
  
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

    setData(name, newData); // Update the state
    console.log({data}); // Log the current state
};
  
  const handleSubmit = (e) => {
    e.preventDefault();
    post('/exercise/create/' + exercise_type + '/' + exercise_category);
  };

  return (
    <AuthenticatedLayout 
      user={auth.user}
      header={<h2 className="major-mono-display-regular text-white font-semibold text-2xl">Exercise: Define Practice</h2>}
    >
      <form className="major-mono-display-regular text-white text-sm" onSubmit={handleSubmit}>
        <div className="flex flex-col">
          <CheckboxFieldSet
            heading="Select Level"
            name="problem_levels"
            checkboxData={problem_levels}
            handleChange={handleChange} 
            />

          <CheckboxFieldSet
            heading="Select Branches"
            name="problem_branches"
            checkboxData={problem_branches}
            handleChange={handleChange} 
            />

          <CheckboxFieldSet
            heading="Select Problem Types"
            name="problem_types"
            checkboxData={problem_types}
            handleChange={handleChange} 
            />

            
          <NumberProblemsInputFieldSet
            heading="No. of problems"
            value={data.problem_count}
            onChange={(e) => setData('problem_count', e.target.value)}
          />
        
        </div>
        <PrimaryButton type="submit" disabled={processing}>
          Continue
        </PrimaryButton>
      </form>
    </AuthenticatedLayout>
  );
}
