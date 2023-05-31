import React from 'react'
import ReactDOM from 'react-dom/client'
import { RouterProvider } from "react-router-dom";
import { MainContextProvider } from "./context/MainContext";
import router from "./router";

import 'bootstrap/dist/css/bootstrap.min.css';
import './index.css'

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
    <MainContextProvider>
        <React.StrictMode>
            <RouterProvider router={router} />
        </React.StrictMode>
    </MainContextProvider>,
)
