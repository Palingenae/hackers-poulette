import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './assets/styles/styles.scss';
import { BrowserRouter, Route, Routes } from "react-router";
import SubmitTicket from "./pages/SubmitTicket.tsx";
import Homepage from "./pages/Homepage.tsx";

createRoot(document.getElementById('root')!).render(
  <StrictMode>
    <BrowserRouter>
        <Routes>
            <Route path='/' element={<Homepage />}/>
            <Route path='/submit-ticket' element={<SubmitTicket />}/>
        </Routes>
    </BrowserRouter>
  </StrictMode>
)
