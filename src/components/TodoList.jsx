import { useEffect, useState } from "react"; // import useEffect dan useState
import TodoItem from "./TodoItem"; // import komponen TodoItem

// Komponen List
const TodoList = () => {
    // State untuk todos
    const [todos, setTodos] = useState([]);

    // Menyiapkan useEffect untuk mengambil data todos pada saat komponen dimuat
    useEffect(() => {
        // Memanggil API untuk mengambil data todos
        fetch("http://localhost:8000/todos")
            .then((res) => {
                return res.json();
            })
            .then((data) => {
                // ketika Rest API sukses, simpan data dari response ke dalam state lokal
                setTodos(data);
            })
            .catch((err) => {
                // ketika Rest API gagal, tampilkan pesan kesalahan
                if (err.name === "AbortError") {
                    console.log("fetch aborted.");
                }
            });
    }, []);

    return (
        <ul id="todo-list">
            {/* Memanggil komponen TodoItem */}
            <TodoItem />
            <TodoItem />
            <TodoItem />
        </ul>
    );
};

export default TodoList;
