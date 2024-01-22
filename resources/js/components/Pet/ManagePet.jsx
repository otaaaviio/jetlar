import React, { useEffect, useState } from "react";
import "../../../css/Pet/managePet.css";
import Header from "../utils/Header";
import Footer from "../utils/Footer";
import api from "../../services/api";
import { useNavigate, useParams } from "react-router-dom";
import { MultipleSelect, SelectInput, getFormConfig } from "./selects";
import Snackbar from "@mui/material/Snackbar";

const ManagePet = () => {
    const navigate = useNavigate();
    const pet = useParams();
    const [openSnackBar, setOpenSnackBar] = useState(false);
    const editing = Object.keys(pet).length > 0 ? true : false;

    const [formData, setFormData] = useState({
        name: "",
        specie_id: "",
        gender_id: "",
        size_id: "",
        life_stage_id: "",
        description: "",
        pet_images: [],
        veterinary_cares: [],
        temperaments: [],
        suitable_livings: [],
        sociable_with: [],
    });

    useEffect(() => {
        const fetchPets = async () => {
            if (Object.keys(pet).length === 0) {
                return;
            }

            try {
                const id = pet.id;
                const response = await api.get(`/user/pets_detailed/${id}`);
                let data = response.data.data;

                if (data.description === null) {
                    data.description = "";
                }

                setFormData(data);
            } catch (error) {
                console.error("Erro ao buscar pet: ", error);
            }
        };

        fetchPets();
    }, [pet]);

    const { formSelectInput, formMultipleSelect } = getFormConfig(
        formData,
        setFormData
    );

    const handleAdd = async () => {
        const data = new FormData();
        Object.keys(formData).forEach((key) => {
            if (Array.isArray(formData[key])) {
                formData[key].forEach((item, index) => {
                    data.append(`${key}[${index}]`, item);
                });
            } else {
                data.append(key, formData[key]);
            }
        });

        try {
            let response;
            if (editing) {
                const id = pet.id;
                response = await api.put(`/user/pets/${id}`, data);
            } else {
                response = await api.post(`/user/pets/`, data);
            }

            if (response.status === 201 || response.status === 200) {
                const id = response.data.data.pet_id;
                navigate("/pets/" + id);
            }
        } catch (error) {
            console.error("Erro durante o registro de pet:", error);
            alert("Erro durante o registro de pet");
        }
    };

    return (
        <div className="bodyManagePet">
            <Header />
            <div className="manageContainer">
                <div className="centerContainer">
                    <div className="editInput">
                        <a>Nome:</a>
                        <input
                            required
                            type="text"
                            value={formData.name}
                            onChange={(e) => {
                                setFormData((prevState) => ({
                                    ...prevState,
                                    name: e.target.value,
                                }));
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
                                    setFormData((prevState) => ({
                                        ...prevState,
                                        pet_images: Array.from(e.target.files),
                                    }));
                                }}
                            />
                        </div>
                    
                    {formSelectInput.map((field, index) => (
                        <SelectInput
                            key={index}
                            value={field.value}
                            onChange={(e) => field.setter(e.target.value)}
                            options={field.options}
                            label={field.label}
                        />
                    ))}
                    {formMultipleSelect.map((field, index) => (
                        <MultipleSelect
                            key={index}
                            values={field.values}
                            onChange={field.setter}
                            options={field.options}
                            label={field.label}
                        />
                    ))}
                    <div className="historyInput">
                        <a>Histórico/Descrição(opcional):</a>
                        <textarea
                            type="text"
                            value={formData.description}
                            onChange={(e) => {
                                setFormData((prevState) => ({
                                    ...prevState,
                                    description: e.target.value,
                                }));
                            }}
                        />
                    </div>
                    <div className="addPet">
                        <button
                            onClick={() => {
                                if (
                                    formData.name &&
                                    formData.specie_id &&
                                    formData.gender_id &&
                                    formData.size_id &&
                                    formData.life_stage_id &&
                                    formData.pet_images.length > 0 &&
                                    formData.veterinary_cares.length > 0 &&
                                    formData.temperaments.length > 0 &&
                                    formData.suitable_livings.length > 0 &&
                                    formData.sociable_with.length > 0
                                ) {
                                    handleAdd();
                                } else {
                                    setOpenSnackBar(true);
                                }
                            }}
                        >
                            {editing ? "Finalizar Edição" : "Registrar Pet"}
                        </button>
                    </div>
                </div>
            </div>
            <Snackbar
                anchorOrigin={{ vertical: "top", horizontal: "center" }}
                open={openSnackBar}
                onClose={() => setOpenSnackBar(false)}
                message="Preencha todos os campos corretamente!"
                autoHideDuration={6000}
            />
            <Footer />
        </div>
    );
};

export default ManagePet;
