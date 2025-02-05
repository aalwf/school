import { useState } from "react"; // import useState

// Komponen Header
const Header = ({ setRefresh }) => {
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
            // ketika sukses menambah data, reset form dengan mengeset state title menjadi empty string
            setInput("");
            setRefresh(true); // mengubah state isRefresh yang ada di App.js menjadi true

            // Tampilkan alert pada saat sukses
            setTimeout(() => {
                alert("new todo added.");
            }, 500);
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
            <span className="add-button" onClick={addTodo}>
                Add
            </span>
        </div>
    );
};

export default Header;
