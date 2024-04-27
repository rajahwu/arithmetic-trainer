import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import { PageProps } from '@/types';


export default function Practice({ problems, auth }: PageProps) {
    // State to track the index of the current problem
    const [currentIndex, setCurrentIndex] = useState(0);

    // Function to move to the next problem
    const goToNextProblem = () => {
        setHasAttempted(false);
        setCurrentIndex(prevIndex => prevIndex + 1);
        setInputValue(''); // Reset input value for the new problem
        setResult(false); // Reset result for the new problem
    };
    
    // Function to move to the previous problem
    const goToPreviousProblem = () => {
        setHasAttempted(false);
        setCurrentIndex(prevIndex => prevIndex - 1);
        setInputValue(''); // Reset input value for the new problem
        setResult(false); // Reset result for the new problem
    };
    
    // Function to handle input change
    const handleInputChange = (e) => {
        setHasAttempted(false);
        setInputValue(e.target.value);
    };

    // Get the current problem and category based on the currentIndex
    const problem = problems[currentIndex];
    const category = problem.category.split(',');

    // State for input value and result
    const [inputValue, setInputValue] = useState('');
    const [result, setResult] = useState(false);
    const [hasAttempted, setHasAttempted] = useState(false);

    // Function to check the answer
    const checkAnswer = () => {
        setResult(inputValue === problem.solution);
        setHasAttempted(true);
    };

    // Boolean variables to disable buttons at the start and end of the problem list
    const isAtFirstProblem = currentIndex === 0;
    const isAtLastProblem = currentIndex === problems.length - 1;



    return (
        <AuthenticatedLayout 
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise</h2>}
        >

        <div className="flex m-10">
            <Head title="Practice" />
            <div className="">
                <h1>Practice</h1>
                <div className="flex-row">
                    <div className="">
                        {category.map((element, index) => (
                            <span className="p-3 uppercase" key={index}>{element}</span>
                        ))}
                    </div>
                    <div className="flex">
                        <p className="p-3">{problem.text}</p>
                        <div className="flex">
                            <TextInput value={inputValue} onChange={handleInputChange} className="" />
                            <PrimaryButton className="m-2" onClick={checkAnswer}>Check</PrimaryButton>
                            <PrimaryButton className="m-2" onClick={goToPreviousProblem} disabled={isAtFirstProblem}>Previous</PrimaryButton>
                            <PrimaryButton className="m-2" onClick={goToNextProblem} disabled={isAtLastProblem}>Next</PrimaryButton>
                        </div>
                    </div>
                    {/* Display "Incorrect" only if the question has been attempted */}
                    <p className="text-center">{hasAttempted && !result ? 'Incorrect!' : ''}</p>
                    <p className="text-center">{hasAttempted && result ? 'Correct' : ''}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    );
}
