import Checkbox from '@/Components/Checkbox';

export default function CheckboxFieldSet({ className = '', heading, checkboxData, handleChange, name, value }) {
  return (
    <>
      <h2 className="spline-sans-mono text-xl text-[var(--primary-color)]">{heading}</h2> 
      <fieldset className="flex">
        {checkboxData.map(checkbox => (
          <label className="flex p-5 items-center justify-center gap-1" key={checkbox.id}>
            <Checkbox
              name={name}
              value={checkbox.id}
              checked={checkbox.checked}
              onChange={handleChange}
            />
            {checkbox.title}
          </label>
        ))}
      </fieldset>
    </>
  );
}
