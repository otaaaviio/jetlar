import React, { useEffect } from "react";
import "../utils/styles.css";
import { ReactSVG } from "react-svg";
import search from "../../../../public/svg/search.svg";

const FilterOption = ({ name, options, filters, updateFilter, value }) => (
    <div className="filterOption">
        <a>{name}:</a>
        <div className="optionList">
            {options.map((option, index) => (
                <label key={index}>
                    <input
                        type="checkbox"
                        value={index + 1}
                        checked={filters[value].includes(index + 1)}
                        onChange={() => updateFilter(value, index + 1)}
                    />
                    {option}
                </label>
            ))}
        </div>
    </div>
);

const Filter = ({ filters, updateFilter, searchBtn, setSearchBtn }) => {
    const filterOptions = [
        { name: "Espécie", options: ["Canino", "Felino"], value: "specie_id" },
        { name: "Sexo", options: ["Fêmea", "Macho"], value: "gender_id" },
        {
            name: "Porte",
            options: ["Pequeno", "Médio", "Grande"],
            value: "size_id",
        },
        {
            name: "Idade",
            options: ["Filhote", "Adulto", "Idoso"],
            value: "life_stage_id",
        },
    ];

    useEffect(() => {
        const fetchName = async () => {
            try {
                const response = await api.get("/user/pets/names", {
                    params: {},
                });
            } catch (error) {
                console.error("Erro ao buscar nome dos pets: ", error);
            }
        };
    }, []);

    return (
        <div className="filter">
            <div className="nameFilter">
                <label>Nome:</label>
                <input
                    type="text"
                    value={filters.name}
                    onChange={(e) => updateFilter("name", e.target.value)}
                />
                <button onClick={() => setSearchBtn(!searchBtn)}>
                    <ReactSVG src={search} />
                </button>
            </div>
            <div className="selectsContainer">
                {filterOptions.map((option, index) => (
                    <FilterOption
                        key={index}
                        name={option.name}
                        options={option.options}
                        value={option.value}
                        filters={filters}
                        updateFilter={updateFilter}
                    />
                ))}
            </div>
            <div
                className="btnFilterContainer"
                onClick={() => setSearchBtn(!searchBtn)}
            >
                <button>Filtrar</button>
            </div>
        </div>
    );
};

export default Filter;
