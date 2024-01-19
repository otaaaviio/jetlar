import React, { useState } from "react";
import "../../../css/Pet/managePet.css";
import Header from "../utils/Header";
import Footer from "../utils/Footer";
import api from "../../services/api";

const ManagePet = () => {
    const [editing, setEditing] = useState(false);
    const [name, setName] = useState("");
    const [specie, setSpecie] = useState("");
    const [pet_photos, setPet_photos] = useState([]);
    const [gender, setGender] = useState("");
    const [size, setSize] = useState("");
    const [age, setAge] = useState("");
    const [veterinary_cares, setVeterinary_cares] = useState([]);
    const [temperament, setTemperament] = useState([]);
    const [suitable_livings, setSuitable_livings] = useState([]);
    const [sociable_with, setSociable_with] = useState([]);
    const [description, setDescription] = useState("");

    const handleAdd = async () => {
        const formData = new FormData();
        formData.append("name", name);
        formData.append("specie", specie);
        formData.append("gender", gender);
        formData.append("size", size);
        formData.append("age", age);
        formData.append("temperament", JSON.stringify(temperament));
        formData.append("description", description);

        veterinary_cares.forEach((care, index) => {
            formData.append(`veterinary_cares[${index}]`, care);
        });

        suitable_livings.forEach((living, index) => {
            formData.append(`suitable_livings[${index}]`, living);
        });

        sociable_with.forEach((sociable, index) => {
            formData.append(`sociable_with[${index}]`, sociable);
        });

        pet_photos.forEach((photo, index) => {
            formData.append(`pet_photos[${index}]`, photo);
        });

        try {
            const response = await api.post("/user/pets", formData);
            if (response.status == 201) {
            }
            console.log(response)
        } catch (error) {
            console.error("Erro durante o registro de pet:", error);
            alert("Erro durante o registro de pet");
        }
    };

    const handleCheckChange = ({ event, setValue }) => {
        const i = event.target.name;
        if (event.target.checked) {
            setValue((prevState) => [...prevState, i]);
        } else {
            setValue((prevState) => prevState.filter((item) => item !== i));
        }
    };

    return (
        <body className="managePet">
            <Header />
            <div className="manageContainer">
                <div className="centerContainer">
                    <div className="editInput">
                        <a>Nome:</a>
                        <input
                            required
                            type="text"
                            value={name}
                            onChange={(e) => {
                                setName(e.target.value);
                            }}
                        />
                    </div>
                    <div className="selectImages">
                        <a>Importar fotos:</a>
                        <input
                            type="file"
                            accept="image/*"
                            multiple
                            onChange={(e) => {
                                setPet_photos(Array.from(e.target.files));
                            }}
                        />
                    </div>
                    <div className="selectInput">
                        <a>Espécie:</a>
                        <select
                            value={specie}
                            onChange={(e) => {
                                setSpecie(e.target.value);
                            }}
                        >
                            <option value="">Selecione...</option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                        </select>
                    </div>
                    <div className="selectInput">
                        <a>Sexo:</a>
                        <select
                            value={gender}
                            onChange={(e) => {
                                setGender(e.target.value);
                            }}
                        >
                            <option value="">Selecione...</option>
                            <option value="Fêmea">Fêmea</option>
                            <option value="Macho">Macho</option>
                        </select>
                    </div>
                    <div className="selectInput">
                        <a>Porte:</a>
                        <select
                            value={size}
                            onChange={(e) => {
                                setSize(e.target.value);
                            }}
                        >
                            <option value="">Selecione...</option>
                            <option value="Pequeno">Pequeno</option>
                            <option value="Médio">Médio</option>
                            <option value="Grande">Grande</option>
                        </select>
                    </div>
                    <div className="selectInput">
                        <a>Idade:</a>
                        <select
                            value={age}
                            onChange={(e) => {
                                setAge(e.target.value);
                            }}
                        >
                            <option value="">Selecione...</option>
                            <option value="Filhote">Filhote</option>
                            <option value="Adulto">Adulto</option>
                            <option value="Idoso">Idoso</option>
                        </select>
                    </div>
                    <div className="multipleSelect">
                        <a>Cuidados Veterinários:</a>
                        <div className="selects">
                            <label>
                                <input
                                    type="checkbox"
                                    id="Castrado"
                                    name="Castrado"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setVeterinary_cares,
                                        })
                                    }
                                />
                                Castrado
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Vacinado"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setVeterinary_cares,
                                        })
                                    }
                                />
                                Vacinado
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Vermifugado"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setVeterinary_cares,
                                        })
                                    }
                                />
                                Vermifugado
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Precisa de cuidados Especiais"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setVeterinary_cares,
                                        })
                                    }
                                />
                                Precisa de cuidados Especiais
                            </label>
                        </div>
                    </div>
                    <div className="selectInput">
                        <a>Temperamento:</a>
                        <select
                            value={temperament}
                            onChange={(e) => {
                                setTemperament(e.target.value);
                            }}
                        >
                            <option value="">Selecione...</option>
                            <option value="Agressivo">Agressivo</option>
                            <option value="Arisco">Arisco</option>
                            <option value="Brincalhão">Brincalhão</option>
                            <option value="Calmo">Calmo</option>
                            <option value="Carente">Carente</option>
                            <option value="Dócil">Dócil</option>
                            <option value="Independente">Independente</option>
                            <option value="Sociável">Sociável</option>
                        </select>
                    </div>
                    <div className="multipleSelect">
                        <a>Vive bem em:</a>
                        <div className="selects">
                            <label>
                                <input
                                    type="checkbox"
                                    name="Apartamento"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSuitable_livings,
                                        })
                                    }
                                />
                                Apartamento
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Apartamento Telado"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSuitable_livings,
                                        })
                                    }
                                />
                                Apartamento Telado
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Casa com quintal fechado"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSuitable_livings,
                                        })
                                    }
                                />
                                Casa com quintal fechado
                            </label>
                        </div>
                    </div>
                    <div className="multipleSelect">
                        <a>Sociável com:</a>
                        <div className="selects">
                            <label>
                                <input
                                    type="checkbox"
                                    name="Cachorros"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSociable_with,
                                        })
                                    }
                                />
                                Cachorros
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Gatos"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSociable_with,
                                        })
                                    }
                                />
                                Gatos
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Crianças"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSociable_with,
                                        })
                                    }
                                />
                                Crianças
                            </label>
                            <label>
                                <input
                                    type="checkbox"
                                    name="Pessoas desconhecidas"
                                    onChange={(event) =>
                                        handleCheckChange({
                                            event,
                                            setValue: setSociable_with,
                                        })
                                    }
                                />
                                Pessoas desconhecidas
                            </label>
                        </div>
                    </div>
                    <div className="historyInput">
                        <a>Histórico/Descrição(opcional):</a>
                        <textarea
                            type="text"
                            value={description}
                            onChange={(e) => {
                                setDescription(e.target.value);
                            }}
                        />
                    </div>
                    <div className="addPet">
                        <button onClick={handleAdd}>Registrar Pet</button>
                    </div>
                </div>
            </div>
            <Footer />
        </body>
    );
};

export default ManagePet;
