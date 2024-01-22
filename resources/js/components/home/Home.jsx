import React, { useEffect, useState } from "react";
import "../../../css/Home/home.css";
import api from "../../services/api";
import PetCard from "../Pet/PetCard";
import Header from "../utils/Header";
import Footer from "../utils/Footer";
import { useNavigate } from "react-router-dom";
import Pagination from "@mui/material/Pagination";
import LinearProgress from "@mui/material/LinearProgress";
import Filter from "../utils/Filter";

const Home = () => {
    const [pets, setPets] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [pageCount, setPageCount] = useState(0);
    const [isLoading, setIsLoading] = useState(false);
    const [activeFilter, setActiveFilter] = useState(false);
    const [searchBtn, setSearchBtn] = useState(true);
    const navigate = useNavigate();

    const [filters, setFilters] = useState({
        name: "",
        specie_id: [],
        gender_id: [],
        size_id: [],
        life_stage_id: [],
    });

    const updateFilter = (filter, value) => {
        setFilters((prevFilters) => {
            if (Array.isArray(prevFilters[filter])) {
                if (prevFilters[filter].includes(value)) {
                    return {
                        ...prevFilters,
                        [filter]: prevFilters[filter].filter(
                            (item) => item !== value
                        ),
                    };
                } else {
                    return {
                        ...prevFilters,
                        [filter]: [...prevFilters[filter], value],
                    };
                }
            } else {
                return {
                    ...prevFilters,
                    [filter]: value,
                };
            }
        });
    };

    const handlePageClick = (event, value) => {
        setCurrentPage(value);
    };

    useEffect(() => {
        const fetchPets = async () => {
            setActiveFilter(false);
            setIsLoading(true);

            const nonEmptyFilters = Object.fromEntries(
                Object.entries(filters).filter(([key, value]) => value.length > 0)
            );
            try {
                const response = await api.get("/user/pets", {
                    params: {
                        page: currentPage,
                        ...nonEmptyFilters,
                    },
                });
                setPets(response.data.data);
                setPageCount(response.data.meta.last_page);
            } catch (error) {
                console.error("Erro ao buscar pets: ", error);
            }
            setIsLoading(false);
        };

        fetchPets();
    }, [currentPage, searchBtn]);

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
                    <div className="navContainer">
                        <div className="btnsContainer">
                            <button
                                className="addBtn"
                                onClick={() => {
                                    navigate("/pets/new");
                                }}
                            >
                                Adicionar Pet
                            </button>
                            <button
                                onClick={() => setActiveFilter(!activeFilter)}
                            >
                                Filtro
                            </button>
                        </div>
                        {activeFilter && (
                            <Filter
                                filters={filters}
                                updateFilter={updateFilter}
                                searchBtn={searchBtn}
                                setSearchBtn={setSearchBtn}
                            />
                        )}
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
