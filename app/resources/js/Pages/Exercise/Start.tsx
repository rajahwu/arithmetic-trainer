import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import { PageProps } from '@/types';

export default function Start({ id, selected, problemSet, auth }: PageProps) {

    const [currentIndex, setCurrentIndex] = useState(0);
    const [inputValue, setInputValue] = useState('');
    const [result, setResult] = useState(false);
    const [hasAttempted, setHasAttempted] = useState(false);

    const goToNextProblem = () => {
        setHasAttempted(false);
        setCurrentIndex(prevIndex => prevIndex + 1);
        setInputValue('');
        setResult(false);
    };
    
    const goToPreviousProblem = () => {
        setHasAttempted(false);
        setCurrentIndex(prevIndex => prevIndex - 1);
        setInputValue('');
        setResult(false);
    };
    
    const handleInputChange = (e) => {
        setHasAttempted(false);
        setInputValue(e.target.value);
    };

    const checkAnswer = () => {
        setResult(inputValue === problemSet[currentIndex].solution);
        setHasAttempted(true);
    };

    const isAtFirstProblem = currentIndex === 0;
    const isAtLastProblem = currentIndex === problemSet.length - 1;

    return (
        <AuthenticatedLayout 
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Exercise</h2>}
        >
            <div className="flex m-10">
                <Head title="Practice" />
                <div className="">
                    <h1 className="uppercase text-blue-700">{selected}/{id}</h1>
                    <div className="flex-row">
                        <div className="">
                            {/* Check if category exists before rendering */}
                            {problemSet[currentIndex]?.category && problemSet[currentIndex]?.category.map((element, index) => (
                                <span className="p-3 uppercase" key={index}>{element}</span>
                            ))}
                        </div>
                        <div className="flex">
                            <p className="p-3">{problemSet[currentIndex]?.text}</p>
                            <div className="flex">
                                <TextInput value={inputValue} onChange={handleInputChange} className="" />
                                <PrimaryButton className="m-2" onClick={checkAnswer}>Check</PrimaryButton>
                                <PrimaryButton className="m-2" onClick={goToPreviousProblem} disabled={isAtFirstProblem}>Previous</PrimaryButton>
                                <PrimaryButton className="m-2" onClick={goToNextProblem} disabled={isAtLastProblem}>Next</PrimaryButton>
                            </div>
                        </div>
                        <p className="text-center">{hasAttempted && !result ? 'Incorrect!' : ''}</p>
                        <p className="text-center">{hasAttempted && result ? 'Correct' : ''}</p>
                    </div>
                </div>
            </div>
            <div className="mx-16">
                <PrimaryButton>Submit</PrimaryButton>
            </div>
        </AuthenticatedLayout>
    );
}
