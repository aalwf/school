import { useEffect, useState } from "react"; // import useEffect dan useState
import TodoItem from "./TodoItem"; // import komponen TodoItem

// Komponen List
const TodoList = () => {
    // State untuk todos
    const [todos, setTodos] = useState([]);

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
