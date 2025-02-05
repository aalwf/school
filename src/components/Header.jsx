import { useState } from "react"; // import useState

// Komponen Header
const Header = () => {
    // State untuk input
    const [input, setInput] = useState("");

    // Tampilan Header
    return (
        <div id="todo-header" className="header">
            <h2>Simple Todo App</h2>
            <input type="text" value={""} onChange={""} />
            <span className="add-button" onClick={""}>
                Add
            </span>
        </div>
    );
};

export default Header;
