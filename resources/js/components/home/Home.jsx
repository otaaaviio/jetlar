import React, { useEffect, useState } from "react";
import "../../../css/Home/home.css";
import api from "../../services/api";
import PetCard from "../Pet/PetCard";
import Header from "../utils/Header";
import Footer from "../utils/Footer";
import { useNavigate } from "react-router-dom";
import Pagination from "@mui/material/Pagination";
import LinearProgress from "@mui/material/LinearProgress";

const Home = () => {
    const [pets, setPets] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [isLoading, setIsLoading] = useState(false);
    const navigate = useNavigate();

    const handlePageClick = (event, value) => {
        setCurrentPage(value);
    };

    useEffect(() => {
        const fetchPets = async () => {
            setIsLoading(true);
            try {
                const response = await api.get(
                    `/user/pets?page=${currentPage}`
                );
                setPets(response.data.data);
                setPageCount(response.data.meta.last_page);
            } catch (error) {
                console.error("Erro ao buscar pets: ", error);
            }
            setIsLoading(false);
        };

        fetchPets();
    }, [currentPage]);

    return (
        <div className="bodyHome">
            <Header />
            {isLoading ? (
                <LinearProgress />
            ) : pets.length === 0 ? (
                <div className="noContent">
                    Não tem nada por aqui... Adicione um pet!
                </div>
            ) : (
                <div>
                    <div className="btnsContainer">
                        <button
                            className="addBtn"
                            onClick={() => {
                                navigate("/pets/new");
                            }}
                        >
                            Adicionar Pet
                        </button>
                        <button>Filtro</button>
                    </div>
                    <div className="petList">
                        {pets.map((pet) => (
                            <div key={pet.pet_id}>
                                <PetCard pet={pet} />
                            </div>
                        ))}
                    </div>
                </div>
            )}
            <div className="pagination">
                <Pagination
                    count={pageCount}
                    page={currentPage}
                    onChange={handlePageClick}
                    variant="outlined"
                    shape="rounded"
                />
            </div>
            <Footer />
        </div>
    );
};

export default Home;
