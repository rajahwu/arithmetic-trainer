import NumberInput from '@/Components/NumberInput';

export default function NumberProblemsInputFieldSet({ className = '', heading, problemData, handleChange, ...props }) {
  return (
    <fieldset>
        <h2 className="spline-sans-mono text-xl text-[var(--primary-color)]">Total Problem Count</h2> 
        <label className="flex flex-col p-3">
            {heading}
        <NumberInput
            type="number"
            name="problem_count"
            value={props.value}
            onChange={props.onChange}
        />
      </label>
  </fieldset>
  );
}