import React, { useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from "@/Components/TextInput";
import { CiCircleCheck } from "react-icons/ci";
import { PageProps } from '@/types';

export default function Start({ exerciseSessionData, auth }: PageProps) {
    const {session, type, category, problemSet, count } = exerciseSessionData;
    const id = session.id;
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
            header={<h2 className="major-mono-display-regular font-semibold text-xl text-[var(--primary-color)]">Exercise</h2>}
            >
            <div className="flex items-center justify-center">
                <Head title="Practice" />
                <div className="flex flex-col justify-center items-center mx-auto">
                    <h1 className="uppercase text-xl spline-sans-mono text-[var(--primary-color)] mt-5">{type}</h1>
                    <div className="flex-row mt-5">
                        <div className="border mb-10 p-5 rounded bg-blue-900">
                            <div className="flex flex-col">
                                <div className="flex justify-between">
                                    <PrimaryButton className="my-2 hover:bg-[var(--primary-color)] " onClick={goToPreviousProblem} disabled={isAtFirstProblem}>Previous</PrimaryButton>
                                    <PrimaryButton className="my-2 hover:bg-[var(--primary-color)] " onClick={goToNextProblem} disabled={isAtLastProblem}>Next</PrimaryButton>
                                </div>
                                <div className="flex ">
                                    <p className="major-mono-display-regular font-semibold text-white text-5xl text-center p-3">{problemSet[currentIndex]?.text}</p>
                                    <div className="flex">
                                        <TextInput value={inputValue} onChange={handleInputChange} className="text-left w-24" />
                                        <PrimaryButton className="rounded-full mx-3" onClick={checkAnswer}>
                                            <CiCircleCheck
                                            size="2.5rem"
                                            color="green"
                                            className="hover:border-2 hover:border-[var(--primary-color)] hover:bg-[var(--primary-color)] rounded-full"
                                            />
                                        </PrimaryButton>
                                    </div>
                                </div>
                                <div className="basis-1/4 content-center">
                                {hasAttempted && !result ? <p className="bg-blue-500 border-2 border-rose-600 my-2 rounded mx-2 text-center text-2xl text-rose-700">Incorrect!</p> : null}
                                {hasAttempted && result ?  <p className="bg-blue-300 border-2 border-lime-500 rounded my-2 text-center text-2xl text-lime-700">Correct</p> : null}
                                </div>
                            </div>
                            <div className="flex justify-end">
                                <div className="flex pt-5 pb-0">
                                    <PrimaryButton className="hover:bg-[var(--primary-color)]" >Submit {type}</PrimaryButton>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
