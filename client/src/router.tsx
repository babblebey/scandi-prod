import { createBrowserRouter } from "react-router-dom";
import Root from "./routes/Root" 
import Home from "./routes/Home";
import AddProduct from "./routes/AddProduct";

const router = createBrowserRouter([
    {
        path: '/',
        element: <Root />,
        children: [
            { path: '/', element: <Home /> },
            { path: '/add-product', element: <AddProduct /> }
        ]
    }
]);

export default router;