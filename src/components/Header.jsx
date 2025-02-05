import { useState } from "react"; // import useState

// Komponen Header
const Header = () => {
    // State untuk input
    const [input, setInput] = useState("");

    // Fungsi untuk menambahkan todo
    const addTodo = () => {
        // Menyiapkan data baru
        const newTodo = { input, done: false };

        // Memanggil API untuk menambahkan todo
        fetch("http://localhost:8000/todos", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(newTodo),
        }).then(() => {
            // ketika sukses menambah data, reset form dengan mengeset state input menjadi empty string
            setInput("");
            console.log("new todo added.");
        });
    };

    // Tampilan Header
    return (
        <div id="todo-header" className="header">
            <h2>Simple Todo App</h2>
            <input
                type="text"
                value={input}
                onChange={(e) => setInput(e.target.value)}
            />
            <span className="add-button" onClick={""}>
                Add
            </span>
        </div>
    );
};

export default Header;
