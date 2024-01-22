import React from "react";

export function SelectInput({ value, onChange, options, label }) {
    return (
        <div className="selectInput">
            <a>{label}:</a>
            <select value={value} onChange={onChange}>
                <option value="">Selecione...</option>
                {options.map((option, index) => (
                    <option key={index} value={option.value}>
                        {option.label}
                    </option>
                ))}
            </select>
        </div>
    );
}

export function MultipleSelect({ values, onChange, options, label }) {
    return (
        <div className="multipleSelect">
            <a>{label}:</a>
            <div className="selects">
                {options.map((option, index) => (
                    <label key={index}>
                        <input
                            type="checkbox"
                            value={option.value}
                            checked={values.includes(option.value)}
                            onChange={(event) =>
                                onChange(event, option.value)
                            }
                        />
                        {option.label}
                    </label>
                ))}
            </div>
        </div>
    );
}

export function getFormConfig(formData, setFormData) {

    function handleCheckChange(event, setValue, field) {
        const value = event.target.value;
        setValue((prevState) => {
            const array = [...prevState[field]];
            if (event.target.checked) {
                array.push(value);
            } else {
                const index = array.indexOf(value);
                if (index !== -1) {
                    array.splice(index, 1);
                }
            }
            return { ...prevState, [field]: array };
        });
    };

    return {
        formSelectInput: [
            {
                value: formData.specie_id,
                setter: (val) =>
                    setFormData((prevState) => ({ ...prevState, specie_id: val })),
                options: [
                    { value: 1, label: "Canino" },
                    { value: 2, label: "Felino" },
                ],
                label: "Espécie",
            },
            {
                value: formData.gender_id,
                setter: (val) =>
                    setFormData((prevState) => ({ ...prevState, gender_id: val })),
                options: [
                    { value: 1, label: "Fêmea" },
                    { value: 2, label: "Macho" },
                ],
                label: "Sexo",
            },
            {
                value: formData.size_id,
                setter: (val) =>
                    setFormData((prevState) => ({ ...prevState, size_id: val })),
                options: [
                    { value: 1, label: "Pequeno" },
                    { value: 2, label: "Médio" },
                    { value: 3, label: "Grande" },
                ],
                label: "Porte",
            },
            {
                value: formData.life_stage_id,
                setter: (val) =>
                    setFormData((prevState) => ({
                        ...prevState,
                        life_stage_id: val,
                    })),
                options: [
                    { value: 1, label: "Filhote" },
                    { value: 2, label: "Adulto" },
                    { value: 3, label: "Idoso" },
                ],
                label: "Idade",
            },
        ],
        formMultipleSelect: [
            {
                values: formData.veterinary_cares,
                setter: (event) =>
                    handleCheckChange(event, setFormData, "veterinary_cares"),
                options: [
                    { value: "1", label: "Castrado" },
                    { value: "2", label: "Vacinado" },
                    { value: "3", label: "Vermifugado" },
                    { value: "4", label: "Precisa de cuidados especiais" },
                ],
                label: "Cuidados Veterinários",
            },
            {
                values: formData.temperaments,
                setter: (event) =>
                    handleCheckChange(event, setFormData, "temperaments"),
                options: [
                    { value: "1", label: "Agressivo" },
                    { value: "2", label: "Arisco" },
                    { value: "3", label: "Brincalhão" },
                    { value: "4", label: "Calmo" },
                    { value: "5", label: "Carente" },
                    { value: "6", label: "Dócil" },
                    { value: "7", label: "Independente" },
                    { value: "8", label: "Sociável" },
                ],
                label: "Temperamento(s)",
            },
            {
                values: formData.suitable_livings,
                setter: (event) =>
                    handleCheckChange(event, setFormData, "suitable_livings"),
                options: [
                    { value: "1", label: "Apartamento" },
                    { value: "2", label: "Apartamento telado" },
                    { value: "3", label: "Casa com quintal fechado" },
                ],
                label: "Vive bem em",
            },
            {
                values: formData.sociable_with,
                setter: (event) =>
                    handleCheckChange(event, setFormData, "sociable_with"),
                options: [
                    { value: "1", label: "Cachorros" },
                    { value: "2", label: "Gatos" },
                    { value: "3", label: "Crianças" },
                    { value: "4", label: "Pessoas desconhecidas" },
                ],
                label: "Sociável com",
            },
        ]
    };
}
