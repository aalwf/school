import { useEffect, useState } from "react"; // import useEffect dan useState
import TodoItem from "./TodoItem"; // import komponen TodoItem

// Komponen List
const TodoList = ({ isRefresh, setRefresh }) => {
    // State untuk todos
    const [todos, setTodos] = useState([]);

    // Menyiapkan useEffect untuk mengambil data todos pada saat komponen dimuat
    useEffect(() => {
        // Jika state isRefresh bernilai true (berarti ada perubahan data todos)
        if (isRefresh) {
            // Memanggil API untuk mengambil data todos
            fetch("http://localhost:8000/todos")
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    // Ketika Rest API sukses, reset state isRefresh
                    setRefresh(false);

                    // ketika Rest API sukses, simpan data dari response ke dalam state lokal
                    setTodos(data);
                })
                .catch((err) => {
                    // ketika Rest API gagal, reset state isRefresh
                    setRefresh(false);

                    // ketika Rest API gagal, tampilkan pesan kesalahan
                    if (err.name === "AbortError") {
                        console.log("fetch aborted.");
                    }
                });
        }
    }, [isRefresh, setRefresh]);

    return (
        <ul id="todo-list">
            {/* Memanggil komponen TodoItem untuk setiap todo yang didapatkan dari API */}
            {todos.map((todo) => (
                <TodoItem todo={todo} key={todo.id} setRefresh={setRefresh} />
            ))}
        </ul>
    );
};

export default TodoList;
