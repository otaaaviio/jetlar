import { HashRouter as Router, Route, Routes } from "react-router-dom";
import React from "react";
import { MantineProvider } from "@mantine/core";

import Login from "./components/auth/Login";
import Home from "./components/home/home";
import PetPage from "./components/Pet/PetPage";
import ManagePet from "./components/Pet/ManagePet";

const App = () => {
    return (
        <MantineProvider>
            <Router>
                <Routes>
                    <Route path="/" element={<Login />} />
                    <Route path="/home" element={<Home />} />
                    <Route path="/pets">
                        <Route path=":id" element={<PetPage />} />
                        <Route path=":id/edit" element={<ManagePet />} />
                        <Route path="new" element={<ManagePet />} />
                    </Route>
                </Routes>
            </Router>
        </MantineProvider>
    );
};

export default App;
