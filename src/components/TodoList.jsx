import TodoItem from "./TodoItem"; // import komponen TodoItem

// Komponen List
const TodoList = () => {
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
