//import react router dom
import { Routes, Route } from "react-router-dom";

//import view homepage
import Home from "../views/home.jsx";

//import view posts index
import PostIndex from "../views/posts/index.jsx";

//import view post create
import PostCreate from "../views/posts/create.jsx";

//import view post edit
import PostEdit from "../views/posts/edit.jsx";

// Mendefiniskan Route
function RoutesIndex() {
    return (
        <Routes>
            {/* Home view */}
            <Route path="/" element={<Home />} />

            {/* Posts view */}
            <Route path="/posts" element={<PostIndex />} />

            {/* Post Create view */}
            <Route path="/posts/create" element={<PostCreate />} />

            {/* Post Edit view */}
            <Route path="/posts/edit/:id" element={<PostEdit />} />
        </Routes>
    );
}

export default RoutesIndex;
