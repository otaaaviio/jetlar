import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import React from 'react';
import { MantineProvider } from '@mantine/core';

import Login from './components/auth/Login';

const App = () => {
  return (
    <MantineProvider>
      <Router>
        <Routes>
          <Route path="/" element={<Login />} />
        </Routes>
      </Router>
    </MantineProvider>
  );
};

export default App;
